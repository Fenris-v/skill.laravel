document.addEventListener('DOMContentLoaded', () => {

    /**
     * Подключение tinymce
     * @type {Element}
     */
    // let htmlInput = document.querySelector('#htmlInput');
    tinymce.init({
        selector:'textarea#htmlInput',
        height: 300,
        language: 'ru'
    });
});
