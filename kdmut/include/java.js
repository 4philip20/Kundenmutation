/*!
 * Bootstrap-select v1.13.1 (https://developer.snapappointments.com/bootstrap-select)
 *
 * Copyright 2012-2018 SnapAppointments, LLC
 * Licensed under MIT (https://github.com/snapappointments/bootstrap-select/blob/master/LICENSE)
 */

!function (a, b) {
    "function" == typeof define && define.amd ? define(["jquery"], function (a) {
        return b(a)
    }) : "object" == typeof module && module.exports ? module.exports = b(require("jquery")) : b(a.jQuery)
}(this, function (a) {
    !function (a) {
        "use strict";

        function b(a, b) {
            return a.length === b.length && a.every(function (a, c) {
                return a === b[c]
            })
        }

        function c(a) {
            var b, c = [], d = a && a.options;
            if (a.multiple) for (var e = 0, f = d.length; e < f; e++) b = d[e], b.selected && c.push(b.value || b.text); else c = a.value;
            return c
        }

        function d(a, b, c, d) {
            for (var e = ["content", "subtext", "tokens"], g = !1, h = 0; h < e.length; h++) {
                var i = e[h], j = a[i];
                if (j && (j = j.toString(), "content" === i && (j = j.replace(/<[^>]+>/g, "")), d && (j = f(j)), j = j.toUpperCase(), g = "contains" === c ? j.indexOf(b) >= 0 : j.startsWith(b))) break
            }
            return g
        }

        function e(a) {
            return parseInt(a, 10) || 0
        }

        function f(b) {
            var c = [{re: /[\xC0-\xC6]/g, ch: "A"}, {re: /[\xE0-\xE6]/g, ch: "a"}, {
                re: /[\xC8-\xCB]/g,
                ch: "E"
            }, {re: /[\xE8-\xEB]/g, ch: "e"}, {re: /[\xCC-\xCF]/g, ch: "I"}, {
                re: /[\xEC-\xEF]/g,
                ch: "i"
            }, {re: /[\xD2-\xD6]/g, ch: "O"}, {re: /[\xF2-\xF6]/g, ch: "o"}, {
                re: /[\xD9-\xDC]/g,
                ch: "U"
            }, {re: /[\xF9-\xFC]/g, ch: "u"}, {re: /[\xC7-\xE7]/g, ch: "c"}, {re: /[\xD1]/g, ch: "N"}, {
                re: /[\xF1]/g,
                ch: "n"
            }];
            return a.each(c, function () {
                b = b ? b.replace(this.re, this.ch) : ""
            }), b
        }

        function g(b) {
            var c = arguments, d = b;
            [].shift.apply(c);
            var e, f = this.each(function () {
                var b = a(this);
                if (b.is("select")) {
                    var f = b.data("selectpicker"), g = "object" == typeof d && d;
                    if (f) {
                        if (g) for (var h in g) g.hasOwnProperty(h) && (f.options[h] = g[h])
                    } else {
                        var i = a.extend({}, x.DEFAULTS, a.fn.selectpicker.defaults || {}, b.data(), g);
                        i.template = a.extend({}, x.DEFAULTS.template, a.fn.selectpicker.defaults ? a.fn.selectpicker.defaults.template : {}, b.data().template, g.template), b.data("selectpicker", f = new x(this, i))
                    }
                    "string" == typeof d && (e = f[d] instanceof Function ? f[d].apply(f, c) : f.options[d])
                }
            });
            return void 0 !== e ? e : f
        }

        var h = document.createElement("_");
        if (h.classList.toggle("c3", !1), h.classList.contains("c3")) {
            var i = DOMTokenList.prototype.toggle;
            DOMTokenList.prototype.toggle = function (a, b) {
                return 1 in arguments && !this.contains(a) == !b ? b : i.call(this, a)
            }
        }
        String.prototype.startsWith || function () {
            var a = function () {
                try {
                    var a = {}, b = Object.defineProperty, c = b(a, a, a) && b
                } catch (a) {
                }
                return c
            }(), b = {}.toString, c = function (a) {
                if (null == this) throw new TypeError;
                var c = String(this);
                if (a && "[object RegExp]" == b.call(a)) throw new TypeError;
                var d = c.length, e = String(a), f = e.length, g = arguments.length > 1 ? arguments[1] : void 0,
                    h = g ? Number(g) : 0;
                h != h && (h = 0);
                var i = Math.min(Math.max(h, 0), d);
                if (f + i > d) return !1;
                for (var j = -1; ++j < f;) if (c.charCodeAt(i + j) != e.charCodeAt(j)) return !1;
                return !0
            };
            a ? a(String.prototype, "startsWith", {
                value: c,
                configurable: !0,
                writable: !0
            }) : String.prototype.startsWith = c
        }(), Object.keys || (Object.keys = function (a, b, c) {
            c = [];
            for (b in a) c.hasOwnProperty.call(a, b) && c.push(b);
            return c
        });
        var j = {useDefault: !1, _set: a.valHooks.select.set};
        a.valHooks.select.set = function (b, c) {
            return c && !j.useDefault && a(b).data("selected", !0), j._set.apply(this, arguments)
        };
        var k = null, l = function () {
            try {
                return new Event("change"), !0
            } catch (a) {
                return !1
            }
        }();
        a.fn.triggerNative = function (a) {
            var b, c = this[0];
            c.dispatchEvent ? (l ? b = new Event(a, {bubbles: !0}) : (b = document.createEvent("Event"), b.initEvent(a, !0, !1)), c.dispatchEvent(b)) : c.fireEvent ? (b = document.createEventObject(), b.eventType = a, c.fireEvent("on" + a, b)) : this.trigger(a)
        };
        var m = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#x27;", "`": "&#x60;"},
            n = {"&amp;": "&", "&lt;": "<", "&gt;": ">", "&quot;": '"', "&#x27;": "'", "&#x60;": "`"},
            o = function (a) {
                var b = function (b) {
                    return a[b]
                }, c = "(?:" + Object.keys(a).join("|") + ")", d = RegExp(c), e = RegExp(c, "g");
                return function (a) {
                    return a = null == a ? "" : "" + a, d.test(a) ? a.replace(e, b) : a
                }
            }, p = o(m), q = o(n), r = {
                32: " ",
                48: "0",
                49: "1",
                50: "2",
                51: "3",
                52: "4",
                53: "5",
                54: "6",
                55: "7",
                56: "8",
                57: "9",
                59: ";",
                65: "A",
                66: "B",
                67: "C",
                68: "D",
                69: "E",
                70: "F",
                71: "G",
                72: "H",
                73: "I",
                74: "J",
                75: "K",
                76: "L",
                77: "M",
                78: "N",
                79: "O",
                80: "P",
                81: "Q",
                82: "R",
                83: "S",
                84: "T",
                85: "U",
                86: "V",
                87: "W",
                88: "X",
                89: "Y",
                90: "Z",
                96: "0",
                97: "1",
                98: "2",
                99: "3",
                100: "4",
                101: "5",
                102: "6",
                103: "7",
                104: "8",
                105: "9"
            }, s = {ESCAPE: 27, ENTER: 13, SPACE: 32, TAB: 9, ARROW_UP: 38, ARROW_DOWN: 40}, t = {};
        try {
            t.full = (a.fn.dropdown.Constructor.VERSION || "").split(" ")[0].split("."), t.major = t.full[0]
        } catch (a) {
            console.error("There was an issue retrieving Bootstrap's version. Ensure Bootstrap is being loaded before bootstrap-select and there is no namespace collision.", a), t.major = "3"
        }
        var u = {
                DISABLED: "disabled",
                DIVIDER: "4" === t.major ? "dropdown-divider" : "divider",
                SHOW: "4" === t.major ? "show" : "open",
                DROPUP: "dropup",
                MENURIGHT: "dropdown-menu-right",
                MENULEFT: "dropdown-menu-left",
                BUTTONCLASS: "4" === t.major ? "btn-light" : "btn-default",
                POPOVERHEADER: "4" === t.major ? "popover-header" : "popover-title"
            }, v = new RegExp(s.ARROW_UP + "|" + s.ARROW_DOWN), w = new RegExp("^" + s.TAB + "$|" + s.ESCAPE),
            x = (new RegExp(s.ENTER + "|" + s.SPACE), function (b, c) {
                var d = this;
                j.useDefault || (a.valHooks.select.set = j._set, j.useDefault = !0), this.$element = a(b), this.$newElement = null, this.$button = null, this.$menu = null, this.options = c, this.selectpicker = {
                    main: {
                        map: {
                            newIndex: {},
                            originalIndex: {}
                        }
                    },
                    current: {map: {}},
                    search: {map: {}},
                    view: {},
                    keydown: {
                        keyHistory: "", resetKeyHistory: {
                            start: function () {
                                return setTimeout(function () {
                                    d.selectpicker.keydown.keyHistory = ""
                                }, 800)
                            }
                        }
                    }
                }, null === this.options.title && (this.options.title = this.$element.attr("title"));
                var e = this.options.windowPadding;
                "number" == typeof e && (this.options.windowPadding = [e, e, e, e]), this.val = x.prototype.val, this.render = x.prototype.render, this.refresh = x.prototype.refresh, this.setStyle = x.prototype.setStyle, this.selectAll = x.prototype.selectAll, this.deselectAll = x.prototype.deselectAll, this.destroy = x.prototype.destroy, this.remove = x.prototype.remove, this.show = x.prototype.show, this.hide = x.prototype.hide, this.init()
            });
        x.VERSION = "1.13.1", x.DEFAULTS = {
            noneSelectedText: "Nothing selected",
            noneResultsText: "No results matched {0}",
            countSelectedText: function (a, b) {
                return 1 == a ? "{0} item selected" : "{0} items selected"
            },
            maxOptionsText: function (a, b) {
                return [1 == a ? "Limit reached ({n} item max)" : "Limit reached ({n} items max)", 1 == b ? "Group limit reached ({n} item max)" : "Group limit reached ({n} items max)"]
            },
            selectAllText: "Select All",
            deselectAllText: "Deselect All",
            doneButton: !1,
            doneButtonText: "Close",
            multipleSeparator: ", ",
            styleBase: "btn",
            style: "btn-default",
            size: "auto",
            title: null,
            selectedTextFormat: "values",
            width: !1,
            container: !1,
            hideDisabled: !1,
            showSubtext: !1,
            showIcon: !0,
            showContent: !0,
            dropupAuto: !0,
            header: !1,
            liveSearch: !1,
            liveSearchPlaceholder: null,
            liveSearchNormalize: !1,
            liveSearchStyle: "contains",
            actionsBox: !1,
            iconBase: "glyphicon",
            tickIcon: "glyphicon-ok",
            showTick: !1,
            template: {caret: '<span class="caret"></span>'},
            maxOptions: !1,
            mobile: !1,
            selectOnTab: !1,
            dropdownAlignRight: !1,
            windowPadding: 0,
            virtualScroll: 600
        }, "4" === t.major && (x.DEFAULTS.style = "btn-light", x.DEFAULTS.iconBase = "", x.DEFAULTS.tickIcon = "bs-ok-default"), x.prototype = {
            constructor: x, init: function () {
                var a = this, b = this.$element.attr("id");
                this.$element.addClass("bs-select-hidden"), this.multiple = this.$element.prop("multiple"), this.autofocus = this.$element.prop("autofocus"), this.$newElement = this.createDropdown(), this.createLi(), this.$element.after(this.$newElement).prependTo(this.$newElement), this.$button = this.$newElement.children("button"), this.$menu = this.$newElement.children(".dropdown-menu"), this.$menuInner = this.$menu.children(".inner"), this.$searchbox = this.$menu.find("input"), this.$element.removeClass("bs-select-hidden"), !0 === this.options.dropdownAlignRight && this.$menu.addClass(u.MENURIGHT), void 0 !== b && this.$button.attr("data-id", b), this.checkDisabled(), this.clickListener(), this.options.liveSearch && this.liveSearchListener(), this.render(), this.setStyle(), this.setWidth(), this.options.container ? this.selectPosition() : this.$element.on("hide.bs.select", function () {
                    if (a.isVirtual()) {
                        var b = a.$menuInner[0], c = b.firstChild.cloneNode(!1);
                        b.replaceChild(c, b.firstChild), b.scrollTop = 0
                    }
                }), this.$menu.data("this", this), this.$newElement.data("this", this), this.options.mobile && this.mobile(), this.$newElement.on({
                    "hide.bs.dropdown": function (b) {
                        a.$menuInner.attr("aria-expanded", !1), a.$element.trigger("hide.bs.select", b)
                    }, "hidden.bs.dropdown": function (b) {
                        a.$element.trigger("hidden.bs.select", b)
                    }, "show.bs.dropdown": function (b) {
                        a.$menuInner.attr("aria-expanded", !0), a.$element.trigger("show.bs.select", b)
                    }, "shown.bs.dropdown": function (b) {
                        a.$element.trigger("shown.bs.select", b)
                    }
                }), a.$element[0].hasAttribute("required") && this.$element.on("invalid", function () {
                    a.$button.addClass("bs-invalid"), a.$element.on({
                        "shown.bs.select": function () {
                            a.$element.val(a.$element.val()).off("shown.bs.select")
                        }, "rendered.bs.select": function () {
                            this.validity.valid && a.$button.removeClass("bs-invalid"), a.$element.off("rendered.bs.select")
                        }
                    }), a.$button.on("blur.bs.select", function () {
                        a.$element.focus().blur(), a.$button.off("blur.bs.select")
                    })
                }), setTimeout(function () {
                    a.$element.trigger("loaded.bs.select")
                })
            }, createDropdown: function () {
                var b = this.multiple || this.options.showTick ? " show-tick" : "",
                    c = this.autofocus ? " autofocus" : "",
                    d = this.options.header ? '<div class="' + u.POPOVERHEADER + '"><button type="button" class="close" aria-hidden="true">&times;</button>' + this.options.header + "</div>" : "",
                    e = this.options.liveSearch ? '<div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"' + (null === this.options.liveSearchPlaceholder ? "" : ' placeholder="' + p(this.options.liveSearchPlaceholder) + '"') + ' role="textbox" aria-label="Search"></div>' : "",
                    f = this.multiple && this.options.actionsBox ? '<div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn ' + u.BUTTONCLASS + '">' + this.options.selectAllText + '</button><button type="button" class="actions-btn bs-deselect-all btn ' + u.BUTTONCLASS + '">' + this.options.deselectAllText + "</button></div></div>" : "",
                    g = this.multiple && this.options.doneButton ? '<div class="bs-donebutton"><div class="btn-group btn-block"><button type="button" class="btn btn-sm ' + u.BUTTONCLASS + '">' + this.options.doneButtonText + "</button></div></div>" : "",
                    h = '<div class="dropdown bootstrap-select' + b + '"><button type="button" class="' + this.options.styleBase + ' dropdown-toggle" data-toggle="dropdown"' + c + ' role="button"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner"></div></div> </div>' + ("4" === t.major ? "" : '<span class="bs-caret">' + this.options.template.caret + "</span>") + '</button><div class="dropdown-menu ' + ("4" === t.major ? "" : u.SHOW) + '" role="combobox">' + d + e + f + '<div class="inner ' + u.SHOW + '" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner ' + ("4" === t.major ? u.SHOW : "") + '"></ul></div>' + g + "</div></div>";
                return a(h)
            }, setPositionData: function () {
                this.selectpicker.view.canHighlight = [];
                for (var a = 0; a < this.selectpicker.current.data.length; a++) {
                    var b = this.selectpicker.current.data[a], c = !0;
                    "divider" === b.type ? (c = !1, b.height = this.sizeInfo.dividerHeight) : "optgroup-label" === b.type ? (c = !1, b.height = this.sizeInfo.dropdownHeaderHeight) : b.height = this.sizeInfo.liHeight, b.disabled && (c = !1), this.selectpicker.view.canHighlight.push(c), b.position = (0 === a ? 0 : this.selectpicker.current.data[a - 1].position) + b.height
                }
            }, isVirtual: function () {
                return !1 !== this.options.virtualScroll && this.selectpicker.main.elements.length >= this.options.virtualScroll || !0 === this.options.virtualScroll
            }, createView: function (c, d) {
                function e(a, d) {
                    var e, j, k, l, m, n, o, p = f.selectpicker.current.elements.length, q = [], r = void 0, s = !0,
                        t = f.isVirtual();
                    f.selectpicker.view.scrollTop = a, !0 === t && f.sizeInfo.hasScrollBar && f.$menu[0].offsetWidth > f.sizeInfo.totalMenuWidth && (f.sizeInfo.menuWidth = f.$menu[0].offsetWidth, f.sizeInfo.totalMenuWidth = f.sizeInfo.menuWidth + f.sizeInfo.scrollBarWidth, f.$menu.css("min-width", f.sizeInfo.menuWidth)), e = Math.ceil(f.sizeInfo.menuInnerHeight / f.sizeInfo.liHeight * 1.5), j = Math.round(p / e) || 1;
                    for (var u = 0; u < j; u++) {
                        var v = (u + 1) * e;
                        if (u === j - 1 && (v = p), q[u] = [u * e + (u ? 1 : 0), v], !p) break;
                        void 0 === r && a <= f.selectpicker.current.data[v - 1].position - f.sizeInfo.menuInnerHeight && (r = u)
                    }
                    if (void 0 === r && (r = 0), m = [f.selectpicker.view.position0, f.selectpicker.view.position1], k = Math.max(0, r - 1), l = Math.min(j - 1, r + 1), f.selectpicker.view.position0 = Math.max(0, q[k][0]) || 0, f.selectpicker.view.position1 = Math.min(p, q[l][1]) || 0, n = m[0] !== f.selectpicker.view.position0 || m[1] !== f.selectpicker.view.position1, void 0 !== f.activeIndex && (h = f.selectpicker.current.elements[f.selectpicker.current.map.newIndex[f.prevActiveIndex]], i = f.selectpicker.current.elements[f.selectpicker.current.map.newIndex[f.activeIndex]], g = f.selectpicker.current.elements[f.selectpicker.current.map.newIndex[f.selectedIndex]], d && (f.activeIndex !== f.selectedIndex && (i.classList.remove("active"), i.firstChild && i.firstChild.classList.remove("active")), f.activeIndex = void 0), f.activeIndex && f.activeIndex !== f.selectedIndex && g && g.length && (g.classList.remove("active"), g.firstChild && g.firstChild.classList.remove("active"))), void 0 !== f.prevActiveIndex && f.prevActiveIndex !== f.activeIndex && f.prevActiveIndex !== f.selectedIndex && h && h.length && (h.classList.remove("active"), h.firstChild && h.firstChild.classList.remove("active")), (d || n) && (o = f.selectpicker.view.visibleElements ? f.selectpicker.view.visibleElements.slice() : [], f.selectpicker.view.visibleElements = f.selectpicker.current.elements.slice(f.selectpicker.view.position0, f.selectpicker.view.position1), f.setOptionStatus(), (c || !1 === t && d) && (s = !b(o, f.selectpicker.view.visibleElements)), (d || !0 === t) && s)) {
                        var w, x, y = f.$menuInner[0], z = document.createDocumentFragment(),
                            A = y.firstChild.cloneNode(!1),
                            B = !0 === t ? f.selectpicker.view.visibleElements : f.selectpicker.current.elements;
                        y.replaceChild(A, y.firstChild);
                        for (var u = 0, C = B.length; u < C; u++) z.appendChild(B[u]);
                        !0 === t && (w = 0 === f.selectpicker.view.position0 ? 0 : f.selectpicker.current.data[f.selectpicker.view.position0 - 1].position, x = f.selectpicker.view.position1 > p - 1 ? 0 : f.selectpicker.current.data[p - 1].position - f.selectpicker.current.data[f.selectpicker.view.position1 - 1].position, y.firstChild.style.marginTop = w + "px", y.firstChild.style.marginBottom = x + "px"), y.firstChild.appendChild(z)
                    }
                    if (f.prevActiveIndex = f.activeIndex, f.options.liveSearch) {
                        if (c && d) {
                            var D, E = 0;
                            f.selectpicker.view.canHighlight[E] || (E = 1 + f.selectpicker.view.canHighlight.slice(1).indexOf(!0)), D = f.selectpicker.view.visibleElements[E], f.selectpicker.view.currentActive && (f.selectpicker.view.currentActive.classList.remove("active"), f.selectpicker.view.currentActive.firstChild && f.selectpicker.view.currentActive.firstChild.classList.remove("active")), D && (D.classList.add("active"), D.firstChild && D.firstChild.classList.add("active")), f.activeIndex = f.selectpicker.current.map.originalIndex[E]
                        }
                    } else f.$menuInner.focus()
                }

                d = d || 0;
                var f = this;
                this.selectpicker.current = c ? this.selectpicker.search : this.selectpicker.main;
                var g, h, i = [];
                this.setPositionData(), e(d, !0), this.$menuInner.off("scroll.createView").on("scroll.createView", function (a, b) {
                    f.noScroll || e(this.scrollTop, b), f.noScroll = !1
                }), a(window).off("resize.createView").on("resize.createView", function () {
                    e(f.$menuInner[0].scrollTop)
                })
            }, createLi: function () {
                var b, c = this, d = [], e = 0, f = 0, g = [], h = 0, i = 0, j = -1;
                this.selectpicker.view.titleOption || (this.selectpicker.view.titleOption = document.createElement("option"));
                var k = {
                    span: document.createElement("span"),
                    subtext: document.createElement("small"),
                    a: document.createElement("a"),
                    li: document.createElement("li"),
                    whitespace: document.createTextNode("Â ")
                }, l = k.span.cloneNode(!1), m = document.createDocumentFragment();
                l.className = c.options.iconBase + " " + c.options.tickIcon + " check-mark", k.a.appendChild(l), k.a.setAttribute("role", "option"), k.subtext.className = "text-muted", k.text = k.span.cloneNode(!1), k.text.className = "text";
                var n = function (a, b, c, d) {
                    var e = k.li.cloneNode(!1);
                    return a && (1 === a.nodeType || 11 === a.nodeType ? e.appendChild(a) : e.innerHTML = a), void 0 !== c && "" !== c && (e.className = c), void 0 !== d && null !== d && e.classList.add("optgroup-" + d), e
                }, o = function (a, b, c) {
                    var d = k.a.cloneNode(!0);
                    return a && (11 === a.nodeType ? d.appendChild(a) : d.insertAdjacentHTML("beforeend", a)), void 0 !== b & "" !== b && (d.className = b), "4" === t.major && d.classList.add("dropdown-item"), c && d.setAttribute("style", c), d
                }, q = function (a) {
                    var b, d, e = k.text.cloneNode(!1);
                    if (a.optionContent) e.innerHTML = a.optionContent; else {
                        if (e.textContent = a.text, a.optionIcon) {
                            var f = k.whitespace.cloneNode(!1);
                            d = k.span.cloneNode(!1), d.className = c.options.iconBase + " " + a.optionIcon, m.appendChild(d), m.appendChild(f)
                        }
                        a.optionSubtext && (b = k.subtext.cloneNode(!1), b.innerHTML = a.optionSubtext, e.appendChild(b))
                    }
                    return m.appendChild(e), m
                }, r = function (a) {
                    var b, d, e = k.text.cloneNode(!1);
                    if (e.textContent = a.labelEscaped, a.labelIcon) {
                        var f = k.whitespace.cloneNode(!1);
                        d = k.span.cloneNode(!1), d.className = c.options.iconBase + " " + a.labelIcon, m.appendChild(d), m.appendChild(f)
                    }
                    return a.labelSubtext && (b = k.subtext.cloneNode(!1), b.textContent = a.labelSubtext, e.appendChild(b)), m.appendChild(e), m
                };
                if (this.options.title && !this.multiple) {
                    j--;
                    var s = this.$element[0], v = !1, w = !this.selectpicker.view.titleOption.parentNode;
                    if (w) {
                        this.selectpicker.view.titleOption.className = "bs-title-option", this.selectpicker.view.titleOption.value = "";
                        v = void 0 === a(s.options[s.selectedIndex]).attr("selected") && void 0 === this.$element.data("selected")
                    }
                    (w || 0 !== this.selectpicker.view.titleOption.index) && s.insertBefore(this.selectpicker.view.titleOption, s.firstChild), v && (s.selectedIndex = 0)
                }
                var x = this.$element.find("option");
                x.each(function (k) {
                    var l = a(this);
                    if (j++, !l.hasClass("bs-title-option")) {
                        var m, s, t = l.data(), v = this.className || "", w = p(this.style.cssText), y = t.content,
                            z = this.textContent, A = t.tokens, B = t.subtext, C = t.icon, D = l.parent(), E = D[0],
                            F = "OPTGROUP" === E.tagName, G = F && E.disabled, H = this.disabled || G,
                            I = this.previousElementSibling && "OPTGROUP" === this.previousElementSibling.tagName,
                            J = D.data();
                        if (!0 === t.hidden || c.options.hideDisabled && (H && !F || G)) {
                            if (m = t.prevHiddenIndex, l.next().data("prevHiddenIndex", void 0 !== m ? m : k), j--, !I && void 0 !== m) {
                                var K = x[m].previousElementSibling;
                                K && "OPTGROUP" === K.tagName && !K.disabled && (I = !0)
                            }
                            return void (I && "divider" !== g[g.length - 1].type && (j++, d.push(n(!1, 0, u.DIVIDER, h + "div")), g.push({
                                type: "divider",
                                optID: h,
                                originalIndex: k
                            })))
                        }
                        if (F && !0 !== t.divider) {
                            if (c.options.hideDisabled && H) {
                                if (void 0 === J.allOptionsDisabled) {
                                    var L = D.children();
                                    D.data("allOptionsDisabled", L.filter(":disabled").length === L.length)
                                }
                                if (D.data("allOptionsDisabled")) return void j--
                            }
                            var M = " " + E.className || "";
                            if (!this.previousElementSibling) {
                                h += 1;
                                var N = E.label, O = p(N), P = J.subtext, Q = J.icon;
                                0 !== k && d.length > 0 && (j++, d.push(n(!1, 0, u.DIVIDER, h + "div")), g.push({
                                    type: "divider",
                                    optID: h,
                                    originalIndex: k
                                })), j++;
                                var R = r({labelEscaped: O, labelSubtext: P, labelIcon: Q});
                                d.push(n(R, 0, "dropdown-header" + M, h)), g.push({
                                    content: O,
                                    subtext: P,
                                    type: "optgroup-label",
                                    optID: h,
                                    originalIndex: k
                                }), i = j - 1
                            }
                            if (c.options.hideDisabled && H || !0 === t.hidden) return void j--;
                            s = q({
                                text: z,
                                optionContent: y,
                                optionSubtext: B,
                                optionIcon: C
                            }), d.push(n(o(s, "opt " + v + M, w), 0, "", h)), g.push({
                                content: y || z,
                                subtext: B,
                                tokens: A,
                                type: "option",
                                optID: h,
                                headerIndex: i,
                                lastIndex: i + E.childElementCount,
                                originalIndex: k,
                                data: t
                            }), e++
                        } else if (!0 === t.divider) d.push(n(!1, 0, "divider")), g.push({
                            type: "divider",
                            originalIndex: k
                        }); else {
                            if (!I && c.options.hideDisabled && void 0 !== (m = t.prevHiddenIndex)) {
                                var K = x[m].previousElementSibling;
                                K && "OPTGROUP" === K.tagName && !K.disabled && (I = !0)
                            }
                            I && "divider" !== g[g.length - 1].type && (j++, d.push(n(!1, 0, u.DIVIDER, h + "div")), g.push({
                                type: "divider",
                                optID: h,
                                originalIndex: k
                            })), s = q({
                                text: z,
                                optionContent: y,
                                optionSubtext: B,
                                optionIcon: C
                            }), d.push(n(o(s, v, w))), g.push({
                                content: y || z,
                                subtext: B,
                                tokens: A,
                                type: "option",
                                originalIndex: k,
                                data: t
                            }), e++
                        }
                        c.selectpicker.main.map.newIndex[k] = j, c.selectpicker.main.map.originalIndex[j] = k;
                        var S = g[g.length - 1];
                        S.disabled = H;
                        var T = 0;
                        S.content && (T += S.content.length), S.subtext && (T += S.subtext.length), C && (T += 1), T > f && (f = T, b = d[d.length - 1])
                    }
                }), this.selectpicker.main.elements = d, this.selectpicker.main.data = g, this.selectpicker.current = this.selectpicker.main, this.selectpicker.view.widestOption = b, this.selectpicker.view.availableOptionsCount = e
            }, findLis: function () {
                return this.$menuInner.find(".inner > li")
            }, render: function () {
                var a = this, b = this.$element.find("option"), c = [], d = [];
                this.togglePlaceholder(), this.tabIndex();
                for (var e = 0, f = this.selectpicker.main.elements.length; e < f; e++) {
                    var g = this.selectpicker.main.map.originalIndex[e], h = b[g];
                    if (h && h.selected && (c.push(h), d.length < 100 && "count" !== a.options.selectedTextFormat || 1 === c.length)) {
                        if (a.options.hideDisabled && (h.disabled || "OPTGROUP" === h.parentNode.tagName && h.parentNode.disabled)) return;
                        var i, j, k = this.selectpicker.main.data[e].data,
                            l = k.icon && a.options.showIcon ? '<i class="' + a.options.iconBase + " " + k.icon + '"></i> ' : "";
                        i = a.options.showSubtext && k.subtext && !a.multiple ? ' <small class="text-muted">' + k.subtext + "</small>" : "", j = h.title ? h.title : k.content && a.options.showContent ? k.content.toString() : l + h.innerHTML.trim() + i, d.push(j)
                    }
                }
                var m = this.multiple ? d.join(this.options.multipleSeparator) : d[0];
                if (c.length > 50 && (m += "..."), this.multiple && -1 !== this.options.selectedTextFormat.indexOf("count")) {
                    var n = this.options.selectedTextFormat.split(">");
                    if (n.length > 1 && c.length > n[1] || 1 === n.length && c.length >= 2) {
                        var o = this.selectpicker.view.availableOptionsCount;
                        m = ("function" == typeof this.options.countSelectedText ? this.options.countSelectedText(c.length, o) : this.options.countSelectedText).replace("{0}", c.length.toString()).replace("{1}", o.toString())
                    }
                }
                void 0 == this.options.title && (this.options.title = this.$element.attr("title")), "static" == this.options.selectedTextFormat && (m = this.options.title), m || (m = void 0 !== this.options.title ? this.options.title : this.options.noneSelectedText), this.$button[0].title = q(m.replace(/<[^>]*>?/g, "").trim()), this.$button.find(".filter-option-inner-inner")[0].innerHTML = m, this.$element.trigger("rendered.bs.select")
            }, setStyle: function (a, b) {
                this.$element.attr("class") && this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|bs-select-hidden|validate\[.*\]/gi, ""));
                var c = a || this.options.style;
                "add" == b ? this.$button.addClass(c) : "remove" == b ? this.$button.removeClass(c) : (this.$button.removeClass(this.options.style), this.$button.addClass(c))
            }, liHeight: function (b) {
                if (b || !1 !== this.options.size && !this.sizeInfo) {
                    this.sizeInfo || (this.sizeInfo = {});
                    var c = document.createElement("div"), d = document.createElement("div"),
                        f = document.createElement("div"), g = document.createElement("ul"),
                        h = document.createElement("li"), i = document.createElement("li"),
                        j = document.createElement("li"), k = document.createElement("a"),
                        l = document.createElement("span"),
                        m = this.options.header && this.$menu.find("." + u.POPOVERHEADER).length > 0 ? this.$menu.find("." + u.POPOVERHEADER)[0].cloneNode(!0) : null,
                        n = this.options.liveSearch ? document.createElement("div") : null,
                        o = this.options.actionsBox && this.multiple && this.$menu.find(".bs-actionsbox").length > 0 ? this.$menu.find(".bs-actionsbox")[0].cloneNode(!0) : null,
                        p = this.options.doneButton && this.multiple && this.$menu.find(".bs-donebutton").length > 0 ? this.$menu.find(".bs-donebutton")[0].cloneNode(!0) : null;
                    if (this.sizeInfo.selectWidth = this.$newElement[0].offsetWidth, l.className = "text", k.className = "dropdown-item", c.className = this.$menu[0].parentNode.className + " " + u.SHOW, c.style.width = this.sizeInfo.selectWidth + "px", d.className = "dropdown-menu " + u.SHOW, f.className = "inner " + u.SHOW, g.className = "dropdown-menu inner " + ("4" === t.major ? u.SHOW : ""), h.className = u.DIVIDER, i.className = "dropdown-header", l.appendChild(document.createTextNode("Inner text")), k.appendChild(l), j.appendChild(k), i.appendChild(l.cloneNode(!0)), this.selectpicker.view.widestOption && g.appendChild(this.selectpicker.view.widestOption.cloneNode(!0)), g.appendChild(j), g.appendChild(h), g.appendChild(i), m && d.appendChild(m), n) {
                        var q = document.createElement("input");
                        n.className = "bs-searchbox", q.className = "form-control", n.appendChild(q), d.appendChild(n)
                    }
                    o && d.appendChild(o), f.appendChild(g), d.appendChild(f), p && d.appendChild(p), c.appendChild(d), document.body.appendChild(c);
                    var r, s = k.offsetHeight, v = i ? i.offsetHeight : 0, w = m ? m.offsetHeight : 0,
                        x = n ? n.offsetHeight : 0, y = o ? o.offsetHeight : 0, z = p ? p.offsetHeight : 0,
                        A = a(h).outerHeight(!0), B = !!window.getComputedStyle && window.getComputedStyle(d),
                        C = d.offsetWidth, D = B ? null : a(d), E = {
                            vert: e(B ? B.paddingTop : D.css("paddingTop")) + e(B ? B.paddingBottom : D.css("paddingBottom")) + e(B ? B.borderTopWidth : D.css("borderTopWidth")) + e(B ? B.borderBottomWidth : D.css("borderBottomWidth")),
                            horiz: e(B ? B.paddingLeft : D.css("paddingLeft")) + e(B ? B.paddingRight : D.css("paddingRight")) + e(B ? B.borderLeftWidth : D.css("borderLeftWidth")) + e(B ? B.borderRightWidth : D.css("borderRightWidth"))
                        }, F = {
                            vert: E.vert + e(B ? B.marginTop : D.css("marginTop")) + e(B ? B.marginBottom : D.css("marginBottom")) + 2,
                            horiz: E.horiz + e(B ? B.marginLeft : D.css("marginLeft")) + e(B ? B.marginRight : D.css("marginRight")) + 2
                        };
                    f.style.overflowY = "scroll", r = d.offsetWidth - C, document.body.removeChild(c), this.sizeInfo.liHeight = s, this.sizeInfo.dropdownHeaderHeight = v, this.sizeInfo.headerHeight = w, this.sizeInfo.searchHeight = x, this.sizeInfo.actionsHeight = y, this.sizeInfo.doneButtonHeight = z, this.sizeInfo.dividerHeight = A, this.sizeInfo.menuPadding = E, this.sizeInfo.menuExtras = F, this.sizeInfo.menuWidth = C, this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth, this.sizeInfo.scrollBarWidth = r, this.sizeInfo.selectHeight = this.$newElement[0].offsetHeight, this.setPositionData()
                }
            }, getSelectPosition: function () {
                var b, c = this, d = a(window), e = c.$newElement.offset(), f = a(c.options.container);
                c.options.container && !f.is("body") ? (b = f.offset(), b.top += parseInt(f.css("borderTopWidth")), b.left += parseInt(f.css("borderLeftWidth"))) : b = {
                    top: 0,
                    left: 0
                };
                var g = c.options.windowPadding;
                this.sizeInfo.selectOffsetTop = e.top - b.top - d.scrollTop(), this.sizeInfo.selectOffsetBot = d.height() - this.sizeInfo.selectOffsetTop - this.sizeInfo.selectHeight - b.top - g[2], this.sizeInfo.selectOffsetLeft = e.left - b.left - d.scrollLeft(), this.sizeInfo.selectOffsetRight = d.width() - this.sizeInfo.selectOffsetLeft - this.sizeInfo.selectWidth - b.left - g[1], this.sizeInfo.selectOffsetTop -= g[0], this.sizeInfo.selectOffsetLeft -= g[3]
            }, setMenuSize: function (a) {
                this.getSelectPosition();
                var b, c, d, e, f, g, h, i = this.sizeInfo.selectWidth, j = this.sizeInfo.liHeight,
                    k = this.sizeInfo.headerHeight, l = this.sizeInfo.searchHeight, m = this.sizeInfo.actionsHeight,
                    n = this.sizeInfo.doneButtonHeight, o = this.sizeInfo.dividerHeight, p = this.sizeInfo.menuPadding,
                    q = 0;
                if (this.options.dropupAuto && (h = j * this.selectpicker.current.elements.length + p.vert, this.$newElement.toggleClass(u.DROPUP, this.sizeInfo.selectOffsetTop - this.sizeInfo.selectOffsetBot > this.sizeInfo.menuExtras.vert && h + this.sizeInfo.menuExtras.vert + 50 > this.sizeInfo.selectOffsetBot)), "auto" === this.options.size) e = this.selectpicker.current.elements.length > 3 ? 3 * this.sizeInfo.liHeight + this.sizeInfo.menuExtras.vert - 2 : 0, c = this.sizeInfo.selectOffsetBot - this.sizeInfo.menuExtras.vert, d = e + k + l + m + n, g = Math.max(e - p.vert, 0), this.$newElement.hasClass(u.DROPUP) && (c = this.sizeInfo.selectOffsetTop - this.sizeInfo.menuExtras.vert), f = c, b = c - k - l - m - n - p.vert; else if (this.options.size && "auto" != this.options.size && this.selectpicker.current.elements.length > this.options.size) {
                    for (var r = 0; r < this.options.size; r++) "divider" === this.selectpicker.current.data[r].type && q++;
                    c = j * this.options.size + q * o + p.vert, b = c - p.vert, f = c + k + l + m + n, d = g = ""
                }
                "auto" === this.options.dropdownAlignRight && this.$menu.toggleClass(u.MENURIGHT, this.sizeInfo.selectOffsetLeft > this.sizeInfo.selectOffsetRight && this.sizeInfo.selectOffsetRight < this.$menu[0].offsetWidth - i), this.$menu.css({
                    "max-height": f + "px",
                    overflow: "hidden",
                    "min-height": d + "px"
                }), this.$menuInner.css({
                    "max-height": b + "px",
                    "overflow-y": "auto",
                    "min-height": g + "px"
                }), this.sizeInfo.menuInnerHeight = b, this.selectpicker.current.data.length && this.selectpicker.current.data[this.selectpicker.current.data.length - 1].position > this.sizeInfo.menuInnerHeight && (this.sizeInfo.hasScrollBar = !0, this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth + this.sizeInfo.scrollBarWidth, this.$menu.css("min-width", this.sizeInfo.totalMenuWidth)), this.dropdown && this.dropdown._popper && this.dropdown._popper.update()
            }, setSize: function (b) {
                if (this.liHeight(b), this.options.header && this.$menu.css("padding-top", 0), !1 !== this.options.size) {
                    var c, d = this, e = a(window), f = 0;
                    this.setMenuSize(), "auto" === this.options.size ? (this.$searchbox.off("input.setMenuSize propertychange.setMenuSize").on("input.setMenuSize propertychange.setMenuSize", function () {
                        return d.setMenuSize()
                    }), e.off("resize.setMenuSize scroll.setMenuSize").on("resize.setMenuSize scroll.setMenuSize", function () {
                        return d.setMenuSize()
                    })) : this.options.size && "auto" != this.options.size && this.selectpicker.current.elements.length > this.options.size && (this.$searchbox.off("input.setMenuSize propertychange.setMenuSize"), e.off("resize.setMenuSize scroll.setMenuSize")), b ? f = this.$menuInner[0].scrollTop : d.multiple || "number" == typeof (c = d.selectpicker.main.map.newIndex[d.$element[0].selectedIndex]) && !1 !== d.options.size && (f = d.sizeInfo.liHeight * c, f = f - d.sizeInfo.menuInnerHeight / 2 + d.sizeInfo.liHeight / 2), d.createView(!1, f)
                }
            }, setWidth: function () {
                var a = this;
                "auto" === this.options.width ? requestAnimationFrame(function () {
                    a.$menu.css("min-width", "0"), a.liHeight(), a.setMenuSize();
                    var b = a.$newElement.clone().appendTo("body"),
                        c = b.css("width", "auto").children("button").outerWidth();
                    b.remove(), a.sizeInfo.selectWidth = Math.max(a.sizeInfo.totalMenuWidth, c), a.$newElement.css("width", a.sizeInfo.selectWidth + "px")
                }) : "fit" === this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", "").addClass("fit-width")) : this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", this.options.width)) : (this.$menu.css("min-width", ""), this.$newElement.css("width", "")), this.$newElement.hasClass("fit-width") && "fit" !== this.options.width && this.$newElement.removeClass("fit-width")
            }, selectPosition: function () {
                this.$bsContainer = a('<div class="bs-container" />');
                var b, c, d, e = this, f = a(this.options.container), g = function (a) {
                    var g = {};
                    e.$bsContainer.addClass(a.attr("class").replace(/form-control|fit-width/gi, "")).toggleClass(u.DROPUP, a.hasClass(u.DROPUP)), b = a.offset(), f.is("body") ? c = {
                        top: 0,
                        left: 0
                    } : (c = f.offset(), c.top += parseInt(f.css("borderTopWidth")) - f.scrollTop(), c.left += parseInt(f.css("borderLeftWidth")) - f.scrollLeft()), d = a.hasClass(u.DROPUP) ? 0 : a[0].offsetHeight, t.major < 4 && (g.top = b.top - c.top + d, g.left = b.left - c.left), g.width = a[0].offsetWidth, e.$bsContainer.css(g)
                };
                this.$button.on("click.bs.dropdown.data-api", function () {
                    e.isDisabled() || (g(e.$newElement), e.$bsContainer.appendTo(e.options.container).toggleClass(u.SHOW, !e.$button.hasClass(u.SHOW)).append(e.$menu))
                }), a(window).on("resize scroll", function () {
                    g(e.$newElement)
                }), this.$element.on("hide.bs.select", function () {
                    e.$menu.data("height", e.$menu.height()), e.$bsContainer.detach()
                })
            }, setOptionStatus: function () {
                var a = this, b = this.$element.find("option");
                if (a.noScroll = !1, a.selectpicker.view.visibleElements && a.selectpicker.view.visibleElements.length) for (var c = 0; c < a.selectpicker.view.visibleElements.length; c++) {
                    var d = a.selectpicker.current.map.originalIndex[c + a.selectpicker.view.position0], e = b[d];
                    if (e) {
                        var f = this.selectpicker.main.map.newIndex[d], g = this.selectpicker.main.elements[f];
                        a.setDisabled(d, e.disabled || "OPTGROUP" === e.parentNode.tagName && e.parentNode.disabled, f, g), a.setSelected(d, e.selected, f, g)
                    }
                }
            }, setSelected: function (a, b, c, d) {
                var e, f, g, h = void 0 !== this.activeIndex, i = this.activeIndex === a,
                    j = i || b && !this.multiple && !h;
                c || (c = this.selectpicker.main.map.newIndex[a]), d || (d = this.selectpicker.main.elements[c]), g = d.firstChild, b && (this.selectedIndex = a), d.classList.toggle("selected", b), d.classList.toggle("active", j), j && (this.selectpicker.view.currentActive = d, this.activeIndex = a), g && (g.classList.toggle("selected", b), g.classList.toggle("active", j), g.setAttribute("aria-selected", b)), j || !h && b && void 0 !== this.prevActiveIndex && (e = this.selectpicker.main.map.newIndex[this.prevActiveIndex], f = this.selectpicker.main.elements[e], f.classList.remove("selected"), f.classList.remove("active"), f.firstChild && (f.firstChild.classList.remove("selected"), f.firstChild.classList.remove("active")))
            }, setDisabled: function (a, b, c, d) {
                var e;
                c || (c = this.selectpicker.main.map.newIndex[a]), d || (d = this.selectpicker.main.elements[c]), e = d.firstChild, d.classList.toggle(u.DISABLED, b), e && ("4" === t.major && e.classList.toggle(u.DISABLED, b), e.setAttribute("aria-disabled", b), b ? e.setAttribute("tabindex", -1) : e.setAttribute("tabindex", 0))
            }, isDisabled: function () {
                return this.$element[0].disabled
            }, checkDisabled: function () {
                var a = this;
                this.isDisabled() ? (this.$newElement.addClass(u.DISABLED), this.$button.addClass(u.DISABLED).attr("tabindex", -1).attr("aria-disabled", !0)) : (this.$button.hasClass(u.DISABLED) && (this.$newElement.removeClass(u.DISABLED), this.$button.removeClass(u.DISABLED).attr("aria-disabled", !1)), -1 != this.$button.attr("tabindex") || this.$element.data("tabindex") || this.$button.removeAttr("tabindex")), this.$button.click(function () {
                    return !a.isDisabled()
                })
            }, togglePlaceholder: function () {
                var a = this.$element[0], b = a.selectedIndex, c = -1 === b;
                c || a.options[b].value || (c = !0), this.$button.toggleClass("bs-placeholder", c)
            }, tabIndex: function () {
                this.$element.data("tabindex") !== this.$element.attr("tabindex") && -98 !== this.$element.attr("tabindex") && "-98" !== this.$element.attr("tabindex") && (this.$element.data("tabindex", this.$element.attr("tabindex")), this.$button.attr("tabindex", this.$element.data("tabindex"))), this.$element.attr("tabindex", -98)
            }, clickListener: function () {
                var b = this, d = a(document);
                d.data("spaceSelect", !1), this.$button.on("keyup", function (a) {
                    /(32)/.test(a.keyCode.toString(10)) && d.data("spaceSelect") && (a.preventDefault(), d.data("spaceSelect", !1))
                }), this.$newElement.on("show.bs.dropdown", function () {
                    t.major > 3 && !b.dropdown && (b.dropdown = b.$button.data("bs.dropdown"), b.dropdown._menu = b.$menu[0])
                }), this.$button.on("click.bs.dropdown.data-api", function () {
                    b.$newElement.hasClass(u.SHOW) || b.setSize()
                }), this.$element.on("shown.bs.select", function () {
                    b.$menuInner[0].scrollTop !== b.selectpicker.view.scrollTop && (b.$menuInner[0].scrollTop = b.selectpicker.view.scrollTop), b.options.liveSearch ? b.$searchbox.focus() : b.$menuInner.focus()
                }), this.$menuInner.on("click", "li a", function (d, e) {
                    var f = a(this), g = b.isVirtual() ? b.selectpicker.view.position0 : 0,
                        h = b.selectpicker.current.map.originalIndex[f.parent().index() + g], i = c(b.$element[0]),
                        j = b.$element.prop("selectedIndex"), l = !0;
                    if (b.multiple && 1 !== b.options.maxOptions && d.stopPropagation(), d.preventDefault(), !b.isDisabled() && !f.parent().hasClass(u.DISABLED)) {
                        var m = b.$element.find("option"), n = m.eq(h), o = n.prop("selected"),
                            p = n.parent("optgroup"), q = b.options.maxOptions, r = p.data("maxOptions") || !1;
                        if (h === b.activeIndex && (e = !0), e || (b.prevActiveIndex = b.activeIndex, b.activeIndex = void 0), b.multiple) {
                            if (n.prop("selected", !o), b.setSelected(h, !o), f.blur(), !1 !== q || !1 !== r) {
                                var s = q < m.filter(":selected").length, t = r < p.find("option:selected").length;
                                if (q && s || r && t) if (q && 1 == q) m.prop("selected", !1), n.prop("selected", !0), b.$menuInner.find(".selected").removeClass("selected"), b.setSelected(h, !0); else if (r && 1 == r) {
                                    p.find("option:selected").prop("selected", !1), n.prop("selected", !0);
                                    var v = b.selectpicker.current.data[f.parent().index() + b.selectpicker.view.position0].optID;
                                    b.$menuInner.find(".optgroup-" + v).removeClass("selected"), b.setSelected(h, !0)
                                } else {
                                    var w = "string" == typeof b.options.maxOptionsText ? [b.options.maxOptionsText, b.options.maxOptionsText] : b.options.maxOptionsText,
                                        x = "function" == typeof w ? w(q, r) : w, y = x[0].replace("{n}", q),
                                        z = x[1].replace("{n}", r), A = a('<div class="notify"></div>');
                                    x[2] && (y = y.replace("{var}", x[2][q > 1 ? 0 : 1]), z = z.replace("{var}", x[2][r > 1 ? 0 : 1])), n.prop("selected", !1), b.$menu.append(A), q && s && (A.append(a("<div>" + y + "</div>")), l = !1, b.$element.trigger("maxReached.bs.select")), r && t && (A.append(a("<div>" + z + "</div>")), l = !1, b.$element.trigger("maxReachedGrp.bs.select")), setTimeout(function () {
                                        b.setSelected(h, !1)
                                    }, 10), A.delay(750).fadeOut(300, function () {
                                        a(this).remove()
                                    })
                                }
                            }
                        } else m.prop("selected", !1), n.prop("selected", !0), b.setSelected(h, !0);
                        !b.multiple || b.multiple && 1 === b.options.maxOptions ? b.$button.focus() : b.options.liveSearch && b.$searchbox.focus(), l && (i != c(b.$element[0]) && b.multiple || j != b.$element.prop("selectedIndex") && !b.multiple) && (k = [h, n.prop("selected"), i], b.$element.triggerNative("change"))
                    }
                }), this.$menu.on("click", "li." + u.DISABLED + " a, ." + u.POPOVERHEADER + ", ." + u.POPOVERHEADER + " :not(.close)", function (c) {
                    c.currentTarget == this && (c.preventDefault(), c.stopPropagation(), b.options.liveSearch && !a(c.target).hasClass("close") ? b.$searchbox.focus() : b.$button.focus())
                }), this.$menuInner.on("click", ".divider, .dropdown-header", function (a) {
                    a.preventDefault(), a.stopPropagation(), b.options.liveSearch ? b.$searchbox.focus() : b.$button.focus()
                }), this.$menu.on("click", "." + u.POPOVERHEADER + " .close", function () {
                    b.$button.click()
                }), this.$searchbox.on("click", function (a) {
                    a.stopPropagation()
                }), this.$menu.on("click", ".actions-btn", function (c) {
                    b.options.liveSearch ? b.$searchbox.focus() : b.$button.focus(), c.preventDefault(), c.stopPropagation(), a(this).hasClass("bs-select-all") ? b.selectAll() : b.deselectAll()
                }), this.$element.on({
                    change: function () {
                        b.render(), b.$element.trigger("changed.bs.select", k), k = null
                    }, focus: function () {
                        b.$button.focus()
                    }
                })
            }, liveSearchListener: function () {
                var a = this, b = document.createElement("li");
                this.$button.on("click.bs.dropdown.data-api", function () {
                    a.$searchbox.val() && a.$searchbox.val("")
                }), this.$searchbox.on("click.bs.dropdown.data-api focus.bs.dropdown.data-api touchend.bs.dropdown.data-api", function (a) {
                    a.stopPropagation()
                }), this.$searchbox.on("input propertychange", function () {
                    var c = a.$searchbox.val();
                    if (a.selectpicker.search.map.newIndex = {}, a.selectpicker.search.map.originalIndex = {}, a.selectpicker.search.elements = [], a.selectpicker.search.data = [], c) {
                        var e, f = [], g = c.toUpperCase(), h = {}, i = [], j = a._searchStyle(),
                            k = a.options.liveSearchNormalize;
                        a._$lisSelected = a.$menuInner.find(".selected");
                        for (var e = 0; e < a.selectpicker.main.data.length; e++) {
                            var l = a.selectpicker.main.data[e];
                            h[e] || (h[e] = d(l, g, j, k)), h[e] && void 0 !== l.headerIndex && -1 === i.indexOf(l.headerIndex) && (l.headerIndex > 0 && (h[l.headerIndex - 1] = !0, i.push(l.headerIndex - 1)), h[l.headerIndex] = !0, i.push(l.headerIndex), h[l.lastIndex + 1] = !0), h[e] && "optgroup-label" !== l.type && i.push(e)
                        }
                        for (var e = 0, m = i.length; e < m; e++) {
                            var n = i[e], o = i[e - 1], l = a.selectpicker.main.data[n],
                                q = a.selectpicker.main.data[o];
                            ("divider" !== l.type || "divider" === l.type && q && "divider" !== q.type && m - 1 !== e) && (a.selectpicker.search.data.push(l), f.push(a.selectpicker.main.elements[n]), a.selectpicker.search.map.newIndex[l.originalIndex] = f.length - 1, a.selectpicker.search.map.originalIndex[f.length - 1] = l.originalIndex)
                        }
                        a.activeIndex = void 0, a.noScroll = !0, a.$menuInner.scrollTop(0), a.selectpicker.search.elements = f, a.createView(!0), f.length || (b.className = "no-results", b.innerHTML = a.options.noneResultsText.replace("{0}", '"' + p(c) + '"'), a.$menuInner[0].firstChild.appendChild(b))
                    } else a.$menuInner.scrollTop(0), a.createView(!1)
                })
            }, _searchStyle: function () {
                return this.options.liveSearchStyle || "contains"
            }, val: function (a) {
                return void 0 !== a ? (this.$element.val(a).triggerNative("change"), this.$element) : this.$element.val()
            }, changeAll: function (a) {
                if (this.multiple) {
                    void 0 === a && (a = !0);
                    var b = this.$element.find("option"), d = 0, e = 0, f = c(this.$element[0]);
                    this.$element.addClass("bs-select-hidden");
                    for (var g = 0; g < this.selectpicker.current.elements.length; g++) {
                        var h = this.selectpicker.current.map.originalIndex[g], i = b[h];
                        i && (i.selected && d++, i.selected = a, i.selected && e++)
                    }
                    this.$element.removeClass("bs-select-hidden"), d !== e && (this.setOptionStatus(), this.togglePlaceholder(), k = [null, null, f], this.$element.triggerNative("change"))
                }
            }, selectAll: function () {
                return this.changeAll(!0)
            }, deselectAll: function () {
                return this.changeAll(!1)
            }, toggle: function (a) {
                a = a || window.event, a && a.stopPropagation(), this.$button.trigger("click.bs.dropdown.data-api")
            }, keydown: function (b) {
                var c, e, f, g, h, i = a(this), j = i.is("input") ? i.parent().parent() : i.parent(),
                    k = j.data("this"), l = k.findLis(), m = !1,
                    n = b.which === s.TAB && !i.hasClass("dropdown-toggle") && !k.options.selectOnTab,
                    o = v.test(b.which) || n, p = k.$menuInner[0].scrollTop, q = k.isVirtual(),
                    t = !0 === q ? k.selectpicker.view.position0 : 0;
                if (e = k.$newElement.hasClass(u.SHOW), !e && (o || b.which >= 48 && b.which <= 57 || b.which >= 96 && b.which <= 105 || b.which >= 65 && b.which <= 90) && k.$button.trigger("click.bs.dropdown.data-api"), b.which === s.ESCAPE && e && (b.preventDefault(), k.$button.trigger("click.bs.dropdown.data-api").focus()), o) {
                    if (!l.length) return;
                    c = !0 === q ? l.index(l.filter(".active")) : k.selectpicker.current.map.newIndex[k.activeIndex], void 0 === c && (c = -1), -1 !== c && (f = k.selectpicker.current.elements[c + t], f.classList.remove("active"), f.firstChild && f.firstChild.classList.remove("active")), b.which === s.ARROW_UP ? (-1 !== c && c--, c + t < 0 && (c += l.length), k.selectpicker.view.canHighlight[c + t] || -1 === (c = k.selectpicker.view.canHighlight.slice(0, c + t).lastIndexOf(!0) - t) && (c = l.length - 1)) : (b.which === s.ARROW_DOWN || n) && (c++, c + t >= k.selectpicker.view.canHighlight.length && (c = 0), k.selectpicker.view.canHighlight[c + t] || (c = c + 1 + k.selectpicker.view.canHighlight.slice(c + t + 1).indexOf(!0))), b.preventDefault();
                    var x = t + c;
                    b.which === s.ARROW_UP ? 0 === t && c === l.length - 1 ? (k.$menuInner[0].scrollTop = k.$menuInner[0].scrollHeight, x = k.selectpicker.current.elements.length - 1) : (g = k.selectpicker.current.data[x], h = g.position - g.height, m = h < p) : (b.which === s.ARROW_DOWN || n) && (0 !== t && 0 === c ? (k.$menuInner[0].scrollTop = 0, x = 0) : (g = k.selectpicker.current.data[x], h = g.position - k.sizeInfo.menuInnerHeight, m = h > p)), f = k.selectpicker.current.elements[x], f.classList.add("active"), f.firstChild && f.firstChild.classList.add("active"), k.activeIndex = k.selectpicker.current.map.originalIndex[x], k.selectpicker.view.currentActive = f, m && (k.$menuInner[0].scrollTop = h), k.options.liveSearch ? k.$searchbox.focus() : i.focus()
                } else if (!i.is("input") && !w.test(b.which) || b.which === s.SPACE && k.selectpicker.keydown.keyHistory) {
                    var y, z, A = [];
                    b.preventDefault(), k.selectpicker.keydown.keyHistory += r[b.which], k.selectpicker.keydown.resetKeyHistory.cancel && clearTimeout(k.selectpicker.keydown.resetKeyHistory.cancel), k.selectpicker.keydown.resetKeyHistory.cancel = k.selectpicker.keydown.resetKeyHistory.start(), z = k.selectpicker.keydown.keyHistory, /^(.)\1+$/.test(z) && (z = z.charAt(0));
                    for (var B = 0; B < k.selectpicker.current.data.length; B++) {
                        var C, D = k.selectpicker.current.data[B];
                        C = d(D, z, "startsWith", !0), C && k.selectpicker.view.canHighlight[B] && (D.index = B, A.push(D.originalIndex))
                    }
                    if (A.length) {
                        var E = 0;
                        l.removeClass("active").find("a").removeClass("active"), 1 === z.length && (E = A.indexOf(k.activeIndex), -1 === E || E === A.length - 1 ? E = 0 : E++), y = k.selectpicker.current.map.newIndex[A[E]], g = k.selectpicker.current.data[y], p - g.position > 0 ? (h = g.position - g.height, m = !0) : (h = g.position - k.sizeInfo.menuInnerHeight, m = g.position > p + k.sizeInfo.menuInnerHeight), f = k.selectpicker.current.elements[y], f.classList.add("active"), f.firstChild && f.firstChild.classList.add("active"), k.activeIndex = A[E], f.firstChild.focus(), m && (k.$menuInner[0].scrollTop = h), i.focus()
                    }
                }
                e && (b.which === s.SPACE && !k.selectpicker.keydown.keyHistory || b.which === s.ENTER || b.which === s.TAB && k.options.selectOnTab) && (b.which !== s.SPACE && b.preventDefault(), k.options.liveSearch && b.which === s.SPACE || (k.$menuInner.find(".active a").trigger("click", !0), i.focus(), k.options.liveSearch || (b.preventDefault(), a(document).data("spaceSelect", !0))))
            }, mobile: function () {
                this.$element.addClass("mobile-device")
            }, refresh: function () {
                var b = a.extend({}, this.options, this.$element.data());
                this.options = b, this.selectpicker.main.map.newIndex = {}, this.selectpicker.main.map.originalIndex = {}, this.createLi(), this.checkDisabled(), this.render(), this.setStyle(), this.setWidth(), this.setSize(!0), this.$element.trigger("refreshed.bs.select")
            }, hide: function () {
                this.$newElement.hide()
            }, show: function () {
                this.$newElement.show()
            }, remove: function () {
                this.$newElement.remove(), this.$element.remove()
            }, destroy: function () {
                this.$newElement.before(this.$element).remove(), this.$bsContainer ? this.$bsContainer.remove() : this.$menu.remove(), this.$element.off(".bs.select").removeData("selectpicker").removeClass("bs-select-hidden selectpicker")
            }
        };
        var y = a.fn.selectpicker;
        a.fn.selectpicker = g, a.fn.selectpicker.Constructor = x, a.fn.selectpicker.noConflict = function () {
            return a.fn.selectpicker = y, this
        }, a(document).off("keydown.bs.dropdown.data-api").on("keydown.bs.select", '.bootstrap-select [data-toggle="dropdown"], .bootstrap-select [role="listbox"], .bs-searchbox input', x.prototype.keydown).on("focusin.modal", '.bootstrap-select [data-toggle="dropdown"], .bootstrap-select [role="listbox"], .bs-searchbox input', function (a) {
            a.stopPropagation()
        }), a(window).on("load.bs.select.data-api", function () {
            a(".selectpicker").each(function () {
                var b = a(this);
                g.call(b, b.data())
            })
        })
    }(a)
});
//# sourceMappingURL=bootstrap-select.js.map