// config/prettier.config.js - Prettier configuration
module.exports = {
    semi: true,
    trailingComma: 'es5',
    singleQuote: true,
    printWidth: 80,
    tabWidth: 2,
    useTabs: false,
    bracketSpacing: true,
    arrowParens: 'avoid',
    endOfLine: 'lf',
    overrides: [
        {
            files: '*.{css,scss,sass}',
            options: {
                singleQuote: false
            }
        }
    ]
};