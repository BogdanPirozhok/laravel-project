const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    module: {
        rules: [
            {
                enforce: 'pre',
                exclude: /node_modules/,
                loader: 'eslint-loader',
                test: /\.(js|vue)?$/
            },
            {
                test: /\.tsx?$/,
                loader: "ts-loader",
                exclude: /node_modules/
            }
        ]
    },
    resolve: {
        extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
    }
})


mix.js('resources/js/public/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/js/prototypes/app.js', 'public/js/prototypes.js')
    .sass('resources/sass/prototypes.scss', 'public/css/prototypes.css');

mix.js('resources/assets/js/public/app.js', 'public/assets/js/public')
    .js('resources/assets/js/home/admin/components/Login/index.js', 'public/assets/js/login.js')
    .js('resources/assets/js/home/admin/app.js', 'public/assets/js/home/admin')
    .sass('resources/assets/sass/public/app.scss', 'public/assets/css/public')
    .sass('resources/assets/sass/home/admin/app.scss', 'public/assets/css/home/admin');
