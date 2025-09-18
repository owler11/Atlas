// config/prettier.config.js - Prettier configuration
module.exports = {
    semi: true,
    trailingComma: 'es5',
    // singleQuote: false,
    printWidth: 80,
    tabWidth: 4,
    useTabs: true,
    bracketSpacing: true,
    arrowParens: 'avoid',
    endOfLine: 'lf',
    overrides: [
        {
            files: '*.{css,scss,sass}',
            options: {
                singleQuote: false,
                tabWidth: 4,
                useTabs: true
            }
        }
    ]
};