﻿/*
 Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.plugins.add('domiterator');
(function() {
    var a = function(c) {
        var d = this;
        if (arguments.length < 1)return;
        d.range = c;
        d.forceBrBreak = false;
        d.enlargeBr = true;
        d.enforceRealBlocks = false;
        d._ || (d._ = {});
    },b = /^[\r\n\t ]+$/;
    a.prototype = {getNextParagraph:function(c) {
        var D = this;
        var d,e,f,g,h;
        if (!D._.lastNode) {
            e = D.range.clone();
            e.enlarge(D.forceBrBreak || !D.enlargeBr ? CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS : CKEDITOR.ENLARGE_BLOCK_CONTENTS);
            var i = new CKEDITOR.dom.walker(e),j = CKEDITOR.dom.walker.bookmark(true, true);
            i.evaluator = j;
            D._.nextNode = i.next();
            i = new CKEDITOR.dom.walker(e);
            i.evaluator = j;
            var k = i.previous();
            D._.lastNode = k.getNextSourceNode(true);
            if (D._.lastNode && D._.lastNode.type == CKEDITOR.NODE_TEXT && !CKEDITOR.tools.trim(D._.lastNode.getText()) && D._.lastNode.getParent().isBlockBoundary()) {
                var l = new CKEDITOR.dom.range(e.document);
                l.moveToPosition(D._.lastNode, CKEDITOR.POSITION_AFTER_END);
                if (l.checkEndOfBlock()) {
                    var m = new CKEDITOR.dom.elementPath(l.endContainer),n = m.block || m.blockLimit;
                    D._.lastNode = n.getNextSourceNode(true);
                }
            }
            if (!D._.lastNode) {
                D._.lastNode = D._.docEndMarker = e.document.createText('');
                D._.lastNode.insertAfter(k);
            }
            e = null;
        }
        var o = D._.nextNode;
        k = D._.lastNode;
        D._.nextNode = null;
        while (o) {
            var p = false,q = o.type != CKEDITOR.NODE_ELEMENT,r = false;
            if (!q) {
                var s = o.getName();
                if (o.isBlockBoundary(D.forceBrBreak && {br:1})) {
                    if (s == 'br')q = true; else if (!e && !o.getChildCount() && s != 'hr') {
                        d = o;
                        f = o.equals(k);
                        break;
                    }
                    if (e) {
                        e.setEndAt(o, CKEDITOR.POSITION_BEFORE_START);
                        if (s != 'br')D._.nextNode = o;
                    }
                    p = true;
                } else {
                    if (o.getFirst()) {
                        if (!e) {
                            e = new CKEDITOR.dom.range(D.range.document);
                            e.setStartAt(o, CKEDITOR.POSITION_BEFORE_START);
                        }
                        o = o.getFirst();
                        continue;
                    }
                    q = true;
                }
            } else if (o.type == CKEDITOR.NODE_TEXT)if (b.test(o.getText()))q = false;
            if (q && !e) {
                e = new CKEDITOR.dom.range(D.range.document);
                e.setStartAt(o, CKEDITOR.POSITION_BEFORE_START);
            }
            f = (!p || q) && (o.equals(k));
            if (e && !p)while (!o.getNext() && !f) {
                var t = o.getParent();
                if (t.isBlockBoundary(D.forceBrBreak && {br:1})) {
                    p = true;
                    f = f || t.equals(k);
                    break;
                }
                o = t;
                q = true;
                f = o.equals(k);
                r = true;
            }
            if (q)e.setEndAt(o, CKEDITOR.POSITION_AFTER_END);
            o = o.getNextSourceNode(r, null, k);
            f = !o;
            if ((p || f) && (e)) {
                var u = e.getBoundaryNodes(),v = new CKEDITOR.dom.elementPath(e.startContainer),w = new CKEDITOR.dom.elementPath(e.endContainer);
                if (u.startNode.equals(u.endNode) && u.startNode.getParent().equals(v.blockLimit) && u.startNode.type == CKEDITOR.NODE_ELEMENT && u.startNode.getAttribute('_fck_bookmark')) {
                    e = null;
                    D._.nextNode = null;
                } else break;
            }
            if (f)break;
        }
        if (!d) {
            if (!e) {
                D._.docEndMarker && D._.docEndMarker.remove();
                D._.nextNode = null;
                return null;
            }
            v = new CKEDITOR.dom.elementPath(e.startContainer);
            var x = v.blockLimit,y = {div:1,th:1,td:1};
            d = v.block;
            if (!d && !D.enforceRealBlocks && y[x.getName()] && e.checkStartOfBlock() && e.checkEndOfBlock())d = x; else if (!d || D.enforceRealBlocks && d.getName() == 'li') {
                d = D.range.document.createElement(c || 'p');
                e.extractContents().appendTo(d);
                d.trim();
                e.insertNode(d);
                g = h = true;
            } else if (d.getName() != 'li') {
                if (!e.checkStartOfBlock() || !e.checkEndOfBlock()) {
                    d = d.clone(false);
                    e.extractContents().appendTo(d);
                    d.trim();
                    var z = e.splitBlock();
                    g = !z.wasStartOfBlock;
                    h = !z.wasEndOfBlock;
                    e.insertNode(d);
                }
            } else if (!f)D._.nextNode = d.equals(k) ? null : e.getBoundaryNodes().endNode.getNextSourceNode(true, null, k);
        }
        if (g) {
            var A = d.getPrevious();
            if (A && A.type == CKEDITOR.NODE_ELEMENT)if (A.getName() == 'br')A.remove(); else if (A.getLast() && A.getLast().$.nodeName.toLowerCase() == 'br')A.getLast().remove();
        }
        if (h) {
            var B = CKEDITOR.dom.walker.bookmark(false, true),C = d.getLast();
            if (C && C.type == CKEDITOR.NODE_ELEMENT && C.getName() == 'br')if (CKEDITOR.env.ie || C.getPrevious(B) || C.getNext(B))C.remove();
        }
        if (!D._.nextNode)D._.nextNode = f || d.equals(k) ? null : d.getNextSourceNode(true, null, k);
        return d;
    }};
    CKEDITOR.dom.range.prototype.createIterator = function() {
        return new a(this);
    };
})();
