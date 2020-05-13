const mix = require('laravel-mix');

// Admin
mix.webpackConfig({
    output: {
        path:__dirname+'/public',
    }

});

mix.sass('public/sass/app.scss','css');
// ----------------------------------------------------------------------------------------------------
//Booking
mix.sass('public/module/booking/scss/checkout.scss','module/booking/css');
mix.sass('public/module/user/scss/user.scss','module/user/css');
mix.sass('public/module/tour/scss/tour.scss','module/tour/css');
mix.sass('public/module/news/scss/news.scss','module/news/css');
mix.sass('public/module/media/scss/browser.scss','module/media/css');