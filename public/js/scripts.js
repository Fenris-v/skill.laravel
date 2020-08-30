document.addEventListener('DOMContentLoaded', () => {

    /**
     * Подключение tinymce
     * @type {Element}
     */
    // let htmlInput = document.querySelector('#htmlInput');
    tinymce.init({
        selector: 'textarea#htmlInput',
        height: 300,
        language: 'ru'
    });

    /**
     * Выпадающее меню пользователя
     */
    let logout = document.querySelector('#navbarDropdown');
    let logoutMenu = document.querySelector('.dropdown-menu.dropdown-menu-right');
    if (logout) {
        logout.addEventListener('click', (e) => {
            e.preventDefault();
            if (logoutMenu.classList.contains('d-block')) {
                logoutMenu.classList.remove('d-block');
            } else {
                logoutMenu.classList.add('d-block');
            }
        });
    }

    document.addEventListener('click', (e) => {
        if (
            logoutMenu.classList.contains('d-block') &&
            e.target !== logout &&
            !e.target.classList.contains('dropdown-item')
        ) {
            logoutMenu.classList.remove('d-block');
        }
    });

    /**
     * Отправка формы разавторизации
     */
    let logoutSend = document.querySelector('#dropdownLogout');
    if (logoutSend) {
        logoutSend.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('logout-form').submit();
        });
    }

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
