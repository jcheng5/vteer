﻿/*
 Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function() {
    var a = {modes:{wysiwyg:1,source:1},canUndo:false,exec:function(c) {
        var d,e = CKEDITOR.env.ie && document.domain != window.location.hostname;
        if (c.config.fullPage)d = c.getData(); else {
            var f = '<body ',g = CKEDITOR.document.getBody(),h = c.config.baseHref.length > 0 ? '<base href="' + c.config.baseHref + '" _cktemp="true"></base>' : '';
            if (g.getAttribute('id'))f += 'id="' + g.getAttribute('id') + '" ';
            if (g.getAttribute('class'))f += 'class="' + g.getAttribute('class') + '" ';
            f += '>';
            d = c.config.docType + '<html dir="' + c.config.contentsLangDirection + '">' + '<head>' + h + '<title>' + c.lang.preview + '</title>' + '<link href="' + c.config.contentsCss + '" type="text/css" rel="stylesheet" _cktemp="true"/>' + '</head>' + f + c.getData() + '</body></html>';
        }
        var i = 640,j = 420,k = 80;
        try {
            var l = window.screen;
            i = Math.round(l.width * 0.8);
            j = Math.round(l.height * 0.7);
            k = Math.round(l.width * 0.1);
        } catch(o) {
        }
        var m = '';
        if (e) {
            window._cke_htmlToLoad = d;
            m = 'javascript:void( (function(){document.open();document.domain="' + document.domain + '";' + 'document.write( window.opener._cke_htmlToLoad );' + 'document.close();' + 'window.opener._cke_htmlToLoad = null;' + '})() )';
        }
        var n = window.open(m, null, 'toolbar=yes,location=no,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=' + i + ',height=' + j + ',left=' + k);
        if (!e) {
            n.document.write(d);
            n.document.close();
        }
    }},b = 'preview';
    CKEDITOR.plugins.add(b, {init:function(c) {
        c.addCommand(b, a);
        c.ui.addButton('Preview', {label:c.lang.preview,command:b});
    }});
})();
