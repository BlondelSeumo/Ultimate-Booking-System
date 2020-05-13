/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    window.Vue = require('vue');

    require('bootstrap');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

} catch (e) {
    console.log(e);
}

//window.ClassicEditor = require('../../ckeditor');
// window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');
// console.log(ClassicEditor);
// console.log(ClassicEditor);
require('../../module/media/admin/js/browser');
require('./_condition');
require('./_base');
require('./_form');
require('./_menu');


import TemplateDetail from '../../module/template/admin/detail.js';

// Template
if(document.getElementById('booking-core-template-detail')){
    TemplateDetail();
}

