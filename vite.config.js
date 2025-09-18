/**
 * Simple Working Vite configuration for WordPress
 * Start with this basic setup, then add plugins as needed
 *
 * @since 2.0.0
 */
import { defineConfig } from 'vite'
import { resolve } from 'path'

// Project configuration
const projectConfig = {
  // Dev server settings (equivalent to BrowserSync)
  devServer: {
    host: 'localhost',
    port: 3000,
    proxy: 'https://atlas.local', // Change this to your WordPress site URL
    open: false
  },
  
  // CSS settings
  css: {
    use: 'sass' // sass 
  },
  
  // JS settings
  js: {
    eslint: false, // Set to true once ESLint is properly configured
    legacy: true
  },
  
  // Images settings
  images: {
    optimize: false // Set to true once image plugin is properly installed
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
      manifest: true,
      rollupOptions: {
        input: {
          frontend: resolve(process.cwd(), 'assets/src/js/frontend.js'),
          backend: resolve(process.cwd(), 'assets/src/js/backend.js')
        },
        output: {
          entryFileNames: 'js/[name].js',
          chunkFileNames: 'js/[name]-[hash].js',
          assetFileNames: (assetInfo) => {
            const extType = assetInfo.name?.split('.').pop()
            if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
              return 'images/[name][extname]'
            }
            if (/woff|woff2|eot|ttf|otf/i.test(extType)) {
              // Preserve font folder structure
              const info = assetInfo.name || '';
              const pathParts = info.split('/');
              if (pathParts.length > 1) {
                // If font is in a subfolder, preserve it
                return `fonts/${pathParts.slice(-2).join('/')}`; // Keep last folder + filename
              }
              return 'fonts/[name][extname]'
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
          // Update path to match your actual Sass folder structure
          // additionalData: `@import "${resolve(process.cwd(), 'assets/src/sass/_variables.scss')}";`,
        }
      },
      devSourcemap: isDev
    },

    // Resolve configuration
    resolve: {
      alias: {
        '@': resolve(process.cwd(), 'assets/src'),
        '@sass': resolve(process.cwd(), 'assets/src/sass'), // Updated to match your structure
        '@js': resolve(process.cwd(), 'assets/src/js'),
        '@images': resolve(process.cwd(), 'assets/src/images')
      }
    },

    // Optimizations
    optimizeDeps: {
      include: ['jquery']
    },

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
        // Serve fonts and images from existing public directory during dev
        middlewares: [
          (req, res, next) => {
            // Handle font requests
            if (req.url?.startsWith('/assets/src/fonts/')) {
              const fontPath = req.url.replace('/assets/src/fonts/', '/assets/public/fonts/');
              req.url = fontPath;
            }
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