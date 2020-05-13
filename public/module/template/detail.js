(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["module/template/detail"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/column.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/components/column.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
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
    return {};
  },
  props: {
    item: {}
  },
  methods: {
    openEdit: function openEdit() {}
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/regular.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/components/regular.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      i18n: template_i18n
    };
  },
  props: {
    item: {},
    block: {}
  },
  methods: {
    openEdit: function openEdit() {
      editBlockScreen.openEdit(this.item, this.block);
    },
    deleteBlock: function deleteBlock() {
      var c = confirm(this.i18n.delete_confirm);
      if (!c) return;
      this.$emit('delete', this.key);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/row.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/components/row.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
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
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {};
  },
  props: {
    item: {}
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/fields/field-editor.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/fields/field-editor.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_form_generator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-form-generator */ "./node_modules/vue-form-generator/dist/vfg.js");
/* harmony import */ var vue_form_generator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_form_generator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @ckeditor/ckeditor5-build-classic */ "./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js");
/* harmony import */ var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _ckeditor_ckeditor5_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @ckeditor/ckeditor5-vue */ "./node_modules/@ckeditor/ckeditor5-vue/dist/ckeditor.js");
/* harmony import */ var _ckeditor_ckeditor5_vue__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_ckeditor_ckeditor5_vue__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _admin_js_ckeditor_uploadAdapter__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../admin/js/ckeditor/uploadAdapter */ "./resources/admin/js/ckeditor/uploadAdapter.js");
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
  mixins: [vue_form_generator__WEBPACK_IMPORTED_MODULE_0__["abstractField"]],
  data: function data() {
    return {
      editor: _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_1___default.a,
      config: {
        extraPlugins: [_admin_js_ckeditor_uploadAdapter__WEBPACK_IMPORTED_MODULE_3__["default"]]
      }
    };
  },
  components: {
    ckeditor: _ckeditor_ckeditor5_vue__WEBPACK_IMPORTED_MODULE_2___default.a.component
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/column.vue?vue&type=template&id=1465b956&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/components/column.vue?vue&type=template&id=1465b956& ***!
  \****************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    {
      staticClass: "col",
      class: "col-sm-" + (_vm.item.settings.size ? _vm.item.settings.size : 12)
    },
    [
      _c("div", { staticClass: "block-panel" }, [
        _c("div", { staticClass: "block-title" }, [
          _c("span", [
            _vm._v(
              "\n                " +
                _vm._s(_vm.item.name) +
                " -\n                "
            ),
            _c(
              "select",
              {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.item.settings.size,
                    expression: "item.settings.size"
                  }
                ],
                on: {
                  change: function($event) {
                    var $$selectedVal = Array.prototype.filter
                      .call($event.target.options, function(o) {
                        return o.selected
                      })
                      .map(function(o) {
                        var val = "_value" in o ? o._value : o.value
                        return val
                      })
                    _vm.$set(
                      _vm.item.settings,
                      "size",
                      $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                    )
                  }
                }
              },
              _vm._l(12, function(i) {
                return _c("option", { domProps: { value: i } }, [
                  _vm._v(_vm._s(i) + "/12")
                ])
              }),
              0
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "title-right" }, [
            _c("span", { staticClass: "btn btn-light block-edit dropdown" }, [
              _vm._m(0),
              _vm._v(" "),
              _c("span", { staticClass: "dropdown-menu" }, [
                _c(
                  "span",
                  {
                    staticClass: "dropdown-item ",
                    on: { click: _vm.openEdit }
                  },
                  [_vm._v("Edit")]
                ),
                _vm._v(" "),
                _c("span", { staticClass: "dropdown-item " }, [
                  _vm._v("Delete")
                ])
              ])
            ]),
            _vm._v(" "),
            _c("span", { staticClass: "block-toggle btn btn-light" }, [
              _c("i", {
                staticClass: "icon ion-md-arrow-dropdown",
                on: {
                  click: function($event) {
                    _vm.item.open = _vm.item.open ? false : true
                  }
                }
              })
            ])
          ])
        ]),
        _vm._v(" "),
        _c(
          "div",
          {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: _vm.item.open,
                expression: "item.open"
              }
            ],
            staticClass: "block-content"
          },
          _vm._l(_vm.item.children, function(child, index) {
            return _c(child.component, {
              key: index,
              tag: "component",
              attrs: { item: child }
            })
          }),
          1
        )
      ])
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("a", { attrs: { href: "#", "data-toggle": "dropdown" } }, [
      _c("i", { staticClass: "icon ion-ios-hammer" })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/regular.vue?vue&type=template&id=74dd0ea6&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/components/regular.vue?vue&type=template&id=74dd0ea6& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "block-panel" }, [
    _c("div", { staticClass: "block-title" }, [
      _vm._v("\n        " + _vm._s(_vm.item.name) + "\n        "),
      _c("div", { staticClass: "title-right" }, [
        _c(
          "span",
          {
            staticClass: "btn btn-light block-delete show-hover",
            on: { click: _vm.deleteBlock }
          },
          [_c("i", { staticClass: "icon ion-ios-trash" })]
        ),
        _vm._v(" "),
        _c(
          "span",
          {
            staticClass: "btn btn-light block-edit",
            on: { click: _vm.openEdit }
          },
          [_c("i", { staticClass: "icon ion-ios-build" })]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/row.vue?vue&type=template&id=03362f2a&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/components/row.vue?vue&type=template&id=03362f2a& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "block-panel" }, [
    _c("div", { staticClass: "block-title" }, [
      _vm._v("\n        " + _vm._s(_vm.item.name) + "\n        "),
      _c("div", { staticClass: "title-right" }, [
        _vm._m(0),
        _vm._v(" "),
        _vm._m(1),
        _vm._v(" "),
        _c("span", { staticClass: "block-toggle btn btn-light" }, [
          _c("i", {
            staticClass: "icon ion-md-arrow-dropdown",
            on: {
              click: function($event) {
                _vm.item.open = _vm.item.open ? false : true
              }
            }
          })
        ])
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.item.open,
            expression: "item.open"
          }
        ],
        staticClass: "block-content"
      },
      [
        _c(
          "div",
          { staticClass: "row" },
          _vm._l(_vm.item.children, function(child, index) {
            return _c(child.component, {
              key: index,
              tag: "component",
              attrs: { item: child }
            })
          }),
          1
        )
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "span",
      { staticClass: "btn btn-light block-delete show-hover" },
      [_c("i", { staticClass: "icon ion-ios-trash" })]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "block-edit btn btn-light show-hover" }, [
      _c("i", { staticClass: "icon ion-ios-build" })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/fields/field-editor.vue?vue&type=template&id=24a3e51c&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/module/template/admin/fields/field-editor.vue?vue&type=template&id=24a3e51c& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    {},
    [
      _c("ckeditor", {
        attrs: { editor: _vm.editor, config: _vm.config },
        model: {
          value: _vm.value,
          callback: function($$v) {
            _vm.value = $$v
          },
          expression: "value"
        }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/module/template/admin/components/column.vue":
/*!***************************************************************!*\
  !*** ./resources/module/template/admin/components/column.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _column_vue_vue_type_template_id_1465b956___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./column.vue?vue&type=template&id=1465b956& */ "./resources/module/template/admin/components/column.vue?vue&type=template&id=1465b956&");
/* harmony import */ var _column_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./column.vue?vue&type=script&lang=js& */ "./resources/module/template/admin/components/column.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _column_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _column_vue_vue_type_template_id_1465b956___WEBPACK_IMPORTED_MODULE_0__["render"],
  _column_vue_vue_type_template_id_1465b956___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/module/template/admin/components/column.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/module/template/admin/components/column.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/module/template/admin/components/column.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_column_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./column.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/column.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_column_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/module/template/admin/components/column.vue?vue&type=template&id=1465b956&":
/*!**********************************************************************************************!*\
  !*** ./resources/module/template/admin/components/column.vue?vue&type=template&id=1465b956& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_column_vue_vue_type_template_id_1465b956___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./column.vue?vue&type=template&id=1465b956& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/column.vue?vue&type=template&id=1465b956&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_column_vue_vue_type_template_id_1465b956___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_column_vue_vue_type_template_id_1465b956___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/module/template/admin/components/regular.vue":
/*!****************************************************************!*\
  !*** ./resources/module/template/admin/components/regular.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _regular_vue_vue_type_template_id_74dd0ea6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./regular.vue?vue&type=template&id=74dd0ea6& */ "./resources/module/template/admin/components/regular.vue?vue&type=template&id=74dd0ea6&");
/* harmony import */ var _regular_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./regular.vue?vue&type=script&lang=js& */ "./resources/module/template/admin/components/regular.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _regular_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _regular_vue_vue_type_template_id_74dd0ea6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _regular_vue_vue_type_template_id_74dd0ea6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/module/template/admin/components/regular.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/module/template/admin/components/regular.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/module/template/admin/components/regular.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_regular_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./regular.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/regular.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_regular_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/module/template/admin/components/regular.vue?vue&type=template&id=74dd0ea6&":
/*!***********************************************************************************************!*\
  !*** ./resources/module/template/admin/components/regular.vue?vue&type=template&id=74dd0ea6& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_regular_vue_vue_type_template_id_74dd0ea6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./regular.vue?vue&type=template&id=74dd0ea6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/regular.vue?vue&type=template&id=74dd0ea6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_regular_vue_vue_type_template_id_74dd0ea6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_regular_vue_vue_type_template_id_74dd0ea6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/module/template/admin/components/row.vue":
/*!************************************************************!*\
  !*** ./resources/module/template/admin/components/row.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _row_vue_vue_type_template_id_03362f2a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./row.vue?vue&type=template&id=03362f2a& */ "./resources/module/template/admin/components/row.vue?vue&type=template&id=03362f2a&");
/* harmony import */ var _row_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./row.vue?vue&type=script&lang=js& */ "./resources/module/template/admin/components/row.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _row_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _row_vue_vue_type_template_id_03362f2a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _row_vue_vue_type_template_id_03362f2a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/module/template/admin/components/row.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/module/template/admin/components/row.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/module/template/admin/components/row.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_row_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./row.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/row.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_row_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/module/template/admin/components/row.vue?vue&type=template&id=03362f2a&":
/*!*******************************************************************************************!*\
  !*** ./resources/module/template/admin/components/row.vue?vue&type=template&id=03362f2a& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_row_vue_vue_type_template_id_03362f2a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./row.vue?vue&type=template&id=03362f2a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/components/row.vue?vue&type=template&id=03362f2a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_row_vue_vue_type_template_id_03362f2a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_row_vue_vue_type_template_id_03362f2a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/module/template/admin/custom-fields.js":
/*!**********************************************************!*\
  !*** ./resources/module/template/admin/custom-fields.js ***!
  \**********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _fields_field_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./fields/field-editor */ "./resources/module/template/admin/fields/field-editor.vue");

Vue.component("fieldEditor", _fields_field_editor__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./resources/module/template/admin/detail.js":
/*!***************************************************!*\
  !*** ./resources/module/template/admin/detail.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuedraggable__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuedraggable */ "./node_modules/vuedraggable/dist/vuedraggable.umd.min.js");
/* harmony import */ var vuedraggable__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuedraggable__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vue_form_generator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-form-generator */ "./node_modules/vue-form-generator/dist/vfg.js");
/* harmony import */ var vue_form_generator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_form_generator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_row__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/row */ "./resources/module/template/admin/components/row.vue");
/* harmony import */ var _components_column__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/column */ "./resources/module/template/admin/components/column.vue");
/* harmony import */ var _components_regular__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/regular */ "./resources/module/template/admin/components/regular.vue");







__webpack_require__(/*! ./custom-fields */ "./resources/module/template/admin/custom-fields.js");

vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('RowBlock', _components_row__WEBPACK_IMPORTED_MODULE_3__["default"]);
vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('ColumnBlock', _components_column__WEBPACK_IMPORTED_MODULE_4__["default"]);
vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('RegularBlock', _components_regular__WEBPACK_IMPORTED_MODULE_5__["default"]);
/* harmony default export */ __webpack_exports__["default"] = (TemplateDetail());
{
  window.editBlockScreen = new vue__WEBPACK_IMPORTED_MODULE_0___default.a({
    el: '#editBlockScreenApp',
    data: {
      modal: false,
      item: {},
      block: {},
      model: {},
      onEdit: false,
      template_i18n: template_i18n,
      options: {}
    },
    mounted: function mounted() {
      var me = this;
      this.modal = $('#editBlockScreen');
      this.$nextTick(function () {// me.modal.modal({
        //     show:false
        // });
      });
    },
    components: {
      "vue-form-generator": vue_form_generator__WEBPACK_IMPORTED_MODULE_2___default.a.component,
      draggable: vuedraggable__WEBPACK_IMPORTED_MODULE_1___default.a
    },
    methods: {
      openEdit: function openEdit(item, block) {
        this.item = item;
        this.block = block;
        this.model = Object.assign({}, this.item.model);
        this.modal.modal('show');
      },
      saveModal: function saveModal() {
        this.item.model = Object.assign({}, this.model);
        this.onEdit = false;
        this.modal.modal('toggle');
      },
      hideModal: function hideModal() {
        this.modal.modal('toggle');
      }
    }
  });
  new vue__WEBPACK_IMPORTED_MODULE_0___default.a({
    el: '#booking-core-template-detail',
    data: {
      items: current_template_items,
      blocks: [],
      title: current_template_title,
      message: {
        content: '',
        type: false
      },
      onSaving: false
    },
    mounted: function mounted() {
      this.reloadBlocks();
    },
    methods: {
      deleteBlock: function deleteBlock(index) {
        this.items.splice(index, 1);
      },
      saveTemplate: function saveTemplate() {
        var me = this;

        if (!this.title) {
          return false;
        }

        this.onSaving = true;
        $.ajax({
          url: bookingCore.url + '/admin/module/template/store',
          dataType: 'json',
          type: 'post',
          data: {
            id: template_id,
            content: JSON.stringify(this.items),
            title: this.title
          },
          success: function success(res) {
            me.onSaving = false;

            if (res.message) {
              me.message.content = res.message;
              me.message.type = res.status;
            }

            if (res.url) {
              window.location.href = res.url;
            }
          },
          error: function error(e) {
            me.onSaving = false;

            if (e.responseJSON.message) {
              me.message.content = e.responseJSON.message;
              me.message.type = false;
            } else {
              me.message.content = 'Can not save menu';
              me.message.type = false;
            }
          }
        });
      },
      reloadBlocks: function reloadBlocks() {
        var me = this;
        $.ajax({
          url: bookingCore.url + '/admin/module/template/getBlocks',
          dataType: 'json',
          type: 'get',
          success: function success(res) {
            if (res.status) {
              me.blocks = res.data;
            }
          },
          error: function error(e) {
            console.log(e);
          }
        });
      },
      addBlock: function addBlock(block) {
        var toItem = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

        /*if(toItem == false && block.id!='row'){
            var blockRow = this.searchBlockById('row');
            var blockColumn = this.searchBlockById('column');
             var row = this.addBlock(blockRow);
             if(block.id!='column'){
                toItem = this.addBlock(blockColumn,row);
            }else{
                toItem = row;
            }
         }*/
        var item = this.getBlockParams(block);

        if (toItem) {
          toItem.children.push(item);
        } else {
          this.items.push(item);
        }

        return item;
      },
      getBlockParams: function getBlockParams(block) {
        var res = {
          type: block.id,
          name: block.name,
          model: block.model,
          component: block.component,
          open: true
        };

        if (block.is_container) {
          res.is_container = true;
          res.children = [];
        }

        return res;
      },
      searchBlockById: function searchBlockById(id) {
        for (var i = 0; i < this.blocks.length; i++) {
          if (this.blocks[i].id == id) {
            return this.blocks[i];
          }
        }
      }
    },
    components: {
      RowBlock: _components_row__WEBPACK_IMPORTED_MODULE_3__["default"],
      ColumnBlock: _components_column__WEBPACK_IMPORTED_MODULE_4__["default"],
      RegularBlock: _components_regular__WEBPACK_IMPORTED_MODULE_5__["default"]
    }
  });
}

/***/ }),

/***/ "./resources/module/template/admin/fields/field-editor.vue":
/*!*****************************************************************!*\
  !*** ./resources/module/template/admin/fields/field-editor.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _field_editor_vue_vue_type_template_id_24a3e51c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./field-editor.vue?vue&type=template&id=24a3e51c& */ "./resources/module/template/admin/fields/field-editor.vue?vue&type=template&id=24a3e51c&");
/* harmony import */ var _field_editor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./field-editor.vue?vue&type=script&lang=js& */ "./resources/module/template/admin/fields/field-editor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _field_editor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _field_editor_vue_vue_type_template_id_24a3e51c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _field_editor_vue_vue_type_template_id_24a3e51c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/module/template/admin/fields/field-editor.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/module/template/admin/fields/field-editor.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/module/template/admin/fields/field-editor.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_field_editor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./field-editor.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/fields/field-editor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_field_editor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/module/template/admin/fields/field-editor.vue?vue&type=template&id=24a3e51c&":
/*!************************************************************************************************!*\
  !*** ./resources/module/template/admin/fields/field-editor.vue?vue&type=template&id=24a3e51c& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_field_editor_vue_vue_type_template_id_24a3e51c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./field-editor.vue?vue&type=template&id=24a3e51c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/module/template/admin/fields/field-editor.vue?vue&type=template&id=24a3e51c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_field_editor_vue_vue_type_template_id_24a3e51c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_field_editor_vue_vue_type_template_id_24a3e51c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);