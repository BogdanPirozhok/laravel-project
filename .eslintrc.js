module.exports = {
    env: {
        browser: true,
        es2020: true,
        node: true
    },
    extends: [
        "eslint:recommended",
        "plugin:vue/recommended",
        "plugin:jsdoc/recommended",
    ],
    parserOptions: {
        ecmaVersion: 11,
        sourceType: 'module'
    },
    plugins: [
        'vue',
        'jsdoc'
    ],
    overrides: [
        {
            files: ["**/*.ts", "**/*.tsx"],
            env: { "browser": true, "es6": true, "node": true },
            extends: [
                "eslint:recommended",
                "plugin:@typescript-eslint/eslint-recommended",
                "plugin:@typescript-eslint/recommended"
            ],
            parser: "@typescript-eslint/parser",
            parserOptions: {
                ecmaFeatures: { "jsx": true },
                ecmaVersion: 2018,
                sourceType: "module",
                project: "./tsconfig.json"
            },
            rules: {
                "@typescript-eslint/no-explicit-any": 0
            },
        }
    ],
    rules: {
        "vue/html-indent": ["warn", 4]
    }
}
