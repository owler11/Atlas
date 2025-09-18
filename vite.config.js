/**
 * Enhanced Vite configuration for WordPress
 * Includes linting, legacy support, and optimizations
 *
 * @since 2.0.0
 */
import { defineConfig } from 'vite'
import { resolve } from 'path'
import legacy from '@vitejs/plugin-legacy'

// Conditionally import linting plugins
let eslintPlugin = null;
let stylelintPlugin = null;

try {
  eslintPlugin = (await import('vite-plugin-eslint')).default;
} catch (e) {
  console.log('ESLint plugin not available - install vite-plugin-eslint to enable');
}

try {
  stylelintPlugin = (await import('vite-plugin-stylelint')).default;
} catch (e) {
  console.log('Stylelint plugin not available - install vite-plugin-stylelint to enable');
}

// Project configuration
const projectConfig = {
  // Dev server settings (equivalent to BrowserSync)
  devServer: {
    host: 'localhost',
    port: 3000,
    proxy: 'https://atlas.local', // Your WordPress site URL
    open: false
  },
  
  // CSS settings
  css: {
    use: 'sass' // sass 
  },
  
  // JS settings
  js: {
    eslint: true, // Disable ESLint to test build process
    legacy: true
  }
}

export default defineConfig(({ command, mode }) => {
  const isDev = mode === 'development'
  const isProd = mode === 'production'

  return {
    // Base configuration
    base: isDev ? '/' : '/assets/public/',
    
    // Build configuration
    build: {
      outDir: 'assets/public',
      emptyOutDir: true,
      manifest: 'manifest.json', // Specify exact filename to avoid .vite subdirectory
      rollupOptions: {
        input: {
          frontend: resolve(process.cwd(), 'assets/src/js/frontend.js'),
          backend: resolve(process.cwd(), 'assets/src/js/backend.js')
        },
        output: {
          entryFileNames: 'js/[name].js',
          chunkFileNames: 'js/[name]-[hash].js',
          manualChunks: () => 'everything', // Prevents orphan files from being created
          assetFileNames: (assetInfo) => {
            const extType = assetInfo.name?.split('.').pop()
            if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
              return 'images/[name][extname]'
            }
            if (extType === 'css') {
              return 'css/[name][extname]'
            }
            return 'assets/[name]-[hash][extname]'
          }
        }
      },
      sourcemap: isDev,
      minify: isProd,
      // Handle static assets properly
      assetsInlineLimit: 0, // Don't inline any assets
      copyPublicDir: false // Don't copy public directory
    },

    // Dev server configuration
    server: {
      host: projectConfig.devServer.host,
      port: projectConfig.devServer.port,
      open: projectConfig.devServer.open,
      cors: true,
      hmr: {
        overlay: false // Disable error overlay temporarily
      },
      headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': 'GET, POST, OPTIONS',
        'Access-Control-Allow-Headers': '*'
      }
    },

    // CSS configuration
    css: {
      preprocessorOptions: {
        scss: {
          quietDeps: true, // Suppress @import deprecation warnings
          silenceDeprecations: ['legacy-js-api', 'import']
        }
      },
      devSourcemap: isDev
    },

    // Resolve configuration
    resolve: {
      alias: {
        '@': resolve(process.cwd(), 'assets/src'),
        '@sass': resolve(process.cwd(), 'assets/src/sass'),
        '@js': resolve(process.cwd(), 'assets/src/js'),
        '@images': resolve(process.cwd(), 'assets/src/images'),
      }
    },

    // Optimizations
    optimizeDeps: {
      include: ['jquery', 'gsap', 'magnific-popup', 'slick-carousel'] // Added common dependencies
    },

    // Plugins array
    plugins: [
      // ESLint integration (development only)
      ...(isDev && projectConfig.js.eslint && eslintPlugin ? [eslintPlugin({
        include: ['assets/src/js/**/*.js'],
        exclude: ['node_modules/**', 'assets/public/**'],
        cache: false,
        overrideConfigFile: resolve(process.cwd(), 'config/.eslintrc.cjs'),
        emitWarning: true, // Make errors warnings instead
        emitError: false
      })] : []),

      // Stylelint integration (development only) - temporarily disabled
      // ...(isDev && stylelintPlugin ? [stylelintPlugin({
      //   include: ['assets/src/**/*.{css,scss,sass}'],
      //   exclude: ['node_modules/**', 'assets/public/**'],
      //   configFile: resolve(process.cwd(), 'config/.stylelintrc.cjs')
      // })] : []),

      // Legacy browser support
      ...(projectConfig.js.legacy ? [legacy({
        targets: ['defaults', 'not IE 11']
      })] : [])
    ],

    // Handle static assets during development
    publicDir: false, // Don't auto-copy public directory
    
    // Serve static assets from multiple locations during development
    ...(isDev && {
      server: {
        ...projectConfig.devServer,
        cors: true,
        headers: {
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Methods': 'GET, POST, OPTIONS',
          'Access-Control-Allow-Headers': '*'
        },
        // Serve images from existing public directory during dev
        middlewares: [
          (req, res, next) => {
            
            // Handle image requests  
            if (req.url?.startsWith('/assets/src/images/')) {
              const imagePath = req.url.replace('/assets/src/images/', '/assets/public/images/');
              req.url = imagePath;
            }
            next();
          }
        ]
      }
    })
  }
})