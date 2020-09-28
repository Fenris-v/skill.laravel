document.addEventListener('DOMContentLoaded', () => {
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
            logoutMenu !== null &&
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
     * Подключаем select2
     */
    $('#tagsInput').select2({
        tags: true
    });

    /**
     * Скрывает, а затем удаляет уведомление
     */
    let notification = document.querySelector('#notification');
    if (notification) {
        setTimeout(() => {
            $(notification).fadeOut();
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }

    /**
     * Подключение cke
     */
    if ($('textarea#htmlInput').length > 0) {
        ClassicEditor
            .create(document.querySelector('textarea#htmlInput'), {
                language: 'ru'
            })
            .catch(error => {
                console.error(error);
            });
    }
});
