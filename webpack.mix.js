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
if (process.env.section) {
    require(`${__dirname}/webpack.${process.env.section}.mix.js`);
}else{
    require(`${__dirname}/webpack.admin.mix.js`);

}