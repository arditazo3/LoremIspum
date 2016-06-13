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
        'libs/jasny-bootstrap.css',
        'libs/my-style.css',
        'libs/chosen.css',
        'libs/bootstrap-colorpicker.min.css',
        'libs/switchery.css',
        'libs/datepicker3.css',

        // data tables
        'libs/dataTables.bootstrap.css',
        'libs/dataTables.responsive.css',
        'libs/dataTables.tableTools.min.css',

        'libs/animate.css',
        'libs/style.css',

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
        'libs/bootstrap-datepicker.js',
        'libs/switchery.js',

        // iCheck
        'libs/icheck.min.js',
        'libs/custom.components.js',
        
        // data tables
        'libs/jquery.dataTables.js',
        'libs/dataTables.bootstrap.js',
        'libs/dataTables.responsive.js',
        'libs/dataTables.tableTools.min.js',

        'libs/my-script.js',


    ], './public/js/libs.js')


});
