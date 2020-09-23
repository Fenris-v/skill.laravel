(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

/***/ }),

/***/ "./resources/js/auth-scripts.js":
/*!**************************************!*\
  !*** ./resources/js/auth-scripts.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener('DOMContentLoaded', function () {
  /**
   * Выпадающее меню пользователя
   */
  var logout = document.querySelector('#navbarDropdown');
  var logoutMenu = document.querySelector('.dropdown-menu.dropdown-menu-right');

  if (logout) {
    logout.addEventListener('click', function (e) {
      e.preventDefault();

      if (logoutMenu.classList.contains('d-block')) {
        logoutMenu.classList.remove('d-block');
      } else {
        logoutMenu.classList.add('d-block');
      }
    });
  }

  document.addEventListener('click', function (e) {
    if (logoutMenu !== null && logoutMenu.classList.contains('d-block') && e.target !== logout && !e.target.classList.contains('dropdown-item')) {
      logoutMenu.classList.remove('d-block');
    }
  });
  /**
   * Отправка формы разавторизации
   */

  var logoutSend = document.querySelector('#dropdownLogout');

  if (logoutSend) {
    logoutSend.addEventListener('click', function (e) {
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

  var notification = document.querySelector('#notification');

  if (notification) {
    setTimeout(function () {
      $(notification).fadeOut();
      setTimeout(function () {
        notification.remove();
      }, 500);
    }, 3000);
  }
  /**
   * Подключение cke
   */


  if ($('textarea#htmlInput').length > 0) {
    ClassicEditor.create(document.querySelector('textarea#htmlInput'), {
      language: 'ru'
    })["catch"](function (error) {
      console.error(error);
    });
  }
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
window.ClassicEditor = __webpack_require__(/*! @ckeditor/ckeditor5-build-classic */ "./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js");
window.select2 = __webpack_require__(/*! select2 */ "./node_modules/select2/dist/js/select2.js");

__webpack_require__(/*! ./scripts */ "./resources/js/scripts.js");

__webpack_require__(/*! ./auth-scripts */ "./resources/js/auth-scripts.js");

/***/ }),

/***/ "./resources/js/scripts.js":
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener('DOMContentLoaded', function () {
  /**
   * Отправка формы публикации
   */
  var publishing = document.querySelector('#publishing');

  if (publishing) {
    publishing.addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('publishing-form').submit();
    });
  }
});

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/fenris/www/skillbox/skill.laravel/resources/js/app.js */"./resources/js/app.js");


/***/ })

},[[1,"/js/manifest","/js/vendor"]]]);