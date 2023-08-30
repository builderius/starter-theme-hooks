module.exports = {
    parser:  'babel-eslint',
    extends: 'wordpress',
    env:     {
        browser: true
    },
    rules:   {
        'key-spacing':                 ['error', { 'mode': 'minimum' }],
        'space-in-parens':             ['off'],
        'space-unary-ops':             ['off'],
        'array-bracket-spacing':       ['off'],
        'wrap-iife': ['off'],

        'space-before-function-paren': ['error', {
            anonymous:  'never',
            named:      'never',
            asyncArrow: 'ignore'
        }],
        'arrow-parens':                ['error', 'as-needed', {
            requireForBlockBody: true
        }],
        'arrow-body-style':            ['off']
    }
};