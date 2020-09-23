document.addEventListener('DOMContentLoaded', () => {
    /**
     * Отправка формы публикации
     */
    let publishing = document.querySelector('#publishing');
    if (publishing) {
        publishing.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('publishing-form').submit();
        });
    }
});
