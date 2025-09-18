// config/.eslintrc.cjs - Simplified ESLint configuration
module.exports = {
    root: true,
    env: {
        browser: true,
        es2021: true,
        node: true,
        jquery: true
    },
    extends: [
        'eslint:recommended',
        'prettier'
    ],
    plugins: ['prettier'],
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module'
    },
    globals: {
        wp: 'readonly',
        jQuery: 'readonly',
        $: 'readonly'
    },
    rules: {
        'prettier/prettier': ['error', require('./prettier.config.cjs')],
        'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off'
    },
    ignorePatterns: [
        'assets/public/**',
        'node_modules/**',
        'vendor/**'
    ]
};