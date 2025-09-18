# Brevity — Vite Build for WordPress Themes (Tidy layout)

This package gives you a fast, modern front‑end build for a WordPress theme using **Vite**.  
It keeps the theme root clean by placing configs in `/vite`, emits hashed assets for cache busting, and supports Sass, Autoprefixer, ESLint, Stylelint, and **image compression on production builds**.

## What it includes

### Dev experience
- Vite dev server
- Instant CSS/SCSS HMR (no PHP reload wired by default)
- Sourcemaps in development

### Styles
- Sass (`sass` / Dart Sass) compiled with `@use` / `@import`
- PostCSS with **Autoprefixer** (targets come from `browserslist` in `package.json`)
- **Stylelint** with `stylelint-config-standard-scss`

### Scripts
- ES modules with Rollup under the hood
- Entry points for `frontend` and `backend`
- **ESLint** with a simple recommended config

### Assets
- Fonts and images are emitted with hashed filenames
- `assets/public/manifest.json` maps logical entries to the hashed files
- **Image compression** via `vite-plugin-imagemin` on production:
  - JPEG (mozjpeg ~75 quality, progressive)
  - PNG (pngquant ~70–85 quality)
  - GIF (gifsicle, interlaced)
  - SVG (SVGO safe defaults, keeps viewBox)
  - WebP (~75 quality)

## Folder structure

```
/vite
  vite.config.ts
  postcss.config.cjs
  .eslintrc.cjs
  stylelint.config.cjs

/assets
  /src
    /js
      frontend.js        # imports ../sass/frontend.scss
      backend.js         # imports ../sass/backend.scss
    /sass
      frontend.scss
      backend.scss
    /images              # source images
    /fonts               # source fonts
  /public                # build output (hashed files + manifest.json)

package.json
README.md
```

## Scripts

```bash
npm run dev       # Vite dev server with CSS/SCSS HMR
npm run build     # Production build to assets/public (hashed assets + manifest.json)
npm run preview   # Preview the production build locally
npm run lint      # ESLint + Stylelint
npm run lint:fix  # Auto-fix where possible
```

## Enqueueing in WordPress (hashed assets)

On `npm run build`, Vite writes `assets/public/manifest.json`. Use it to enqueue the right hashed CSS/JS for your entries.

Minimal approach in PHP:

```php
$manifest = json_decode( file_get_contents( get_theme_file_path( 'assets/public/manifest.json' ) ), true );

$entries = [
  'frontend' => 'assets/src/js/frontend.js',
  'backend'  => 'assets/src/js/backend.js',
];

foreach ( $entries as $handle => $source ) {
  if ( empty( $manifest[ $source ] ) ) continue;
  $entry = $manifest[ $source ];

  if ( ! empty( $entry['file'] ) ) {
    wp_enqueue_script( "brevity-$handle", get_theme_file_uri( 'assets/public/' . $entry['file'] ), [], null, true );
  }
  if ( ! empty( $entry['css'] ) ) {
    foreach ( $entry['css'] as $i => $css_file ) {
      wp_enqueue_style( "brevity-$handle" . ( $i ? "-$i" : '' ), get_theme_file_uri( 'assets/public/' . $css_file ), [], null );
    }
  }
}
```

If you prefer a tidy helper, drop `inc/enqueue.php` into your theme and `require` it from `functions.php`.

## Configuration notes

- **Configs under `/vite`**: scripts in `package.json` call Vite with `--config vite/vite.config.ts`. PostCSS path is set to `./vite/postcss.config.cjs`. Linters use configs in `/vite` as well.
- **Image quality**: tweak the `vite-plugin-imagemin` options in `vite/vite.config.ts`.
- **Adding entries**: add to `rollupOptions.input` in `vite.config.ts` and create the matching `assets/src/js/*.js` file.
- **Browser targets**: edit `browserslist` in `package.json`. Autoprefixer reads from there.
- **Optional extras**:
  - PHP template reloads: add `vite-plugin-full-reload` and watch `**/*.php`.
  - TypeScript: rename files to `.ts` and install the TS ESLint setup if you want TS linting.

## Why Vite here

You get fast startup, instant CSS HMR, simpler config, and smaller dependency surface than a loader-heavy Webpack setup, while keeping the WordPress theme layout you like. This README mirrors the intent of your original Webpack workflow docs but reflects the Vite-based approach and the tools we actually ship here.

## Changelog

- 1.1.0 — Added image compression, tidy `/vite` configs, manifest enqueue guidance
- 1.0.0 — Initial Vite setup (Sass, Autoprefixer, ESLint, Stylelint, CSS HMR)
