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

document.addEventListener('turbo:load', () => {
    Alpine.start();
});

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', dropdown);
    Alpine.data('buttons', buttons);
});

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
