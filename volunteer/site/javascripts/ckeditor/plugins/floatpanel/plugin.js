﻿/*
 Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.plugins.add('floatpanel', {requires:['panel']});
(function() {
    var a = {},b = false;

    function c(d, e, f, g, h) {
        var i = e.getUniqueId() + '-' + f.getUniqueId() + '-' + d.skinName + '-' + d.lang.dir + (d.uiColor && '-' + d.uiColor || '') + (g.css && '-' + g.css || '') + (h && '-' + h || ''),j = a[i];
        if (!j) {
            j = a[i] = new CKEDITOR.ui.panel(e, g);
            j.element = f.append(CKEDITOR.dom.element.createFromHtml(j.renderHtml(d), e));
            j.element.setStyles({display:'none',position:'absolute'});
        }
        return j;
    }

    ;
    CKEDITOR.ui.floatPanel = CKEDITOR.tools.createClass({$:function(d, e, f, g) {
        f.forceIFrame = true;
        var h = e.getDocument(),i = c(d, h, e, f, g || 0),j = i.element,k = j.getFirst().getFirst();
        this.element = j;
        this._ = {panel:i,parentElement:e,definition:f,document:h,iframe:k,children:[],dir:d.lang.dir};
    },proto:{addBlock:function(d, e) {
        return this._.panel.addBlock(d, e);
    },addListBlock:function(d, e) {
        return this._.panel.addListBlock(d, e);
    },getBlock:function(d) {
        return this._.panel.getBlock(d);
    },showBlock:function(d, e, f, g, h) {
        var i = this._.panel,j = i.showBlock(d);
        this.allowBlur(false);
        b = true;
        var k = this.element,l = this._.iframe,m = this._.definition,n = e.getDocumentPosition(k.getDocument()),o = this._.dir == 'rtl',p = n.x + (g || 0),q = n.y + (h || 0);
        if (o && (f == 1 || f == 4) || !o && (f == 2 || f == 3))p += e.$.offsetWidth - 1;
        if (f == 3 || f == 4)q += e.$.offsetHeight - 1;
        this._.panel._.offsetParentId = e.getId();
        k.setStyles({top:q + 'px',left:'-3000px',visibility:'hidden',opacity:'0',display:''});
        if (!this._.blurSet) {
            var r = CKEDITOR.env.ie ? l : new CKEDITOR.dom.window(l.$.contentWindow);
            CKEDITOR.event.useCapture = true;
            r.on('blur', function(s) {
                var v = this;
                if (CKEDITOR.env.ie && !v.allowBlur())return;
                var t = s.data.getTarget(),u = t.getWindow && t.getWindow();
                if (u && u.equals(r))return;
                if (v.visible && !v._.activeChild && !b)v.hide();
            }, this);
            r.on('focus', function() {
                this._.focused = true;
                this.hideChild();
                this.allowBlur(true);
            }, this);
            CKEDITOR.event.useCapture = false;
            this._.blurSet = 1;
        }
        i.onEscape = CKEDITOR.tools.bind(function() {
            this.onEscape && this.onEscape();
        }, this);
        CKEDITOR.tools.setTimeout(function() {
            if (o)p -= k.$.offsetWidth;
            k.setStyles({left:p + 'px',visibility:'',opacity:'1'});
            if (j.autoSize) {
                function s() {
                    var t = k.getFirst(),u = j.element.$.scrollHeight;
                    if (CKEDITOR.env.ie && CKEDITOR.env.quirks && u > 0)u += (t.$.offsetHeight || 0) - (t.$.clientHeight || 0);
                    t.setStyle('height', u + 'px');
                    i._.currentBlock.element.setStyle('display', 'none').removeStyle('display');
                }

                ;
                if (i.isLoaded)s(); else i.onLoad = s;
            } else k.getFirst().removeStyle('height');
            CKEDITOR.tools.setTimeout(function() {
                if (m.voiceLabel)if (CKEDITOR.env.gecko) {
                    var t = l.getParent();
                    t.setAttribute('role', 'region');
                    t.setAttribute('title', m.voiceLabel);
                    l.setAttribute('role', 'region');
                    l.setAttribute('title', ' ');
                }
                if (CKEDITOR.env.ie && CKEDITOR.env.quirks)l.focus(); else l.$.contentWindow.focus();
                if (CKEDITOR.env.ie && !CKEDITOR.env.quirks)this.allowBlur(true);
            }, 0, this);
        }, 0, this);
        this.visible = 1;
        if (this.onShow)this.onShow.call(this);
        b = false;
    },hide:function() {
        var d = this;
        if (d.visible && (!d.onHide || d.onHide.call(d) !== true)) {
            d.hideChild();
            d.element.setStyle('display', 'none');
            d.visible = 0;
        }
    },allowBlur:function(d) {
        var e = this._.panel;
        if (d != undefined)e.allowBlur = d;
        return e.allowBlur;
    },showAsChild:function(d, e, f, g, h, i) {
        if (this._.activeChild == d && d._.panel._.offsetParentId == f.getId())return;
        this.hideChild();
        d.onHide = CKEDITOR.tools.bind(function() {
            CKEDITOR.tools.setTimeout(function() {
                if (!this._.focused)this.hide();
            }, 0, this);
        }, this);
        this._.activeChild = d;
        this._.focused = false;
        d.showBlock(e, f, g, h, i);
        if (CKEDITOR.env.ie7Compat || CKEDITOR.env.ie8 && CKEDITOR.env.ie6Compat)setTimeout(function() {
            d.element.getChild(0).$.style.cssText += '';
        }, 100);
    },hideChild:function() {
        var d = this._.activeChild;
        if (d) {
            delete d.onHide;
            delete this._.activeChild;
            d.hide();
        }
    }}});
})();
