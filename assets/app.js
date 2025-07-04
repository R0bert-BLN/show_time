import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import {dropdown} from './js/components/dropdown.js';
import {buttons} from "./js/components/buttons.js";
import {tables} from "./js/components/tables.js";
import {colors} from "./js/components/colors.js";
import {bandsSubForms} from "./js/components/bandsSubForms.js";

document.addEventListener('turbo:load', () => {
    Alpine.start();
});

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', dropdown);
    Alpine.data('buttons', buttons);
    Alpine.data('tables', tables);
    Alpine.data('colors', colors);
    Alpine.data('bandsSubForms', bandsSubForms);
});

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
