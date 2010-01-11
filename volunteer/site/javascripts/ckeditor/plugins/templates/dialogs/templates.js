﻿/*
 Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function() {
    var a = CKEDITOR.document,b = 'cke' + CKEDITOR.tools.getNextNumber();

    function c(f, g) {
        var h = a.getById(b);
        h.setHtml('');
        for (var i = 0; i < g.length; i++) {
            var j = CKEDITOR.getTemplates(g[i]),k = j.imagesPath,l = j.templates;
            for (var m = 0; m < l.length; m++) {
                var n = l[m];
                h.append(d(f, n, k));
            }
        }
    }

    ;
    function d(f, g, h) {
        var i = a.createElement('div');
        i.setAttribute('class', 'cke_tpl_item');
        var j = '<table style="width:350px;" class="cke_tpl_preview"><tr>';
        if (g.image && h)j += '<td class="cke_tpl_preview_img"><img src="' + CKEDITOR.getUrl(h + g.image) + '"></td>';
        j += '<td style="white-space:normal;"><span class="cke_tpl_title">' + g.title + '</span><br/>';
        if (g.description)j += '<span>' + g.description + '</span>';
        j += '</td></tr></table>';
        i.setHtml(j);
        i.on('mouseover', function() {
            i.addClass('cke_tpl_hover');
        });
        i.on('mouseout', function() {
            i.removeClass('cke_tpl_hover');
        });
        i.on('click', function() {
            e(f, g.html);
        });
        return i;
    }

    ;
    function e(f, g) {
        var h = CKEDITOR.dialog.getCurrent(),i = h.getValueOf('selectTpl', 'chkInsertOpt');
        if (i)f.setData(g); else f.insertHtml(g);
        h.hide();
    }

    ;
    CKEDITOR.dialog.add('templates', function(f) {
        CKEDITOR.skins.load(f, 'templates');
        var g = false;
        return{title:f.lang.templates.title,minWidth:CKEDITOR.env.ie ? 440 : 400,minHeight:340,contents:[
            {
                id:'selectTpl',
                label:f.lang.templates.title,
                elements:[
                    {
                        type:'vbox',
                        padding:5,
                        children:[
                            {
                                type:'html',
                                html:'<span>' + f.lang.templates.selectPromptMsg + '</span>'
                            },
                            {
                                type:'html',
                                html:'<div id="' + b + '" class="cke_tpl_list">' + '<div class="cke_tpl_loading"><span></span></div>' + '</div>'
                            },
                            {
                                id:'chkInsertOpt',
                                type:'checkbox',
                                label:f.lang.templates.insertOption,
                                'default':f.config.templates_replaceContent
                            }
                        ]
                    }
                ]
            }
        ],buttons:[CKEDITOR.dialog.cancelButton],onShow:function() {
            CKEDITOR.loadTemplates(f.config.templates_files, function() {
                var h = f.config.templates.split(',');
                if (h.length)c(f, h); else {
                    var i = a.getById(b);
                    i.setHtml('<div class="cke_tpl_empty"><span>' + f.lang.templates.emptyListMsg + '</span>' + '</div>');
                }
            });
        }};
    });
})();
