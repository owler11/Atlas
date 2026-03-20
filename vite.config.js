/**
 * Enhanced Vite configuration for WordPress
 * Includes linting, legacy support, and optimizations
 *
 * @since 2.0.0
 */
import { defineConfig } from "vite";
import { resolve } from "path";
import { readFileSync, existsSync } from "fs";
import legacy from "@vitejs/plugin-legacy";

// Optional HTTPS for dev (so https://atlas.local:8890 can load assets). Uses mkcert certs in .vite-certs/
const certDir = resolve(process.cwd(), ".vite-certs");
const certPairs = [
  {
    key: resolve(certDir, "localhost-key.pem"),
    cert: resolve(certDir, "localhost.pem"),
  },
  {
    key: resolve(certDir, "localhost+1-key.pem"),
    cert: resolve(certDir, "localhost+1.pem"),
  },
];
const certPair = certPairs.find((p) => existsSync(p.key) && existsSync(p.cert));
const httpsConfig = certPair
  ? { key: readFileSync(certPair.key), cert: readFileSync(certPair.cert) }
  : null;
const useHttps = !!httpsConfig;

// Conditionally import linting plugins
let eslintPlugin = null;
let stylelintPlugin = null;

try {
  eslintPlugin = (await import("vite-plugin-eslint")).default;
} catch (e) {
  console.log(
    "ESLint plugin not available - install vite-plugin-eslint to enable"
  );
}

try {
  stylelintPlugin = (await import("vite-plugin-stylelint")).default;
} catch (e) {
  console.log(
    "Stylelint plugin not available - install vite-plugin-stylelint to enable"
  );
}

// Project configuration
const projectConfig = {
  // Dev server – use http://localhost:3000 in the browser; Vite proxies to WordPress
  devServer: {
    host: "localhost",
    port: 3000,
    proxyTarget: "https://atlas.local:8890", // WordPress URL
    proxyHeader: "X-Atlas-Vite",
    open: false,
  },

  css: { use: "sass" },
  js: { eslint: true, legacy: false },
};

/**
 * Proxy config: forward to WordPress, add header for PHP, rewrite HTML so links stay on localhost (HMR works).
 * Standard pattern for Vite: selfHandleResponse + proxyRes (see Vite proxy docs / SO 75459489).
 */
function wpProxyConfig(devServer, useHttps = false) {
  if (!devServer.proxyTarget) return undefined;
  const protocol = useHttps ? "https" : "http";
  const localUrl = `${protocol}://${devServer.host}:${devServer.port}`;
  const wpUrl = devServer.proxyTarget.replace(/\/$/, "");
  const wpUrlHttp = wpUrl.replace("https://", "http://");
  const escapeRe = (s) => s.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
  const re = new RegExp(`${escapeRe(wpUrl)}|${escapeRe(wpUrlHttp)}`, "g");

  return {
    "^/(?!@vite|@id|assets/src|node_modules)": {
      target: devServer.proxyTarget,
      changeOrigin: true,
      secure: false,
      headers: { [devServer.proxyHeader]: "1" },
      selfHandleResponse: true,
      configure(proxy) {
        proxy.on("proxyRes", (proxyRes, req, res) => {
          const ct = proxyRes.headers["content-type"] || "";
          if (ct.includes("text/html")) {
            const chunks = [];
            proxyRes.on("data", (c) => chunks.push(c));
            proxyRes.on("end", () => {
              res.end(Buffer.concat(chunks).toString().replace(re, localUrl));
            });
          } else {
            proxyRes.pipe(res);
          }
        });
      },
    },
  };
}

export default defineConfig(({ command, mode }) => {
  const isDev = mode === "development";
  const isProd = mode === "production";

  return {
    // Base configuration
    base: isDev ? "/" : "/assets/public/",

    // Build configuration
    build: {
      outDir: "assets/public",
      emptyOutDir: true,
      manifest: "manifest.json", // Specify exact filename to avoid .vite subdirectory
      rollupOptions: {
        input: {
          frontend: resolve(process.cwd(), "assets/src/js/frontend.js"),
          backend: resolve(process.cwd(), "assets/src/js/backend.js"),
        },
        output: {
          entryFileNames: "js/[name].js",
          chunkFileNames: "js/[name]-[hash].js",
          inlineDynamicImports: false,
          manualChunks: () => null,
          assetFileNames: (assetInfo) => {
            const extType = assetInfo.name?.split(".").pop();
            if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
              return "images/[name][extname]";
            }
            if (extType === "css") {
              return "css/[name][extname]";
            }
            return "assets/[name]-[hash][extname]";
          },
        },
      },
      sourcemap: isDev,
      minify: isProd,
      // Handle static assets properly
      assetsInlineLimit: 0, // Don't inline any assets
      copyPublicDir: false, // Don't copy public directory
    },

    // Dev server configuration
    server: {
      host: projectConfig.devServer.host,
      port: projectConfig.devServer.port,
      open: projectConfig.devServer.open,
      cors: true,
      hmr: {
        overlay: false, // Disable error overlay temporarily
        protocol: "ws",
        timeout: 30000,
        clientPort: 3000, // This can help reduce flash
      },
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
        "Access-Control-Allow-Headers": "*",
      },
    },

    // CSS configuration
    css: {
      preprocessorOptions: {
        scss: {
          quietDeps: true, // Suppress @import deprecation warnings
          silenceDeprecations: ["legacy-js-api", "import"],
        },
      },
      devSourcemap: isDev,
    },

    // Resolve configuration
    resolve: {
      alias: {
        "@": resolve(process.cwd(), "assets/src"),
        "@sass": resolve(process.cwd(), "assets/src/sass"),
        "@js": resolve(process.cwd(), "assets/src/js"),
        "@images": resolve(process.cwd(), "assets/src/images"),
      },
    },

    // Optimizations
    optimizeDeps: {
      include: ["jquery", "gsap", "magnific-popup", "slick-carousel"], // Added common dependencies
    },

    // Plugins array
    plugins: [
      // ESLint integration (development only)
      ...(isDev && projectConfig.js.eslint && eslintPlugin
        ? [
            eslintPlugin({
              include: ["assets/src/js/**/*.js"],
              exclude: ["node_modules/**", "assets/public/**"],
              cache: false,
              overrideConfigFile: resolve(
                process.cwd(),
                "config/.eslintrc.cjs"
              ),
              emitWarning: true, // Make errors warnings instead
              emitError: false,
            }),
          ]
        : []),

      // Stylelint integration (development only) - temporarily disabled
      // ...(isDev && stylelintPlugin ? [stylelintPlugin({
      //   include: ['assets/src/**/*.{css,scss,sass}'],
      //   exclude: ['node_modules/**', 'assets/public/**'],
      //   configFile: resolve(process.cwd(), 'config/.stylelintrc.cjs')
      // })] : []),

      // Legacy browser support
      ...(projectConfig.js.legacy
        ? [
            legacy({
              targets: ["defaults", "not IE 11"],
            }),
          ]
        : []),
    ],

    // Handle static assets during development
    publicDir: false, // Don't auto-copy public directory

    // Development: with .vite-certs/ (mkcert), uses HTTPS so https://atlas.local:8890 can load dev assets
    ...(isDev && {
      server: {
        host: projectConfig.devServer.host,
        port: projectConfig.devServer.port,
        strictPort: true,
        ...(httpsConfig && { https: httpsConfig }),
        open: projectConfig.devServer.open,
        cors: true,
        hmr: {
          overlay: false,
          protocol: useHttps ? "wss" : "ws",
          host: "localhost",
          port: 3000,
          clientPort: 3000,
          timeout: 30000,
        },
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
          "Access-Control-Allow-Headers": "*",
        },
        proxy: wpProxyConfig(projectConfig.devServer, useHttps),
        middlewares: [
          (req, res, next) => {
            if (req.url?.startsWith("/assets/src/images/")) {
              req.url = req.url.replace(
                "/assets/src/images/",
                "/assets/public/images/"
              );
            }
            next();
          },
        ],
      },
    }),
  };
});
