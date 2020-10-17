window.$ = window.jQuery = require('jquery');
window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');
window.select2 = require('select2');

require('./scripts');
require('./auth-scripts');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/#csrf-x-csrf-token');
}

require('./web-socket');
