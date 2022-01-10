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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/proveedores.js', 'public/js')
    .js('resources/js/formas_pago.js', 'public/js')
    .js('resources/js/orden_de_compra.js', 'public/js')
    .js('resources/js/usuarios.js', 'public/js')
    .js('resources/js/pagos.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/sucursal/index.js', 'public/js/sucursal')
    .js('resources/js/producto/index.js', 'public/js/producto')
    .js('resources/js/categoria/index.js', 'public/js/categoria')
    .js('resources/js/cliente/index.js', 'public/js/cliente')
    // js's de login
    .js('resources/js/login/login.js', 'public/js')
    .js('resources/js/login/register.js', 'public/js')
    //
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/estilos_factura.scss', 'public/css');
    //.sourceMaps();
