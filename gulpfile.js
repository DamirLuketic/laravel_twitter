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


        // This is new
        // Add new css and js

        // compile -> first method

        // we here add file from css -> with address

        .styles([

            'libs/blog-post.css',
            'libs/bootstrap.css',
            'libs/bootstrap.min.css',
            'libs/font-awesome.css',
            'libs/metisMenu.css',
            'libs/sb-admin-2.css',
            'libs/styles.css'

        ], './public/css/libs.css')

        // create in public css directory, and redirect file there
        // with second parameter


        // this is file from js

        .scripts([

            'libs/bootstrap.js',
            'libs/bootstrap.min.js',
            'libs/jquery.js',
            'libs/metisMenu.js',
            'libs/sb-admin-2.js',
            'libs/scripts.js'

        ], './public/js/libs.js')

// create in public css directory, and redirect file there
// with second parameter

});
