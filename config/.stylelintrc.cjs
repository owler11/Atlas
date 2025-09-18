// config/.stylelintrc.js - Stylelint configuration
module.exports = {
    extends: [
        'stylelint-config-standard',
        'stylelint-config-standard-scss'
    ],
    plugins: [
        'stylelint-scss',
        'stylelint-order'
    ],
    ignoreFiles: [
        'assets/public/**/*.css',
        'node_modules/**/*.css',
        'vendor/**/*.css'
    ],
    rules: {
        // Only override essential rules
        'at-rule-no-unknown': null,
        'scss/at-rule-no-unknown': true,
        'selector-class-pattern': null,
        'custom-property-pattern': null,
        'keyframes-name-pattern': null,
        'scss/dollar-variable-pattern': null,
        'scss/percent-placeholder-pattern': null,
        'comment-whitespace-inside': null,
        'scss/double-slash-comment-whitespace-inside': null,
        'no-invalid-position-at-import-rule': null,
        'at-rule-empty-line-before': null,
        'no-duplicate-at-import-rules': null,
        'no-descending-specificity': null,
        'block-no-empty': null,
        'font-family-no-duplicate-names': null,
        'no-duplicate-selectors': null,
        'scss/operator-no-newline-after': null,
        'declaration-block-no-shorthand-property-overrides': null,
        'property-no-unknown': null,

        'font-family-no-missing-generic-family-keyword': null,
        'length-zero-no-unit': [true, {"ignore": ["custom-properties"]}],
        'property-no-vendor-prefix': null,
        'selector-id-pattern': null,
        
        // Property ordering rules
        'order/properties-order': [
            [
                {
                    "groupName": "display",
                    "properties": [
                        "content",
                        "appearance",
                        "position",
                        "top",
                        "right",
                        "bottom",
                        "left",
                        "z-index",
                        "display",
                        "flex",
                        "flex-direction",
                        "flex-basis",
                        "flex-flow",
                        "flex-grow",
                        "flex-shrink",
                        "flex-wrap",
                        "align-content",
                        "align-items",
                        "justify-content",
                        "justify-items"
                    ]
                },
                {
                    "groupName": "grid",
                    "properties": [
                        "grid",
                        "grid-area",
                        "grid-template",
                        "grid-template-areas",
                        "grid-template-rows",
                        "grid-template-columns",
                        "grid-row",
                        "grid-row-start",
                        "grid-row-end",
                        "grid-column",
                        "grid-column-start",
                        "grid-column-end",
                        "grid-auto-rows",
                        "grid-auto-columns",
                        "grid-auto-flow",
                        "grid-gap",
                        "grid-row-gap",
                        "grid-column-gap",
                        "gap"
                    ]
                },
                {
                    "groupName": "dimensions",
                    "properties": [
                        "width",
                        "max-width",
                        "min-width",
                        "height",
                        "max-height",
                        "min-height"
                    ]
                },
                {
                    "groupName": "margin and padding",
                    "properties": [
                        "margin",
                        "margin-top",
                        "margin-right",
                        "margin-bottom",
                        "margin-left",
                        "padding",
                        "padding-top",
                        "padding-right",
                        "padding-bottom",
                        "padding-left"
                    ]
                },
                {
                    "groupName": "border and background",
                    "properties": [
                        "box-sizing",
                        "border",
                        "border-top",
                        "border-right",
                        "border-bottom",
                        "border-left",
                        "border-width",
                        "border-radius",
                        "outline",
                        "box-shadow",
                        "background",
                        "background-color",
                        "background-image"
                    ]
                },
                {
                    "groupName": "font",
                    "properties": [
                        "font",
                        "font-family",
                        "font-size",
                        "font-style",
                        "font-weight",
                        "line-height",
                        "color",
                        "text-decoration",
                        "font-smoothing"
                    ]
                }
            ],
            {
                "unspecified": "bottom"
            }
        ]
    }
};