<?php

/**
 * Functions - Functions Enqueued Scripts (Simple Vite Integration)
 *
 * @package atlas
 */
 
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Vite Helper Functions (Simple)
2.0 - Enqueue styles
3.0 - Enqueue scripts
4.0 - Admin Styles & Scripts
5.0 - Script Module Type Filter
6.0 - De-enqueue WP Embed script
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1.0 - Simple Vite Helper Functions
--------------------------------------------------------------*/

/**
 * Check if we're in Vite development mode.
 * True when: (a) request came through the Vite proxy (X-Atlas-Vite header), or
 * (b) no production build exists (no manifest) so we load from the Vite dev server.
 */
function atlas_is_vite_development()
{
    if (!empty($_SERVER['HTTP_X_ATLAS_VITE'])) {
        return true;
    }
    return !file_exists(get_template_directory() . '/assets/public/manifest.json');
}

/**
 * Vite dev server URL (must match host/port in vite.config.js).
 * Always HTTP — Vite dev server runs without HTTPS unless .vite-certs/ exist (they don't by default).
 * CORS headers in vite.config.js allow cross-origin loading from an HTTPS WordPress host.
 */
function atlas_get_vite_dev_server()
{
    return 'http://localhost:3000';
}

/*--------------------------------------------------------------
2.0 & 3.0 - Enqueue styles and scripts
--------------------------------------------------------------*/

function atlas_scripts()
{
    $is_dev = atlas_is_vite_development();

    if ($is_dev) {
        /*--------------------------------------------------------------
        DEVELOPMENT MODE - Load from Vite dev server
        --------------------------------------------------------------*/

        // Add Vite client for HMR
        wp_enqueue_script(
            'vite-client',
            atlas_get_vite_dev_server() . '/@vite/client',
            [],
            null,
            false
        );

        // Load main frontend script
        wp_enqueue_script(
            'atlas-frontend-scripts',
            atlas_get_vite_dev_server() . '/assets/src/js/frontend.js',
            ['jquery'],
            null,
            true
        );

        // CSS is handled by Vite in development (injected via JS)

    } else {
        /*--------------------------------------------------------------
        PRODUCTION MODE - Load built files
        --------------------------------------------------------------*/

        // Load production CSS
        // Depend on GF theme CSS if present so our styles win the cascade without specificity hacks.
        $css_deps = wp_style_is('gravity_forms_theme_css', 'registered') ? ['gravity_forms_theme_css'] : [];
        $css_file = get_template_directory() . '/assets/public/css/frontend.css';
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'atlas-frontend-style',
                get_template_directory_uri() . '/assets/public/css/frontend.css',
                $css_deps,
                filemtime($css_file)
            );
        }

        // Load production JS
        $js_file = get_template_directory() . '/assets/public/js/frontend.js';
        if (file_exists($js_file)) {
            wp_enqueue_script(
                'atlas-frontend-scripts',
                get_template_directory_uri() . '/assets/public/js/frontend.js',
                ['jquery'],
                filemtime($js_file),
                true
            );
        }
    }

    // Localize script with WordPress data
    wp_localize_script('atlas-frontend-scripts', 'atlasData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wp_rest'),
        'homeUrl' => home_url('/'),
        'isDev' => $is_dev
    ]);

    // Comments script (unchanged)
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'atlas_scripts');

/*--------------------------------------------------------------
4.0 - Admin Styles & Scripts
--------------------------------------------------------------*/

function atlas_load_custom_wp_admin_style()
{
    $is_dev = atlas_is_vite_development();

    if ($is_dev) {
        // Development mode - backend assets
        wp_enqueue_script(
            'atlas-backend-scripts',
            atlas_get_vite_dev_server() . '/assets/src/js/backend.js',
            ['jquery'],
            null,
            true
        );
    } else {
        // Production mode - built files
        $css_file = get_template_directory() . '/assets/public/css/backend.css';
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'atlas-backend-style',
                get_template_directory_uri() . '/assets/public/css/backend.css',
                [],
                filemtime($css_file)
            );
        }

        $js_file = get_template_directory() . '/assets/public/js/backend.js';
        if (file_exists($js_file)) {
            wp_enqueue_script(
                'atlas-backend-scripts',
                get_template_directory_uri() . '/assets/public/js/backend.js',
                ['jquery'],
                filemtime($js_file),
                true
            );
        }
    }
}
add_action('enqueue_block_editor_assets', 'atlas_load_custom_wp_admin_style');

/*--------------------------------------------------------------
5.0 - Script Module Type Filter (Moved outside for reliability)
--------------------------------------------------------------*/

/**
 * Add module type to Vite scripts in development mode
 */
function atlas_add_module_type_to_scripts($tag, $handle, $src)
{
    // Apply to both dev and production
    if (in_array($handle, ['vite-client', 'atlas-frontend-scripts', 'atlas-backend-scripts'])) {
        return str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'atlas_add_module_type_to_scripts', 10, 3);

/*--------------------------------------------------------------
6.0 - De-enqueue WP Embed script (unchanged)
--------------------------------------------------------------*/

function atlas_deregister_scripts() {
    wp_dequeue_script('wp-embed');
}
add_action('wp_footer', 'atlas_deregister_scripts');

/*--------------------------------------------------------------
7.0 - Dequeue ACF Font Awesome plugin assets
      The theme bundles Font Awesome Pro via compiled SCSS, so
      we don't want the plugin loading its own version on top.
--------------------------------------------------------------*/

function atlas_dequeue_acf_fontawesome() {
    wp_dequeue_style('acffa_font-awesome');
    wp_dequeue_script('acffa_font-awesome-kit');
    wp_dequeue_script('acffa_fontawesome-js-api');
}
add_action('wp_enqueue_scripts', 'atlas_dequeue_acf_fontawesome', 100);
