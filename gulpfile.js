var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')

    .styles([

        'libs/bootstrap.min.css',
        'libs/font-awesome.css',
        'libs/custom.css',
        'libs/animate.css',
        'libs/style.css',
        'libs/jasny-bootstrap.css',
        'libs/my-style.css',

    ], './public/css/libs.css')

    .scripts([


        'libs/jquery-2.1.1.js',
        'libs/bootstrap.min.js',
        'libs/jquery.metisMenu.js',
        'libs/jquery.slimscroll.min.js',

        // Custom and plugin javascript
        'libs/inspinia.js',
        'libs/pace.min.js',
        'libs/wow.min.js',
        'libs/jasny-bootstrap.js',

        // iCheck
        'libs/icheck.min.js',
        'libs/custom.components.js'

    ], './public/js/libs.js')


});
