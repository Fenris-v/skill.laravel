(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/admin/scripts"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/PostComponent.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/PostComponent.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      hasUpdate: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    Echo["private"]('post').listen('PostEdited', function (data) {
      _this.slug = data.slug;
      _this.title = data.title;
      _this.fields = data.fields;
      _this.hasUpdate = true;
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ReportComponent.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ReportComponent.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['userId'],
  data: function data() {
    return {
      hasReport: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    Echo["private"]('report.user.' + this.userId).listen('ReportRequested', function (data) {
      console.log(data);
      _this.hasReport = true;
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/PostComponent.vue?vue&type=template&id=54a00d62&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/PostComponent.vue?vue&type=template&id=54a00d62& ***!
  \****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "position-fixed ws-badge-container" }, [
    _vm.hasUpdate
      ? _c(
          "div",
          { staticClass: "badge badge-warning p-4 ws-badge position-fixed" },
          [
            _c("h3", { staticClass: "h3" }, [
              _vm._v("Пост "),
              _c("i", [_vm._v(_vm._s(this.title))]),
              _vm._v(" обновлен")
            ]),
            _vm._v(" "),
            _c("p", { staticClass: "font-weight-bold mb-0" }, [
              _vm._v("Изменились поля:")
            ]),
            _vm._v(" "),
            _c(
              "ul",
              _vm._l(this.fields, function(field) {
                return _c("li", [
                  _vm._v(
                    "\n                " + _vm._s(field) + "\n            "
                  )
                ])
              }),
              0
            ),
            _vm._v(" "),
            _c(
              "a",
              { staticClass: "btn btn-primary", attrs: { href: this.slug } },
              [_vm._v("Перейти к статье")]
            )
          ]
        )
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ReportComponent.vue?vue&type=template&id=46075be4&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ReportComponent.vue?vue&type=template&id=46075be4& ***!
  \******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.hasReport
      ? _c(
          "div",
          { staticClass: "badge badge-warning p-4 ws-badge position-fixed" },
          [_c("h3", { staticClass: "h3" }, [_vm._v("Отчет готов")])]
        )
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

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

/***/ "./resources/js/components/PostComponent.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/PostComponent.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PostComponent_vue_vue_type_template_id_54a00d62___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PostComponent.vue?vue&type=template&id=54a00d62& */ "./resources/js/components/PostComponent.vue?vue&type=template&id=54a00d62&");
/* harmony import */ var _PostComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PostComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/PostComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PostComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PostComponent_vue_vue_type_template_id_54a00d62___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PostComponent_vue_vue_type_template_id_54a00d62___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/PostComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/PostComponent.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/PostComponent.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PostComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./PostComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/PostComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PostComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/PostComponent.vue?vue&type=template&id=54a00d62&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/PostComponent.vue?vue&type=template&id=54a00d62& ***!
  \**********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PostComponent_vue_vue_type_template_id_54a00d62___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./PostComponent.vue?vue&type=template&id=54a00d62& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/PostComponent.vue?vue&type=template&id=54a00d62&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PostComponent_vue_vue_type_template_id_54a00d62___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PostComponent_vue_vue_type_template_id_54a00d62___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/ReportComponent.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/ReportComponent.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ReportComponent_vue_vue_type_template_id_46075be4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ReportComponent.vue?vue&type=template&id=46075be4& */ "./resources/js/components/ReportComponent.vue?vue&type=template&id=46075be4&");
/* harmony import */ var _ReportComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ReportComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/ReportComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ReportComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ReportComponent_vue_vue_type_template_id_46075be4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ReportComponent_vue_vue_type_template_id_46075be4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ReportComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ReportComponent.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/ReportComponent.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReportComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ReportComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ReportComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReportComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ReportComponent.vue?vue&type=template&id=46075be4&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/ReportComponent.vue?vue&type=template&id=46075be4& ***!
  \************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReportComponent_vue_vue_type_template_id_46075be4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ReportComponent.vue?vue&type=template&id=46075be4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ReportComponent.vue?vue&type=template&id=46075be4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReportComponent_vue_vue_type_template_id_46075be4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReportComponent_vue_vue_type_template_id_46075be4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/vue.js":
/*!*****************************!*\
  !*** ./resources/js/vue.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
Vue.component('post-update', __webpack_require__(/*! ./components/PostComponent.vue */ "./resources/js/components/PostComponent.vue")["default"]);
Vue.component('reports-requested', __webpack_require__(/*! ./components/ReportComponent.vue */ "./resources/js/components/ReportComponent.vue")["default"]);

/***/ }),

/***/ "./resources/js/web-socket.js":
/*!************************************!*\
  !*** ./resources/js/web-socket.js ***!
  \************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var laravel_echo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-echo */ "./node_modules/laravel-echo/dist/echo.js");
/**
 * Web-socket соединение
 */

window.io = __webpack_require__(/*! socket.io-client */ "./node_modules/socket.io-client/lib/index.js");
window.Echo = new laravel_echo__WEBPACK_IMPORTED_MODULE_0__["default"]({
  broadcaster: 'socket.io',
  host: window.location.hostname + ':6001'
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


/***/ }),

/***/ 1:
/*!********************!*\
  !*** ws (ignored) ***!
  \********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);