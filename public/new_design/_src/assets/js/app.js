/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = window.jQuery = $;

// import 'owl.carousel/dist/assets/owl.carousel.css';
// import 'owl.carousel';

require('owl.carousel/dist/assets/owl.carousel.css');
require('owl.carousel');

// var sliders = require('./sliders');
import sliders from './sliders';
import menu from './menu';

var animateVerticalHide = require('./animateVerticalHide');

$(document).ready(function() {
    sliders();
    animateVerticalHide();
    menu();

    $(".js-form").on('submit', function() {
        $(this).hide();
        $(".js-form-result").show();
        return false;
    })
});