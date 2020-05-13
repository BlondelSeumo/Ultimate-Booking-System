/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.filebrowserBrowseUrl = bookingCore.url+'/admin/module/media/ckeditorBrowser';
    config.filebrowserUploadUrl = bookingCore.url+'/admin/module/media/store?ckeditor=1';

    config.toolbarCanCollapse = true;

    config.toolbarGroups = [
        {"name":"styles","groups":["styles","colors"]},
        {"name":"basicstyles","groups":["basicstyles"]},
        {"name":"links","groups":["links"]},
        {"name":"paragraph","groups":["align","list","blocks"]},
        {"name":"document","groups":["mode"]},
        {"name":"insert","groups":["insert"]},
        // {"name":"about","groups":["about"]},
    ];

    config.removeButtons = '';
    config.fileTools_requestHeaders = {
        "X-CSRF-TOKEN" : bookingCore.csrf
    };

};
