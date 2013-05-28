/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.plugins = 'dialogui,dialog,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,list,indent,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,htmlwriter,horizontalrule,iframe,wysiwygarea,image,smiley,justify,link,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,menubutton,scayt,stylescombo,tab,table,tabletools,undo,wsc,syntaxhighlight';
    // %REMOVE_END%
///e/forum/create/core/connector/php/connector.ph
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    //filebrowserBrowseUrl: '/browser/browse.php'
    //filebrowserUploadUrl: '/uploader/upload.php'
    CKEDITOR.config.syntaxhighlight_noWrap = true;
    /*
     CKEDITOR.config.syntaxhighlight_hideGutter = [true|false];
     CKEDITOR.config.syntaxhighlight_hideControls = [true|false];
     CKEDITOR.config.syntaxhighlight_collapse = [true|false];
     CKEDITOR.config.syntaxhighlight_showColumns = [true|false];
     CKEDITOR.config.syntaxhighlight_noWrap = [true|false];
     CKEDITOR.config.syntaxhighlight_firstLine = any numeric value; default 0
     CKEDITOR.config.syntaxhighlight_highlight = i.e. [1,3,9]; default null
     */
    config.syntaxhighlight_lang = 'php';
    config.syntaxhighlight_hideControls = true;

    config.toolbar_forum = [
        {name: 'document', items: ['NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']},
        {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        {name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']},
        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
        {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
                '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
        {name: 'insert', items: ['Image', 'Flash', 'Table', 'Smiley', 'SpecialChar', '-', 'TextColor', 'BGColor']},
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        ['Syntaxhighlight']
    ];

    config.toolbar_basic = [
        {name: 'document', items: ['NewPage', 'DocProps', 'Preview', 'Print']},
        ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
        {name: 'insert', items: ['HorizontalRule', 'Smiley', 'SpecialChar']},
        {name: 'styles', items: ['Styles', 'Font', 'TextColor', 'BGColor']},
        ['Syntaxhighlight']

    ];

    config.toolbar_full =
            [
                {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']},
                {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                {name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']},
                {name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
                        'HiddenField']},
                '/',
                {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
                        '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
                {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
                {name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']},
                '/',
                {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['Maximize', 'ShowBlocks']},
                ['Syntaxhighlight']
            ];
};

var chk1 = document.getElementById(siteName+'_forum_read_form_comment');
var chk2 = document.getElementById(siteName+'_forum_create_form_detail');

if (chk1) {
    var editor = $('#'+siteName+'_forum_read_form_comment').ckeditorGet();
    CKFinder.setupCKEditor(editor, './../../../../'+siteName+'/templates/js/ckfinder/');
}
if (chk2) {
    var editor = $('#'+siteName+'_forum_create_form_detail').ckeditorGet();
    CKFinder.setupCKEditor(editor, './../../../../'+siteName+'/templates/js/ckfinder/');
}
