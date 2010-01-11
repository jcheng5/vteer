﻿/*
 Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function() {
    CKEDITOR.plugins.add('stylescombo', {requires:['richcombo','styles'],init:function(d) {
        var e = d.config,f = d.lang.stylesCombo,g = this.path,h;
        d.ui.addRichCombo('Styles', {label:f.label,title:f.panelTitle,voiceLabel:f.voiceLabel,className:'cke_styles',multiSelect:true,panel:{css:[e.contentsCss,CKEDITOR.getUrl(d.skinPath + 'editor.css')],voiceLabel:f.panelVoiceLabel},init:function() {
            var i = this,j = e.stylesCombo_stylesSet.split(':', 2),k = j[1] || CKEDITOR.getUrl(g + 'styles/' + j[0] + '.js');
            j = j[0];
            CKEDITOR.loadStylesSet(j, k, function(l) {
                var m,n,o = [];
                h = {};
                for (var p = 0; p < l.length; p++) {
                    var q = l[p];
                    n = q.name;
                    m = h[n] = new CKEDITOR.style(q);
                    m._name = n;
                    o.push(m);
                }
                o.sort(c);
                var r;
                for (p = 0; p < o.length; p++) {
                    m = o[p];
                    n = m._name;
                    var s = m.type;
                    if (s != r) {
                        i.startGroup(f['panelTitle' + String(s)]);
                        r = s;
                    }
                    i.add(n, m.type == CKEDITOR.STYLE_OBJECT ? n : b(m._.definition), n);
                }
                i.commit();
                i.onOpen();
            });
        },onClick:function(i) {
            d.focus();
            d.fire('saveSnapshot');
            var j = h[i],k = d.getSelection();
            if (j.type == CKEDITOR.STYLE_OBJECT) {
                var l = k.getSelectedElement();
                if (l)j.applyToObject(l);
                return;
            }
            var m = new CKEDITOR.dom.elementPath(k.getStartElement());
            if (j.type == CKEDITOR.STYLE_INLINE && j.checkActive(m))j.remove(d.document); else j.apply(d.document);
            d.fire('saveSnapshot');
        },onRender:function() {
            d.on('selectionChange', function(i) {
                var j = this.getValue(),k = i.data.path,l = k.elements;
                for (var m = 0,n; m < l.length; m++) {
                    n = l[m];
                    for (var o in h)if (h[o].checkElementRemovable(n, true)) {
                        if (o != j)this.setValue(o);
                        return;
                    }
                }
                this.setValue('');
            }, this);
        },onOpen:function() {
            var q = this;
            if (CKEDITOR.env.ie)d.focus();
            var i = d.getSelection(),j = i.getSelectedElement(),k = j && j.getName(),l = new CKEDITOR.dom.elementPath(j || i.getStartElement()),m = [0,0,0,0];
            q.showAll();
            q.unmarkAll();
            for (var n in h) {
                var o = h[n],p = o.type;
                if (p == CKEDITOR.STYLE_OBJECT) {
                    if (j && o.element == k) {
                        if (o.checkElementRemovable(j, true))q.mark(n);
                        m[p]++;
                    } else q.hideItem(n);
                } else {
                    if (o.checkActive(l))q.mark(n);
                    m[p]++;
                }
            }
            if (!m[CKEDITOR.STYLE_BLOCK])q.hideGroup(f['panelTitle' + String(CKEDITOR.STYLE_BLOCK)]);
            if (!m[CKEDITOR.STYLE_INLINE])q.hideGroup(f['panelTitle' + String(CKEDITOR.STYLE_INLINE)]);
            if (!m[CKEDITOR.STYLE_OBJECT])q.hideGroup(f['panelTitle' + String(CKEDITOR.STYLE_OBJECT)]);
        }});
    }});
    var a = {};
    CKEDITOR.addStylesSet = function(d, e) {
        a[d] = e;
    };
    CKEDITOR.loadStylesSet = function(d, e, f) {
        var g = a[d];
        if (g) {
            f(g);
            return;
        }
        CKEDITOR.scriptLoader.load(e, function() {
            f(a[d]);
        });
    };
    function b(d) {
        var e = [],f = d.element;
        if (f == 'bdo')f = 'span';
        e = ['<',f];
        var g = d.attributes;
        if (g)for (var h in g)e.push(' ', h, '="', g[h], '"');
        var i = CKEDITOR.style.getStyleText(d);
        if (i)e.push(' style="', i, '"');
        e.push('>', d.name, '</', f, '>');
        return e.join('');
    }

    ;
    function c(d, e) {
        var f = d.type,g = e.type;
        return f == g ? 0 : f == CKEDITOR.STYLE_OBJECT ? -1 : g == CKEDITOR.STYLE_OBJECT ? 1 : g == CKEDITOR.STYLE_BLOCK ? 1 : -1;
    }

    ;
})();
CKEDITOR.config.stylesCombo_stylesSet = 'default';
