/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.colorButton_colors = '667991';
    config.toolbar = [
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord']},
        { name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        { name: 'insert', items: ['Iframe', 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Smiley', 'PageBreak']},
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
        '/',
        { name: 'list', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
        { name: 'font', items: ['Format', 'FontSize', 'TextColor', 'BGColor','Font']}
    ];
};
