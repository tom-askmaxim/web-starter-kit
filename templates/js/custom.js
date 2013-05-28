
function reloadSH(elm) {
    setTimeout(function() {
        $.get('./../../templates/js/load_syntaxhighlighter_ajax.js', function(data) {
            //$('#jscript').html(data);
        });
        if (elm) {
            var editor = $(elm).ckeditorGet();
            CKFinder.setupCKEditor(editor, './../../../../templates/js/ckfinder/');
        }
    }, 1500);

}