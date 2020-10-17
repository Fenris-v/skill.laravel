window.$ = window.jQuery = require('jquery');
window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');
window.select2 = require('select2');

require('../auth-scripts');

require('../web-socket');

require('../vue');

const app = new Vue({
    el: '#app',
});

document.addEventListener('DOMContentLoaded', () => {
    $('#get-reports').select2();
});

