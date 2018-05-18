var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/animsition', './assets/vendor/animsition/js/animsition.min.js')
    .addEntry('js/bootstrap', './assets/vendor/bootstrap/js/bootstrap.min.js')
    .addEntry('js/select2', './assets/vendor/select2/select2.min.js')
    .addEntry('js/isotope', './assets/vendor/isotope/isotope.pkgd.min.js')
    .addEntry('js/slick', './assets/vendor/slick/slick.min.js')
    .addEntry('js/paralax100', './assets/vendor/parallax100/parallax100.js')
    .addEntry('js/jquery.magnific-popup', './assets/vendor/MagnificPopup/jquery.magnific-popup.min.js')
    .addEntry('js/sweetalert', './assets/vendor/sweetalert/sweetalert.min.js')
    .addEntry('js/daterangepicker', './assets/vendor/daterangepicker/daterangepicker.js')
    .addEntry('js/map-custom', './assets/js/map-custom.js')
    .addEntry('js/slick-custom', './assets/js/slick-custom.js')
    .addEntry('js/main', './assets/js/main.js')
    .addEntry('js/app', './assets/js/app.js')

    .addStyleEntry('css/variables', './assets/css/variables.scss')
    .addStyleEntry('css/app', './assets/css/app.scss')
    .addStyleEntry('css/blog', './assets/css/blog.scss')
    .addStyleEntry('css/home', './assets/css/home.scss')
    .addStyleEntry('css/admin', './assets/css/admin.scss')
    .addStyleEntry('css/account', './assets/css/account.scss')

    .createSharedEntry('vendor', [
        'jquery', 
        'popper.js',
        'moment',
        'isotope-layout'
    ])

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
