function showPreview()
{
    alert(ckeditor.getData());
}

$(function() {
    ckeditor = CKEDITOR.replace('htmlbody',
    {
        toolbar:
                [
                    ['Format','Font','FontSize'],
                    ['Bold','Italic','Underline','Strike','-','TextColor'],
                    '/',
                    ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['Link','Unlink'],
                ]
    }
            );

    new YAHOO.widget.Button('btnInsert', {
        type: 'menu',
        menu: 'selInsertMenu'
    }).getMenu().subscribe('click', function(type, args) {
        ckeditor.insertText(args[1].value + ' ');
        ckeditor.focus();
    });

    new YAHOO.widget.Button('btnPreview').on('click', showPreview);
    new YAHOO.widget.Button('btnSave');
    new YAHOO.widget.Button('btnCancel').on('click', function() {
        location.href = 'list.php'
    });
});
