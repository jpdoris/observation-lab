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

    mix.autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"],
        tether: ['window.Tether', 'Tether']
    });

    mix
        .js([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/tether/dist/js/tether.min.js',
            'node_modules/bootstrap/dist/js/bootstrap.js',
            'resources/js/app.js'
        ], 'public/js/app-es6.js')

        .combine('public/js/app-es6.js','public/js/app.js', true)

        .sourceMaps()

        .sass('resources/sass/app.scss', 'public/css/app.css')

        .version()

        .copy('node_modules/font-awesome/fonts', 'public/fonts');

