const mix = require('laravel-echo');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])

mix.options({
    hmroptions:{
        host: 'localhost',
        port: 8080,
    }

})