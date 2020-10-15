(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/admin/scripts"],{

/***/ "./resources/js/admin/scripts.js":
/*!***************************************!*\
  !*** ./resources/js/admin/scripts.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
window.ClassicEditor = __webpack_require__(/*! @ckeditor/ckeditor5-build-classic */ "./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js");
window.select2 = __webpack_require__(/*! select2 */ "./node_modules/select2/dist/js/select2.js");

__webpack_require__(/*! ../auth-scripts */ "./resources/js/auth-scripts.js");

__webpack_require__(/*! ../web-socket */ "./resources/js/web-socket.js");

__webpack_require__(/*! ../vue */ "./resources/js/vue.js");

var app = new Vue({
  el: '#app'
});
document.addEventListener('DOMContentLoaded', function () {
  $('#get-reports').select2();
});

/***/ }),

/***/ "./resources/sass/admin.sass":
/*!***********************************!*\
  !*** ./resources/sass/admin.sass ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************************************!*\
  !*** multi ./resources/js/admin/scripts.js ./resources/sass/app.scss ./resources/sass/admin.sass ***!
  \***************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/fenris/www/skillbox/skill.laravel/resources/js/admin/scripts.js */"./resources/js/admin/scripts.js");
__webpack_require__(/*! /home/fenris/www/skillbox/skill.laravel/resources/sass/app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! /home/fenris/www/skillbox/skill.laravel/resources/sass/admin.sass */"./resources/sass/admin.sass");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);