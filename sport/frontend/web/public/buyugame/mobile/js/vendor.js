/* file version: 1528452652_1319fac89e6107575c2a5582c987db1f */
/*! jQuery v1.11.3 | (c) 2005, 2015 jQuery Foundation, Inc. | jquery.org/license */
! function (a, b) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function (a) {
        if (!a.document) throw new Error("jQuery requires a window with a document");
        return b(a)
    } : b(a)
}("undefined" != typeof window ? window : this, function (a, b) {
    var c = [],
        d = c.slice,
        e = c.concat,
        f = c.push,
        g = c.indexOf,
        h = {},
        i = h.toString,
        j = h.hasOwnProperty,
        k = {},
        l = "1.11.3",
        m = function (a, b) {
            return new m.fn.init(a, b)
        },
        n = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        o = /^-ms-/,
        p = /-([\da-z])/gi,
        q = function (a, b) {
            return b.toUpperCase()
        };
    m.fn = m.prototype = {
        jquery: l,
        constructor: m,
        selector: "",
        length: 0,
        toArray: function () {
            return d.call(this)
        },
        get: function (a) {
            return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this)
        },
        pushStack: function (a) {
            var b = m.merge(this.constructor(), a);
            return b.prevObject = this, b.context = this.context, b
        },
        each: function (a, b) {
            return m.each(this, a, b)
        },
        map: function (a) {
            return this.pushStack(m.map(this, function (b, c) {
                return a.call(b, c, b)
            }))
        },
        slice: function () {
            return this.pushStack(d.apply(this, arguments))
        },
        first: function () {
            return this.eq(0)
        },
        last: function () {
            return this.eq(-1)
        },
        eq: function (a) {
            var b = this.length,
                c = +a + (0 > a ? b : 0);
            return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
        },
        end: function () {
            return this.prevObject || this.constructor(null)
        },
        push: f,
        sort: c.sort,
        splice: c.splice
    }, m.extend = m.fn.extend = function () {
        var a, b, c, d, e, f, g = arguments[0] || {},
            h = 1,
            i = arguments.length,
            j = !1;
        for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || m.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)
            if (null != (e = arguments[h]))
                for (d in e) a = g[d], c = e[d], g !== c && (j && c && (m.isPlainObject(c) || (b = m.isArray(c))) ? (b ? (b = !1, f = a && m.isArray(a) ? a : []) : f = a && m.isPlainObject(a) ? a : {}, g[d] = m.extend(j, f, c)) : void 0 !== c && (g[d] = c));
        return g
    }, m.extend({
        expando: "jQuery" + (l + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function (a) {
            throw new Error(a)
        },
        noop: function () {},
        isFunction: function (a) {
            return "function" === m.type(a)
        },
        isArray: Array.isArray || function (a) {
            return "array" === m.type(a)
        },
        isWindow: function (a) {
            return null != a && a == a.window
        },
        isNumeric: function (a) {
            return !m.isArray(a) && a - parseFloat(a) + 1 >= 0
        },
        isEmptyObject: function (a) {
            var b;
            for (b in a) return !1;
            return !0
        },
        isPlainObject: function (a) {
            var b;
            if (!a || "object" !== m.type(a) || a.nodeType || m.isWindow(a)) return !1;
            try {
                if (a.constructor && !j.call(a, "constructor") && !j.call(a.constructor.prototype, "isPrototypeOf")) return !1
            } catch (c) {
                return !1
            }
            if (k.ownLast)
                for (b in a) return j.call(a, b);
            for (b in a);
            return void 0 === b || j.call(a, b)
        },
        type: function (a) {
            return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object" : typeof a
        },
        globalEval: function (b) {
            b && m.trim(b) && (a.execScript || function (b) {
                a.eval.call(a, b)
            })(b)
        },
        camelCase: function (a) {
            return a.replace(o, "ms-").replace(p, q)
        },
        nodeName: function (a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
        },
        each: function (a, b, c) {
            var d, e = 0,
                f = a.length,
                g = r(a);
            if (c) {
                if (g) {
                    for (; f > e; e++)
                        if (d = b.apply(a[e], c), d === !1) break
                } else
                    for (e in a)
                        if (d = b.apply(a[e], c), d === !1) break
            } else if (g) {
                for (; f > e; e++)
                    if (d = b.call(a[e], e, a[e]), d === !1) break
            } else
                for (e in a)
                    if (d = b.call(a[e], e, a[e]), d === !1) break;
            return a
        },
        trim: function (a) {
            return null == a ? "" : (a + "").replace(n, "")
        },
        makeArray: function (a, b) {
            var c = b || [];
            return null != a && (r(Object(a)) ? m.merge(c, "string" == typeof a ? [a] : a) : f.call(c, a)), c
        },
        inArray: function (a, b, c) {
            var d;
            if (b) {
                if (g) return g.call(b, a, c);
                for (d = b.length, c = c ? 0 > c ? Math.max(0, d + c) : c : 0; d > c; c++)
                    if (c in b && b[c] === a) return c
            }
            return -1
        },
        merge: function (a, b) {
            var c = +b.length,
                d = 0,
                e = a.length;
            while (c > d) a[e++] = b[d++];
            if (c !== c)
                while (void 0 !== b[d]) a[e++] = b[d++];
            return a.length = e, a
        },
        grep: function (a, b, c) {
            for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++) d = !b(a[f], f), d !== h && e.push(a[f]);
            return e
        },
        map: function (a, b, c) {
            var d, f = 0,
                g = a.length,
                h = r(a),
                i = [];
            if (h)
                for (; g > f; f++) d = b(a[f], f, c), null != d && i.push(d);
            else
                for (f in a) d = b(a[f], f, c), null != d && i.push(d);
            return e.apply([], i)
        },
        guid: 1,
        proxy: function (a, b) {
            var c, e, f;
            return "string" == typeof b && (f = a[b], b = a, a = f), m.isFunction(a) ? (c = d.call(arguments, 2), e = function () {
                return a.apply(b || this, c.concat(d.call(arguments)))
            }, e.guid = a.guid = a.guid || m.guid++, e) : void 0
        },
        now: function () {
            return +new Date
        },
        support: k
    }), m.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) {
        h["[object " + b + "]"] = b.toLowerCase()
    });

    function r(a) {
        var b = "length" in a && a.length,
            c = m.type(a);
        return "function" === c || m.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
    }
    var s = function (a) {
        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + 1 * new Date,
            v = a.document,
            w = 0,
            x = 0,
            y = ha(),
            z = ha(),
            A = ha(),
            B = function (a, b) {
                return a === b && (l = !0), 0
            },
            C = 1 << 31,
            D = {}.hasOwnProperty,
            E = [],
            F = E.pop,
            G = E.push,
            H = E.push,
            I = E.slice,
            J = function (a, b) {
                for (var c = 0, d = a.length; d > c; c++)
                    if (a[c] === b) return c;
                return -1
            },
            K = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            L = "[\\x20\\t\\r\\n\\f]",
            M = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            N = M.replace("w", "w#"),
            O = "\\[" + L + "*(" + M + ")(?:" + L + "*([*^$|!~]?=)" + L + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + N + "))|)" + L + "*\\]",
            P = ":(" + M + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + O + ")*)|.*)\\)|)",
            Q = new RegExp(L + "+", "g"),
            R = new RegExp("^" + L + "+|((?:^|[^\\\\])(?:\\\\.)*)" + L + "+$", "g"),
            S = new RegExp("^" + L + "*," + L + "*"),
            T = new RegExp("^" + L + "*([>+~]|" + L + ")" + L + "*"),
            U = new RegExp("=" + L + "*([^\\]'\"]*?)" + L + "*\\]", "g"),
            V = new RegExp(P),
            W = new RegExp("^" + N + "$"),
            X = {
                ID: new RegExp("^#(" + M + ")"),
                CLASS: new RegExp("^\\.(" + M + ")"),
                TAG: new RegExp("^(" + M.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + O),
                PSEUDO: new RegExp("^" + P),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + L + "*(even|odd|(([+-]|)(\\d*)n|)" + L + "*(?:([+-]|)" + L + "*(\\d+)|))" + L + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + K + ")$", "i"),
                needsContext: new RegExp("^" + L + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + L + "*((?:-\\d)?\\d*)" + L + "*\\)|)(?=[^-]|$)", "i")
            },
            Y = /^(?:input|select|textarea|button)$/i,
            Z = /^h\d$/i,
            $ = /^[^{]+\{\s*\[native \w/,
            _ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            aa = /[+~]/,
            ba = /'|\\/g,
            ca = new RegExp("\\\\([\\da-f]{1,6}" + L + "?|(" + L + ")|.)", "ig"),
            da = function (a, b, c) {
                var d = "0x" + b - 65536;
                return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
            },
            ea = function () {
                m()
            };
        try {
            H.apply(E = I.call(v.childNodes), v.childNodes), E[v.childNodes.length].nodeType
        } catch (fa) {
            H = {
                apply: E.length ? function (a, b) {
                    G.apply(a, I.call(b))
                } : function (a, b) {
                    var c = a.length,
                        d = 0;
                    while (a[c++] = b[d++]);
                    a.length = c - 1
                }
            }
        }

        function ga(a, b, d, e) {
            var f, h, j, k, l, o, r, s, w, x;
            if ((b ? b.ownerDocument || b : v) !== n && m(b), b = b || n, d = d || [], k = b.nodeType, "string" != typeof a || !a || 1 !== k && 9 !== k && 11 !== k) return d;
            if (!e && p) {
                if (11 !== k && (f = _.exec(a)))
                    if (j = f[1]) {
                        if (9 === k) {
                            if (h = b.getElementById(j), !h || !h.parentNode) return d;
                            if (h.id === j) return d.push(h), d
                        } else if (b.ownerDocument && (h = b.ownerDocument.getElementById(j)) && t(b, h) && h.id === j) return d.push(h), d
                    } else {
                        if (f[2]) return H.apply(d, b.getElementsByTagName(a)), d;
                        if ((j = f[3]) && c.getElementsByClassName) return H.apply(d, b.getElementsByClassName(j)), d
                    } if (c.qsa && (!q || !q.test(a))) {
                    if (s = r = u, w = b, x = 1 !== k && a, 1 === k && "object" !== b.nodeName.toLowerCase()) {
                        o = g(a), (r = b.getAttribute("id")) ? s = r.replace(ba, "\\$&") : b.setAttribute("id", s), s = "[id='" + s + "'] ", l = o.length;
                        while (l--) o[l] = s + ra(o[l]);
                        w = aa.test(a) && pa(b.parentNode) || b, x = o.join(",")
                    }
                    if (x) try {
                        return H.apply(d, w.querySelectorAll(x)), d
                    } catch (y) {} finally {
                        r || b.removeAttribute("id")
                    }
                }
            }
            return i(a.replace(R, "$1"), b, d, e)
        }

        function ha() {
            var a = [];

            function b(c, e) {
                return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e
            }
            return b
        }

        function ia(a) {
            return a[u] = !0, a
        }

        function ja(a) {
            var b = n.createElement("div");
            try {
                return !!a(b)
            } catch (c) {
                return !1
            } finally {
                b.parentNode && b.parentNode.removeChild(b), b = null
            }
        }

        function ka(a, b) {
            var c = a.split("|"),
                e = a.length;
            while (e--) d.attrHandle[c[e]] = b
        }

        function la(a, b) {
            var c = b && a,
                d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || C) - (~a.sourceIndex || C);
            if (d) return d;
            if (c)
                while (c = c.nextSibling)
                    if (c === b) return -1;
            return a ? 1 : -1
        }

        function ma(a) {
            return function (b) {
                var c = b.nodeName.toLowerCase();
                return "input" === c && b.type === a
            }
        }

        function na(a) {
            return function (b) {
                var c = b.nodeName.toLowerCase();
                return ("input" === c || "button" === c) && b.type === a
            }
        }

        function oa(a) {
            return ia(function (b) {
                return b = +b, ia(function (c, d) {
                    var e, f = a([], c.length, b),
                        g = f.length;
                    while (g--) c[e = f[g]] && (c[e] = !(d[e] = c[e]))
                })
            })
        }

        function pa(a) {
            return a && "undefined" != typeof a.getElementsByTagName && a
        }
        c = ga.support = {}, f = ga.isXML = function (a) {
            var b = a && (a.ownerDocument || a).documentElement;
            return b ? "HTML" !== b.nodeName : !1
        }, m = ga.setDocument = function (a) {
            var b, e, g = a ? a.ownerDocument || a : v;
            return g !== n && 9 === g.nodeType && g.documentElement ? (n = g, o = g.documentElement, e = g.defaultView, e && e !== e.top && (e.addEventListener ? e.addEventListener("unload", ea, !1) : e.attachEvent && e.attachEvent("onunload", ea)), p = !f(g), c.attributes = ja(function (a) {
                return a.className = "i", !a.getAttribute("className")
            }), c.getElementsByTagName = ja(function (a) {
                return a.appendChild(g.createComment("")), !a.getElementsByTagName("*").length
            }), c.getElementsByClassName = $.test(g.getElementsByClassName), c.getById = ja(function (a) {
                return o.appendChild(a).id = u, !g.getElementsByName || !g.getElementsByName(u).length
            }), c.getById ? (d.find.ID = function (a, b) {
                if ("undefined" != typeof b.getElementById && p) {
                    var c = b.getElementById(a);
                    return c && c.parentNode ? [c] : []
                }
            }, d.filter.ID = function (a) {
                var b = a.replace(ca, da);
                return function (a) {
                    return a.getAttribute("id") === b
                }
            }) : (delete d.find.ID, d.filter.ID = function (a) {
                var b = a.replace(ca, da);
                return function (a) {
                    var c = "undefined" != typeof a.getAttributeNode && a.getAttributeNode("id");
                    return c && c.value === b
                }
            }), d.find.TAG = c.getElementsByTagName ? function (a, b) {
                return "undefined" != typeof b.getElementsByTagName ? b.getElementsByTagName(a) : c.qsa ? b.querySelectorAll(a) : void 0
            } : function (a, b) {
                var c, d = [],
                    e = 0,
                    f = b.getElementsByTagName(a);
                if ("*" === a) {
                    while (c = f[e++]) 1 === c.nodeType && d.push(c);
                    return d
                }
                return f
            }, d.find.CLASS = c.getElementsByClassName && function (a, b) {
                return p ? b.getElementsByClassName(a) : void 0
            }, r = [], q = [], (c.qsa = $.test(g.querySelectorAll)) && (ja(function (a) {
                o.appendChild(a).innerHTML = "<a id='" + u + "'></a><select id='" + u + "-\f]' msallowcapture=''><option selected=''></option></select>", a.querySelectorAll("[msallowcapture^='']").length && q.push("[*^$]=" + L + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || q.push("\\[" + L + "*(?:value|" + K + ")"), a.querySelectorAll("[id~=" + u + "-]").length || q.push("~="), a.querySelectorAll(":checked").length || q.push(":checked"), a.querySelectorAll("a#" + u + "+*").length || q.push(".#.+[+~]")
            }), ja(function (a) {
                var b = g.createElement("input");
                b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && q.push("name" + L + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), q.push(",.*:")
            })), (c.matchesSelector = $.test(s = o.matches || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ja(function (a) {
                c.disconnectedMatch = s.call(a, "div"), s.call(a, "[s!='']:x"), r.push("!=", P)
            }), q = q.length && new RegExp(q.join("|")), r = r.length && new RegExp(r.join("|")), b = $.test(o.compareDocumentPosition), t = b || $.test(o.contains) ? function (a, b) {
                var c = 9 === a.nodeType ? a.documentElement : a,
                    d = b && b.parentNode;
                return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
            } : function (a, b) {
                if (b)
                    while (b = b.parentNode)
                        if (b === a) return !0;
                return !1
            }, B = b ? function (a, b) {
                if (a === b) return l = !0, 0;
                var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
                return d ? d : (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === g || a.ownerDocument === v && t(v, a) ? -1 : b === g || b.ownerDocument === v && t(v, b) ? 1 : k ? J(k, a) - J(k, b) : 0 : 4 & d ? -1 : 1)
            } : function (a, b) {
                if (a === b) return l = !0, 0;
                var c, d = 0,
                    e = a.parentNode,
                    f = b.parentNode,
                    h = [a],
                    i = [b];
                if (!e || !f) return a === g ? -1 : b === g ? 1 : e ? -1 : f ? 1 : k ? J(k, a) - J(k, b) : 0;
                if (e === f) return la(a, b);
                c = a;
                while (c = c.parentNode) h.unshift(c);
                c = b;
                while (c = c.parentNode) i.unshift(c);
                while (h[d] === i[d]) d++;
                return d ? la(h[d], i[d]) : h[d] === v ? -1 : i[d] === v ? 1 : 0
            }, g) : n
        }, ga.matches = function (a, b) {
            return ga(a, null, null, b)
        }, ga.matchesSelector = function (a, b) {
            if ((a.ownerDocument || a) !== n && m(a), b = b.replace(U, "='$1']"), !(!c.matchesSelector || !p || r && r.test(b) || q && q.test(b))) try {
                var d = s.call(a, b);
                if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType) return d
            } catch (e) {}
            return ga(b, n, null, [a]).length > 0
        }, ga.contains = function (a, b) {
            return (a.ownerDocument || a) !== n && m(a), t(a, b)
        }, ga.attr = function (a, b) {
            (a.ownerDocument || a) !== n && m(a);
            var e = d.attrHandle[b.toLowerCase()],
                f = e && D.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !p) : void 0;
            return void 0 !== f ? f : c.attributes || !p ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null
        }, ga.error = function (a) {
            throw new Error("Syntax error, unrecognized expression: " + a)
        }, ga.uniqueSort = function (a) {
            var b, d = [],
                e = 0,
                f = 0;
            if (l = !c.detectDuplicates, k = !c.sortStable && a.slice(0), a.sort(B), l) {
                while (b = a[f++]) b === a[f] && (e = d.push(f));
                while (e--) a.splice(d[e], 1)
            }
            return k = null, a
        }, e = ga.getText = function (a) {
            var b, c = "",
                d = 0,
                f = a.nodeType;
            if (f) {
                if (1 === f || 9 === f || 11 === f) {
                    if ("string" == typeof a.textContent) return a.textContent;
                    for (a = a.firstChild; a; a = a.nextSibling) c += e(a)
                } else if (3 === f || 4 === f) return a.nodeValue
            } else
                while (b = a[d++]) c += e(b);
            return c
        }, d = ga.selectors = {
            cacheLength: 50,
            createPseudo: ia,
            match: X,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function (a) {
                    return a[1] = a[1].replace(ca, da), a[3] = (a[3] || a[4] || a[5] || "").replace(ca, da), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
                },
                CHILD: function (a) {
                    return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || ga.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && ga.error(a[0]), a
                },
                PSEUDO: function (a) {
                    var b, c = !a[6] && a[2];
                    return X.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && V.test(c) && (b = g(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
                }
            },
            filter: {
                TAG: function (a) {
                    var b = a.replace(ca, da).toLowerCase();
                    return "*" === a ? function () {
                        return !0
                    } : function (a) {
                        return a.nodeName && a.nodeName.toLowerCase() === b
                    }
                },
                CLASS: function (a) {
                    var b = y[a + " "];
                    return b || (b = new RegExp("(^|" + L + ")" + a + "(" + L + "|$)")) && y(a, function (a) {
                        return b.test("string" == typeof a.className && a.className || "undefined" != typeof a.getAttribute && a.getAttribute("class") || "")
                    })
                },
                ATTR: function (a, b, c) {
                    return function (d) {
                        var e = ga.attr(d, a);
                        return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e.replace(Q, " ") + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0
                    }
                },
                CHILD: function (a, b, c, d, e) {
                    var f = "nth" !== a.slice(0, 3),
                        g = "last" !== a.slice(-4),
                        h = "of-type" === b;
                    return 1 === d && 0 === e ? function (a) {
                        return !!a.parentNode
                    } : function (b, c, i) {
                        var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling",
                            q = b.parentNode,
                            r = h && b.nodeName.toLowerCase(),
                            s = !i && !h;
                        if (q) {
                            if (f) {
                                while (p) {
                                    l = b;
                                    while (l = l[p])
                                        if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) return !1;
                                    o = p = "only" === a && !o && "nextSibling"
                                }
                                return !0
                            }
                            if (o = [g ? q.firstChild : q.lastChild], g && s) {
                                k = q[u] || (q[u] = {}), j = k[a] || [], n = j[0] === w && j[1], m = j[0] === w && j[2], l = n && q.childNodes[n];
                                while (l = ++n && l && l[p] || (m = n = 0) || o.pop())
                                    if (1 === l.nodeType && ++m && l === b) {
                                        k[a] = [w, n, m];
                                        break
                                    }
                            } else if (s && (j = (b[u] || (b[u] = {}))[a]) && j[0] === w) m = j[1];
                            else
                                while (l = ++n && l && l[p] || (m = n = 0) || o.pop())
                                    if ((h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) && ++m && (s && ((l[u] || (l[u] = {}))[a] = [w, m]), l === b)) break;
                            return m -= e, m === d || m % d === 0 && m / d >= 0
                        }
                    }
                },
                PSEUDO: function (a, b) {
                    var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || ga.error("unsupported pseudo: " + a);
                    return e[u] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? ia(function (a, c) {
                        var d, f = e(a, b),
                            g = f.length;
                        while (g--) d = J(a, f[g]), a[d] = !(c[d] = f[g])
                    }) : function (a) {
                        return e(a, 0, c)
                    }) : e
                }
            },
            pseudos: {
                not: ia(function (a) {
                    var b = [],
                        c = [],
                        d = h(a.replace(R, "$1"));
                    return d[u] ? ia(function (a, b, c, e) {
                        var f, g = d(a, null, e, []),
                            h = a.length;
                        while (h--)(f = g[h]) && (a[h] = !(b[h] = f))
                    }) : function (a, e, f) {
                        return b[0] = a, d(b, null, f, c), b[0] = null, !c.pop()
                    }
                }),
                has: ia(function (a) {
                    return function (b) {
                        return ga(a, b).length > 0
                    }
                }),
                contains: ia(function (a) {
                    return a = a.replace(ca, da),
                        function (b) {
                            return (b.textContent || b.innerText || e(b)).indexOf(a) > -1
                        }
                }),
                lang: ia(function (a) {
                    return W.test(a || "") || ga.error("unsupported lang: " + a), a = a.replace(ca, da).toLowerCase(),
                        function (b) {
                            var c;
                            do
                                if (c = p ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang")) return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType);
                            return !1
                        }
                }),
                target: function (b) {
                    var c = a.location && a.location.hash;
                    return c && c.slice(1) === b.id
                },
                root: function (a) {
                    return a === o
                },
                focus: function (a) {
                    return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
                },
                enabled: function (a) {
                    return a.disabled === !1
                },
                disabled: function (a) {
                    return a.disabled === !0
                },
                checked: function (a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && !!a.checked || "option" === b && !!a.selected
                },
                selected: function (a) {
                    return a.parentNode && a.parentNode.selectedIndex, a.selected === !0
                },
                empty: function (a) {
                    for (a = a.firstChild; a; a = a.nextSibling)
                        if (a.nodeType < 6) return !1;
                    return !0
                },
                parent: function (a) {
                    return !d.pseudos.empty(a)
                },
                header: function (a) {
                    return Z.test(a.nodeName)
                },
                input: function (a) {
                    return Y.test(a.nodeName)
                },
                button: function (a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && "button" === a.type || "button" === b
                },
                text: function (a) {
                    var b;
                    return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase())
                },
                first: oa(function () {
                    return [0]
                }),
                last: oa(function (a, b) {
                    return [b - 1]
                }),
                eq: oa(function (a, b, c) {
                    return [0 > c ? c + b : c]
                }),
                even: oa(function (a, b) {
                    for (var c = 0; b > c; c += 2) a.push(c);
                    return a
                }),
                odd: oa(function (a, b) {
                    for (var c = 1; b > c; c += 2) a.push(c);
                    return a
                }),
                lt: oa(function (a, b, c) {
                    for (var d = 0 > c ? c + b : c; --d >= 0;) a.push(d);
                    return a
                }),
                gt: oa(function (a, b, c) {
                    for (var d = 0 > c ? c + b : c; ++d < b;) a.push(d);
                    return a
                })
            }
        }, d.pseudos.nth = d.pseudos.eq;
        for (b in {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) d.pseudos[b] = ma(b);
        for (b in {
                submit: !0,
                reset: !0
            }) d.pseudos[b] = na(b);

        function qa() {}
        qa.prototype = d.filters = d.pseudos, d.setFilters = new qa, g = ga.tokenize = function (a, b) {
            var c, e, f, g, h, i, j, k = z[a + " "];
            if (k) return b ? 0 : k.slice(0);
            h = a, i = [], j = d.preFilter;
            while (h) {
                (!c || (e = S.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = T.exec(h)) && (c = e.shift(), f.push({
                    value: c,
                    type: e[0].replace(R, " ")
                }), h = h.slice(c.length));
                for (g in d.filter) !(e = X[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({
                    value: c,
                    type: g,
                    matches: e
                }), h = h.slice(c.length));
                if (!c) break
            }
            return b ? h.length : h ? ga.error(a) : z(a, i).slice(0)
        };

        function ra(a) {
            for (var b = 0, c = a.length, d = ""; c > b; b++) d += a[b].value;
            return d
        }

        function sa(a, b, c) {
            var d = b.dir,
                e = c && "parentNode" === d,
                f = x++;
            return b.first ? function (b, c, f) {
                while (b = b[d])
                    if (1 === b.nodeType || e) return a(b, c, f)
            } : function (b, c, g) {
                var h, i, j = [w, f];
                if (g) {
                    while (b = b[d])
                        if ((1 === b.nodeType || e) && a(b, c, g)) return !0
                } else
                    while (b = b[d])
                        if (1 === b.nodeType || e) {
                            if (i = b[u] || (b[u] = {}), (h = i[d]) && h[0] === w && h[1] === f) return j[2] = h[2];
                            if (i[d] = j, j[2] = a(b, c, g)) return !0
                        }
            }
        }

        function ta(a) {
            return a.length > 1 ? function (b, c, d) {
                var e = a.length;
                while (e--)
                    if (!a[e](b, c, d)) return !1;
                return !0
            } : a[0]
        }

        function ua(a, b, c) {
            for (var d = 0, e = b.length; e > d; d++) ga(a, b[d], c);
            return c
        }

        function va(a, b, c, d, e) {
            for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
            return g
        }

        function wa(a, b, c, d, e, f) {
            return d && !d[u] && (d = wa(d)), e && !e[u] && (e = wa(e, f)), ia(function (f, g, h, i) {
                var j, k, l, m = [],
                    n = [],
                    o = g.length,
                    p = f || ua(b || "*", h.nodeType ? [h] : h, []),
                    q = !a || !f && b ? p : va(p, m, a, h, i),
                    r = c ? e || (f ? a : o || d) ? [] : g : q;
                if (c && c(q, r, h, i), d) {
                    j = va(r, n), d(j, [], h, i), k = j.length;
                    while (k--)(l = j[k]) && (r[n[k]] = !(q[n[k]] = l))
                }
                if (f) {
                    if (e || a) {
                        if (e) {
                            j = [], k = r.length;
                            while (k--)(l = r[k]) && j.push(q[k] = l);
                            e(null, r = [], j, i)
                        }
                        k = r.length;
                        while (k--)(l = r[k]) && (j = e ? J(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l))
                    }
                } else r = va(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : H.apply(g, r)
            })
        }

        function xa(a) {
            for (var b, c, e, f = a.length, g = d.relative[a[0].type], h = g || d.relative[" "], i = g ? 1 : 0, k = sa(function (a) {
                    return a === b
                }, h, !0), l = sa(function (a) {
                    return J(b, a) > -1
                }, h, !0), m = [function (a, c, d) {
                    var e = !g && (d || c !== j) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d));
                    return b = null, e
                }]; f > i; i++)
                if (c = d.relative[a[i].type]) m = [sa(ta(m), c)];
                else {
                    if (c = d.filter[a[i].type].apply(null, a[i].matches), c[u]) {
                        for (e = ++i; f > e; e++)
                            if (d.relative[a[e].type]) break;
                        return wa(i > 1 && ta(m), i > 1 && ra(a.slice(0, i - 1).concat({
                            value: " " === a[i - 2].type ? "*" : ""
                        })).replace(R, "$1"), c, e > i && xa(a.slice(i, e)), f > e && xa(a = a.slice(e)), f > e && ra(a))
                    }
                    m.push(c)
                } return ta(m)
        }

        function ya(a, b) {
            var c = b.length > 0,
                e = a.length > 0,
                f = function (f, g, h, i, k) {
                    var l, m, o, p = 0,
                        q = "0",
                        r = f && [],
                        s = [],
                        t = j,
                        u = f || e && d.find.TAG("*", k),
                        v = w += null == t ? 1 : Math.random() || .1,
                        x = u.length;
                    for (k && (j = g !== n && g); q !== x && null != (l = u[q]); q++) {
                        if (e && l) {
                            m = 0;
                            while (o = a[m++])
                                if (o(l, g, h)) {
                                    i.push(l);
                                    break
                                } k && (w = v)
                        }
                        c && ((l = !o && l) && p--, f && r.push(l))
                    }
                    if (p += q, c && q !== p) {
                        m = 0;
                        while (o = b[m++]) o(r, s, g, h);
                        if (f) {
                            if (p > 0)
                                while (q--) r[q] || s[q] || (s[q] = F.call(i));
                            s = va(s)
                        }
                        H.apply(i, s), k && !f && s.length > 0 && p + b.length > 1 && ga.uniqueSort(i)
                    }
                    return k && (w = v, j = t), r
                };
            return c ? ia(f) : f
        }
        return h = ga.compile = function (a, b) {
            var c, d = [],
                e = [],
                f = A[a + " "];
            if (!f) {
                b || (b = g(a)), c = b.length;
                while (c--) f = xa(b[c]), f[u] ? d.push(f) : e.push(f);
                f = A(a, ya(e, d)), f.selector = a
            }
            return f
        }, i = ga.select = function (a, b, e, f) {
            var i, j, k, l, m, n = "function" == typeof a && a,
                o = !f && g(a = n.selector || a);
            if (e = e || [], 1 === o.length) {
                if (j = o[0] = o[0].slice(0), j.length > 2 && "ID" === (k = j[0]).type && c.getById && 9 === b.nodeType && p && d.relative[j[1].type]) {
                    if (b = (d.find.ID(k.matches[0].replace(ca, da), b) || [])[0], !b) return e;
                    n && (b = b.parentNode), a = a.slice(j.shift().value.length)
                }
                i = X.needsContext.test(a) ? 0 : j.length;
                while (i--) {
                    if (k = j[i], d.relative[l = k.type]) break;
                    if ((m = d.find[l]) && (f = m(k.matches[0].replace(ca, da), aa.test(j[0].type) && pa(b.parentNode) || b))) {
                        if (j.splice(i, 1), a = f.length && ra(j), !a) return H.apply(e, f), e;
                        break
                    }
                }
            }
            return (n || h(a, o))(f, b, !p, e, aa.test(a) && pa(b.parentNode) || b), e
        }, c.sortStable = u.split("").sort(B).join("") === u, c.detectDuplicates = !!l, m(), c.sortDetached = ja(function (a) {
            return 1 & a.compareDocumentPosition(n.createElement("div"))
        }), ja(function (a) {
            return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href")
        }) || ka("type|href|height|width", function (a, b, c) {
            return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2)
        }), c.attributes && ja(function (a) {
            return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value")
        }) || ka("value", function (a, b, c) {
            return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue
        }), ja(function (a) {
            return null == a.getAttribute("disabled")
        }) || ka(K, function (a, b, c) {
            var d;
            return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
        }), ga
    }(a);
    m.find = s, m.expr = s.selectors, m.expr[":"] = m.expr.pseudos, m.unique = s.uniqueSort, m.text = s.getText, m.isXMLDoc = s.isXML, m.contains = s.contains;
    var t = m.expr.match.needsContext,
        u = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        v = /^.[^:#\[\.,]*$/;

    function w(a, b, c) {
        if (m.isFunction(b)) return m.grep(a, function (a, d) {
            return !!b.call(a, d, a) !== c
        });
        if (b.nodeType) return m.grep(a, function (a) {
            return a === b !== c
        });
        if ("string" == typeof b) {
            if (v.test(b)) return m.filter(b, a, c);
            b = m.filter(b, a)
        }
        return m.grep(a, function (a) {
            return m.inArray(a, b) >= 0 !== c
        })
    }
    m.filter = function (a, b, c) {
        var d = b[0];
        return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? m.find.matchesSelector(d, a) ? [d] : [] : m.find.matches(a, m.grep(b, function (a) {
            return 1 === a.nodeType
        }))
    }, m.fn.extend({
        find: function (a) {
            var b, c = [],
                d = this,
                e = d.length;
            if ("string" != typeof a) return this.pushStack(m(a).filter(function () {
                for (b = 0; e > b; b++)
                    if (m.contains(d[b], this)) return !0
            }));
            for (b = 0; e > b; b++) m.find(a, d[b], c);
            return c = this.pushStack(e > 1 ? m.unique(c) : c), c.selector = this.selector ? this.selector + " " + a : a, c
        },
        filter: function (a) {
            return this.pushStack(w(this, a || [], !1))
        },
        not: function (a) {
            return this.pushStack(w(this, a || [], !0))
        },
        is: function (a) {
            return !!w(this, "string" == typeof a && t.test(a) ? m(a) : a || [], !1).length
        }
    });
    var x, y = a.document,
        z = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        A = m.fn.init = function (a, b) {
            var c, d;
            if (!a) return this;
            if ("string" == typeof a) {
                if (c = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [null, a, null] : z.exec(a), !c || !c[1] && b) return !b || b.jquery ? (b || x).find(a) : this.constructor(b).find(a);
                if (c[1]) {
                    if (b = b instanceof m ? b[0] : b, m.merge(this, m.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : y, !0)), u.test(c[1]) && m.isPlainObject(b))
                        for (c in b) m.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
                    return this
                }
                if (d = y.getElementById(c[2]), d && d.parentNode) {
                    if (d.id !== c[2]) return x.find(a);
                    this.length = 1, this[0] = d
                }
                return this.context = y, this.selector = a, this
            }
            return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : m.isFunction(a) ? "undefined" != typeof x.ready ? x.ready(a) : a(m) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), m.makeArray(a, this))
        };
    A.prototype = m.fn, x = m(y);
    var B = /^(?:parents|prev(?:Until|All))/,
        C = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
    m.extend({
        dir: function (a, b, c) {
            var d = [],
                e = a[b];
            while (e && 9 !== e.nodeType && (void 0 === c || 1 !== e.nodeType || !m(e).is(c))) 1 === e.nodeType && d.push(e), e = e[b];
            return d
        },
        sibling: function (a, b) {
            for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
            return c
        }
    }), m.fn.extend({
        has: function (a) {
            var b, c = m(a, this),
                d = c.length;
            return this.filter(function () {
                for (b = 0; d > b; b++)
                    if (m.contains(this, c[b])) return !0
            })
        },
        closest: function (a, b) {
            for (var c, d = 0, e = this.length, f = [], g = t.test(a) || "string" != typeof a ? m(a, b || this.context) : 0; e > d; d++)
                for (c = this[d]; c && c !== b; c = c.parentNode)
                    if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && m.find.matchesSelector(c, a))) {
                        f.push(c);
                        break
                    } return this.pushStack(f.length > 1 ? m.unique(f) : f)
        },
        index: function (a) {
            return a ? "string" == typeof a ? m.inArray(this[0], m(a)) : m.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function (a, b) {
            return this.pushStack(m.unique(m.merge(this.get(), m(a, b))))
        },
        addBack: function (a) {
            return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
        }
    });

    function D(a, b) {
        do a = a[b]; while (a && 1 !== a.nodeType);
        return a
    }
    m.each({
        parent: function (a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b : null
        },
        parents: function (a) {
            return m.dir(a, "parentNode")
        },
        parentsUntil: function (a, b, c) {
            return m.dir(a, "parentNode", c)
        },
        next: function (a) {
            return D(a, "nextSibling")
        },
        prev: function (a) {
            return D(a, "previousSibling")
        },
        nextAll: function (a) {
            return m.dir(a, "nextSibling")
        },
        prevAll: function (a) {
            return m.dir(a, "previousSibling")
        },
        nextUntil: function (a, b, c) {
            return m.dir(a, "nextSibling", c)
        },
        prevUntil: function (a, b, c) {
            return m.dir(a, "previousSibling", c)
        },
        siblings: function (a) {
            return m.sibling((a.parentNode || {}).firstChild, a)
        },
        children: function (a) {
            return m.sibling(a.firstChild)
        },
        contents: function (a) {
            return m.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : m.merge([], a.childNodes)
        }
    }, function (a, b) {
        m.fn[a] = function (c, d) {
            var e = m.map(this, b, c);
            return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = m.filter(d, e)), this.length > 1 && (C[a] || (e = m.unique(e)), B.test(a) && (e = e.reverse())), this.pushStack(e)
        }
    });
    var E = /\S+/g,
        F = {};

    function G(a) {
        var b = F[a] = {};
        return m.each(a.match(E) || [], function (a, c) {
            b[c] = !0
        }), b
    }
    m.Callbacks = function (a) {
        a = "string" == typeof a ? F[a] || G(a) : m.extend({}, a);
        var b, c, d, e, f, g, h = [],
            i = !a.once && [],
            j = function (l) {
                for (c = a.memory && l, d = !0, f = g || 0, g = 0, e = h.length, b = !0; h && e > f; f++)
                    if (h[f].apply(l[0], l[1]) === !1 && a.stopOnFalse) {
                        c = !1;
                        break
                    } b = !1, h && (i ? i.length && j(i.shift()) : c ? h = [] : k.disable())
            },
            k = {
                add: function () {
                    if (h) {
                        var d = h.length;
                        ! function f(b) {
                            m.each(b, function (b, c) {
                                var d = m.type(c);
                                "function" === d ? a.unique && k.has(c) || h.push(c) : c && c.length && "string" !== d && f(c)
                            })
                        }(arguments), b ? e = h.length : c && (g = d, j(c))
                    }
                    return this
                },
                remove: function () {
                    return h && m.each(arguments, function (a, c) {
                        var d;
                        while ((d = m.inArray(c, h, d)) > -1) h.splice(d, 1), b && (e >= d && e--, f >= d && f--)
                    }), this
                },
                has: function (a) {
                    return a ? m.inArray(a, h) > -1 : !(!h || !h.length)
                },
                empty: function () {
                    return h = [], e = 0, this
                },
                disable: function () {
                    return h = i = c = void 0, this
                },
                disabled: function () {
                    return !h
                },
                lock: function () {
                    return i = void 0, c || k.disable(), this
                },
                locked: function () {
                    return !i
                },
                fireWith: function (a, c) {
                    return !h || d && !i || (c = c || [], c = [a, c.slice ? c.slice() : c], b ? i.push(c) : j(c)), this
                },
                fire: function () {
                    return k.fireWith(this, arguments), this
                },
                fired: function () {
                    return !!d
                }
            };
        return k
    }, m.extend({
        Deferred: function (a) {
            var b = [
                    ["resolve", "done", m.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", m.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", m.Callbacks("memory")]
                ],
                c = "pending",
                d = {
                    state: function () {
                        return c
                    },
                    always: function () {
                        return e.done(arguments).fail(arguments), this
                    },
                    then: function () {
                        var a = arguments;
                        return m.Deferred(function (c) {
                            m.each(b, function (b, f) {
                                var g = m.isFunction(a[b]) && a[b];
                                e[f[1]](function () {
                                    var a = g && g.apply(this, arguments);
                                    a && m.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments)
                                })
                            }), a = null
                        }).promise()
                    },
                    promise: function (a) {
                        return null != a ? m.extend(a, d) : d
                    }
                },
                e = {};
            return d.pipe = d.then, m.each(b, function (a, f) {
                var g = f[2],
                    h = f[3];
                d[f[1]] = g.add, h && g.add(function () {
                    c = h
                }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function () {
                    return e[f[0] + "With"](this === e ? d : this, arguments), this
                }, e[f[0] + "With"] = g.fireWith
            }), d.promise(e), a && a.call(e, e), e
        },
        when: function (a) {
            var b = 0,
                c = d.call(arguments),
                e = c.length,
                f = 1 !== e || a && m.isFunction(a.promise) ? e : 0,
                g = 1 === f ? a : m.Deferred(),
                h = function (a, b, c) {
                    return function (e) {
                        b[a] = this, c[a] = arguments.length > 1 ? d.call(arguments) : e, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c)
                    }
                },
                i, j, k;
            if (e > 1)
                for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++) c[b] && m.isFunction(c[b].promise) ? c[b].promise().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
            return f || g.resolveWith(k, c), g.promise()
        }
    });
    var H;
    m.fn.ready = function (a) {
        return m.ready.promise().done(a), this
    }, m.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function (a) {
            a ? m.readyWait++ : m.ready(!0)
        },
        ready: function (a) {
            if (a === !0 ? !--m.readyWait : !m.isReady) {
                if (!y.body) return setTimeout(m.ready);
                m.isReady = !0, a !== !0 && --m.readyWait > 0 || (H.resolveWith(y, [m]), m.fn.triggerHandler && (m(y).triggerHandler("ready"), m(y).off("ready")))
            }
        }
    });

    function I() {
        y.addEventListener ? (y.removeEventListener("DOMContentLoaded", J, !1), a.removeEventListener("load", J, !1)) : (y.detachEvent("onreadystatechange", J), a.detachEvent("onload", J))
    }

    function J() {
        (y.addEventListener || "load" === event.type || "complete" === y.readyState) && (I(), m.ready())
    }
    m.ready.promise = function (b) {
        if (!H)
            if (H = m.Deferred(), "complete" === y.readyState) setTimeout(m.ready);
            else if (y.addEventListener) y.addEventListener("DOMContentLoaded", J, !1), a.addEventListener("load", J, !1);
        else {
            y.attachEvent("onreadystatechange", J), a.attachEvent("onload", J);
            var c = !1;
            try {
                c = null == a.frameElement && y.documentElement
            } catch (d) {}
            c && c.doScroll && ! function e() {
                if (!m.isReady) {
                    try {
                        c.doScroll("left")
                    } catch (a) {
                        return setTimeout(e, 50)
                    }
                    I(), m.ready()
                }
            }()
        }
        return H.promise(b)
    };
    var K = "undefined",
        L;
    for (L in m(k)) break;
    k.ownLast = "0" !== L, k.inlineBlockNeedsLayout = !1, m(function () {
            var a, b, c, d;
            c = y.getElementsByTagName("body")[0], c && c.style && (b = y.createElement("div"), d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", c.appendChild(d).appendChild(b), typeof b.style.zoom !== K && (b.style.cssText = "display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1", k.inlineBlockNeedsLayout = a = 3 === b.offsetWidth, a && (c.style.zoom = 1)), c.removeChild(d))
        }),
        function () {
            var a = y.createElement("div");
            if (null == k.deleteExpando) {
                k.deleteExpando = !0;
                try {
                    delete a.test
                } catch (b) {
                    k.deleteExpando = !1
                }
            }
            a = null
        }(), m.acceptData = function (a) {
            var b = m.noData[(a.nodeName + " ").toLowerCase()],
                c = +a.nodeType || 1;
            return 1 !== c && 9 !== c ? !1 : !b || b !== !0 && a.getAttribute("classid") === b
        };
    var M = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        N = /([A-Z])/g;

    function O(a, b, c) {
        if (void 0 === c && 1 === a.nodeType) {
            var d = "data-" + b.replace(N, "-$1").toLowerCase();
            if (c = a.getAttribute(d), "string" == typeof c) {
                try {
                    c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : M.test(c) ? m.parseJSON(c) : c
                } catch (e) {}
                m.data(a, b, c)
            } else c = void 0
        }
        return c
    }

    function P(a) {
        var b;
        for (b in a)
            if (("data" !== b || !m.isEmptyObject(a[b])) && "toJSON" !== b) return !1;

        return !0
    }

    function Q(a, b, d, e) {
        if (m.acceptData(a)) {
            var f, g, h = m.expando,
                i = a.nodeType,
                j = i ? m.cache : a,
                k = i ? a[h] : a[h] && h;
            if (k && j[k] && (e || j[k].data) || void 0 !== d || "string" != typeof b) return k || (k = i ? a[h] = c.pop() || m.guid++ : h), j[k] || (j[k] = i ? {} : {
                toJSON: m.noop
            }), ("object" == typeof b || "function" == typeof b) && (e ? j[k] = m.extend(j[k], b) : j[k].data = m.extend(j[k].data, b)), g = j[k], e || (g.data || (g.data = {}), g = g.data), void 0 !== d && (g[m.camelCase(b)] = d), "string" == typeof b ? (f = g[b], null == f && (f = g[m.camelCase(b)])) : f = g, f
        }
    }

    function R(a, b, c) {
        if (m.acceptData(a)) {
            var d, e, f = a.nodeType,
                g = f ? m.cache : a,
                h = f ? a[m.expando] : m.expando;
            if (g[h]) {
                if (b && (d = c ? g[h] : g[h].data)) {
                    m.isArray(b) ? b = b.concat(m.map(b, m.camelCase)) : b in d ? b = [b] : (b = m.camelCase(b), b = b in d ? [b] : b.split(" ")), e = b.length;
                    while (e--) delete d[b[e]];
                    if (c ? !P(d) : !m.isEmptyObject(d)) return
                }(c || (delete g[h].data, P(g[h]))) && (f ? m.cleanData([a], !0) : k.deleteExpando || g != g.window ? delete g[h] : g[h] = null)
            }
        }
    }
    m.extend({
        cache: {},
        noData: {
            "applet ": !0,
            "embed ": !0,
            "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function (a) {
            return a = a.nodeType ? m.cache[a[m.expando]] : a[m.expando], !!a && !P(a)
        },
        data: function (a, b, c) {
            return Q(a, b, c)
        },
        removeData: function (a, b) {
            return R(a, b)
        },
        _data: function (a, b, c) {
            return Q(a, b, c, !0)
        },
        _removeData: function (a, b) {
            return R(a, b, !0)
        }
    }), m.fn.extend({
        data: function (a, b) {
            var c, d, e, f = this[0],
                g = f && f.attributes;
            if (void 0 === a) {
                if (this.length && (e = m.data(f), 1 === f.nodeType && !m._data(f, "parsedAttrs"))) {
                    c = g.length;
                    while (c--) g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = m.camelCase(d.slice(5)), O(f, d, e[d])));
                    m._data(f, "parsedAttrs", !0)
                }
                return e
            }
            return "object" == typeof a ? this.each(function () {
                m.data(this, a)
            }) : arguments.length > 1 ? this.each(function () {
                m.data(this, a, b)
            }) : f ? O(f, a, m.data(f, a)) : void 0
        },
        removeData: function (a) {
            return this.each(function () {
                m.removeData(this, a)
            })
        }
    }), m.extend({
        queue: function (a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = m._data(a, b), c && (!d || m.isArray(c) ? d = m._data(a, b, m.makeArray(c)) : d.push(c)), d || []) : void 0
        },
        dequeue: function (a, b) {
            b = b || "fx";
            var c = m.queue(a, b),
                d = c.length,
                e = c.shift(),
                f = m._queueHooks(a, b),
                g = function () {
                    m.dequeue(a, b)
                };
            "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
        },
        _queueHooks: function (a, b) {
            var c = b + "queueHooks";
            return m._data(a, c) || m._data(a, c, {
                empty: m.Callbacks("once memory").add(function () {
                    m._removeData(a, b + "queue"), m._removeData(a, c)
                })
            })
        }
    }), m.fn.extend({
        queue: function (a, b) {
            var c = 2;
            return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? m.queue(this[0], a) : void 0 === b ? this : this.each(function () {
                var c = m.queue(this, a, b);
                m._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && m.dequeue(this, a)
            })
        },
        dequeue: function (a) {
            return this.each(function () {
                m.dequeue(this, a)
            })
        },
        clearQueue: function (a) {
            return this.queue(a || "fx", [])
        },
        promise: function (a, b) {
            var c, d = 1,
                e = m.Deferred(),
                f = this,
                g = this.length,
                h = function () {
                    --d || e.resolveWith(f, [f])
                };
            "string" != typeof a && (b = a, a = void 0), a = a || "fx";
            while (g--) c = m._data(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h));
            return h(), e.promise(b)
        }
    });
    var S = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        T = ["Top", "Right", "Bottom", "Left"],
        U = function (a, b) {
            return a = b || a, "none" === m.css(a, "display") || !m.contains(a.ownerDocument, a)
        },
        V = m.access = function (a, b, c, d, e, f, g) {
            var h = 0,
                i = a.length,
                j = null == c;
            if ("object" === m.type(c)) {
                e = !0;
                for (h in c) m.access(a, b, h, c[h], !0, f, g)
            } else if (void 0 !== d && (e = !0, m.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function (a, b, c) {
                    return j.call(m(a), c)
                })), b))
                for (; i > h; h++) b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
            return e ? a : j ? b.call(a) : i ? b(a[0], c) : f
        },
        W = /^(?:checkbox|radio)$/i;
    ! function () {
        var a = y.createElement("input"),
            b = y.createElement("div"),
            c = y.createDocumentFragment();
        if (b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", k.leadingWhitespace = 3 === b.firstChild.nodeType, k.tbody = !b.getElementsByTagName("tbody").length, k.htmlSerialize = !!b.getElementsByTagName("link").length, k.html5Clone = "<:nav></:nav>" !== y.createElement("nav").cloneNode(!0).outerHTML, a.type = "checkbox", a.checked = !0, c.appendChild(a), k.appendChecked = a.checked, b.innerHTML = "<textarea>x</textarea>", k.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue, c.appendChild(b), b.innerHTML = "<input type='radio' checked='checked' name='t'/>", k.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, k.noCloneEvent = !0, b.attachEvent && (b.attachEvent("onclick", function () {
                k.noCloneEvent = !1
            }), b.cloneNode(!0).click()), null == k.deleteExpando) {
            k.deleteExpando = !0;
            try {
                delete b.test
            } catch (d) {
                k.deleteExpando = !1
            }
        }
    }(),
    function () {
        var b, c, d = y.createElement("div");
        for (b in {
                submit: !0,
                change: !0,
                focusin: !0
            }) c = "on" + b, (k[b + "Bubbles"] = c in a) || (d.setAttribute(c, "t"), k[b + "Bubbles"] = d.attributes[c].expando === !1);
        d = null
    }();
    var X = /^(?:input|select|textarea)$/i,
        Y = /^key/,
        Z = /^(?:mouse|pointer|contextmenu)|click/,
        $ = /^(?:focusinfocus|focusoutblur)$/,
        _ = /^([^.]*)(?:\.(.+)|)$/;

    function aa() {
        return !0
    }

    function ba() {
        return !1
    }

    function ca() {
        try {
            return y.activeElement
        } catch (a) {}
    }
    m.event = {
        global: {},
        add: function (a, b, c, d, e) {
            var f, g, h, i, j, k, l, n, o, p, q, r = m._data(a);
            if (r) {
                c.handler && (i = c, c = i.handler, e = i.selector), c.guid || (c.guid = m.guid++), (g = r.events) || (g = r.events = {}), (k = r.handle) || (k = r.handle = function (a) {
                    return typeof m === K || a && m.event.triggered === a.type ? void 0 : m.event.dispatch.apply(k.elem, arguments)
                }, k.elem = a), b = (b || "").match(E) || [""], h = b.length;
                while (h--) f = _.exec(b[h]) || [], o = q = f[1], p = (f[2] || "").split(".").sort(), o && (j = m.event.special[o] || {}, o = (e ? j.delegateType : j.bindType) || o, j = m.event.special[o] || {}, l = m.extend({
                    type: o,
                    origType: q,
                    data: d,
                    handler: c,
                    guid: c.guid,
                    selector: e,
                    needsContext: e && m.expr.match.needsContext.test(e),
                    namespace: p.join(".")
                }, i), (n = g[o]) || (n = g[o] = [], n.delegateCount = 0, j.setup && j.setup.call(a, d, p, k) !== !1 || (a.addEventListener ? a.addEventListener(o, k, !1) : a.attachEvent && a.attachEvent("on" + o, k))), j.add && (j.add.call(a, l), l.handler.guid || (l.handler.guid = c.guid)), e ? n.splice(n.delegateCount++, 0, l) : n.push(l), m.event.global[o] = !0);
                a = null
            }
        },
        remove: function (a, b, c, d, e) {
            var f, g, h, i, j, k, l, n, o, p, q, r = m.hasData(a) && m._data(a);
            if (r && (k = r.events)) {
                b = (b || "").match(E) || [""], j = b.length;
                while (j--)
                    if (h = _.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
                        l = m.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, n = k[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), i = f = n.length;
                        while (f--) g = n[f], !e && q !== g.origType || c && c.guid !== g.guid || h && !h.test(g.namespace) || d && d !== g.selector && ("**" !== d || !g.selector) || (n.splice(f, 1), g.selector && n.delegateCount--, l.remove && l.remove.call(a, g));
                        i && !n.length && (l.teardown && l.teardown.call(a, p, r.handle) !== !1 || m.removeEvent(a, o, r.handle), delete k[o])
                    } else
                        for (o in k) m.event.remove(a, o + b[j], c, d, !0);
                m.isEmptyObject(k) && (delete r.handle, m._removeData(a, "events"))
            }
        },
        trigger: function (b, c, d, e) {
            var f, g, h, i, k, l, n, o = [d || y],
                p = j.call(b, "type") ? b.type : b,
                q = j.call(b, "namespace") ? b.namespace.split(".") : [];
            if (h = l = d = d || y, 3 !== d.nodeType && 8 !== d.nodeType && !$.test(p + m.event.triggered) && (p.indexOf(".") >= 0 && (q = p.split("."), p = q.shift(), q.sort()), g = p.indexOf(":") < 0 && "on" + p, b = b[m.expando] ? b : new m.Event(p, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b.namespace = q.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + q.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = d), c = null == c ? [b] : m.makeArray(c, [b]), k = m.event.special[p] || {}, e || !k.trigger || k.trigger.apply(d, c) !== !1)) {
                if (!e && !k.noBubble && !m.isWindow(d)) {
                    for (i = k.delegateType || p, $.test(i + p) || (h = h.parentNode); h; h = h.parentNode) o.push(h), l = h;
                    l === (d.ownerDocument || y) && o.push(l.defaultView || l.parentWindow || a)
                }
                n = 0;
                while ((h = o[n++]) && !b.isPropagationStopped()) b.type = n > 1 ? i : k.bindType || p, f = (m._data(h, "events") || {})[b.type] && m._data(h, "handle"), f && f.apply(h, c), f = g && h[g], f && f.apply && m.acceptData(h) && (b.result = f.apply(h, c), b.result === !1 && b.preventDefault());
                if (b.type = p, !e && !b.isDefaultPrevented() && (!k._default || k._default.apply(o.pop(), c) === !1) && m.acceptData(d) && g && d[p] && !m.isWindow(d)) {
                    l = d[g], l && (d[g] = null), m.event.triggered = p;
                    try {
                        d[p]()
                    } catch (r) {}
                    m.event.triggered = void 0, l && (d[g] = l)
                }
                return b.result
            }
        },
        dispatch: function (a) {
            a = m.event.fix(a);
            var b, c, e, f, g, h = [],
                i = d.call(arguments),
                j = (m._data(this, "events") || {})[a.type] || [],
                k = m.event.special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) {
                h = m.event.handlers.call(this, a, j), b = 0;
                while ((f = h[b++]) && !a.isPropagationStopped()) {
                    a.currentTarget = f.elem, g = 0;
                    while ((e = f.handlers[g++]) && !a.isImmediatePropagationStopped())(!a.namespace_re || a.namespace_re.test(e.namespace)) && (a.handleObj = e, a.data = e.data, c = ((m.event.special[e.origType] || {}).handle || e.handler).apply(f.elem, i), void 0 !== c && (a.result = c) === !1 && (a.preventDefault(), a.stopPropagation()))
                }
                return k.postDispatch && k.postDispatch.call(this, a), a.result
            }
        },
        handlers: function (a, b) {
            var c, d, e, f, g = [],
                h = b.delegateCount,
                i = a.target;
            if (h && i.nodeType && (!a.button || "click" !== a.type))
                for (; i != this; i = i.parentNode || this)
                    if (1 === i.nodeType && (i.disabled !== !0 || "click" !== a.type)) {
                        for (e = [], f = 0; h > f; f++) d = b[f], c = d.selector + " ", void 0 === e[c] && (e[c] = d.needsContext ? m(c, this).index(i) >= 0 : m.find(c, this, null, [i]).length), e[c] && e.push(d);
                        e.length && g.push({
                            elem: i,
                            handlers: e
                        })
                    } return h < b.length && g.push({
                elem: this,
                handlers: b.slice(h)
            }), g
        },
        fix: function (a) {
            if (a[m.expando]) return a;
            var b, c, d, e = a.type,
                f = a,
                g = this.fixHooks[e];
            g || (this.fixHooks[e] = g = Z.test(e) ? this.mouseHooks : Y.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new m.Event(f), b = d.length;
            while (b--) c = d[b], a[c] = f[c];
            return a.target || (a.target = f.srcElement || y), 3 === a.target.nodeType && (a.target = a.target.parentNode), a.metaKey = !!a.metaKey, g.filter ? g.filter(a, f) : a
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function (a, b) {
                return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function (a, b) {
                var c, d, e, f = b.button,
                    g = b.fromElement;
                return null == a.pageX && null != b.clientX && (d = a.target.ownerDocument || y, e = d.documentElement, c = d.body, a.pageX = b.clientX + (e && e.scrollLeft || c && c.scrollLeft || 0) - (e && e.clientLeft || c && c.clientLeft || 0), a.pageY = b.clientY + (e && e.scrollTop || c && c.scrollTop || 0) - (e && e.clientTop || c && c.clientTop || 0)), !a.relatedTarget && g && (a.relatedTarget = g === a.target ? b.toElement : g), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), a
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function () {
                    if (this !== ca() && this.focus) try {
                        return this.focus(), !1
                    } catch (a) {}
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function () {
                    return this === ca() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function () {
                    return m.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                },
                _default: function (a) {
                    return m.nodeName(a.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function (a) {
                    void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result)
                }
            }
        },
        simulate: function (a, b, c, d) {
            var e = m.extend(new m.Event, c, {
                type: a,
                isSimulated: !0,
                originalEvent: {}
            });
            d ? m.event.trigger(e, null, b) : m.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
        }
    }, m.removeEvent = y.removeEventListener ? function (a, b, c) {
        a.removeEventListener && a.removeEventListener(b, c, !1)
    } : function (a, b, c) {
        var d = "on" + b;
        a.detachEvent && (typeof a[d] === K && (a[d] = null), a.detachEvent(d, c))
    }, m.Event = function (a, b) {
        return this instanceof m.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && a.returnValue === !1 ? aa : ba) : this.type = a, b && m.extend(this, b), this.timeStamp = a && a.timeStamp || m.now(), void(this[m.expando] = !0)) : new m.Event(a, b)
    }, m.Event.prototype = {
        isDefaultPrevented: ba,
        isPropagationStopped: ba,
        isImmediatePropagationStopped: ba,
        preventDefault: function () {
            var a = this.originalEvent;
            this.isDefaultPrevented = aa, a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
        },
        stopPropagation: function () {
            var a = this.originalEvent;
            this.isPropagationStopped = aa, a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
        },
        stopImmediatePropagation: function () {
            var a = this.originalEvent;
            this.isImmediatePropagationStopped = aa, a && a.stopImmediatePropagation && a.stopImmediatePropagation(), this.stopPropagation()
        }
    }, m.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (a, b) {
        m.event.special[a] = {
            delegateType: b,
            bindType: b,
            handle: function (a) {
                var c, d = this,
                    e = a.relatedTarget,
                    f = a.handleObj;
                return (!e || e !== d && !m.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
            }
        }
    }), k.submitBubbles || (m.event.special.submit = {
        setup: function () {
            return m.nodeName(this, "form") ? !1 : void m.event.add(this, "click._submit keypress._submit", function (a) {
                var b = a.target,
                    c = m.nodeName(b, "input") || m.nodeName(b, "button") ? b.form : void 0;
                c && !m._data(c, "submitBubbles") && (m.event.add(c, "submit._submit", function (a) {
                    a._submit_bubble = !0
                }), m._data(c, "submitBubbles", !0))
            })
        },
        postDispatch: function (a) {
            a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && m.event.simulate("submit", this.parentNode, a, !0))
        },
        teardown: function () {
            return m.nodeName(this, "form") ? !1 : void m.event.remove(this, "._submit")
        }
    }), k.changeBubbles || (m.event.special.change = {
        setup: function () {
            return X.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (m.event.add(this, "propertychange._change", function (a) {
                "checked" === a.originalEvent.propertyName && (this._just_changed = !0)
            }), m.event.add(this, "click._change", function (a) {
                this._just_changed && !a.isTrigger && (this._just_changed = !1), m.event.simulate("change", this, a, !0)
            })), !1) : void m.event.add(this, "beforeactivate._change", function (a) {
                var b = a.target;
                X.test(b.nodeName) && !m._data(b, "changeBubbles") && (m.event.add(b, "change._change", function (a) {
                    !this.parentNode || a.isSimulated || a.isTrigger || m.event.simulate("change", this.parentNode, a, !0)
                }), m._data(b, "changeBubbles", !0))
            })
        },
        handle: function (a) {
            var b = a.target;
            return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0
        },
        teardown: function () {
            return m.event.remove(this, "._change"), !X.test(this.nodeName)
        }
    }), k.focusinBubbles || m.each({
        focus: "focusin",
        blur: "focusout"
    }, function (a, b) {
        var c = function (a) {
            m.event.simulate(b, a.target, m.event.fix(a), !0)
        };
        m.event.special[b] = {
            setup: function () {
                var d = this.ownerDocument || this,
                    e = m._data(d, b);
                e || d.addEventListener(a, c, !0), m._data(d, b, (e || 0) + 1)
            },
            teardown: function () {
                var d = this.ownerDocument || this,
                    e = m._data(d, b) - 1;
                e ? m._data(d, b, e) : (d.removeEventListener(a, c, !0), m._removeData(d, b))
            }
        }
    }), m.fn.extend({
        on: function (a, b, c, d, e) {
            var f, g;
            if ("object" == typeof a) {
                "string" != typeof b && (c = c || b, b = void 0);
                for (f in a) this.on(f, b, c, a[f], e);
                return this
            }
            if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1) d = ba;
            else if (!d) return this;
            return 1 === e && (g = d, d = function (a) {
                return m().off(a), g.apply(this, arguments)
            }, d.guid = g.guid || (g.guid = m.guid++)), this.each(function () {
                m.event.add(this, a, d, c, b)
            })
        },
        one: function (a, b, c, d) {
            return this.on(a, b, c, d, 1)
        },
        off: function (a, b, c) {
            var d, e;
            if (a && a.preventDefault && a.handleObj) return d = a.handleObj, m(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
            if ("object" == typeof a) {
                for (e in a) this.off(e, b, a[e]);
                return this
            }
            return (b === !1 || "function" == typeof b) && (c = b, b = void 0), c === !1 && (c = ba), this.each(function () {
                m.event.remove(this, a, c, b)
            })
        },
        trigger: function (a, b) {
            return this.each(function () {
                m.event.trigger(a, b, this)
            })
        },
        triggerHandler: function (a, b) {
            var c = this[0];
            return c ? m.event.trigger(a, b, c, !0) : void 0
        }
    });

    function da(a) {
        var b = ea.split("|"),
            c = a.createDocumentFragment();
        if (c.createElement)
            while (b.length) c.createElement(b.pop());
        return c
    }
    var ea = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        fa = / jQuery\d+="(?:null|\d+)"/g,
        ga = new RegExp("<(?:" + ea + ")[\\s/>]", "i"),
        ha = /^\s+/,
        ia = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        ja = /<([\w:]+)/,
        ka = /<tbody/i,
        la = /<|&#?\w+;/,
        ma = /<(?:script|style|link)/i,
        na = /checked\s*(?:[^=]|=\s*.checked.)/i,
        oa = /^$|\/(?:java|ecma)script/i,
        pa = /^true\/(.*)/,
        qa = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        ra = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: k.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        },
        sa = da(y),
        ta = sa.appendChild(y.createElement("div"));
    ra.optgroup = ra.option, ra.tbody = ra.tfoot = ra.colgroup = ra.caption = ra.thead, ra.th = ra.td;

    function ua(a, b) {
        var c, d, e = 0,
            f = typeof a.getElementsByTagName !== K ? a.getElementsByTagName(b || "*") : typeof a.querySelectorAll !== K ? a.querySelectorAll(b || "*") : void 0;
        if (!f)
            for (f = [], c = a.childNodes || a; null != (d = c[e]); e++) !b || m.nodeName(d, b) ? f.push(d) : m.merge(f, ua(d, b));
        return void 0 === b || b && m.nodeName(a, b) ? m.merge([a], f) : f
    }

    function va(a) {
        W.test(a.type) && (a.defaultChecked = a.checked)
    }

    function wa(a, b) {
        return m.nodeName(a, "table") && m.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
    }

    function xa(a) {
        return a.type = (null !== m.find.attr(a, "type")) + "/" + a.type, a
    }

    function ya(a) {
        var b = pa.exec(a.type);
        return b ? a.type = b[1] : a.removeAttribute("type"), a
    }

    function za(a, b) {
        for (var c, d = 0; null != (c = a[d]); d++) m._data(c, "globalEval", !b || m._data(b[d], "globalEval"))
    }

    function Aa(a, b) {
        if (1 === b.nodeType && m.hasData(a)) {
            var c, d, e, f = m._data(a),
                g = m._data(b, f),
                h = f.events;
            if (h) {
                delete g.handle, g.events = {};
                for (c in h)
                    for (d = 0, e = h[c].length; e > d; d++) m.event.add(b, c, h[c][d])
            }
            g.data && (g.data = m.extend({}, g.data))
        }
    }

    function Ba(a, b) {
        var c, d, e;
        if (1 === b.nodeType) {
            if (c = b.nodeName.toLowerCase(), !k.noCloneEvent && b[m.expando]) {
                e = m._data(b);
                for (d in e.events) m.removeEvent(b, d, e.handle);
                b.removeAttribute(m.expando)
            }
            "script" === c && b.text !== a.text ? (xa(b).text = a.text, ya(b)) : "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), k.html5Clone && a.innerHTML && !m.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && W.test(a.type) ? (b.defaultChecked = b.checked = a.checked, b.value !== a.value && (b.value = a.value)) : "option" === c ? b.defaultSelected = b.selected = a.defaultSelected : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue)
        }
    }
    m.extend({
        clone: function (a, b, c) {
            var d, e, f, g, h, i = m.contains(a.ownerDocument, a);
            if (k.html5Clone || m.isXMLDoc(a) || !ga.test("<" + a.nodeName + ">") ? f = a.cloneNode(!0) : (ta.innerHTML = a.outerHTML, ta.removeChild(f = ta.firstChild)), !(k.noCloneEvent && k.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || m.isXMLDoc(a)))
                for (d = ua(f), h = ua(a), g = 0; null != (e = h[g]); ++g) d[g] && Ba(e, d[g]);
            if (b)
                if (c)
                    for (h = h || ua(a), d = d || ua(f), g = 0; null != (e = h[g]); g++) Aa(e, d[g]);
                else Aa(a, f);
            return d = ua(f, "script"), d.length > 0 && za(d, !i && ua(a, "script")), d = h = e = null, f
        },
        buildFragment: function (a, b, c, d) {
            for (var e, f, g, h, i, j, l, n = a.length, o = da(b), p = [], q = 0; n > q; q++)
                if (f = a[q], f || 0 === f)
                    if ("object" === m.type(f)) m.merge(p, f.nodeType ? [f] : f);
                    else if (la.test(f)) {
                h = h || o.appendChild(b.createElement("div")), i = (ja.exec(f) || ["", ""])[1].toLowerCase(), l = ra[i] || ra._default, h.innerHTML = l[1] + f.replace(ia, "<$1></$2>") + l[2], e = l[0];
                while (e--) h = h.lastChild;
                if (!k.leadingWhitespace && ha.test(f) && p.push(b.createTextNode(ha.exec(f)[0])), !k.tbody) {
                    f = "table" !== i || ka.test(f) ? "<table>" !== l[1] || ka.test(f) ? 0 : h : h.firstChild, e = f && f.childNodes.length;
                    while (e--) m.nodeName(j = f.childNodes[e], "tbody") && !j.childNodes.length && f.removeChild(j)
                }
                m.merge(p, h.childNodes), h.textContent = "";
                while (h.firstChild) h.removeChild(h.firstChild);
                h = o.lastChild
            } else p.push(b.createTextNode(f));
            h && o.removeChild(h), k.appendChecked || m.grep(ua(p, "input"), va), q = 0;
            while (f = p[q++])
                if ((!d || -1 === m.inArray(f, d)) && (g = m.contains(f.ownerDocument, f), h = ua(o.appendChild(f), "script"), g && za(h), c)) {
                    e = 0;
                    while (f = h[e++]) oa.test(f.type || "") && c.push(f)
                } return h = null, o
        },
        cleanData: function (a, b) {
            for (var d, e, f, g, h = 0, i = m.expando, j = m.cache, l = k.deleteExpando, n = m.event.special; null != (d = a[h]); h++)
                if ((b || m.acceptData(d)) && (f = d[i], g = f && j[f])) {
                    if (g.events)
                        for (e in g.events) n[e] ? m.event.remove(d, e) : m.removeEvent(d, e, g.handle);
                    j[f] && (delete j[f], l ? delete d[i] : typeof d.removeAttribute !== K ? d.removeAttribute(i) : d[i] = null, c.push(f))
                }
        }
    }), m.fn.extend({
        text: function (a) {
            return V(this, function (a) {
                return void 0 === a ? m.text(this) : this.empty().append((this[0] && this[0].ownerDocument || y).createTextNode(a))
            }, null, a, arguments.length)
        },
        append: function () {
            return this.domManip(arguments, function (a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = wa(this, a);
                    b.appendChild(a)
                }
            })
        },
        prepend: function () {
            return this.domManip(arguments, function (a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = wa(this, a);
                    b.insertBefore(a, b.firstChild)
                }
            })
        },
        before: function () {
            return this.domManip(arguments, function (a) {
                this.parentNode && this.parentNode.insertBefore(a, this)
            })
        },
        after: function () {
            return this.domManip(arguments, function (a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
            })
        },
        remove: function (a, b) {
            for (var c, d = a ? m.filter(a, this) : this, e = 0; null != (c = d[e]); e++) b || 1 !== c.nodeType || m.cleanData(ua(c)), c.parentNode && (b && m.contains(c.ownerDocument, c) && za(ua(c, "script")), c.parentNode.removeChild(c));
            return this
        },
        empty: function () {
            for (var a, b = 0; null != (a = this[b]); b++) {
                1 === a.nodeType && m.cleanData(ua(a, !1));
                while (a.firstChild) a.removeChild(a.firstChild);
                a.options && m.nodeName(a, "select") && (a.options.length = 0)
            }
            return this
        },
        clone: function (a, b) {
            return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function () {
                return m.clone(this, a, b)
            })
        },
        html: function (a) {
            return V(this, function (a) {
                var b = this[0] || {},
                    c = 0,
                    d = this.length;
                if (void 0 === a) return 1 === b.nodeType ? b.innerHTML.replace(fa, "") : void 0;
                if (!("string" != typeof a || ma.test(a) || !k.htmlSerialize && ga.test(a) || !k.leadingWhitespace && ha.test(a) || ra[(ja.exec(a) || ["", ""])[1].toLowerCase()])) {
                    a = a.replace(ia, "<$1></$2>");
                    try {
                        for (; d > c; c++) b = this[c] || {}, 1 === b.nodeType && (m.cleanData(ua(b, !1)), b.innerHTML = a);
                        b = 0
                    } catch (e) {}
                }
                b && this.empty().append(a)
            }, null, a, arguments.length)
        },
        replaceWith: function () {
            var a = arguments[0];
            return this.domManip(arguments, function (b) {
                a = this.parentNode, m.cleanData(ua(this)), a && a.replaceChild(b, this)
            }), a && (a.length || a.nodeType) ? this : this.remove()
        },
        detach: function (a) {
            return this.remove(a, !0)
        },
        domManip: function (a, b) {
            a = e.apply([], a);
            var c, d, f, g, h, i, j = 0,
                l = this.length,
                n = this,
                o = l - 1,
                p = a[0],
                q = m.isFunction(p);
            if (q || l > 1 && "string" == typeof p && !k.checkClone && na.test(p)) return this.each(function (c) {
                var d = n.eq(c);
                q && (a[0] = p.call(this, c, d.html())), d.domManip(a, b)
            });
            if (l && (i = m.buildFragment(a, this[0].ownerDocument, !1, this), c = i.firstChild, 1 === i.childNodes.length && (i = c), c)) {
                for (g = m.map(ua(i, "script"), xa), f = g.length; l > j; j++) d = i, j !== o && (d = m.clone(d, !0, !0), f && m.merge(g, ua(d, "script"))), b.call(this[j], d, j);
                if (f)
                    for (h = g[g.length - 1].ownerDocument, m.map(g, ya), j = 0; f > j; j++) d = g[j], oa.test(d.type || "") && !m._data(d, "globalEval") && m.contains(h, d) && (d.src ? m._evalUrl && m._evalUrl(d.src) : m.globalEval((d.text || d.textContent || d.innerHTML || "").replace(qa, "")));
                i = c = null
            }
            return this
        }
    }), m.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (a, b) {
        m.fn[a] = function (a) {
            for (var c, d = 0, e = [], g = m(a), h = g.length - 1; h >= d; d++) c = d === h ? this : this.clone(!0), m(g[d])[b](c), f.apply(e, c.get());
            return this.pushStack(e)
        }
    });
    var Ca, Da = {};

    function Ea(b, c) {
        var d, e = m(c.createElement(b)).appendTo(c.body),
            f = a.getDefaultComputedStyle && (d = a.getDefaultComputedStyle(e[0])) ? d.display : m.css(e[0], "display");
        return e.detach(), f
    }

    function Fa(a) {
        var b = y,
            c = Da[a];
        return c || (c = Ea(a, b), "none" !== c && c || (Ca = (Ca || m("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = (Ca[0].contentWindow || Ca[0].contentDocument).document, b.write(), b.close(), c = Ea(a, b), Ca.detach()), Da[a] = c), c
    }! function () {
        var a;
        k.shrinkWrapBlocks = function () {
            if (null != a) return a;
            a = !1;
            var b, c, d;
            return c = y.getElementsByTagName("body")[0], c && c.style ? (b = y.createElement("div"), d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", c.appendChild(d).appendChild(b), typeof b.style.zoom !== K && (b.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1", b.appendChild(y.createElement("div")).style.width = "5px", a = 3 !== b.offsetWidth), c.removeChild(d), a) : void 0
        }
    }();
    var Ga = /^margin/,
        Ha = new RegExp("^(" + S + ")(?!px)[a-z%]+$", "i"),
        Ia, Ja, Ka = /^(top|right|bottom|left)$/;
    a.getComputedStyle ? (Ia = function (b) {
        return b.ownerDocument.defaultView.opener ? b.ownerDocument.defaultView.getComputedStyle(b, null) : a.getComputedStyle(b, null)
    }, Ja = function (a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Ia(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, c && ("" !== g || m.contains(a.ownerDocument, a) || (g = m.style(a, b)), Ha.test(g) && Ga.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 === g ? g : g + ""
    }) : y.documentElement.currentStyle && (Ia = function (a) {
        return a.currentStyle
    }, Ja = function (a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Ia(a), g = c ? c[b] : void 0, null == g && h && h[b] && (g = h[b]), Ha.test(g) && !Ka.test(b) && (d = h.left, e = a.runtimeStyle, f = e && e.left, f && (e.left = a.currentStyle.left), h.left = "fontSize" === b ? "1em" : g, g = h.pixelLeft + "px", h.left = d, f && (e.left = f)), void 0 === g ? g : g + "" || "auto"
    });

    function La(a, b) {
        return {
            get: function () {
                var c = a();
                if (null != c) return c ? void delete this.get : (this.get = b).apply(this, arguments)
            }
        }
    }! function () {
        var b, c, d, e, f, g, h;
        if (b = y.createElement("div"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", d = b.getElementsByTagName("a")[0], c = d && d.style) {
            c.cssText = "float:left;opacity:.5", k.opacity = "0.5" === c.opacity, k.cssFloat = !!c.cssFloat, b.style.backgroundClip = "content-box", b.cloneNode(!0).style.backgroundClip = "", k.clearCloneStyle = "content-box" === b.style.backgroundClip, k.boxSizing = "" === c.boxSizing || "" === c.MozBoxSizing || "" === c.WebkitBoxSizing, m.extend(k, {
                reliableHiddenOffsets: function () {
                    return null == g && i(), g
                },
                boxSizingReliable: function () {
                    return null == f && i(), f
                },
                pixelPosition: function () {
                    return null == e && i(), e
                },
                reliableMarginRight: function () {
                    return null == h && i(), h
                }
            });

            function i() {
                var b, c, d, i;
                c = y.getElementsByTagName("body")[0], c && c.style && (b = y.createElement("div"), d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", c.appendChild(d).appendChild(b), b.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", e = f = !1, h = !0, a.getComputedStyle && (e = "1%" !== (a.getComputedStyle(b, null) || {}).top, f = "4px" === (a.getComputedStyle(b, null) || {
                    width: "4px"
                }).width, i = b.appendChild(y.createElement("div")), i.style.cssText = b.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", i.style.marginRight = i.style.width = "0", b.style.width = "1px", h = !parseFloat((a.getComputedStyle(i, null) || {}).marginRight), b.removeChild(i)), b.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", i = b.getElementsByTagName("td"), i[0].style.cssText = "margin:0;border:0;padding:0;display:none", g = 0 === i[0].offsetHeight, g && (i[0].style.display = "", i[1].style.display = "none", g = 0 === i[0].offsetHeight), c.removeChild(d))
            }
        }
    }(), m.swap = function (a, b, c, d) {
        var e, f, g = {};
        for (f in b) g[f] = a.style[f], a.style[f] = b[f];
        e = c.apply(a, d || []);
        for (f in b) a.style[f] = g[f];
        return e
    };
    var Ma = /alpha\([^)]*\)/i,
        Na = /opacity\s*=\s*([^)]*)/,
        Oa = /^(none|table(?!-c[ea]).+)/,
        Pa = new RegExp("^(" + S + ")(.*)$", "i"),
        Qa = new RegExp("^([+-])=(" + S + ")", "i"),
        Ra = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Sa = {
            letterSpacing: "0",
            fontWeight: "400"
        },
        Ta = ["Webkit", "O", "Moz", "ms"];

    function Ua(a, b) {
        if (b in a) return b;
        var c = b.charAt(0).toUpperCase() + b.slice(1),
            d = b,
            e = Ta.length;
        while (e--)
            if (b = Ta[e] + c, b in a) return b;
        return d
    }

    function Va(a, b) {
        for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g], d.style && (f[g] = m._data(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && U(d) && (f[g] = m._data(d, "olddisplay", Fa(d.nodeName)))) : (e = U(d), (c && "none" !== c || !e) && m._data(d, "olddisplay", e ? c : m.css(d, "display"))));
        for (g = 0; h > g; g++) d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
        return a
    }

    function Wa(a, b, c) {
        var d = Pa.exec(b);
        return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
    }

    function Xa(a, b, c, d, e) {
        for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) "margin" === c && (g += m.css(a, c + T[f], !0, e)), d ? ("content" === c && (g -= m.css(a, "padding" + T[f], !0, e)), "margin" !== c && (g -= m.css(a, "border" + T[f] + "Width", !0, e))) : (g += m.css(a, "padding" + T[f], !0, e), "padding" !== c && (g += m.css(a, "border" + T[f] + "Width", !0, e)));
        return g
    }

    function Ya(a, b, c) {
        var d = !0,
            e = "width" === b ? a.offsetWidth : a.offsetHeight,
            f = Ia(a),
            g = k.boxSizing && "border-box" === m.css(a, "boxSizing", !1, f);
        if (0 >= e || null == e) {
            if (e = Ja(a, b, f), (0 > e || null == e) && (e = a.style[b]), Ha.test(e)) return e;
            d = g && (k.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0
        }
        return e + Xa(a, b, c || (g ? "border" : "content"), d, f) + "px"
    }
    m.extend({
        cssHooks: {
            opacity: {
                get: function (a, b) {
                    if (b) {
                        var c = Ja(a, "opacity");
                        return "" === c ? "1" : c
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            "float": k.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function (a, b, c, d) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var e, f, g, h = m.camelCase(b),
                    i = a.style;
                if (b = m.cssProps[h] || (m.cssProps[h] = Ua(i, h)), g = m.cssHooks[b] || m.cssHooks[h], void 0 === c) return g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b];
                if (f = typeof c, "string" === f && (e = Qa.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(m.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || m.cssNumber[h] || (c += "px"), k.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), !(g && "set" in g && void 0 === (c = g.set(a, c, d))))) try {
                    i[b] = c
                } catch (j) {}
            }
        },
        css: function (a, b, c, d) {
            var e, f, g, h = m.camelCase(b);
            return b = m.cssProps[h] || (m.cssProps[h] = Ua(a.style, h)), g = m.cssHooks[b] || m.cssHooks[h], g && "get" in g && (f = g.get(a, !0, c)), void 0 === f && (f = Ja(a, b, d)), "normal" === f && b in Sa && (f = Sa[b]), "" === c || c ? (e = parseFloat(f), c === !0 || m.isNumeric(e) ? e || 0 : f) : f
        }
    }), m.each(["height", "width"], function (a, b) {
        m.cssHooks[b] = {
            get: function (a, c, d) {
                return c ? Oa.test(m.css(a, "display")) && 0 === a.offsetWidth ? m.swap(a, Ra, function () {
                    return Ya(a, b, d)
                }) : Ya(a, b, d) : void 0
            },
            set: function (a, c, d) {
                var e = d && Ia(a);
                return Wa(a, c, d ? Xa(a, b, d, k.boxSizing && "border-box" === m.css(a, "boxSizing", !1, e), e) : 0)
            }
        }
    }), k.opacity || (m.cssHooks.opacity = {
        get: function (a, b) {
            return Na.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : b ? "1" : ""
        },
        set: function (a, b) {
            var c = a.style,
                d = a.currentStyle,
                e = m.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")" : "",
                f = d && d.filter || c.filter || "";
            c.zoom = 1, (b >= 1 || "" === b) && "" === m.trim(f.replace(Ma, "")) && c.removeAttribute && (c.removeAttribute("filter"), "" === b || d && !d.filter) || (c.filter = Ma.test(f) ? f.replace(Ma, e) : f + " " + e)
        }
    }), m.cssHooks.marginRight = La(k.reliableMarginRight, function (a, b) {
        return b ? m.swap(a, {
            display: "inline-block"
        }, Ja, [a, "marginRight"]) : void 0
    }), m.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function (a, b) {
        m.cssHooks[a + b] = {
            expand: function (c) {
                for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++) e[a + T[d] + b] = f[d] || f[d - 2] || f[0];
                return e
            }
        }, Ga.test(a) || (m.cssHooks[a + b].set = Wa)
    }), m.fn.extend({
        css: function (a, b) {
            return V(this, function (a, b, c) {
                var d, e, f = {},
                    g = 0;
                if (m.isArray(b)) {
                    for (d = Ia(a), e = b.length; e > g; g++) f[b[g]] = m.css(a, b[g], !1, d);
                    return f
                }
                return void 0 !== c ? m.style(a, b, c) : m.css(a, b)
            }, a, b, arguments.length > 1)
        },
        show: function () {
            return Va(this, !0)
        },
        hide: function () {
            return Va(this)
        },
        toggle: function (a) {
            return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function () {
                U(this) ? m(this).show() : m(this).hide()
            })
        }
    });

    function Za(a, b, c, d, e) {
        return new Za.prototype.init(a, b, c, d, e)
    }
    m.Tween = Za, Za.prototype = {
        constructor: Za,
        init: function (a, b, c, d, e, f) {
            this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (m.cssNumber[c] ? "" : "px")
        },
        cur: function () {
            var a = Za.propHooks[this.prop];
            return a && a.get ? a.get(this) : Za.propHooks._default.get(this)
        },
        run: function (a) {
            var b, c = Za.propHooks[this.prop];
            return this.options.duration ? this.pos = b = m.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : this.pos = b = a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : Za.propHooks._default.set(this), this
        }
    }, Za.prototype.init.prototype = Za.prototype, Za.propHooks = {
        _default: {
            get: function (a) {
                var b;
                return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = m.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop]
            },
            set: function (a) {
                m.fx.step[a.prop] ? m.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[m.cssProps[a.prop]] || m.cssHooks[a.prop]) ? m.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
            }
        }
    }, Za.propHooks.scrollTop = Za.propHooks.scrollLeft = {
        set: function (a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
        }
    }, m.easing = {
        linear: function (a) {
            return a
        },
        swing: function (a) {
            return .5 - Math.cos(a * Math.PI) / 2
        }
    }, m.fx = Za.prototype.init, m.fx.step = {};
    var $a, _a, ab = /^(?:toggle|show|hide)$/,
        bb = new RegExp("^(?:([+-])=|)(" + S + ")([a-z%]*)$", "i"),
        cb = /queueHooks$/,
        db = [ib],
        eb = {
            "*": [function (a, b) {
                var c = this.createTween(a, b),
                    d = c.cur(),
                    e = bb.exec(b),
                    f = e && e[3] || (m.cssNumber[a] ? "" : "px"),
                    g = (m.cssNumber[a] || "px" !== f && +d) && bb.exec(m.css(c.elem, a)),
                    h = 1,
                    i = 20;
                if (g && g[3] !== f) {
                    f = f || g[3], e = e || [], g = +d || 1;
                    do h = h || ".5", g /= h, m.style(c.elem, a, g + f); while (h !== (h = c.cur() / d) && 1 !== h && --i)
                }
                return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), c
            }]
        };

    function fb() {
        return setTimeout(function () {
            $a = void 0
        }), $a = m.now()
    }

    function gb(a, b) {
        var c, d = {
                height: a
            },
            e = 0;
        for (b = b ? 1 : 0; 4 > e; e += 2 - b) c = T[e], d["margin" + c] = d["padding" + c] = a;
        return b && (d.opacity = d.width = a), d
    }

    function hb(a, b, c) {
        for (var d, e = (eb[b] || []).concat(eb["*"]), f = 0, g = e.length; g > f; f++)
            if (d = e[f].call(c, b, a)) return d
    }

    function ib(a, b, c) {
        var d, e, f, g, h, i, j, l, n = this,
            o = {},
            p = a.style,
            q = a.nodeType && U(a),
            r = m._data(a, "fxshow");
        c.queue || (h = m._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function () {
            h.unqueued || i()
        }), h.unqueued++, n.always(function () {
            n.always(function () {
                h.unqueued--, m.queue(a, "fx").length || h.empty.fire()
            })
        })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [p.overflow, p.overflowX, p.overflowY], j = m.css(a, "display"), l = "none" === j ? m._data(a, "olddisplay") || Fa(a.nodeName) : j, "inline" === l && "none" === m.css(a, "float") && (k.inlineBlockNeedsLayout && "inline" !== Fa(a.nodeName) ? p.zoom = 1 : p.display = "inline-block")), c.overflow && (p.overflow = "hidden", k.shrinkWrapBlocks() || n.always(function () {
            p.overflow = c.overflow[0], p.overflowX = c.overflow[1], p.overflowY = c.overflow[2]
        }));
        for (d in b)
            if (e = b[d], ab.exec(e)) {
                if (delete b[d], f = f || "toggle" === e, e === (q ? "hide" : "show")) {
                    if ("show" !== e || !r || void 0 === r[d]) continue;
                    q = !0
                }
                o[d] = r && r[d] || m.style(a, d)
            } else j = void 0;
        if (m.isEmptyObject(o)) "inline" === ("none" === j ? Fa(a.nodeName) : j) && (p.display = j);
        else {
            r ? "hidden" in r && (q = r.hidden) : r = m._data(a, "fxshow", {}), f && (r.hidden = !q), q ? m(a).show() : n.done(function () {
                m(a).hide()
            }), n.done(function () {
                var b;
                m._removeData(a, "fxshow");
                for (b in o) m.style(a, b, o[b])
            });
            for (d in o) g = hb(q ? r[d] : 0, d, n), d in r || (r[d] = g.start, q && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0))
        }
    }

    function jb(a, b) {
        var c, d, e, f, g;
        for (c in a)
            if (d = m.camelCase(c), e = b[d], f = a[c], m.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = m.cssHooks[d], g && "expand" in g) {
                f = g.expand(f), delete a[d];
                for (c in f) c in a || (a[c] = f[c], b[c] = e)
            } else b[d] = e
    }

    function kb(a, b, c) {
        var d, e, f = 0,
            g = db.length,
            h = m.Deferred().always(function () {
                delete i.elem
            }),
            i = function () {
                if (e) return !1;
                for (var b = $a || fb(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++) j.tweens[g].run(f);
                return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
            },
            j = h.promise({
                elem: a,
                props: m.extend({}, b),
                opts: m.extend(!0, {
                    specialEasing: {}
                }, c),
                originalProperties: b,
                originalOptions: c,
                startTime: $a || fb(),
                duration: c.duration,
                tweens: [],
                createTween: function (b, c) {
                    var d = m.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                    return j.tweens.push(d), d
                },
                stop: function (b) {
                    var c = 0,
                        d = b ? j.tweens.length : 0;
                    if (e) return this;
                    for (e = !0; d > c; c++) j.tweens[c].run(1);
                    return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this
                }
            }),
            k = j.props;
        for (jb(k, j.opts.specialEasing); g > f; f++)
            if (d = db[f].call(j, a, k, j.opts)) return d;
        return m.map(k, hb, j), m.isFunction(j.opts.start) && j.opts.start.call(a, j), m.fx.timer(m.extend(i, {
            elem: a,
            anim: j,
            queue: j.opts.queue
        })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
    }
    m.Animation = m.extend(kb, {
            tweener: function (a, b) {
                m.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
                for (var c, d = 0, e = a.length; e > d; d++) c = a[d], eb[c] = eb[c] || [], eb[c].unshift(b)
            },
            prefilter: function (a, b) {
                b ? db.unshift(a) : db.push(a)
            }
        }), m.speed = function (a, b, c) {
            var d = a && "object" == typeof a ? m.extend({}, a) : {
                complete: c || !c && b || m.isFunction(a) && a,
                duration: a,
                easing: c && b || b && !m.isFunction(b) && b
            };
            return d.duration = m.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in m.fx.speeds ? m.fx.speeds[d.duration] : m.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function () {
                m.isFunction(d.old) && d.old.call(this), d.queue && m.dequeue(this, d.queue)
            }, d
        }, m.fn.extend({
            fadeTo: function (a, b, c, d) {
                return this.filter(U).css("opacity", 0).show().end().animate({
                    opacity: b
                }, a, c, d)
            },
            animate: function (a, b, c, d) {
                var e = m.isEmptyObject(a),
                    f = m.speed(b, c, d),
                    g = function () {
                        var b = kb(this, m.extend({}, a), f);
                        (e || m._data(this, "finish")) && b.stop(!0)
                    };
                return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
            },
            stop: function (a, b, c) {
                var d = function (a) {
                    var b = a.stop;
                    delete a.stop, b(c)
                };
                return "string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function () {
                    var b = !0,
                        e = null != a && a + "queueHooks",
                        f = m.timers,
                        g = m._data(this);
                    if (e) g[e] && g[e].stop && d(g[e]);
                    else
                        for (e in g) g[e] && g[e].stop && cb.test(e) && d(g[e]);
                    for (e = f.length; e--;) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
                    (b || !c) && m.dequeue(this, a)
                })
            },
            finish: function (a) {
                return a !== !1 && (a = a || "fx"), this.each(function () {
                    var b, c = m._data(this),
                        d = c[a + "queue"],
                        e = c[a + "queueHooks"],
                        f = m.timers,
                        g = d ? d.length : 0;
                    for (c.finish = !0, m.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;) f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
                    for (b = 0; g > b; b++) d[b] && d[b].finish && d[b].finish.call(this);
                    delete c.finish
                })
            }
        }), m.each(["toggle", "show", "hide"], function (a, b) {
            var c = m.fn[b];
            m.fn[b] = function (a, d, e) {
                return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(gb(b, !0), a, d, e)
            }
        }), m.each({
            slideDown: gb("show"),
            slideUp: gb("hide"),
            slideToggle: gb("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function (a, b) {
            m.fn[a] = function (a, c, d) {
                return this.animate(b, a, c, d)
            }
        }), m.timers = [], m.fx.tick = function () {
            var a, b = m.timers,
                c = 0;
            for ($a = m.now(); c < b.length; c++) a = b[c], a() || b[c] !== a || b.splice(c--, 1);
            b.length || m.fx.stop(), $a = void 0
        }, m.fx.timer = function (a) {
            m.timers.push(a), a() ? m.fx.start() : m.timers.pop()
        }, m.fx.interval = 13, m.fx.start = function () {
            _a || (_a = setInterval(m.fx.tick, m.fx.interval))
        }, m.fx.stop = function () {
            clearInterval(_a), _a = null
        }, m.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        }, m.fn.delay = function (a, b) {
            return a = m.fx ? m.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function (b, c) {
                var d = setTimeout(b, a);
                c.stop = function () {
                    clearTimeout(d)
                }
            })
        },
        function () {
            var a, b, c, d, e;
            b = y.createElement("div"), b.setAttribute("className", "t"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", d = b.getElementsByTagName("a")[0], c = y.createElement("select"), e = c.appendChild(y.createElement("option")), a = b.getElementsByTagName("input")[0], d.style.cssText = "top:1px", k.getSetAttribute = "t" !== b.className, k.style = /top/.test(d.getAttribute("style")), k.hrefNormalized = "/a" === d.getAttribute("href"), k.checkOn = !!a.value, k.optSelected = e.selected, k.enctype = !!y.createElement("form").enctype, c.disabled = !0, k.optDisabled = !e.disabled, a = y.createElement("input"), a.setAttribute("value", ""), k.input = "" === a.getAttribute("value"), a.value = "t", a.setAttribute("type", "radio"), k.radioValue = "t" === a.value
        }();
    var lb = /\r/g;
    m.fn.extend({
        val: function (a) {
            var b, c, d, e = this[0]; {
                if (arguments.length) return d = m.isFunction(a), this.each(function (c) {
                    var e;
                    1 === this.nodeType && (e = d ? a.call(this, c, m(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : m.isArray(e) && (e = m.map(e, function (a) {
                        return null == a ? "" : a + ""
                    })), b = m.valHooks[this.type] || m.valHooks[this.nodeName.toLowerCase()], b && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e))
                });
                if (e) return b = m.valHooks[e.type] || m.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(lb, "") : null == c ? "" : c)
            }
        }
    }), m.extend({
        valHooks: {
            option: {
                get: function (a) {
                    var b = m.find.attr(a, "value");
                    return null != b ? b : m.trim(m.text(a))
                }
            },
            select: {
                get: function (a) {
                    for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)
                        if (c = d[i], !(!c.selected && i !== e || (k.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && m.nodeName(c.parentNode, "optgroup"))) {
                            if (b = m(c).val(), f) return b;
                            g.push(b)
                        } return g
                },
                set: function (a, b) {
                    var c, d, e = a.options,
                        f = m.makeArray(b),
                        g = e.length;
                    while (g--)
                        if (d = e[g], m.inArray(m.valHooks.option.get(d), f) >= 0) try {
                            d.selected = c = !0
                        } catch (h) {
                            d.scrollHeight
                        } else d.selected = !1;
                    return c || (a.selectedIndex = -1), e
                }
            }
        }
    }), m.each(["radio", "checkbox"], function () {
        m.valHooks[this] = {
            set: function (a, b) {
                return m.isArray(b) ? a.checked = m.inArray(m(a).val(), b) >= 0 : void 0
            }
        }, k.checkOn || (m.valHooks[this].get = function (a) {
            return null === a.getAttribute("value") ? "on" : a.value
        })
    });
    var mb, nb, ob = m.expr.attrHandle,
        pb = /^(?:checked|selected)$/i,
        qb = k.getSetAttribute,
        rb = k.input;
    m.fn.extend({
        attr: function (a, b) {
            return V(this, m.attr, a, b, arguments.length > 1)
        },
        removeAttr: function (a) {
            return this.each(function () {
                m.removeAttr(this, a)
            })
        }
    }), m.extend({
        attr: function (a, b, c) {
            var d, e, f = a.nodeType;
            if (a && 3 !== f && 8 !== f && 2 !== f) return typeof a.getAttribute === K ? m.prop(a, b, c) : (1 === f && m.isXMLDoc(a) || (b = b.toLowerCase(), d = m.attrHooks[b] || (m.expr.match.bool.test(b) ? nb : mb)), void 0 === c ? d && "get" in d && null !== (e = d.get(a, b)) ? e : (e = m.find.attr(a, b), null == e ? void 0 : e) : null !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), c) : void m.removeAttr(a, b))
        },
        removeAttr: function (a, b) {
            var c, d, e = 0,
                f = b && b.match(E);
            if (f && 1 === a.nodeType)
                while (c = f[e++]) d = m.propFix[c] || c, m.expr.match.bool.test(c) ? rb && qb || !pb.test(c) ? a[d] = !1 : a[m.camelCase("default-" + c)] = a[d] = !1 : m.attr(a, c, ""), a.removeAttribute(qb ? c : d)
        },
        attrHooks: {
            type: {
                set: function (a, b) {
                    if (!k.radioValue && "radio" === b && m.nodeName(a, "input")) {
                        var c = a.value;
                        return a.setAttribute("type", b), c && (a.value = c), b
                    }
                }
            }
        }
    }), nb = {
        set: function (a, b, c) {
            return b === !1 ? m.removeAttr(a, c) : rb && qb || !pb.test(c) ? a.setAttribute(!qb && m.propFix[c] || c, c) : a[m.camelCase("default-" + c)] = a[c] = !0, c
        }
    }, m.each(m.expr.match.bool.source.match(/\w+/g), function (a, b) {
        var c = ob[b] || m.find.attr;
        ob[b] = rb && qb || !pb.test(b) ? function (a, b, d) {
            var e, f;
            return d || (f = ob[b], ob[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, ob[b] = f), e
        } : function (a, b, c) {
            return c ? void 0 : a[m.camelCase("default-" + b)] ? b.toLowerCase() : null
        }
    }), rb && qb || (m.attrHooks.value = {
        set: function (a, b, c) {
            return m.nodeName(a, "input") ? void(a.defaultValue = b) : mb && mb.set(a, b, c)
        }
    }), qb || (mb = {
        set: function (a, b, c) {
            var d = a.getAttributeNode(c);
            return d || a.setAttributeNode(d = a.ownerDocument.createAttribute(c)), d.value = b += "", "value" === c || b === a.getAttribute(c) ? b : void 0
        }
    }, ob.id = ob.name = ob.coords = function (a, b, c) {
        var d;
        return c ? void 0 : (d = a.getAttributeNode(b)) && "" !== d.value ? d.value : null
    }, m.valHooks.button = {
        get: function (a, b) {
            var c = a.getAttributeNode(b);
            return c && c.specified ? c.value : void 0
        },
        set: mb.set
    }, m.attrHooks.contenteditable = {
        set: function (a, b, c) {
            mb.set(a, "" === b ? !1 : b, c)
        }
    }, m.each(["width", "height"], function (a, b) {
        m.attrHooks[b] = {
            set: function (a, c) {
                return "" === c ? (a.setAttribute(b, "auto"), c) : void 0
            }
        }
    })), k.style || (m.attrHooks.style = {
        get: function (a) {
            return a.style.cssText || void 0
        },
        set: function (a, b) {
            return a.style.cssText = b + ""
        }
    });
    var sb = /^(?:input|select|textarea|button|object)$/i,
        tb = /^(?:a|area)$/i;
    m.fn.extend({
        prop: function (a, b) {
            return V(this, m.prop, a, b, arguments.length > 1)
        },
        removeProp: function (a) {
            return a = m.propFix[a] || a, this.each(function () {
                try {
                    this[a] = void 0, delete this[a]
                } catch (b) {}
            })
        }
    }), m.extend({
        propFix: {
            "for": "htmlFor",
            "class": "className"
        },
        prop: function (a, b, c) {
            var d, e, f, g = a.nodeType;
            if (a && 3 !== g && 8 !== g && 2 !== g) return f = 1 !== g || !m.isXMLDoc(a), f && (b = m.propFix[b] || b, e = m.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b]
        },
        propHooks: {
            tabIndex: {
                get: function (a) {
                    var b = m.find.attr(a, "tabindex");
                    return b ? parseInt(b, 10) : sb.test(a.nodeName) || tb.test(a.nodeName) && a.href ? 0 : -1
                }
            }
        }
    }), k.hrefNormalized || m.each(["href", "src"], function (a, b) {
        m.propHooks[b] = {
            get: function (a) {
                return a.getAttribute(b, 4)
            }
        }
    }), k.optSelected || (m.propHooks.selected = {
        get: function (a) {
            var b = a.parentNode;
            return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex), null
        }
    }), m.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        m.propFix[this.toLowerCase()] = this
    }), k.enctype || (m.propFix.enctype = "encoding");
    var ub = /[\t\r\n\f]/g;
    m.fn.extend({
        addClass: function (a) {
            var b, c, d, e, f, g, h = 0,
                i = this.length,
                j = "string" == typeof a && a;
            if (m.isFunction(a)) return this.each(function (b) {
                m(this).addClass(a.call(this, b, this.className))
            });
            if (j)
                for (b = (a || "").match(E) || []; i > h; h++)
                    if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(ub, " ") : " ")) {
                        f = 0;
                        while (e = b[f++]) d.indexOf(" " + e + " ") < 0 && (d += e + " ");
                        g = m.trim(d), c.className !== g && (c.className = g)
                    } return this
        },
        removeClass: function (a) {
            var b, c, d, e, f, g, h = 0,
                i = this.length,
                j = 0 === arguments.length || "string" == typeof a && a;
            if (m.isFunction(a)) return this.each(function (b) {
                m(this).removeClass(a.call(this, b, this.className))
            });
            if (j)
                for (b = (a || "").match(E) || []; i > h; h++)
                    if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(ub, " ") : "")) {
                        f = 0;
                        while (e = b[f++])
                            while (d.indexOf(" " + e + " ") >= 0) d = d.replace(" " + e + " ", " ");
                        g = a ? m.trim(d) : "", c.className !== g && (c.className = g)
                    } return this
        },
        toggleClass: function (a, b) {
            var c = typeof a;
            return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : this.each(m.isFunction(a) ? function (c) {
                m(this).toggleClass(a.call(this, c, this.className, b), b)
            } : function () {
                if ("string" === c) {
                    var b, d = 0,
                        e = m(this),
                        f = a.match(E) || [];
                    while (b = f[d++]) e.hasClass(b) ? e.removeClass(b) : e.addClass(b)
                } else(c === K || "boolean" === c) && (this.className && m._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : m._data(this, "__className__") || "")
            })
        },
        hasClass: function (a) {
            for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++)
                if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(ub, " ").indexOf(b) >= 0) return !0;
            return !1
        }
    }), m.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) {
        m.fn[b] = function (a, c) {
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
        }
    }), m.fn.extend({
        hover: function (a, b) {
            return this.mouseenter(a).mouseleave(b || a)
        },
        bind: function (a, b, c) {
            return this.on(a, null, b, c)
        },
        unbind: function (a, b) {
            return this.off(a, null, b)
        },
        delegate: function (a, b, c, d) {
            return this.on(b, a, c, d)
        },
        undelegate: function (a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
        }
    });
    var vb = m.now(),
        wb = /\?/,
        xb = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
    m.parseJSON = function (b) {
        if (a.JSON && a.JSON.parse) return a.JSON.parse(b + "");
        var c, d = null,
            e = m.trim(b + "");
        return e && !m.trim(e.replace(xb, function (a, b, e, f) {
            return c && b && (d = 0), 0 === d ? a : (c = e || b, d += !f - !e, "")
        })) ? Function("return " + e)() : m.error("Invalid JSON: " + b)
    }, m.parseXML = function (b) {
        var c, d;
        if (!b || "string" != typeof b) return null;
        try {
            a.DOMParser ? (d = new DOMParser, c = d.parseFromString(b, "text/xml")) : (c = new ActiveXObject("Microsoft.XMLDOM"), c.async = "false", c.loadXML(b))
        } catch (e) {
            c = void 0
        }
        return c && c.documentElement && !c.getElementsByTagName("parsererror").length || m.error("Invalid XML: " + b), c
    };
    var yb, zb, Ab = /#.*$/,
        Bb = /([?&])_=[^&]*/,
        Cb = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Db = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        Eb = /^(?:GET|HEAD)$/,
        Fb = /^\/\//,
        Gb = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
        Hb = {},
        Ib = {},
        Jb = "*/".concat("*");
    try {
        zb = location.href
    } catch (Kb) {
        zb = y.createElement("a"), zb.href = "", zb = zb.href
    }
    yb = Gb.exec(zb.toLowerCase()) || [];

    function Lb(a) {
        return function (b, c) {
            "string" != typeof b && (c = b, b = "*");
            var d, e = 0,
                f = b.toLowerCase().match(E) || [];
            if (m.isFunction(c))
                while (d = f[e++]) "+" === d.charAt(0) ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
        }
    }

    function Mb(a, b, c, d) {
        var e = {},
            f = a === Ib;

        function g(h) {
            var i;
            return e[h] = !0, m.each(a[h] || [], function (a, h) {
                var j = h(b, c, d);
                return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1)
            }), i
        }
        return g(b.dataTypes[0]) || !e["*"] && g("*")
    }

    function Nb(a, b) {
        var c, d, e = m.ajaxSettings.flatOptions || {};
        for (d in b) void 0 !== b[d] && ((e[d] ? a : c || (c = {}))[d] = b[d]);
        return c && m.extend(!0, a, c), a
    }

    function Ob(a, b, c) {
        var d, e, f, g, h = a.contents,
            i = a.dataTypes;
        while ("*" === i[0]) i.shift(), void 0 === e && (e = a.mimeType || b.getResponseHeader("Content-Type"));
        if (e)
            for (g in h)
                if (h[g] && h[g].test(e)) {
                    i.unshift(g);
                    break
                } if (i[0] in c) f = i[0];
        else {
            for (g in c) {
                if (!i[0] || a.converters[g + " " + i[0]]) {
                    f = g;
                    break
                }
                d || (d = g)
            }
            f = f || d
        }
        return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
    }

    function Pb(a, b, c, d) {
        var e, f, g, h, i, j = {},
            k = a.dataTypes.slice();
        if (k[1])
            for (g in a.converters) j[g.toLowerCase()] = a.converters[g];
        f = k.shift();
        while (f)
            if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())
                if ("*" === f) f = i;
                else if ("*" !== i && i !== f) {
            if (g = j[i + " " + f] || j["* " + f], !g)
                for (e in j)
                    if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                        g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
                        break
                    } if (g !== !0)
                if (g && a["throws"]) b = g(b);
                else try {
                    b = g(b)
                } catch (l) {
                    return {
                        state: "parsererror",
                        error: g ? l : "No conversion from " + i + " to " + f
                    }
                }
        }
        return {
            state: "success",
            data: b
        }
    }
    m.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: zb,
            type: "GET",
            isLocal: Db.test(yb[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Jb,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": m.parseJSON,
                "text xml": m.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function (a, b) {
            return b ? Nb(Nb(a, m.ajaxSettings), b) : Nb(m.ajaxSettings, a)
        },
        ajaxPrefilter: Lb(Hb),
        ajaxTransport: Lb(Ib),
        ajax: function (a, b) {
            "object" == typeof a && (b = a, a = void 0), b = b || {};
            var c, d, e, f, g, h, i, j, k = m.ajaxSetup({}, b),
                l = k.context || k,
                n = k.context && (l.nodeType || l.jquery) ? m(l) : m.event,
                o = m.Deferred(),
                p = m.Callbacks("once memory"),
                q = k.statusCode || {},
                r = {},
                s = {},
                t = 0,
                u = "canceled",
                v = {
                    readyState: 0,
                    getResponseHeader: function (a) {
                        var b;
                        if (2 === t) {
                            if (!j) {
                                j = {};
                                while (b = Cb.exec(f)) j[b[1].toLowerCase()] = b[2]
                            }
                            b = j[a.toLowerCase()]
                        }
                        return null == b ? null : b
                    },
                    getAllResponseHeaders: function () {
                        return 2 === t ? f : null
                    },
                    setRequestHeader: function (a, b) {
                        var c = a.toLowerCase();
                        return t || (a = s[c] = s[c] || a, r[a] = b), this
                    },
                    overrideMimeType: function (a) {
                        return t || (k.mimeType = a), this
                    },
                    statusCode: function (a) {
                        var b;
                        if (a)
                            if (2 > t)
                                for (b in a) q[b] = [q[b], a[b]];
                            else v.always(a[v.status]);
                        return this
                    },
                    abort: function (a) {
                        var b = a || u;
                        return i && i.abort(b), x(0, b), this
                    }
                };
            if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, k.url = ((a || k.url || zb) + "").replace(Ab, "").replace(Fb, yb[1] + "//"), k.type = b.method || b.type || k.method || k.type, k.dataTypes = m.trim(k.dataType || "*").toLowerCase().match(E) || [""], null == k.crossDomain && (c = Gb.exec(k.url.toLowerCase()), k.crossDomain = !(!c || c[1] === yb[1] && c[2] === yb[2] && (c[3] || ("http:" === c[1] ? "80" : "443")) === (yb[3] || ("http:" === yb[1] ? "80" : "443")))), k.data && k.processData && "string" != typeof k.data && (k.data = m.param(k.data, k.traditional)), Mb(Hb, k, b, v), 2 === t) return v;
            h = m.event && k.global, h && 0 === m.active++ && m.event.trigger("ajaxStart"), k.type = k.type.toUpperCase(), k.hasContent = !Eb.test(k.type), e = k.url, k.hasContent || (k.data && (e = k.url += (wb.test(e) ? "&" : "?") + k.data, delete k.data), k.cache === !1 && (k.url = Bb.test(e) ? e.replace(Bb, "$1_=" + vb++) : e + (wb.test(e) ? "&" : "?") + "_=" + vb++)), k.ifModified && (m.lastModified[e] && v.setRequestHeader("If-Modified-Since", m.lastModified[e]), m.etag[e] && v.setRequestHeader("If-None-Match", m.etag[e])), (k.data && k.hasContent && k.contentType !== !1 || b.contentType) && v.setRequestHeader("Content-Type", k.contentType), v.setRequestHeader("Accept", k.dataTypes[0] && k.accepts[k.dataTypes[0]] ? k.accepts[k.dataTypes[0]] + ("*" !== k.dataTypes[0] ? ", " + Jb + "; q=0.01" : "") : k.accepts["*"]);
            for (d in k.headers) v.setRequestHeader(d, k.headers[d]);
            if (k.beforeSend && (k.beforeSend.call(l, v, k) === !1 || 2 === t)) return v.abort();
            u = "abort";
            for (d in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) v[d](k[d]);
            if (i = Mb(Ib, k, b, v)) {
                v.readyState = 1, h && n.trigger("ajaxSend", [v, k]), k.async && k.timeout > 0 && (g = setTimeout(function () {
                    v.abort("timeout")
                }, k.timeout));
                try {
                    t = 1, i.send(r, x)
                } catch (w) {
                    if (!(2 > t)) throw w;
                    x(-1, w)
                }
            } else x(-1, "No Transport");

            function x(a, b, c, d) {
                var j, r, s, u, w, x = b;
                2 !== t && (t = 2, g && clearTimeout(g), i = void 0, f = d || "", v.readyState = a > 0 ? 4 : 0, j = a >= 200 && 300 > a || 304 === a, c && (u = Ob(k, v, c)), u = Pb(k, u, v, j), j ? (k.ifModified && (w = v.getResponseHeader("Last-Modified"), w && (m.lastModified[e] = w), w = v.getResponseHeader("etag"), w && (m.etag[e] = w)), 204 === a || "HEAD" === k.type ? x = "nocontent" : 304 === a ? x = "notmodified" : (x = u.state, r = u.data, s = u.error, j = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [r, x, v]) : o.rejectWith(l, [v, x, s]), v.statusCode(q), q = void 0, h && n.trigger(j ? "ajaxSuccess" : "ajaxError", [v, k, j ? r : s]), p.fireWith(l, [v, x]), h && (n.trigger("ajaxComplete", [v, k]), --m.active || m.event.trigger("ajaxStop")))
            }
            return v
        },
        getJSON: function (a, b, c) {
            return m.get(a, b, c, "json")
        },
        getScript: function (a, b) {
            return m.get(a, void 0, b, "script")
        }
    }), m.each(["get", "post"], function (a, b) {
        m[b] = function (a, c, d, e) {
            return m.isFunction(c) && (e = e || d, d = c, c = void 0), m.ajax({
                url: a,
                type: b,
                dataType: e,
                data: c,
                success: d
            })
        }
    }), m._evalUrl = function (a) {
        return m.ajax({
            url: a,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            "throws": !0
        })
    }, m.fn.extend({
        wrapAll: function (a) {
            if (m.isFunction(a)) return this.each(function (b) {
                m(this).wrapAll(a.call(this, b))
            });
            if (this[0]) {
                var b = m(a, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && b.insertBefore(this[0]), b.map(function () {
                    var a = this;
                    while (a.firstChild && 1 === a.firstChild.nodeType) a = a.firstChild;
                    return a
                }).append(this)
            }
            return this
        },
        wrapInner: function (a) {
            return this.each(m.isFunction(a) ? function (b) {
                m(this).wrapInner(a.call(this, b))
            } : function () {
                var b = m(this),
                    c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a)
            })
        },
        wrap: function (a) {
            var b = m.isFunction(a);
            return this.each(function (c) {
                m(this).wrapAll(b ? a.call(this, c) : a)
            })
        },
        unwrap: function () {
            return this.parent().each(function () {
                m.nodeName(this, "body") || m(this).replaceWith(this.childNodes)
            }).end()
        }
    }), m.expr.filters.hidden = function (a) {
        return a.offsetWidth <= 0 && a.offsetHeight <= 0 || !k.reliableHiddenOffsets() && "none" === (a.style && a.style.display || m.css(a, "display"))
    }, m.expr.filters.visible = function (a) {
        return !m.expr.filters.hidden(a)
    };
    var Qb = /%20/g,
        Rb = /\[\]$/,
        Sb = /\r?\n/g,
        Tb = /^(?:submit|button|image|reset|file)$/i,
        Ub = /^(?:input|select|textarea|keygen)/i;

    function Vb(a, b, c, d) {
        var e;
        if (m.isArray(b)) m.each(b, function (b, e) {
            c || Rb.test(a) ? d(a, e) : Vb(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d)
        });
        else if (c || "object" !== m.type(b)) d(a, b);
        else
            for (e in b) Vb(a + "[" + e + "]", b[e], c, d)
    }
    m.param = function (a, b) {
        var c, d = [],
            e = function (a, b) {
                b = m.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
            };
        if (void 0 === b && (b = m.ajaxSettings && m.ajaxSettings.traditional), m.isArray(a) || a.jquery && !m.isPlainObject(a)) m.each(a, function () {
            e(this.name, this.value)
        });
        else
            for (c in a) Vb(c, a[c], b, e);
        return d.join("&").replace(Qb, "+")
    }, m.fn.extend({
        serialize: function () {
            return m.param(this.serializeArray())
        },
        serializeArray: function () {
            return this.map(function () {
                var a = m.prop(this, "elements");
                return a ? m.makeArray(a) : this
            }).filter(function () {
                var a = this.type;
                return this.name && !m(this).is(":disabled") && Ub.test(this.nodeName) && !Tb.test(a) && (this.checked || !W.test(a))
            }).map(function (a, b) {
                var c = m(this).val();
                return null == c ? null : m.isArray(c) ? m.map(c, function (a) {
                    return {
                        name: b.name,
                        value: a.replace(Sb, "\r\n")
                    }
                }) : {
                    name: b.name,
                    value: c.replace(Sb, "\r\n")
                }
            }).get()
        }
    }), m.ajaxSettings.xhr = void 0 !== a.ActiveXObject ? function () {
        return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && Zb() || $b()
    } : Zb;
    var Wb = 0,
        Xb = {},
        Yb = m.ajaxSettings.xhr();
    a.attachEvent && a.attachEvent("onunload", function () {
        for (var a in Xb) Xb[a](void 0, !0)
    }), k.cors = !!Yb && "withCredentials" in Yb, Yb = k.ajax = !!Yb, Yb && m.ajaxTransport(function (a) {
        if (!a.crossDomain || k.cors) {
            var b;
            return {
                send: function (c, d) {
                    var e, f = a.xhr(),
                        g = ++Wb;
                    if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields)
                        for (e in a.xhrFields) f[e] = a.xhrFields[e];
                    a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
                    for (e in c) void 0 !== c[e] && f.setRequestHeader(e, c[e] + "");
                    f.send(a.hasContent && a.data || null), b = function (c, e) {
                        var h, i, j;
                        if (b && (e || 4 === f.readyState))
                            if (delete Xb[g], b = void 0, f.onreadystatechange = m.noop, e) 4 !== f.readyState && f.abort();
                            else {
                                j = {}, h = f.status, "string" == typeof f.responseText && (j.text = f.responseText);
                                try {
                                    i = f.statusText
                                } catch (k) {
                                    i = ""
                                }
                                h || !a.isLocal || a.crossDomain ? 1223 === h && (h = 204) : h = j.text ? 200 : 404
                            } j && d(h, i, j, f.getAllResponseHeaders())
                    }, a.async ? 4 === f.readyState ? setTimeout(b) : f.onreadystatechange = Xb[g] = b : b()
                },
                abort: function () {
                    b && b(void 0, !0)
                }
            }
        }
    });

    function Zb() {
        try {
            return new a.XMLHttpRequest
        } catch (b) {}
    }

    function $b() {
        try {
            return new a.ActiveXObject("Microsoft.XMLHTTP")
        } catch (b) {}
    }
    m.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function (a) {
                return m.globalEval(a), a
            }
        }
    }), m.ajaxPrefilter("script", function (a) {
        void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1)
    }), m.ajaxTransport("script", function (a) {
        if (a.crossDomain) {
            var b, c = y.head || m("head")[0] || y.documentElement;
            return {
                send: function (d, e) {
                    b = y.createElement("script"), b.async = !0, a.scriptCharset && (b.charset = a.scriptCharset), b.src = a.url, b.onload = b.onreadystatechange = function (a, c) {
                        (c || !b.readyState || /loaded|complete/.test(b.readyState)) && (b.onload = b.onreadystatechange = null, b.parentNode && b.parentNode.removeChild(b), b = null, c || e(200, "success"))
                    }, c.insertBefore(b, c.firstChild)
                },
                abort: function () {
                    b && b.onload(void 0, !0)
                }
            }
        }
    });
    var _b = [],
        ac = /(=)\?(?=&|$)|\?\?/;
    m.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function () {
            var a = _b.pop() || m.expando + "_" + vb++;
            return this[a] = !0, a
        }
    }), m.ajaxPrefilter("json jsonp", function (b, c, d) {
        var e, f, g, h = b.jsonp !== !1 && (ac.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && ac.test(b.data) && "data");
        return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = m.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(ac, "$1" + e) : b.jsonp !== !1 && (b.url += (wb.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function () {
            return g || m.error(e + " was not called"), g[0]
        }, b.dataTypes[0] = "json", f = a[e], a[e] = function () {
            g = arguments
        }, d.always(function () {
            a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, _b.push(e)), g && m.isFunction(f) && f(g[0]), g = f = void 0
        }), "script") : void 0
    }), m.parseHTML = function (a, b, c) {
        if (!a || "string" != typeof a) return null;
        "boolean" == typeof b && (c = b, b = !1), b = b || y;
        var d = u.exec(a),
            e = !c && [];
        return d ? [b.createElement(d[1])] : (d = m.buildFragment([a], b, e), e && e.length && m(e).remove(), m.merge([], d.childNodes))
    };
    var bc = m.fn.load;
    m.fn.load = function (a, b, c) {
        if ("string" != typeof a && bc) return bc.apply(this, arguments);
        var d, e, f, g = this,
            h = a.indexOf(" ");
        return h >= 0 && (d = m.trim(a.slice(h, a.length)), a = a.slice(0, h)), m.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (f = "POST"), g.length > 0 && m.ajax({
            url: a,
            type: f,
            dataType: "html",
            data: b
        }).done(function (a) {
            e = arguments, g.html(d ? m("<div>").append(m.parseHTML(a)).find(d) : a)
        }).complete(c && function (a, b) {
            g.each(c, e || [a.responseText, b, a])
        }), this
    }, m.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (a, b) {
        m.fn[b] = function (a) {
            return this.on(b, a)
        }
    }), m.expr.filters.animated = function (a) {
        return m.grep(m.timers, function (b) {
            return a === b.elem
        }).length
    };
    var cc = a.document.documentElement;

    function dc(a) {
        return m.isWindow(a) ? a : 9 === a.nodeType ? a.defaultView || a.parentWindow : !1
    }
    m.offset = {
        setOffset: function (a, b, c) {
            var d, e, f, g, h, i, j, k = m.css(a, "position"),
                l = m(a),
                n = {};
            "static" === k && (a.style.position = "relative"), h = l.offset(), f = m.css(a, "top"), i = m.css(a, "left"), j = ("absolute" === k || "fixed" === k) && m.inArray("auto", [f, i]) > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), m.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (n.top = b.top - h.top + g), null != b.left && (n.left = b.left - h.left + e), "using" in b ? b.using.call(a, n) : l.css(n)
        }
    }, m.fn.extend({
        offset: function (a) {
            if (arguments.length) return void 0 === a ? this : this.each(function (b) {
                m.offset.setOffset(this, a, b)
            });
            var b, c, d = {
                    top: 0,
                    left: 0
                },
                e = this[0],
                f = e && e.ownerDocument;
            if (f) return b = f.documentElement, m.contains(b, e) ? (typeof e.getBoundingClientRect !== K && (d = e.getBoundingClientRect()), c = dc(f), {
                top: d.top + (c.pageYOffset || b.scrollTop) - (b.clientTop || 0),
                left: d.left + (c.pageXOffset || b.scrollLeft) - (b.clientLeft || 0)
            }) : d
        },
        position: function () {
            if (this[0]) {
                var a, b, c = {
                        top: 0,
                        left: 0
                    },
                    d = this[0];
                return "fixed" === m.css(d, "position") ? b = d.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), m.nodeName(a[0], "html") || (c = a.offset()), c.top += m.css(a[0], "borderTopWidth", !0), c.left += m.css(a[0], "borderLeftWidth", !0)), {
                    top: b.top - c.top - m.css(d, "marginTop", !0),
                    left: b.left - c.left - m.css(d, "marginLeft", !0)
                }
            }
        },
        offsetParent: function () {
            return this.map(function () {
                var a = this.offsetParent || cc;
                while (a && !m.nodeName(a, "html") && "static" === m.css(a, "position")) a = a.offsetParent;
                return a || cc
            })
        }
    }), m.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function (a, b) {
        var c = /Y/.test(b);
        m.fn[a] = function (d) {
            return V(this, function (a, d, e) {
                var f = dc(a);
                return void 0 === e ? f ? b in f ? f[b] : f.document.documentElement[d] : a[d] : void(f ? f.scrollTo(c ? m(f).scrollLeft() : e, c ? e : m(f).scrollTop()) : a[d] = e)
            }, a, d, arguments.length, null)
        }
    }), m.each(["top", "left"], function (a, b) {
        m.cssHooks[b] = La(k.pixelPosition, function (a, c) {
            return c ? (c = Ja(a, b), Ha.test(c) ? m(a).position()[b] + "px" : c) : void 0
        })
    }), m.each({
        Height: "height",
        Width: "width"
    }, function (a, b) {
        m.each({
            padding: "inner" + a,
            content: b,
            "": "outer" + a
        }, function (c, d) {
            m.fn[d] = function (d, e) {
                var f = arguments.length && (c || "boolean" != typeof d),
                    g = c || (d === !0 || e === !0 ? "margin" : "border");
                return V(this, function (b, c, d) {
                    var e;
                    return m.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? m.css(b, c, g) : m.style(b, c, d, g)
                }, b, f ? d : void 0, f, null)
            }
        })
    }), m.fn.size = function () {
        return this.length
    }, m.fn.andSelf = m.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function () {
        return m
    });
    var ec = a.jQuery,
        fc = a.$;
    return m.noConflict = function (b) {
        return a.$ === m && (a.$ = fc), b && a.jQuery === m && (a.jQuery = ec), m
    }, typeof b === K && (a.jQuery = a.$ = m), m
});

;
/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery"); + function (a) {
    "use strict";
    var b = a.fn.jquery.split(" ")[0].split(".");
    if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] > 2) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3")
}(jQuery), + function (a) {
    "use strict";

    function b() {
        var a = document.createElement("bootstrap"),
            b = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var c in b)
            if (void 0 !== a.style[c]) return {
                end: b[c]
            };
        return !1
    }
    a.fn.emulateTransitionEnd = function (b) {
        var c = !1,
            d = this;
        a(this).one("bsTransitionEnd", function () {
            c = !0
        });
        var e = function () {
            c || a(d).trigger(a.support.transition.end)
        };
        return setTimeout(e, b), this
    }, a(function () {
        a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
            bindType: a.support.transition.end,
            delegateType: a.support.transition.end,
            handle: function (b) {
                return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0
            }
        })
    })
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var c = a(this),
                e = c.data("bs.alert");
            e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c)
        })
    }
    var c = '[data-dismiss="alert"]',
        d = function (b) {
            a(b).on("click", c, this.close)
        };
    d.VERSION = "3.3.6", d.TRANSITION_DURATION = 150, d.prototype.close = function (b) {
        function c() {
            g.detach().trigger("closed.bs.alert").remove()
        }
        var e = a(this),
            f = e.attr("data-target");
        f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
        var g = a(f);
        b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c())
    };
    var e = a.fn.alert;
    a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
        return a.fn.alert = e, this
    }, a(document).on("click.bs.alert.data-api", c, d.prototype.close)
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.button"),
                f = "object" == typeof b && b;
            e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b)
        })
    }
    var c = function (b, d) {
        this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1
    };
    c.VERSION = "3.3.6", c.DEFAULTS = {
        loadingText: "loading..."
    }, c.prototype.setState = function (b) {
        var c = "disabled",
            d = this.$element,
            e = d.is("input") ? "val" : "html",
            f = d.data();
        b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function () {
            d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c))
        }, this), 0)
    }, c.prototype.toggle = function () {
        var a = !0,
            b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
            var c = this.$element.find("input");
            "radio" == c.prop("type") ? (c.prop("checked") && (a = !1), b.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == c.prop("type") && (c.prop("checked") !== this.$element.hasClass("active") && (a = !1), this.$element.toggleClass("active")), c.prop("checked", this.$element.hasClass("active")), a && c.trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active")
    };
    var d = a.fn.button;
    a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function () {
        return a.fn.button = d, this
    }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (c) {
        var d = a(c.target);
        d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), a(c.target).is('input[type="radio"]') || a(c.target).is('input[type="checkbox"]') || c.preventDefault()
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (b) {
        a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type))
    })
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.carousel"),
                f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b),
                g = "string" == typeof b ? b : f.slide;
            e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle()
        })
    }
    var c = function (b, c) {
        this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this))
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 600, c.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, c.prototype.keydown = function (a) {
        if (!/input|textarea/i.test(a.target.tagName)) {
            switch (a.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            a.preventDefault()
        }
    }, c.prototype.cycle = function (b) {
        return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this
    }, c.prototype.getItemIndex = function (a) {
        return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active)
    }, c.prototype.getItemForDirection = function (a, b) {
        var c = this.getItemIndex(b),
            d = "prev" == a && 0 === c || "next" == a && c == this.$items.length - 1;
        if (d && !this.options.wrap) return b;
        var e = "prev" == a ? -1 : 1,
            f = (c + e) % this.$items.length;
        return this.$items.eq(f)
    }, c.prototype.to = function (a) {
        var b = this,
            c = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        return a > this.$items.length - 1 || 0 > a ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
            b.to(a)
        }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a))
    }, c.prototype.pause = function (b) {
        return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, c.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next")
    }, c.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev")
    }, c.prototype.slide = function (b, d) {
        var e = this.$element.find(".item.active"),
            f = d || this.getItemForDirection(b, e),
            g = this.interval,
            h = "next" == b ? "left" : "right",
            i = this;
        if (f.hasClass("active")) return this.sliding = !1;
        var j = f[0],
            k = a.Event("slide.bs.carousel", {
                relatedTarget: j,
                direction: h
            });
        if (this.$element.trigger(k), !k.isDefaultPrevented()) {
            if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var l = a(this.$indicators.children()[this.getItemIndex(f)]);
                l && l.addClass("active")
            }
            var m = a.Event("slid.bs.carousel", {
                relatedTarget: j,
                direction: h
            });
            return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function () {
                f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), i.sliding = !1, setTimeout(function () {
                    i.$element.trigger(m)
                }, 0)
            }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(m)), g && this.cycle(), this
        }
    };
    var d = a.fn.carousel;
    a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function () {
        return a.fn.carousel = d, this
    };
    var e = function (c) {
        var d, e = a(this),
            f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));
        if (f.hasClass("carousel")) {
            var g = a.extend({}, f.data(), e.data()),
                h = e.attr("data-slide-to");
            h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault()
        }
    };
    a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function () {
        a('[data-ride="carousel"]').each(function () {
            var c = a(this);
            b.call(c, c.data())
        })
    })
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");
        return a(d)
    }

    function c(b) {
        return this.each(function () {
            var c = a(this),
                e = c.data("bs.collapse"),
                f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
            !e && f.toggle && /show|hide/.test(b) && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]()
        })
    }
    var d = function (b, c) {
        this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a('[data-toggle="collapse"][href="#' + b.id + '"],[data-toggle="collapse"][data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    d.VERSION = "3.3.6", d.TRANSITION_DURATION = 350, d.DEFAULTS = {
        toggle: !0
    }, d.prototype.dimension = function () {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height"
    }, d.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var b, e = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
                var f = a.Event("show.bs.collapse");
                if (this.$element.trigger(f), !f.isDefaultPrevented()) {
                    e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
                    var g = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var h = function () {
                        this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!a.support.transition) return h.call(this);
                    var i = a.camelCase(["scroll", g].join("-"));
                    this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])
                }
            }
        }
    }, d.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var b = a.Event("hide.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var e = function () {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this)
            }
        }
    }, d.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, d.prototype.getParent = function () {
        return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function (c, d) {
            var e = a(d);
            this.addAriaAndCollapsedClass(b(e), e)
        }, this)).end()
    }, d.prototype.addAriaAndCollapsedClass = function (a, b) {
        var c = a.hasClass("in");
        a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c)
    };
    var e = a.fn.collapse;
    a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function () {
        return a.fn.collapse = e, this
    }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (d) {
        var e = a(this);
        e.attr("data-target") || d.preventDefault();
        var f = b(e),
            g = f.data("bs.collapse"),
            h = g ? "toggle" : e.data();
        c.call(f, h)
    })
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        var c = b.attr("data-target");
        c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
        var d = c && a(c);
        return d && d.length ? d : b.parent()
    }

    function c(c) {
        c && 3 === c.which || (a(e).remove(), a(f).each(function () {
            var d = a(this),
                e = b(d),
                f = {
                    relatedTarget: this
                };
            e.hasClass("open") && (c && "click" == c.type && /input|textarea/i.test(c.target.tagName) && a.contains(e[0], c.target) || (e.trigger(c = a.Event("hide.bs.dropdown", f)), c.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger(a.Event("hidden.bs.dropdown", f)))))
        }))
    }

    function d(b) {
        return this.each(function () {
            var c = a(this),
                d = c.data("bs.dropdown");
            d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c)
        })
    }
    var e = ".dropdown-backdrop",
        f = '[data-toggle="dropdown"]',
        g = function (b) {
            a(b).on("click.bs.dropdown", this.toggle)
        };
    g.VERSION = "3.3.6", g.prototype.toggle = function (d) {
        var e = a(this);
        if (!e.is(".disabled, :disabled")) {
            var f = b(e),
                g = f.hasClass("open");
            if (c(), !g) {
                "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click", c);
                var h = {
                    relatedTarget: this
                };
                if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;
                e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger(a.Event("shown.bs.dropdown", h))
            }
            return !1
        }
    }, g.prototype.keydown = function (c) {
        if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName)) {
            var d = a(this);
            if (c.preventDefault(), c.stopPropagation(), !d.is(".disabled, :disabled")) {
                var e = b(d),
                    g = e.hasClass("open");
                if (!g && 27 != c.which || g && 27 == c.which) return 27 == c.which && e.find(f).trigger("focus"), d.trigger("click");
                var h = " li:not(.disabled):visible a",
                    i = e.find(".dropdown-menu" + h);
                if (i.length) {
                    var j = i.index(c.target);
                    38 == c.which && j > 0 && j--, 40 == c.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus")
                }
            }
        }
    };
    var h = a.fn.dropdown;
    a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
        return a.fn.dropdown = h, this
    }, a(document).on("click.bs.dropdown.data-api", c).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
        a.stopPropagation()
    }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", g.prototype.keydown)
}(jQuery), + function (a) {
    "use strict";

    function b(b, d) {
        return this.each(function () {
            var e = a(this),
                f = e.data("bs.modal"),
                g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
            f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d)
        })
    }
    var c = function (b, c) {
        this.options = c, this.$body = a(document.body), this.$element = a(b), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, c.prototype.toggle = function (a) {
        return this.isShown ? this.hide() : this.show(a)
    }, c.prototype.show = function (b) {
        var d = this,
            e = a.Event("show.bs.modal", {
                relatedTarget: b
            });
        this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
            d.$element.one("mouseup.dismiss.bs.modal", function (b) {
                a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0)
            })
        }), this.backdrop(function () {
            var e = a.support.transition && d.$element.hasClass("fade");
            d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in"), d.enforceFocus();
            var f = a.Event("shown.bs.modal", {
                relatedTarget: b
            });
            e ? d.$dialog.one("bsTransitionEnd", function () {
                d.$element.trigger("focus").trigger(f)
            }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f)
        }))
    }, c.prototype.hide = function (b) {
        b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal())
    }, c.prototype.enforceFocus = function () {
        a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
            this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus")
        }, this))
    }, c.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function (a) {
            27 == a.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
    }, c.prototype.resize = function () {
        this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal")
    }, c.prototype.hideModal = function () {
        var a = this;
        this.$element.hide(), this.backdrop(function () {
            a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal")
        })
    }, c.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, c.prototype.backdrop = function (b) {
        var d = this,
            e = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var f = a.support.transition && e;
            if (this.$backdrop = a(document.createElement("div")).addClass("modal-backdrop " + e).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", a.proxy(function (a) {
                    return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) : void(a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()))
                }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;
            f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var g = function () {
                d.removeBackdrop(), b && b()
            };
            a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g()
        } else b && b()
    }, c.prototype.handleUpdate = function () {
        this.adjustDialog()
    }, c.prototype.adjustDialog = function () {
        var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : ""
        })
    }, c.prototype.resetAdjustments = function () {
        this.$element.css({
            paddingLeft: "",
            paddingRight: ""
        })
    }, c.prototype.checkScrollbar = function () {
        var a = window.innerWidth;
        if (!a) {
            var b = document.documentElement.getBoundingClientRect();
            a = b.right - Math.abs(b.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < a, this.scrollbarWidth = this.measureScrollbar()
    }, c.prototype.setScrollbar = function () {
        var a = parseInt(this.$body.css("padding-right") || 0, 10);
        this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth)
    }, c.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", this.originalBodyPad)
    }, c.prototype.measureScrollbar = function () {
        var a = document.createElement("div");
        a.className = "modal-scrollbar-measure", this.$body.append(a);
        var b = a.offsetWidth - a.clientWidth;
        return this.$body[0].removeChild(a), b
    };
    var d = a.fn.modal;
    a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function () {
        return a.fn.modal = d, this
    }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
        var d = a(this),
            e = d.attr("href"),
            f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
            g = f.data("bs.modal") ? "toggle" : a.extend({
                remote: !/#/.test(e) && e
            }, f.data(), d.data());
        d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
            a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
                d.is(":visible") && d.trigger("focus")
            })
        }), b.call(f, g, this)
    })
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.tooltip"),
                f = "object" == typeof b && b;
            (e || !/destroy|hide/.test(b)) && (e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }
    var c = function (a, b) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", a, b)
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {
            selector: "body",
            padding: 0
        }
    }, c.prototype.init = function (b, c, d) {
        if (this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(a.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
                click: !1,
                hover: !1,
                focus: !1
            }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
            var g = e[f];
            if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));
            else if ("manual" != g) {
                var h = "hover" == g ? "mouseenter" : "focusin",
                    i = "hover" == g ? "mouseleave" : "focusout";
                this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = a.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, c.prototype.getDefaults = function () {
        return c.DEFAULTS
    }, c.prototype.getOptions = function (b) {
        return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
            show: b.delay,
            hide: b.delay
        }), b
    }, c.prototype.getDelegateOptions = function () {
        var b = {},
            c = this.getDefaults();
        return this._options && a.each(this._options, function (a, d) {
            c[a] != d && (b[a] = d)
        }), b
    }, c.prototype.enter = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusin" == b.type ? "focus" : "hover"] = !0), c.tip().hasClass("in") || "in" == c.hoverState ? void(c.hoverState = "in") : (clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function () {
            "in" == c.hoverState && c.show()
        }, c.options.delay.show)) : c.show())
    }, c.prototype.isInStateTrue = function () {
        for (var a in this.inState)
            if (this.inState[a]) return !0;
        return !1
    }, c.prototype.leave = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusout" == b.type ? "focus" : "hover"] = !1), c.isInStateTrue() ? void 0 : (clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function () {
            "out" == c.hoverState && c.hide()
        }, c.options.delay.hide)) : c.hide())
    }, c.prototype.show = function () {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(b);
            var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (b.isDefaultPrevented() || !d) return;
            var e = this,
                f = this.tip(),
                g = this.getUID(this.type);
            this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");
            var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
                i = /\s?auto?\s?/i,
                j = i.test(h);
            j && (h = h.replace(i, "") || "top"), f.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var k = this.getPosition(),
                l = f[0].offsetWidth,
                m = f[0].offsetHeight;
            if (j) {
                var n = h,
                    o = this.getPosition(this.$viewport);
                h = "bottom" == h && k.bottom + m > o.bottom ? "top" : "top" == h && k.top - m < o.top ? "bottom" : "right" == h && k.right + l > o.width ? "left" : "left" == h && k.left - l < o.left ? "right" : h, f.removeClass(n).addClass(h)
            }
            var p = this.getCalculatedOffset(h, k, l, m);
            this.applyPlacement(p, h);
            var q = function () {
                var a = e.hoverState;
                e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e)
            };
            a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", q).emulateTransitionEnd(c.TRANSITION_DURATION) : q()
        }
    }, c.prototype.applyPlacement = function (b, c) {
        var d = this.tip(),
            e = d[0].offsetWidth,
            f = d[0].offsetHeight,
            g = parseInt(d.css("margin-top"), 10),
            h = parseInt(d.css("margin-left"), 10);
        isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top += g, b.left += h, a.offset.setOffset(d[0], a.extend({
            using: function (a) {
                d.css({
                    top: Math.round(a.top),
                    left: Math.round(a.left)
                })
            }
        }, b), 0), d.addClass("in");
        var i = d[0].offsetWidth,
            j = d[0].offsetHeight;
        "top" == c && j != f && (b.top = b.top + f - j);
        var k = this.getViewportAdjustedDelta(c, b, i, j);
        k.left ? b.left += k.left : b.top += k.top;
        var l = /top|bottom/.test(c),
            m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
            n = l ? "offsetWidth" : "offsetHeight";
        d.offset(b), this.replaceArrow(m, d[0][n], l)
    }, c.prototype.replaceArrow = function (a, b, c) {
        this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "")
    }, c.prototype.setContent = function () {
        var a = this.tip(),
            b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
    }, c.prototype.hide = function (b) {
        function d() {
            "in" != e.hoverState && f.detach(), e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b()
        }
        var e = this,
            f = a(this.$tip),
            g = a.Event("hide.bs." + this.type);
        return this.$element.trigger(g), g.isDefaultPrevented() ? void 0 : (f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this)
    }, c.prototype.fixTitle = function () {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
    }, c.prototype.hasContent = function () {
        return this.getTitle()
    }, c.prototype.getPosition = function (b) {
        b = b || this.$element;
        var c = b[0],
            d = "BODY" == c.tagName,
            e = c.getBoundingClientRect();
        null == e.width && (e = a.extend({}, e, {
            width: e.right - e.left,
            height: e.bottom - e.top
        }));
        var f = d ? {
                top: 0,
                left: 0
            } : b.offset(),
            g = {
                scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop()
            },
            h = d ? {
                width: a(window).width(),
                height: a(window).height()
            } : null;
        return a.extend({}, e, g, h, f)
    }, c.prototype.getCalculatedOffset = function (a, b, c, d) {
        return "bottom" == a ? {
            top: b.top + b.height,
            left: b.left + b.width / 2 - c / 2
        } : "top" == a ? {
            top: b.top - d,
            left: b.left + b.width / 2 - c / 2
        } : "left" == a ? {
            top: b.top + b.height / 2 - d / 2,
            left: b.left - c
        } : {
            top: b.top + b.height / 2 - d / 2,
            left: b.left + b.width
        }
    }, c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
        var e = {
            top: 0,
            left: 0
        };
        if (!this.$viewport) return e;
        var f = this.options.viewport && this.options.viewport.padding || 0,
            g = this.getPosition(this.$viewport);
        if (/right|left/.test(a)) {
            var h = b.top - f - g.scroll,
                i = b.top + f - g.scroll + d;
            h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i)
        } else {
            var j = b.left - f,
                k = b.left + f + c;
            j < g.left ? e.left = g.left - j : k > g.right && (e.left = g.left + g.width - k)
        }
        return e
    }, c.prototype.getTitle = function () {
        var a, b = this.$element,
            c = this.options;
        return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
    }, c.prototype.getUID = function (a) {
        do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
        return a
    }, c.prototype.tip = function () {
        if (!this.$tip && (this.$tip = a(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, c.prototype.enable = function () {
        this.enabled = !0
    }, c.prototype.disable = function () {
        this.enabled = !1
    }, c.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled
    }, c.prototype.toggle = function (b) {
        var c = this;
        b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), b ? (c.inState.click = !c.inState.click, c.isInStateTrue() ? c.enter(c) : c.leave(c)) : c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
    }, c.prototype.destroy = function () {
        var a = this;
        clearTimeout(this.timeout), this.hide(function () {
            a.$element.off("." + a.type).removeData("bs." + a.type), a.$tip && a.$tip.detach(), a.$tip = null, a.$arrow = null, a.$viewport = null
        })
    };
    var d = a.fn.tooltip;
    a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function () {
        return a.fn.tooltip = d, this
    }
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.popover"),
                f = "object" == typeof b && b;
            (e || !/destroy|hide/.test(b)) && (e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }
    var c = function (a, b) {
        this.init("popover", a, b)
    };
    if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
    c.VERSION = "3.3.6", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function () {
        return c.DEFAULTS
    }, c.prototype.setContent = function () {
        var a = this.tip(),
            b = this.getTitle(),
            c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
    }, c.prototype.hasContent = function () {
        return this.getTitle() || this.getContent()
    }, c.prototype.getContent = function () {
        var a = this.$element,
            b = this.options;
        return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    };
    var d = a.fn.popover;
    a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function () {
        return a.fn.popover = d, this
    }
}(jQuery), + function (a) {
    "use strict";

    function b(c, d) {
        this.$body = a(document.body), this.$scrollElement = a(a(c).is(document.body) ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", a.proxy(this.process, this)), this.refresh(), this.process()
    }

    function c(c) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.scrollspy"),
                f = "object" == typeof c && c;
            e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }
    b.VERSION = "3.3.6", b.DEFAULTS = {
        offset: 10
    }, b.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, b.prototype.refresh = function () {
        var b = this,
            c = "offset",
            d = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), a.isWindow(this.$scrollElement[0]) || (c = "position", d = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
            var b = a(this),
                e = b.data("target") || b.attr("href"),
                f = /^#./.test(e) && a(e);
            return f && f.length && f.is(":visible") && [
                [f[c]().top + d, e]
            ] || null
        }).sort(function (a, b) {
            return a[0] - b[0]
        }).each(function () {
            b.offsets.push(this[0]), b.targets.push(this[1])
        })
    }, b.prototype.process = function () {
        var a, b = this.$scrollElement.scrollTop() + this.options.offset,
            c = this.getScrollHeight(),
            d = this.options.offset + c - this.$scrollElement.height(),
            e = this.offsets,
            f = this.targets,
            g = this.activeTarget;
        if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length - 1]) && this.activate(a);
        if (g && b < e[0]) return this.activeTarget = null, this.clear();
        for (a = e.length; a--;) g != f[a] && b >= e[a] && (void 0 === e[a + 1] || b < e[a + 1]) && this.activate(f[a])
    }, b.prototype.activate = function (b) {
        this.activeTarget = b, this.clear();
        var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
            d = a(c).parents("li").addClass("active");
        d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy")
    }, b.prototype.clear = function () {
        a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var d = a.fn.scrollspy;
    a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
        return a.fn.scrollspy = d, this
    }, a(window).on("load.bs.scrollspy.data-api", function () {
        a('[data-spy="scroll"]').each(function () {
            var b = a(this);
            c.call(b, b.data())
        })
    })
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.tab");
            e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]()
        })
    }
    var c = function (b) {
        this.element = a(b)
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 150, c.prototype.show = function () {
        var b = this.element,
            c = b.closest("ul:not(.dropdown-menu)"),
            d = b.data("target");
        if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
            var e = c.find(".active:last a"),
                f = a.Event("hide.bs.tab", {
                    relatedTarget: b[0]
                }),
                g = a.Event("show.bs.tab", {
                    relatedTarget: e[0]
                });
            if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
                var h = a(d);
                this.activate(b.closest("li"), c), this.activate(h, h.parent(), function () {
                    e.trigger({
                        type: "hidden.bs.tab",
                        relatedTarget: b[0]
                    }), b.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: e[0]
                    })
                })
            }
        }
    }, c.prototype.activate = function (b, d, e) {
        function f() {
            g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu").length && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e()
        }
        var g = d.find("> .active"),
            h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find("> .fade").length);
        g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in")
    };
    var d = a.fn.tab;
    a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
        return a.fn.tab = d, this
    };
    var e = function (c) {
        c.preventDefault(), b.call(a(this), "show")
    };
    a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e)
}(jQuery), + function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this),
                e = d.data("bs.affix"),
                f = "object" == typeof b && b;
            e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]()
        })
    }
    var c = function (b, d) {
        this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
    };
    c.VERSION = "3.3.6", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = {
        offset: 0,
        target: window
    }, c.prototype.getState = function (a, b, c, d) {
        var e = this.$target.scrollTop(),
            f = this.$element.offset(),
            g = this.$target.height();
        if (null != c && "top" == this.affixed) return c > e ? "top" : !1;
        if ("bottom" == this.affixed) return null != c ? e + this.unpin <= f.top ? !1 : "bottom" : a - d >= e + g ? !1 : "bottom";
        var h = null == this.affixed,
            i = h ? e : f.top,
            j = h ? g : b;
        return null != c && c >= e ? "top" : null != d && i + j >= a - d ? "bottom" : !1
    }, c.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(c.RESET).addClass("affix");
        var a = this.$target.scrollTop(),
            b = this.$element.offset();
        return this.pinnedOffset = b.top - a
    }, c.prototype.checkPositionWithEventLoop = function () {
        setTimeout(a.proxy(this.checkPosition, this), 1)
    }, c.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var b = this.$element.height(),
                d = this.options.offset,
                e = d.top,
                f = d.bottom,
                g = Math.max(a(document).height(), a(document.body).height());
            "object" != typeof d && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));
            var h = this.getState(g, b, e, f);
            if (this.affixed != h) {
                null != this.unpin && this.$element.css("top", "");
                var i = "affix" + (h ? "-" + h : ""),
                    j = a.Event(i + ".bs.affix");
                if (this.$element.trigger(j), j.isDefaultPrevented()) return;
                this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == h && this.$element.offset({
                top: g - b - f
            })
        }
    };
    var d = a.fn.affix;
    a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function () {
        return a.fn.affix = d, this
    }, a(window).on("load", function () {
        a('[data-spy="affix"]').each(function () {
            var c = a(this),
                d = c.data();
            d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d)
        })
    })
}(jQuery);;
/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }
}(function ($) {
    var pluses = /\+/g;

    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }

    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch (e) {}
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }
    var config = $.cookie = function (key, value, options) {
        if (arguments.length > 1 && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);
            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setMilliseconds(t.getMilliseconds() + days * 864e+5);
            }
            return (document.cookie = [encode(key), '=', stringifyCookieValue(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''));
        }
        var result = key ? undefined : {},
            cookies = document.cookie ? document.cookie.split('; ') : [],
            i = 0,
            l = cookies.length;
        for (; i < l; i++) {
            var parts = cookies[i].split('='),
                name = decode(parts.shift()),
                cookie = parts.join('=');
            if (key === name) {
                result = read(cookie, value);
                break;
            }
            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }
        return result;
    };
    config.defaults = {};
    $.removeCookie = function (key, options) {
        $.cookie(key, '', $.extend({}, options, {
            expires: -1
        }));
        return !$.cookie(key);
    };
}));;
/*!art-template - Template Engine | http://aui.github.com/artTemplate/*/
! function () {
    function a(a) {
        return a.replace(t, "").replace(u, ",").replace(v, "").replace(w, "").replace(x, "").split(y)
    }

    function b(a) {
        return "'" + a.replace(/('|\\)/g, "\\$1").replace(/\r/g, "\\r").replace(/\n/g, "\\n") + "'"
    }

    function c(c, d) {
        function e(a) {
            return m += a.split(/\n/).length - 1, k && (a = a.replace(/\s+/g, " ").replace(/<!--[\w\W]*?-->/g, "")), a && (a = s[1] + b(a) + s[2] + "\n"), a
        }

        function f(b) {
            var c = m;
            if (j ? b = j(b, d) : g && (b = b.replace(/\n/g, function () {
                    return m++, "$line=" + m + ";"
                })), 0 === b.indexOf("=")) {
                var e = l && !/^=[=#]/.test(b);
                if (b = b.replace(/^=[=#]?|[\s;]*$/g, ""), e) {
                    var f = b.replace(/\s*\([^\)]+\)/, "");
                    n[f] || /^(include|print)$/.test(f) || (b = "$escape(" + b + ")")
                } else b = "$string(" + b + ")";
                b = s[1] + b + s[2]
            }
            return g && (b = "$line=" + c + ";" + b), r(a(b), function (a) {
                if (a && !p[a]) {
                    var b;
                    b = "print" === a ? u : "include" === a ? v : n[a] ? "$utils." + a : o[a] ? "$helpers." + a : "$data." + a, w += a + "=" + b + ",", p[a] = !0
                }
            }), b + "\n"
        }
        var g = d.debug,
            h = d.openTag,
            i = d.closeTag,
            j = d.parser,
            k = d.compress,
            l = d.escape,
            m = 1,
            p = {
                $data: 1,
                $filename: 1,
                $utils: 1,
                $helpers: 1,
                $out: 1,
                $line: 1
            },
            q = "".trim,
            s = q ? ["$out='';", "$out+=", ";", "$out"] : ["$out=[];", "$out.push(", ");", "$out.join('')"],
            t = q ? "$out+=text;return $out;" : "$out.push(text);",
            u = "function(){var text=''.concat.apply('',arguments);" + t + "}",
            v = "function(filename,data){data=data||$data;var text=$utils.$include(filename,data,$filename);" + t + "}",
            w = "'use strict';var $utils=this,$helpers=$utils.$helpers," + (g ? "$line=0," : ""),
            x = s[0],
            y = "return new String(" + s[3] + ");";
        r(c.split(h), function (a) {
            a = a.split(i);
            var b = a[0],
                c = a[1];
            1 === a.length ? x += e(b) : (x += f(b), c && (x += e(c)))
        });
        var z = w + x + y;
        g && (z = "try{" + z + "}catch(e){throw {filename:$filename,name:'Render Error',message:e.message,line:$line,source:" + b(c) + ".split(/\\n/)[$line-1].replace(/^\\s+/,'')};}");
        try {
            var A = new Function("$data", "$filename", z);
            return A.prototype = n, A
        } catch (B) {
            throw B.temp = "function anonymous($data,$filename) {" + z + "}", B
        }
    }
    var d = function (a, b) {
        return "string" == typeof b ? q(b, {
            filename: a
        }) : g(a, b)
    };
    d.version = "3.0.0", d.config = function (a, b) {
        e[a] = b
    };
    var e = d.defaults = {
            openTag: "<%",
            closeTag: "%>",
            escape: !0,
            cache: !0,
            compress: !1,
            parser: null
        },
        f = d.cache = {};
    d.render = function (a, b) {
        return q(a, b)
    };
    var g = d.renderFile = function (a, b) {
        var c = d.get(a) || p({
            filename: a,
            name: "Render Error",
            message: "Template not found"
        });
        return b ? c(b) : c
    };
    d.get = function (a) {
        var b;
        if (f[a]) b = f[a];
        else if ("object" == typeof document) {
            var c = document.getElementById(a);
            if (c) {
                var d = (c.value || c.innerHTML).replace(/^\s*|\s*$/g, "");
                b = q(d, {
                    filename: a
                })
            }
        }
        return b
    };
    var h = function (a, b) {
            return "string" != typeof a && (b = typeof a, "number" === b ? a += "" : a = "function" === b ? h(a.call(a)) : ""), a
        },
        i = {
            "<": "&#60;",
            ">": "&#62;",
            '"': "&#34;",
            "'": "&#39;",
            "&": "&#38;"
        },
        j = function (a) {
            return i[a]
        },
        k = function (a) {
            return h(a).replace(/&(?![\w#]+;)|[<>"']/g, j)
        },
        l = Array.isArray || function (a) {
            return "[object Array]" === {}.toString.call(a)
        },
        m = function (a, b) {
            var c, d;
            if (l(a))
                for (c = 0, d = a.length; d > c; c++) b.call(a, a[c], c, a);
            else
                for (c in a) b.call(a, a[c], c)
        },
        n = d.utils = {
            $helpers: {},
            $include: g,
            $string: h,
            $escape: k,
            $each: m
        };
    d.helper = function (a, b) {
        o[a] = b
    };
    var o = d.helpers = n.$helpers;
    d.onerror = function (a) {
        var b = "Template Error\n\n";
        for (var c in a) b += "<" + c + ">\n" + a[c] + "\n\n";
        "object" == typeof console && console.error(b)
    };
    var p = function (a) {
            return d.onerror(a),
                function () {
                    return "{Template Error}"
                }
        },
        q = d.compile = function (a, b) {
            function d(c) {
                try {
                    return new i(c, h) + ""
                } catch (d) {
                    return b.debug ? p(d)() : (b.debug = !0, q(a, b)(c))
                }
            }
            b = b || {};
            for (var g in e) void 0 === b[g] && (b[g] = e[g]);
            var h = b.filename;
            try {
                var i = c(a, b)
            } catch (j) {
                return j.filename = h || "anonymous", j.name = "Syntax Error", p(j)
            }
            return d.prototype = i.prototype, d.toString = function () {
                return i.toString()
            }, h && b.cache && (f[h] = d), d
        },
        r = n.$each,
        s = "break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined",
        t = /\/\*[\w\W]*?\*\/|\/\/[^\n]*\n|\/\/[^\n]*$|"(?:[^"\\]|\\[\w\W])*"|'(?:[^'\\]|\\[\w\W])*'|\s*\.\s*[$\w\.]+/g,
        u = /[^\w$]+/g,
        v = new RegExp(["\\b" + s.replace(/,/g, "\\b|\\b") + "\\b"].join("|"), "g"),
        w = /^\d[^,]*|,\d[^,]*/g,
        x = /^,+|,+$/g,
        y = /^$|,+/;
    e.openTag = "{{", e.closeTag = "}}";
    var z = function (a, b) {
        var c = b.split(":"),
            d = c.shift(),
            e = c.join(":") || "";
        return e && (e = ", " + e), "$helpers." + d + "(" + a + e + ")"
    };
    e.parser = function (a) {
        a = a.replace(/^\s/, "");
        var b = a.split(" "),
            c = b.shift(),
            e = b.join(" ");
        switch (c) {
            case "if":
                a = "if(" + e + "){";
                break;
            case "else":
                b = "if" === b.shift() ? " if(" + b.join(" ") + ")" : "", a = "}else" + b + "{";
                break;
            case "/if":
                a = "}";
                break;
            case "each":
                var f = b[0] || "$data",
                    g = b[1] || "as",
                    h = b[2] || "$value",
                    i = b[3] || "$index",
                    j = h + "," + i;
                "as" !== g && (f = "[]"), a = "$each(" + f + ",function(" + j + "){";
                break;
            case "/each":
                a = "});";
                break;
            case "echo":
                a = "print(" + e + ");";
                break;
            case "print":
            case "include":
                a = c + "(" + b.join(",") + ");";
                break;
            default:
                if (/^\s*\|\s*[\w\$]/.test(e)) {
                    var k = !0;
                    0 === a.indexOf("#") && (a = a.substr(1), k = !1);
                    for (var l = 0, m = a.split("|"), n = m.length, o = m[l++]; n > l; l++) o = z(o, m[l]);
                    a = (k ? "=" : "=#") + o
                } else a = d.helpers[c] ? "=#" + c + "(" + b.join(",") + ");" : "=" + a
        }
        return a
    }, "function" == typeof define ? define(function () {
        return d
    }) : "undefined" != typeof exports ? module.exports = d : this.template = d
}();;
/*!
 * iScroll v4.2.5 ~ Copyright (c) 2012 Matteo Spinelli, http://cubiq.org
 * Released under MIT license, http://cubiq.org/license
 */
(function (window, doc) {
    var m = Math,
        dummyStyle = doc.createElement('div').style,
        vendor = (function () {
            var vendors = 't,webkitT,MozT,msT,OT'.split(','),
                t, i = 0,
                l = vendors.length;
            for (; i < l; i++) {
                t = vendors[i] + 'ransform';
                if (t in dummyStyle) {
                    return vendors[i].substr(0, vendors[i].length - 1);
                }
            }
            return false;
        })(),
        cssVendor = vendor ? '-' + vendor.toLowerCase() + '-' : '',
        transform = prefixStyle('transform'),
        transitionProperty = prefixStyle('transitionProperty'),
        transitionDuration = prefixStyle('transitionDuration'),
        transformOrigin = prefixStyle('transformOrigin'),
        transitionTimingFunction = prefixStyle('transitionTimingFunction'),
        transitionDelay = prefixStyle('transitionDelay'),
        isAndroid = (/android/gi).test(navigator.appVersion),
        isIDevice = (/iphone|ipad/gi).test(navigator.appVersion),
        isTouchPad = (/hp-tablet/gi).test(navigator.appVersion),
        has3d = prefixStyle('perspective') in dummyStyle,
        hasTouch = 'ontouchstart' in window && !isTouchPad,
        hasTransform = vendor !== false,
        hasTransitionEnd = prefixStyle('transition') in dummyStyle,
        RESIZE_EV = 'onorientationchange' in window ? 'orientationchange' : 'resize',
        START_EV = hasTouch ? 'touchstart' : 'mousedown',
        MOVE_EV = hasTouch ? 'touchmove' : 'mousemove',
        END_EV = hasTouch ? 'touchend' : 'mouseup',
        CANCEL_EV = hasTouch ? 'touchcancel' : 'mouseup',
        TRNEND_EV = (function () {
            if (vendor === false) return false;
            var transitionEnd = {
                '': 'transitionend',
                'webkit': 'webkitTransitionEnd',
                'Moz': 'transitionend',
                'O': 'otransitionend',
                'ms': 'MSTransitionEnd'
            };
            return transitionEnd[vendor];
        })(),
        nextFrame = (function () {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
                return setTimeout(callback, 1);
            };
        })(),
        cancelFrame = (function () {
            return window.cancelRequestAnimationFrame || window.webkitCancelAnimationFrame || window.webkitCancelRequestAnimationFrame || window.mozCancelRequestAnimationFrame || window.oCancelRequestAnimationFrame || window.msCancelRequestAnimationFrame || clearTimeout;
        })(),
        translateZ = has3d ? ' translateZ(0)' : '',
        iScroll = function (el, options) {
            var that = this,
                i;
            that.wrapper = typeof el == 'object' ? el : doc.getElementById(el);
            that.wrapper.style.overflow = 'hidden';
            that.scroller = that.wrapper.children[0];
            that.options = {
                hScroll: true,
                vScroll: true,
                x: 0,
                y: 0,
                bounce: true,
                bounceLock: false,
                momentum: true,
                lockDirection: true,
                useTransform: true,
                useTransition: false,
                topOffset: 0,
                checkDOMChanges: false,
                handleClick: true,
                hScrollbar: true,
                vScrollbar: true,
                fixedScrollbar: isAndroid,
                hideScrollbar: isIDevice,
                fadeScrollbar: isIDevice && has3d,
                scrollbarClass: '',
                zoom: false,
                zoomMin: 1,
                zoomMax: 4,
                doubleTapZoom: 2,
                wheelAction: 'scroll',
                snap: false,
                snapThreshold: 1,
                onRefresh: null,
                onBeforeScrollStart: function (e) {
                    e.preventDefault();
                },
                onScrollStart: null,
                onBeforeScrollMove: null,
                onScrollMove: null,
                onBeforeScrollEnd: null,
                onScrollEnd: null,
                onTouchEnd: null,
                onDestroy: null,
                onZoomStart: null,
                onZoom: null,
                onZoomEnd: null
            };
            for (i in options) that.options[i] = options[i];
            that.x = that.options.x;
            that.y = that.options.y;
            that.options.useTransform = hasTransform && that.options.useTransform;
            that.options.hScrollbar = that.options.hScroll && that.options.hScrollbar;
            that.options.vScrollbar = that.options.vScroll && that.options.vScrollbar;
            that.options.zoom = that.options.useTransform && that.options.zoom;
            that.options.useTransition = hasTransitionEnd && that.options.useTransition;
            if (that.options.zoom && isAndroid) {
                translateZ = '';
            }
            that.scroller.style[transitionProperty] = that.options.useTransform ? cssVendor + 'transform' : 'top left';
            that.scroller.style[transitionDuration] = '0';
            that.scroller.style[transformOrigin] = '0 0';
            if (that.options.useTransition) that.scroller.style[transitionTimingFunction] = 'cubic-bezier(0.33,0.66,0.66,1)';
            if (that.options.useTransform) that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px)' + translateZ;
            else that.scroller.style.cssText += ';position:absolute;top:' + that.y + 'px;left:' + that.x + 'px';
            if (that.options.useTransition) that.options.fixedScrollbar = true;
            that.refresh();
            that._bind(RESIZE_EV, window);
            that._bind(START_EV);
            if (!hasTouch) {
                if (that.options.wheelAction != 'none') {
                    that._bind('DOMMouseScroll');
                    that._bind('mousewheel');
                }
            }
            if (that.options.checkDOMChanges) that.checkDOMTime = setInterval(function () {
                that._checkDOMChanges();
            }, 500);
        };
    iScroll.prototype = {
        enabled: true,
        x: 0,
        y: 0,
        steps: [],
        scale: 1,
        currPageX: 0,
        currPageY: 0,
        pagesX: [],
        pagesY: [],
        aniTime: null,
        wheelZoomCount: 0,
        handleEvent: function (e) {
            var that = this;
            switch (e.type) {
                case START_EV:
                    if (!hasTouch && e.button !== 0) return;
                    that._start(e);
                    break;
                case MOVE_EV:
                    that._move(e);
                    break;
                case END_EV:
                case CANCEL_EV:
                    that._end(e);
                    break;
                case RESIZE_EV:
                    that._resize();
                    break;
                case 'DOMMouseScroll':
                case 'mousewheel':
                    that._wheel(e);
                    break;
                case TRNEND_EV:
                    that._transitionEnd(e);
                    break;
            }
        },
        _checkDOMChanges: function () {
            if (this.moved || this.zoomed || this.animating || (this.scrollerW == this.scroller.offsetWidth * this.scale && this.scrollerH == this.scroller.offsetHeight * this.scale)) return;
            this.refresh();
        },
        _scrollbar: function (dir) {
            var that = this,
                bar;
            if (!that[dir + 'Scrollbar']) {
                if (that[dir + 'ScrollbarWrapper']) {
                    if (hasTransform) that[dir + 'ScrollbarIndicator'].style[transform] = '';
                    that[dir + 'ScrollbarWrapper'].parentNode.removeChild(that[dir + 'ScrollbarWrapper']);
                    that[dir + 'ScrollbarWrapper'] = null;
                    that[dir + 'ScrollbarIndicator'] = null;
                }
                return;
            }
            if (!that[dir + 'ScrollbarWrapper']) {
                bar = doc.createElement('div');
                if (that.options.scrollbarClass) bar.className = that.options.scrollbarClass + dir.toUpperCase();
                else bar.style.cssText = 'position:absolute;z-index:100;' + (dir == 'h' ? 'height:7px;bottom:1px;left:2px;right:' + (that.vScrollbar ? '7' : '2') + 'px' : 'width:7px;bottom:' + (that.hScrollbar ? '7' : '2') + 'px;top:2px;right:1px');
                bar.style.cssText += ';pointer-events:none;' + cssVendor + 'transition-property:opacity;' + cssVendor + 'transition-duration:' + (that.options.fadeScrollbar ? '350ms' : '0') + ';overflow:hidden;opacity:' + (that.options.hideScrollbar ? '0' : '1');
                that.wrapper.appendChild(bar);
                that[dir + 'ScrollbarWrapper'] = bar;
                bar = doc.createElement('div');
                if (!that.options.scrollbarClass) {
                    bar.style.cssText = 'position:absolute;z-index:100;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);' + cssVendor + 'background-clip:padding-box;' + cssVendor + 'box-sizing:border-box;' + (dir == 'h' ? 'height:100%' : 'width:100%') + ';' + cssVendor + 'border-radius:3px;border-radius:3px';
                }
                bar.style.cssText += ';pointer-events:none;' + cssVendor + 'transition-property:' + cssVendor + 'transform;' + cssVendor + 'transition-timing-function:cubic-bezier(0.33,0.66,0.66,1);' + cssVendor + 'transition-duration:0;' + cssVendor + 'transform: translate(0,0)' + translateZ;
                if (that.options.useTransition) bar.style.cssText += ';' + cssVendor + 'transition-timing-function:cubic-bezier(0.33,0.66,0.66,1)';
                that[dir + 'ScrollbarWrapper'].appendChild(bar);
                that[dir + 'ScrollbarIndicator'] = bar;
            }
            if (dir == 'h') {
                that.hScrollbarSize = that.hScrollbarWrapper.clientWidth;
                that.hScrollbarIndicatorSize = m.max(m.round(that.hScrollbarSize * that.hScrollbarSize / that.scrollerW), 8);
                that.hScrollbarIndicator.style.width = that.hScrollbarIndicatorSize + 'px';
                that.hScrollbarMaxScroll = that.hScrollbarSize - that.hScrollbarIndicatorSize;
                that.hScrollbarProp = that.hScrollbarMaxScroll / that.maxScrollX;
            } else {
                that.vScrollbarSize = that.vScrollbarWrapper.clientHeight;
                that.vScrollbarIndicatorSize = m.max(m.round(that.vScrollbarSize * that.vScrollbarSize / that.scrollerH), 8);
                that.vScrollbarIndicator.style.height = that.vScrollbarIndicatorSize + 'px';
                that.vScrollbarMaxScroll = that.vScrollbarSize - that.vScrollbarIndicatorSize;
                that.vScrollbarProp = that.vScrollbarMaxScroll / that.maxScrollY;
            }
            that._scrollbarPos(dir, true);
        },
        _resize: function () {
            var that = this;
            setTimeout(function () {
                that.refresh();
            }, isAndroid ? 200 : 0);
        },
        _pos: function (x, y) {
            if (this.zoomed) return;
            x = this.hScroll ? x : 0;
            y = this.vScroll ? y : 0;
            if (this.options.useTransform) {
                this.scroller.style[transform] = 'translate(' + x + 'px,' + y + 'px) scale(' + this.scale + ')' + translateZ;
            } else {
                x = m.round(x);
                y = m.round(y);
                this.scroller.style.left = x + 'px';
                this.scroller.style.top = y + 'px';
            }
            this.x = x;
            this.y = y;
            this._scrollbarPos('h');
            this._scrollbarPos('v');
        },
        _scrollbarPos: function (dir, hidden) {
            var that = this,
                pos = dir == 'h' ? that.x : that.y,
                size;
            if (!that[dir + 'Scrollbar']) return;
            pos = that[dir + 'ScrollbarProp'] * pos;
            if (pos < 0) {
                if (!that.options.fixedScrollbar) {
                    size = that[dir + 'ScrollbarIndicatorSize'] + m.round(pos * 3);
                    if (size < 8) size = 8;
                    that[dir + 'ScrollbarIndicator'].style[dir == 'h' ? 'width' : 'height'] = size + 'px';
                }
                pos = 0;
            } else if (pos > that[dir + 'ScrollbarMaxScroll']) {
                if (!that.options.fixedScrollbar) {
                    size = that[dir + 'ScrollbarIndicatorSize'] - m.round((pos - that[dir + 'ScrollbarMaxScroll']) * 3);
                    if (size < 8) size = 8;
                    that[dir + 'ScrollbarIndicator'].style[dir == 'h' ? 'width' : 'height'] = size + 'px';
                    pos = that[dir + 'ScrollbarMaxScroll'] + (that[dir + 'ScrollbarIndicatorSize'] - size);
                } else {
                    pos = that[dir + 'ScrollbarMaxScroll'];
                }
            }
            that[dir + 'ScrollbarWrapper'].style[transitionDelay] = '0';
            that[dir + 'ScrollbarWrapper'].style.opacity = hidden && that.options.hideScrollbar ? '0' : '1';
            that[dir + 'ScrollbarIndicator'].style[transform] = 'translate(' + (dir == 'h' ? pos + 'px,0)' : '0,' + pos + 'px)') + translateZ;
        },
        _start: function (e) {
            var that = this,
                point = hasTouch ? e.touches[0] : e,
                matrix, x, y, c1, c2;
            if (!that.enabled) return;
            if (that.options.onBeforeScrollStart) that.options.onBeforeScrollStart.call(that, e);
            if (that.options.useTransition || that.options.zoom) that._transitionTime(0);
            that.moved = false;
            that.animating = false;
            that.zoomed = false;
            that.distX = 0;
            that.distY = 0;
            that.absDistX = 0;
            that.absDistY = 0;
            that.dirX = 0;
            that.dirY = 0;
            if (that.options.zoom && hasTouch && e.touches.length > 1) {
                c1 = m.abs(e.touches[0].pageX - e.touches[1].pageX);
                c2 = m.abs(e.touches[0].pageY - e.touches[1].pageY);
                that.touchesDistStart = m.sqrt(c1 * c1 + c2 * c2);
                that.originX = m.abs(e.touches[0].pageX + e.touches[1].pageX - that.wrapperOffsetLeft * 2) / 2 - that.x;
                that.originY = m.abs(e.touches[0].pageY + e.touches[1].pageY - that.wrapperOffsetTop * 2) / 2 - that.y;
                if (that.options.onZoomStart) that.options.onZoomStart.call(that, e);
            }
            if (that.options.momentum) {
                if (that.options.useTransform) {
                    matrix = getComputedStyle(that.scroller, null)[transform].replace(/[^0-9\-.,]/g, '').split(',');
                    x = +(matrix[12] || matrix[4]);
                    y = +(matrix[13] || matrix[5]);
                } else {
                    x = +getComputedStyle(that.scroller, null).left.replace(/[^0-9-]/g, '');
                    y = +getComputedStyle(that.scroller, null).top.replace(/[^0-9-]/g, '');
                }
                if (x != that.x || y != that.y) {
                    if (that.options.useTransition) that._unbind(TRNEND_EV);
                    else cancelFrame(that.aniTime);
                    that.steps = [];
                    that._pos(x, y);
                    if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);
                }
            }
            that.absStartX = that.x;
            that.absStartY = that.y;
            that.startX = that.x;
            that.startY = that.y;
            that.pointX = point.pageX;
            that.pointY = point.pageY;
            that.startTime = e.timeStamp || Date.now();
            if (that.options.onScrollStart) that.options.onScrollStart.call(that, e);
            that._bind(MOVE_EV, window);
            that._bind(END_EV, window);
            that._bind(CANCEL_EV, window);
        },
        _move: function (e) {
            var that = this,
                point = hasTouch ? e.touches[0] : e,
                deltaX = point.pageX - that.pointX,
                deltaY = point.pageY - that.pointY,
                newX = that.x + deltaX,
                newY = that.y + deltaY,
                c1, c2, scale, timestamp = e.timeStamp || Date.now();
            if (that.options.onBeforeScrollMove) that.options.onBeforeScrollMove.call(that, e);
            if (that.options.zoom && hasTouch && e.touches.length > 1) {
                c1 = m.abs(e.touches[0].pageX - e.touches[1].pageX);
                c2 = m.abs(e.touches[0].pageY - e.touches[1].pageY);
                that.touchesDist = m.sqrt(c1 * c1 + c2 * c2);
                that.zoomed = true;
                scale = 1 / that.touchesDistStart * that.touchesDist * this.scale;
                if (scale < that.options.zoomMin) scale = 0.5 * that.options.zoomMin * Math.pow(2.0, scale / that.options.zoomMin);
                else if (scale > that.options.zoomMax) scale = 2.0 * that.options.zoomMax * Math.pow(0.5, that.options.zoomMax / scale);
                that.lastScale = scale / this.scale;
                newX = this.originX - this.originX * that.lastScale + this.x;
                newY = this.originY - this.originY * that.lastScale + this.y;
                this.scroller.style[transform] = 'translate(' + newX + 'px,' + newY + 'px) scale(' + scale + ')' + translateZ;
                if (that.options.onZoom) that.options.onZoom.call(that, e);
                return;
            }
            that.pointX = point.pageX;
            that.pointY = point.pageY;
            if (newX > 0 || newX < that.maxScrollX) {
                newX = that.options.bounce ? that.x + (deltaX / 2) : newX >= 0 || that.maxScrollX >= 0 ? 0 : that.maxScrollX;
            }
            if (newY > that.minScrollY || newY < that.maxScrollY) {
                newY = that.options.bounce ? that.y + (deltaY / 2) : newY >= that.minScrollY || that.maxScrollY >= 0 ? that.minScrollY : that.maxScrollY;
            }
            that.distX += deltaX;
            that.distY += deltaY;
            that.absDistX = m.abs(that.distX);
            that.absDistY = m.abs(that.distY);
            if (that.absDistX < 6 && that.absDistY < 6) {
                return;
            }
            if (that.options.lockDirection) {
                if (that.absDistX > that.absDistY + 5) {
                    newY = that.y;
                    deltaY = 0;
                } else if (that.absDistY > that.absDistX + 5) {
                    newX = that.x;
                    deltaX = 0;
                }
            }
            that.moved = true;
            that._pos(newX, newY);
            that.dirX = deltaX > 0 ? -1 : deltaX < 0 ? 1 : 0;
            that.dirY = deltaY > 0 ? -1 : deltaY < 0 ? 1 : 0;
            if (timestamp - that.startTime > 300) {
                that.startTime = timestamp;
                that.startX = that.x;
                that.startY = that.y;
            }
            if (that.options.onScrollMove) that.options.onScrollMove.call(that, e);
        },
        _end: function (e) {
            if (hasTouch && e.touches.length !== 0) return;
            var that = this,
                point = hasTouch ? e.changedTouches[0] : e,
                target, ev, momentumX = {
                    dist: 0,
                    time: 0
                },
                momentumY = {
                    dist: 0,
                    time: 0
                },
                duration = (e.timeStamp || Date.now()) - that.startTime,
                newPosX = that.x,
                newPosY = that.y,
                distX, distY, newDuration, snap, scale;
            that._unbind(MOVE_EV, window);
            that._unbind(END_EV, window);
            that._unbind(CANCEL_EV, window);
            if (that.options.onBeforeScrollEnd) that.options.onBeforeScrollEnd.call(that, e);
            if (that.zoomed) {
                scale = that.scale * that.lastScale;
                scale = Math.max(that.options.zoomMin, scale);
                scale = Math.min(that.options.zoomMax, scale);
                that.lastScale = scale / that.scale;
                that.scale = scale;
                that.x = that.originX - that.originX * that.lastScale + that.x;
                that.y = that.originY - that.originY * that.lastScale + that.y;
                that.scroller.style[transitionDuration] = '200ms';
                that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px) scale(' + that.scale + ')' + translateZ;
                that.zoomed = false;
                that.refresh();
                if (that.options.onZoomEnd) that.options.onZoomEnd.call(that, e);
                return;
            }
            if (!that.moved) {
                if (hasTouch) {
                    if (that.doubleTapTimer && that.options.zoom) {
                        clearTimeout(that.doubleTapTimer);
                        that.doubleTapTimer = null;
                        if (that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                        that.zoom(that.pointX, that.pointY, that.scale == 1 ? that.options.doubleTapZoom : 1);
                        if (that.options.onZoomEnd) {
                            setTimeout(function () {
                                that.options.onZoomEnd.call(that, e);
                            }, 200);
                        }
                    } else if (this.options.handleClick) {
                        that.doubleTapTimer = setTimeout(function () {
                            that.doubleTapTimer = null;
                            target = point.target;
                            while (target.nodeType != 1) target = target.parentNode;
                            if (target.tagName != 'SELECT' && target.tagName != 'INPUT' && target.tagName != 'TEXTAREA') {
                                ev = doc.createEvent('MouseEvents');
                                ev.initMouseEvent('click', true, true, e.view, 1, point.screenX, point.screenY, point.clientX, point.clientY, e.ctrlKey, e.altKey, e.shiftKey, e.metaKey, 0, null);
                                ev._fake = true;
                                target.dispatchEvent(ev);
                            }
                        }, that.options.zoom ? 250 : 0);
                    }
                }
                that._resetPos(400);
                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }
            if (duration < 300 && that.options.momentum) {
                momentumX = newPosX ? that._momentum(newPosX - that.startX, duration, -that.x, that.scrollerW - that.wrapperW + that.x, that.options.bounce ? that.wrapperW : 0) : momentumX;
                momentumY = newPosY ? that._momentum(newPosY - that.startY, duration, -that.y, (that.maxScrollY < 0 ? that.scrollerH - that.wrapperH + that.y - that.minScrollY : 0), that.options.bounce ? that.wrapperH : 0) : momentumY;
                newPosX = that.x + momentumX.dist;
                newPosY = that.y + momentumY.dist;
                if ((that.x > 0 && newPosX > 0) || (that.x < that.maxScrollX && newPosX < that.maxScrollX)) momentumX = {
                    dist: 0,
                    time: 0
                };
                if ((that.y > that.minScrollY && newPosY > that.minScrollY) || (that.y < that.maxScrollY && newPosY < that.maxScrollY)) momentumY = {
                    dist: 0,
                    time: 0
                };
            }
            if (momentumX.dist || momentumY.dist) {
                newDuration = m.max(m.max(momentumX.time, momentumY.time), 10);
                if (that.options.snap) {
                    distX = newPosX - that.absStartX;
                    distY = newPosY - that.absStartY;
                    if (m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold) {
                        that.scrollTo(that.absStartX, that.absStartY, 200);
                    } else {
                        snap = that._snap(newPosX, newPosY);
                        newPosX = snap.x;
                        newPosY = snap.y;
                        newDuration = m.max(snap.time, newDuration);
                    }
                }
                that.scrollTo(m.round(newPosX), m.round(newPosY), newDuration);
                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }
            if (that.options.snap) {
                distX = newPosX - that.absStartX;
                distY = newPosY - that.absStartY;
                if (m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold) that.scrollTo(that.absStartX, that.absStartY, 200);
                else {
                    snap = that._snap(that.x, that.y);
                    if (snap.x != that.x || snap.y != that.y) that.scrollTo(snap.x, snap.y, snap.time);
                }
                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }
            that._resetPos(200);
            if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
        },
        _resetPos: function (time) {
            var that = this,
                resetX = that.x >= 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x,
                resetY = that.y >= that.minScrollY || that.maxScrollY > 0 ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;
            if (resetX == that.x && resetY == that.y) {
                if (that.moved) {
                    that.moved = false;
                    if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);
                }
                if (that.hScrollbar && that.options.hideScrollbar) {
                    if (vendor == 'webkit') that.hScrollbarWrapper.style[transitionDelay] = '300ms';
                    that.hScrollbarWrapper.style.opacity = '0';
                }
                if (that.vScrollbar && that.options.hideScrollbar) {
                    if (vendor == 'webkit') that.vScrollbarWrapper.style[transitionDelay] = '300ms';
                    that.vScrollbarWrapper.style.opacity = '0';
                }
                return;
            }
            that.scrollTo(resetX, resetY, time || 0);
        },
        _wheel: function (e) {
            var that = this,
                wheelDeltaX, wheelDeltaY, deltaX, deltaY, deltaScale;
            if ('wheelDeltaX' in e) {
                wheelDeltaX = e.wheelDeltaX / 12;
                wheelDeltaY = e.wheelDeltaY / 12;
            } else if ('wheelDelta' in e) {
                wheelDeltaX = wheelDeltaY = e.wheelDelta / 12;
            } else if ('detail' in e) {
                wheelDeltaX = wheelDeltaY = -e.detail * 3;
            } else {
                return;
            }
            if (that.options.wheelAction == 'zoom') {
                deltaScale = that.scale * Math.pow(2, 1 / 3 * (wheelDeltaY ? wheelDeltaY / Math.abs(wheelDeltaY) : 0));
                if (deltaScale < that.options.zoomMin) deltaScale = that.options.zoomMin;
                if (deltaScale > that.options.zoomMax) deltaScale = that.options.zoomMax;
                if (deltaScale != that.scale) {
                    if (!that.wheelZoomCount && that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                    that.wheelZoomCount++;
                    that.zoom(e.pageX, e.pageY, deltaScale, 400);
                    setTimeout(function () {
                        that.wheelZoomCount--;
                        if (!that.wheelZoomCount && that.options.onZoomEnd) that.options.onZoomEnd.call(that, e);
                    }, 400);
                }
                return;
            }
            deltaX = that.x + wheelDeltaX;
            deltaY = that.y + wheelDeltaY;
            if (deltaX > 0) deltaX = 0;
            else if (deltaX < that.maxScrollX) deltaX = that.maxScrollX;
            if (deltaY > that.minScrollY) deltaY = that.minScrollY;
            else if (deltaY < that.maxScrollY) deltaY = that.maxScrollY;
            if (that.maxScrollY < 0) {
                that.scrollTo(deltaX, deltaY, 0);
            }
        },
        _transitionEnd: function (e) {
            var that = this;
            if (e.target != that.scroller) return;
            that._unbind(TRNEND_EV);
            that._startAni();
        },
        _startAni: function () {
            var that = this,
                startX = that.x,
                startY = that.y,
                startTime = Date.now(),
                step, easeOut, animate;
            if (that.animating) return;
            if (!that.steps.length) {
                that._resetPos(400);
                return;
            }
            step = that.steps.shift();
            if (step.x == startX && step.y == startY) step.time = 0;
            that.animating = true;
            that.moved = true;
            if (that.options.useTransition) {
                that._transitionTime(step.time);
                that._pos(step.x, step.y);
                that.animating = false;
                if (step.time) that._bind(TRNEND_EV);
                else that._resetPos(0);
                return;
            }
            animate = function () {
                var now = Date.now(),
                    newX, newY;
                if (now >= startTime + step.time) {
                    that._pos(step.x, step.y);
                    that.animating = false;
                    if (that.options.onAnimationEnd) that.options.onAnimationEnd.call(that);
                    that._startAni();
                    return;
                }
                now = (now - startTime) / step.time - 1;
                easeOut = m.sqrt(1 - now * now);
                newX = (step.x - startX) * easeOut + startX;
                newY = (step.y - startY) * easeOut + startY;
                that._pos(newX, newY);
                if (that.animating) that.aniTime = nextFrame(animate);
            };
            animate();
        },
        _transitionTime: function (time) {
            time += 'ms';
            this.scroller.style[transitionDuration] = time;
            if (this.hScrollbar) this.hScrollbarIndicator.style[transitionDuration] = time;
            if (this.vScrollbar) this.vScrollbarIndicator.style[transitionDuration] = time;
        },
        _momentum: function (dist, time, maxDistUpper, maxDistLower, size) {
            var deceleration = 0.0006,
                speed = m.abs(dist) / time,
                newDist = (speed * speed) / (2 * deceleration),
                newTime = 0,
                outsideDist = 0;
            if (dist > 0 && newDist > maxDistUpper) {
                outsideDist = size / (6 / (newDist / speed * deceleration));
                maxDistUpper = maxDistUpper + outsideDist;
                speed = speed * maxDistUpper / newDist;
                newDist = maxDistUpper;
            } else if (dist < 0 && newDist > maxDistLower) {
                outsideDist = size / (6 / (newDist / speed * deceleration));
                maxDistLower = maxDistLower + outsideDist;
                speed = speed * maxDistLower / newDist;
                newDist = maxDistLower;
            }
            newDist = newDist * (dist < 0 ? -1 : 1);
            newTime = speed / deceleration;
            return {
                dist: newDist,
                time: m.round(newTime)
            };
        },
        _offset: function (el) {
            var left = -el.offsetLeft,
                top = -el.offsetTop;
            while (el = el.offsetParent) {
                left -= el.offsetLeft;
                top -= el.offsetTop;
            }
            if (el != this.wrapper) {
                left *= this.scale;
                top *= this.scale;
            }
            return {
                left: left,
                top: top
            };
        },
        _snap: function (x, y) {
            var that = this,
                i, l, page, time, sizeX, sizeY;
            page = that.pagesX.length - 1;
            for (i = 0, l = that.pagesX.length; i < l; i++) {
                if (x >= that.pagesX[i]) {
                    page = i;
                    break;
                }
            }
            if (page == that.currPageX && page > 0 && that.dirX < 0) page--;
            x = that.pagesX[page];
            sizeX = m.abs(x - that.pagesX[that.currPageX]);
            sizeX = sizeX ? m.abs(that.x - x) / sizeX * 500 : 0;
            that.currPageX = page;
            page = that.pagesY.length - 1;
            for (i = 0; i < page; i++) {
                if (y >= that.pagesY[i]) {
                    page = i;
                    break;
                }
            }
            if (page == that.currPageY && page > 0 && that.dirY < 0) page--;
            y = that.pagesY[page];
            sizeY = m.abs(y - that.pagesY[that.currPageY]);
            sizeY = sizeY ? m.abs(that.y - y) / sizeY * 500 : 0;
            that.currPageY = page;
            time = m.round(m.max(sizeX, sizeY)) || 200;
            return {
                x: x,
                y: y,
                time: time
            };
        },
        _bind: function (type, el, bubble) {
            (el || this.scroller).addEventListener(type, this, !!bubble);
        },
        _unbind: function (type, el, bubble) {
            (el || this.scroller).removeEventListener(type, this, !!bubble);
        },
        destroy: function () {
            var that = this;
            that.scroller.style[transform] = '';
            that.hScrollbar = false;
            that.vScrollbar = false;
            that._scrollbar('h');
            that._scrollbar('v');
            that._unbind(RESIZE_EV, window);
            that._unbind(START_EV);
            that._unbind(MOVE_EV, window);
            that._unbind(END_EV, window);
            that._unbind(CANCEL_EV, window);
            if (!that.options.hasTouch) {
                that._unbind('DOMMouseScroll');
                that._unbind('mousewheel');
            }
            if (that.options.useTransition) that._unbind(TRNEND_EV);
            if (that.options.checkDOMChanges) clearInterval(that.checkDOMTime);
            if (that.options.onDestroy) that.options.onDestroy.call(that);
        },
        refresh: function () {
            var that = this,
                offset, i, l, els, pos = 0,
                page = 0;
            if (that.scale < that.options.zoomMin) that.scale = that.options.zoomMin;
            that.wrapperW = that.wrapper.clientWidth || 1;
            that.wrapperH = that.wrapper.clientHeight || 1;
            that.minScrollY = -that.options.topOffset || 0;
            that.scrollerW = m.round(that.scroller.offsetWidth * that.scale);
            that.scrollerH = m.round((that.scroller.offsetHeight + that.minScrollY) * that.scale);
            that.maxScrollX = that.wrapperW - that.scrollerW;
            that.maxScrollY = that.wrapperH - that.scrollerH + that.minScrollY;
            that.dirX = 0;
            that.dirY = 0;
            if (that.options.onRefresh) that.options.onRefresh.call(that);
            that.hScroll = that.options.hScroll && that.maxScrollX < 0;
            that.vScroll = that.options.vScroll && (!that.options.bounceLock && !that.hScroll || that.scrollerH > that.wrapperH);
            that.hScrollbar = that.hScroll && that.options.hScrollbar;
            that.vScrollbar = that.vScroll && that.options.vScrollbar && that.scrollerH > that.wrapperH;
            offset = that._offset(that.wrapper);
            that.wrapperOffsetLeft = -offset.left;
            that.wrapperOffsetTop = -offset.top;
            if (typeof that.options.snap == 'string') {
                that.pagesX = [];
                that.pagesY = [];
                els = that.scroller.querySelectorAll(that.options.snap);
                for (i = 0, l = els.length; i < l; i++) {
                    pos = that._offset(els[i]);
                    pos.left += that.wrapperOffsetLeft;
                    pos.top += that.wrapperOffsetTop;
                    that.pagesX[i] = pos.left < that.maxScrollX ? that.maxScrollX : pos.left * that.scale;
                    that.pagesY[i] = pos.top < that.maxScrollY ? that.maxScrollY : pos.top * that.scale;
                }
            } else if (that.options.snap) {
                that.pagesX = [];
                while (pos >= that.maxScrollX) {
                    that.pagesX[page] = pos;
                    pos = pos - that.wrapperW;
                    page++;
                }
                if (that.maxScrollX % that.wrapperW) that.pagesX[that.pagesX.length] = that.maxScrollX - that.pagesX[that.pagesX.length - 1] + that.pagesX[that.pagesX.length - 1];
                pos = 0;
                page = 0;
                that.pagesY = [];
                while (pos >= that.maxScrollY) {
                    that.pagesY[page] = pos;
                    pos = pos - that.wrapperH;
                    page++;
                }
                if (that.maxScrollY % that.wrapperH) that.pagesY[that.pagesY.length] = that.maxScrollY - that.pagesY[that.pagesY.length - 1] + that.pagesY[that.pagesY.length - 1];
            }
            that._scrollbar('h');
            that._scrollbar('v');
            if (!that.zoomed) {
                that.scroller.style[transitionDuration] = '0';
                that._resetPos(400);
            }
        },
        scrollTo: function (x, y, time, relative) {
            var that = this,
                step = x,
                i, l;
            that.stop();
            if (!step.length) step = [{
                x: x,
                y: y,
                time: time,
                relative: relative
            }];
            for (i = 0, l = step.length; i < l; i++) {
                if (step[i].relative) {
                    step[i].x = that.x - step[i].x;
                    step[i].y = that.y - step[i].y;
                }
                that.steps.push({
                    x: step[i].x,
                    y: step[i].y,
                    time: step[i].time || 0
                });
            }
            that._startAni();
        },
        scrollToElement: function (el, time) {
            var that = this,
                pos;
            el = el.nodeType ? el : that.scroller.querySelector(el);
            if (!el) return;
            pos = that._offset(el);
            pos.left += that.wrapperOffsetLeft;
            pos.top += that.wrapperOffsetTop;
            pos.left = pos.left > 0 ? 0 : pos.left < that.maxScrollX ? that.maxScrollX : pos.left;
            pos.top = pos.top > that.minScrollY ? that.minScrollY : pos.top < that.maxScrollY ? that.maxScrollY : pos.top;
            time = time === undefined ? m.max(m.abs(pos.left) * 2, m.abs(pos.top) * 2) : time;
            that.scrollTo(pos.left, pos.top, time);
        },
        scrollToPage: function (pageX, pageY, time) {
            var that = this,
                x, y;
            time = time === undefined ? 400 : time;
            if (that.options.onScrollStart) that.options.onScrollStart.call(that);
            if (that.options.snap) {
                pageX = pageX == 'next' ? that.currPageX + 1 : pageX == 'prev' ? that.currPageX - 1 : pageX;
                pageY = pageY == 'next' ? that.currPageY + 1 : pageY == 'prev' ? that.currPageY - 1 : pageY;
                pageX = pageX < 0 ? 0 : pageX > that.pagesX.length - 1 ? that.pagesX.length - 1 : pageX;
                pageY = pageY < 0 ? 0 : pageY > that.pagesY.length - 1 ? that.pagesY.length - 1 : pageY;
                that.currPageX = pageX;
                that.currPageY = pageY;
                x = that.pagesX[pageX];
                y = that.pagesY[pageY];
            } else {
                x = -that.wrapperW * pageX;
                y = -that.wrapperH * pageY;
                if (x < that.maxScrollX) x = that.maxScrollX;
                if (y < that.maxScrollY) y = that.maxScrollY;
            }
            that.scrollTo(x, y, time);
        },
        disable: function () {
            this.stop();
            this._resetPos(0);
            this.enabled = false;
            this._unbind(MOVE_EV, window);
            this._unbind(END_EV, window);
            this._unbind(CANCEL_EV, window);
        },
        enable: function () {
            this.enabled = true;
        },
        stop: function () {
            if (this.options.useTransition) this._unbind(TRNEND_EV);
            else cancelFrame(this.aniTime);
            this.steps = [];
            this.moved = false;
            this.animating = false;
        },
        zoom: function (x, y, scale, time) {
            var that = this,
                relScale = scale / that.scale;
            if (!that.options.useTransform) return;
            that.zoomed = true;
            time = time === undefined ? 200 : time;
            x = x - that.wrapperOffsetLeft - that.x;
            y = y - that.wrapperOffsetTop - that.y;
            that.x = x - x * relScale + that.x;
            that.y = y - y * relScale + that.y;
            that.scale = scale;
            that.refresh();
            that.x = that.x > 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x;
            that.y = that.y > that.minScrollY ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;
            that.scroller.style[transitionDuration] = time + 'ms';
            that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px) scale(' + scale + ')' + translateZ;
            that.zoomed = false;
        },
        isReady: function () {
            return !this.moved && !this.zoomed && !this.animating;
        }
    };

    function prefixStyle(style) {
        if (vendor === '') return style;
        style = style.charAt(0).toUpperCase() + style.substr(1);
        return vendor + style;
    }
    dummyStyle = null;
    if (typeof exports !== 'undefined') exports.iScroll = iScroll;
    else window.iScroll = iScroll;
})(window, document);;
eval(function (p, a, c, k, e, d) {
    e = function (c) {
        return (c < a ? "" : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
    };
    if (!''.replace(/^/, String)) {
        while (c--) d[e(c)] = k[c] || e(c);
        k = [function (e) {
            return d[e]
        }];
        e = function () {
            return '\\w+'
        };
        c = 1;
    };
    while (c--)
        if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
    return p;
}('o 1P(p){o X(K,1s){h(K<<1s)|(K>>>(32-1s))}o e(1b,1f){f 1e,1g,B,C,w;B=(1b&1p);C=(1f&1p);1e=(1b&1a);1g=(1f&1a);w=(1b&1A)+(1f&1A);T(1e&1g){h(w^1p^B^C)}T(1e|1g){T(w&1a){h(w^1U^B^C)}1h{h(w^1a^B^C)}}1h{h(w^B^C)}}o 1D(x,y,z){h(x&y)|((~x)&z)}o 1B(x,y,z){h(x&z)|(y&(~z))}o 1E(x,y,z){h(x^y^z)}o 1F(x,y,z){h(y^(x|(~z)))}o m(a,b,c,d,x,s,u){a=e(a,e(e(1D(b,c,d),x),u));h e(X(a,s),b)};o i(a,b,c,d,x,s,u){a=e(a,e(e(1B(b,c,d),x),u));h e(X(a,s),b)};o l(a,b,c,d,x,s,u){a=e(a,e(e(1E(b,c,d),x),u));h e(X(a,s),b)};o j(a,b,c,d,x,s,u){a=e(a,e(e(1F(b,c,d),x),u));h e(X(a,s),b)};o 1v(p){f A;f G=p.1d;f 1l=G+8;f 1w=(1l-(1l%1y))/1y;f 1j=(1w+1)*16;f t=1z(1j-1);f F=0;f q=0;1S(q<G){A=(q-(q%4))/4;F=(q%4)*8;t[A]=(t[A]|(p.1C(q)<<F));q++}A=(q-(q%4))/4;F=(q%4)*8;t[A]=t[A]|(2a<<F);t[1j-2]=G<<3;t[1j-1]=G>>>29;h t};o 19(K){f 1c="",1i="",1t,I;1r(I=0;I<=3;I++){1t=(K>>>(I*8))&1T;1i="0"+1t.1V(16);1c=1c+1i.26(1i.1d-2,2)}h 1c};o 1x(p){p=p.25(/\\r\\n/g,"\\n");f v="";1r(f n=0;n<p.1d;n++){f c=p.1C(n);T(c<1k){v+=E.D(c)}1h T((c>1W)&&(c<1Z)){v+=E.D((c>>6)|1Y);v+=E.D((c&1o)|1k)}1h{v+=E.D((c>>12)|1X);v+=E.D(((c>>6)&1o)|1k);v+=E.D((c&1o)|1k)}}h v};f x=1z();f k,1n,1m,1q,1u,a,b,c,d;f J=7,V=12,N=17,O=22;f P=5,H=9,Q=14,M=20;f U=4,R=11,S=16,L=23;f Y=6,Z=10,W=15,18=21;p=1x(p);x=1v(p);a=24;b=2b;c=2c;d=28;1r(k=0;k<x.1d;k+=16){1n=a;1m=b;1q=c;1u=d;a=m(a,b,c,d,x[k+0],J,27);d=m(d,a,b,c,x[k+1],V,1J);c=m(c,d,a,b,x[k+2],N,1K);b=m(b,c,d,a,x[k+3],O,1L);a=m(a,b,c,d,x[k+4],J,1G);d=m(d,a,b,c,x[k+5],V,1I);c=m(c,d,a,b,x[k+6],N,1H);b=m(b,c,d,a,x[k+7],O,1M);a=m(a,b,c,d,x[k+8],J,1R);d=m(d,a,b,c,x[k+9],V,1N);c=m(c,d,a,b,x[k+10],N,1O);b=m(b,c,d,a,x[k+11],O,1Q);a=m(a,b,c,d,x[k+12],J,2Y);d=m(d,a,b,c,x[k+13],V,2N);c=m(c,d,a,b,x[k+14],N,2I);b=m(b,c,d,a,x[k+15],O,2V);a=i(a,b,c,d,x[k+1],P,2Q);d=i(d,a,b,c,x[k+6],H,2R);c=i(c,d,a,b,x[k+11],Q,2P);b=i(b,c,d,a,x[k+0],M,2S);a=i(a,b,c,d,x[k+5],P,2U);d=i(d,a,b,c,x[k+10],H,2T);c=i(c,d,a,b,x[k+15],Q,2O);b=i(b,c,d,a,x[k+4],M,2H);a=i(a,b,c,d,x[k+9],P,2K);d=i(d,a,b,c,x[k+14],H,2M);c=i(c,d,a,b,x[k+3],Q,2L);b=i(b,c,d,a,x[k+8],M,34);a=i(a,b,c,d,x[k+13],P,33);d=i(d,a,b,c,x[k+2],H,2X);c=i(c,d,a,b,x[k+7],Q,2W);b=i(b,c,d,a,x[k+12],M,31);a=l(a,b,c,d,x[k+5],U,30);d=l(d,a,b,c,x[k+8],R,2Z);c=l(c,d,a,b,x[k+11],S,2G);b=l(b,c,d,a,x[k+14],L,2m);a=l(a,b,c,d,x[k+1],U,2l);d=l(d,a,b,c,x[k+4],R,2k);c=l(c,d,a,b,x[k+7],S,2n);b=l(b,c,d,a,x[k+10],L,2q);a=l(a,b,c,d,x[k+13],U,2p);d=l(d,a,b,c,x[k+0],R,2o);c=l(c,d,a,b,x[k+3],S,2f);b=l(b,c,d,a,x[k+6],L,2e);a=l(a,b,c,d,x[k+9],U,2d);d=l(d,a,b,c,x[k+12],R,2g);c=l(c,d,a,b,x[k+15],S,2j);b=l(b,c,d,a,x[k+2],L,2i);a=j(a,b,c,d,x[k+0],Y,2h);d=j(d,a,b,c,x[k+7],Z,2r);c=j(c,d,a,b,x[k+14],W,2B);b=j(b,c,d,a,x[k+5],18,2A);a=j(a,b,c,d,x[k+12],Y,2z);d=j(d,a,b,c,x[k+3],Z,2C);c=j(c,d,a,b,x[k+10],W,2F);b=j(b,c,d,a,x[k+1],18,2E);a=j(a,b,c,d,x[k+8],Y,2D);d=j(d,a,b,c,x[k+15],Z,2u);c=j(c,d,a,b,x[k+6],W,2t);b=j(b,c,d,a,x[k+13],18,2s);a=j(a,b,c,d,x[k+4],Y,2v);d=j(d,a,b,c,x[k+11],Z,2y);c=j(c,d,a,b,x[k+2],W,2x);b=j(b,c,d,a,x[k+9],18,2w);a=e(a,1n);b=e(b,1m);c=e(c,1q);d=e(d,1u)}h(19(a)+19(b)+19(c)+19(d)).2J()}', 62, 191, '||||||||||||||sdc_AddUnsigned|var||return|sdc_GG|sdc_II||sdc_HH|sdc_FF||function|string|lByteCount|||lWordArray|ac|utftext|lResult||||lWordCount|lX8|lY8|fromCharCode|String|lBytePosition|lMessageLength|S22|lCount|S11|lValue|S34|S24|S13|S14|S21|S23|S32|S33|if|S31|S12|S43|sdc_RotateLeft|S41|S42|||||||||S44|sdc_WordToHex|0x40000000|lX|WordToHexValue|length|lX4|lY|lY4|else|WordToHexValue_temp|lNumberOfWords|128|lNumberOfWords_temp1|BB|AA|63|0x80000000|CC|for|iShiftBits|lByte|DD|sdc_ConvertToWordArray|lNumberOfWords_temp2|sdc_Utf8Encode|64|Array|0x3FFFFFFF|sdc_G|charCodeAt|sdc_F|sdc_H|sdc_I|0xF57C0FAF|0xA8304613|0x4787C62A|0xE8C7B756|0x242070DB|0xC1BDCEEE|0xFD469501|0x8B44F7AF|0xFFFF5BB1|sdc|0x895CD7BE|0x698098D8|while|255|0xC0000000|toString|127|224|192|2048|||||0x67452301|replace|substr|0xD76AA478|0x10325476||0x80|0xEFCDAB89|0x98BADCFE|0xD9D4D039|0x4881D05|0xD4EF3085|0xE6DB99E5|0xF4292244|0xC4AC5665|0x1FA27CF8|0x4BDECFA9|0xA4BEEA44|0xFDE5380C|0xF6BB4B60|0xEAA127FA|0x289B7EC6|0xBEBFBC70|0x432AFF97|0x4E0811A1|0xA3014314|0xFE2CE6E0|0xF7537E82|0xEB86D391|0x2AD7D2BB|0xBD3AF235|0x655B59C3|0xFC93A039|0xAB9423A7|0x8F0CCC92|0x6FA87E4F|0x85845DD1|0xFFEFF47D|0x6D9D6122|0xE7D3FBC8|0xA679438E|toLowerCase|0x21E1CDE6|0xF4D50D87|0xC33707D6|0xFD987193|0xD8A1E681|0x265E5A51|0xF61E2562|0xC040B340|0xE9B6C7AA|0x2441453|0xD62F105D|0x49B40821|0x676F02D9|0xFCEFA3F8|0x6B901122|0x8771F681|0xFFFA3942|0x8D2A4C8A||0xA9E3E905|0x455A14ED'.split('|'), 0, {}))
bgh = ~[];
bgh = {
    ___: ++bgh,
    $$$$: (![] + "")[bgh],
    __$: ++bgh,
    $_$_: (![] + "")[bgh],
    _$_: ++bgh,
    $_$$: ({} + "")[bgh],
    $$_$: (bgh[bgh] + "")[bgh],
    _$$: ++bgh,
    $$$_: (!"" + "")[bgh],
    $__: ++bgh,
    $_$: ++bgh,
    $$__: ({} + "")[bgh],
    $$_: ++bgh,
    $$$: ++bgh,
    $___: ++bgh,
    $__$: ++bgh
};
bgh.$_ = (bgh.$_ = bgh + "")[bgh.$_$] + (bgh._$ = bgh.$_[bgh.__$]) + (bgh.$$ = (bgh.$ + "")[bgh.__$]) + ((!bgh) + "")[bgh._$$] + (bgh.__ = bgh.$_[bgh.$$_]) + (bgh.$ = (!"" + "")[bgh.__$]) + (bgh._ = (!"" + "")[bgh._$_]) + bgh.$_[bgh.$_$] + bgh.__ + bgh._$ + bgh.$;
bgh.$$ = bgh.$ + (!"" + "")[bgh._$$] + bgh.__ + bgh._ + bgh.$ + bgh.$$;
bgh.$ = (bgh.___)[bgh.$_][bgh.$_];
bgh.$(bgh.$(bgh.$$ + "\"" + "\\" + bgh.__$ + bgh.__$ + bgh.$$$$ + bgh._ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$__ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.__$ + bgh._$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "(){\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$$ + "(\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$$_ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + ".\\" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$__ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.__ + "\\" + bgh.$__ + bgh.___ + "&&\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$$_ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + ".\\" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$__ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.__ + ">" + bgh.__$ + bgh.___ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "&&\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$$_ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$_$ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "&&\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$$_ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$_$ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + ">" + bgh.__$ + bgh.___ + bgh.___ + "\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "&&\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ".$\\" + bgh.$__ + bgh.___ + "&&\\" + bgh.$__ + bgh.___ + "$(\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ").\\" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$__ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.__ + "()>" + bgh.__$ + bgh.___ + bgh.___ + "\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "&&\\" + bgh.$__ + bgh.___ + "$(\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + ").\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$_$ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + "()>" + bgh.__$ + bgh.___ + bgh.___ + "\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "){\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$$_ + bgh.__ + bgh._ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "\\" + bgh.$__ + bgh.___ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh._ + bgh.$$$_ + ";\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "}" + bgh.$$$_ + (![] + "")[bgh._$_] + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$$_ + "{\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$$_ + bgh.__ + bgh._ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "\\" + bgh.$__ + bgh.___ + bgh.$$$$ + bgh.$_$_ + (![] + "")[bgh._$_] + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$$_ + ";\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.__$ + "}\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "}\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "$(" + bgh.$$_$ + bgh._$ + bgh.$$__ + bgh._ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.__ + ")." + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "(\\\"" + bgh.$$__ + (![] + "")[bgh._$_] + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$__ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.$__ + bgh.___ + bgh.$$$$ + bgh._$ + bgh.$$__ + bgh._ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\\",\\\".\\" + bgh.__$ + bgh.$$_ + bgh.$$_ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$$ + "\\" + bgh.__$ + bgh.$$$ + bgh.__$ + "\\" + bgh.__$ + bgh._$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\\"," + bgh.$$$$ + bgh._ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$__ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "(){\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "\\" + bgh.__$ + bgh.___ + bgh._$$ + bgh._$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$_ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "$." + bgh.$$__ + bgh._$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$_ + "('\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + bgh.$$$_ + bgh.$_$$ + "');\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$$ + bgh.__$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "$." + bgh.$$__ + bgh._$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$_ + "('\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$$ + bgh.__$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "');\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$_$ + bgh.$$__ + "(\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$_$ + bgh.$$__ + "(\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "\\" + bgh.__$ + bgh.___ + bgh._$$ + bgh._$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$_ + ")+'" + bgh.__$ + bgh.$_$ + bgh.___ + bgh.$_$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "');\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$$ + bgh.__$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "(\\" + bgh.__$ + bgh.$$_ + bgh.___ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.__ + "(\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$$ + bgh.__$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + ")+" + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + bgh._$_ + ")*" + bgh._$_ + ";\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$$ + bgh.__$ + bgh.$$$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "." + bgh.__ + bgh._$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + "\\" + bgh.__$ + bgh.$__ + bgh.$$$ + "();\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__$ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.___ + "," + bgh._$_ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._$_ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh._$_ + "," + bgh._$_ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._$$ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.$__ + "," + bgh._$_ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$__ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.$$_ + "," + bgh._$_ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$_$ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh._$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.$___ + "," + bgh._$_ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh.__$ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.___ + "," + bgh._$$ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh._$_ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh._$$ + "," + bgh._$$ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh._$$ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.$$_ + "," + bgh._$$ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh.$__ + "=\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + ".\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._ + bgh.$_$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "(" + bgh.$__$ + ");\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$$ + "(\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "\\" + bgh.__$ + bgh._$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$$_ + bgh.$$$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + "()){\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh.__$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._$_ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh._$_ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._$$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh._$$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$__ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh.$__ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$_$ + ";\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "$." + bgh.$$__ + bgh._$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$_ + "('\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + "',\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + ",{\\" + bgh.__$ + bgh.$$_ + bgh.___ + bgh.$_$_ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + ":\\" + bgh.$__ + bgh.___ + "'/'});\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "}" + bgh.$$$_ + (![] + "")[bgh._$_] + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$$$_ + "{\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + "\\" + bgh.$__ + bgh.___ + "=\\" + bgh.$__ + bgh.___ + "\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.__$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh.__$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._$_ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh._$_ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh._$$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh._$$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$__ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + "\\" + bgh.__$ + bgh.$$_ + bgh._$$ + bgh.$_$ + "+\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$$_$ + bgh.$__ + ";\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "$." + bgh.$$__ + bgh._$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh._$$ + "\\" + bgh.__$ + bgh.$_$ + bgh.__$ + bgh.$$$_ + "('\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + "',\\" + bgh.__$ + bgh.$$_ + bgh._$_ + bgh.$_$_ + "\\" + bgh.__$ + bgh.$_$ + bgh.$$_ + bgh.$$_$ + bgh._$ + "\\" + bgh.__$ + bgh.$_$ + bgh.$_$ + "\\" + bgh.__$ + bgh.__$ + bgh.__$ + bgh.$$_$ + ",{\\" + bgh.__$ + bgh.$$_ + bgh.___ + bgh.$_$_ + bgh.__ + "\\" + bgh.__$ + bgh.$_$ + bgh.___ + ":\\" + bgh.$__ + bgh.___ + "'/'});\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "\\" + bgh.__$ + bgh.__$ + "}\\" + bgh.__$ + bgh._$_ + "\\" + bgh.__$ + bgh.__$ + "});" + "\"")())();;
eval(function (p, a, c, k, e, d) {
    e = function (c) {
        return (c < a ? "" : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
    };
    if (!''.replace(/^/, String)) {
        while (c--) d[e(c)] = k[c] || e(c);
        k = [function (e) {
            return d[e]
        }];
        e = function () {
            return '\\w+'
        };
        c = 1;
    };
    while (c--)
        if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
    return p;
}('I 1d=1d||o(u,p){I d={},l=d.1r={},s=o(){},t=l.3e={L:o(a){s.2Q=i;I c=1j s;a&&c.2E(a);c.2N("P")||(c.P=o(){c.s.P.3b(i,3F)});c.P.2Q=c;c.s=i;J c},V:o(){I a=i.L();a.P.3b(a,3F);J a},P:o(){},2E:o(a){M(I c 5g a)a.2N(c)&&(i[c]=a[c]);a.2N("1h")&&(i.1h=a.1h)},1f:o(){J i.P.2Q.L(i)}},r=l.1O=t.L({P:o(a,c){a=i.R=a||[];i.Q=c!=p?c:4*a.Z},1h:o(a){J(a||v).1m(i)},1D:o(a){I c=i.R,e=a.R,j=i.Q;a=a.Q;i.2S();Y(j%4)M(I k=0;k<a;k++)c[j+k>>>2]|=(e[k>>>2]>>>24-8*(k%4)&K)<<24-8*((j+k)%4);1i Y(5h<e.Z)M(k=0;k<a;k+=4)c[j+k>>>2]=e[k>>>2];1i c.1k.3b(c,e);i.Q+=a;J i},2S:o(){I a=i.R,c=i.Q;a[c>>>2]&=5e<<32-8*(c%4);a.Z=u.3y(c/4)},1f:o(){I a=t.1f.1a(i);a.R=i.R.1N(0);J a},3f:o(a){M(I c=[],e=0;e<a;e+=4)c.1k(3s*u.3f()|0);J 1j r.P(c,a)}}),w=d.3k={},v=w.5f={1m:o(a){I c=a.R;a=a.Q;M(I e=[],j=0;j<a;j++){I k=c[j>>>2]>>>24-8*(j%4)&K;e.1k((k>>>4).1h(16));e.1k((k&15).1h(16))}J e.3c("")},1g:o(a){M(I c=a.Z,e=[],j=0;j<c;j+=2)e[j>>>3]|=5i(a.4e(j,2),16)<<24-4*(j%8);J 1j r.P(e,c/2)}},b=w.5l={1m:o(a){I c=a.R;a=a.Q;M(I e=[],j=0;j<a;j++)e.1k(1v.1w(c[j>>>2]>>>24-8*(j%4)&K));J e.3c("")},1g:o(a){M(I c=a.Z,e=[],j=0;j<c;j++)e[j>>>2]|=(a.2U(j)&K)<<24-8*(j%4);J 1j r.P(e,c)}},x=w.5m={1m:o(a){5j{J 5k(5d(b.1m(a)))}4W(c){4X 4U("4V 4Y-8 5b")}},1g:o(a){J b.1g(5c(4Z(a)))}},q=l.3W=t.L({1b:o(){i.1u=1j r.P;i.2O=0},2h:o(a){"X"==2F a&&(a=x.1g(a));i.1u.1D(a);i.2O+=a.Q},1s:o(a){I c=i.1u,e=c.R,j=c.Q,k=i.1e,b=j/(4*k),b=a?u.3y(b):u.5a((b|0)-i.3m,0);a=b*k;j=u.5z(4*a,j);Y(a){M(I q=0;q<a;q+=k)i.3n(e,q);q=e.3T(0,a);c.Q-=j}J 1j r.P(q,j)},1f:o(){I a=t.1f.1a(i);a.1u=i.1u.1f();J a},3m:0});l.3H=q.L({N:t.L(),P:o(a){i.N=i.N.L(a);i.1b()},1b:o(){q.1b.1a(i);i.2r()},3d:o(a){i.2h(a);i.1s();J i},1l:o(a){a&&i.2h(a);J i.2f()},1e:16,2G:o(a){J o(b,e){J(1j a.P(e)).1l(b)}},3L:o(a){J o(b,e){J(1j n.5A.P(a,e)).1l(b)}}});I n=d.1J={};J d}(3K);(o(){I u=1d,p=u.1r.1O;u.3k.3R={1m:o(d){I l=d.R,p=d.Q,t=i.2I;d.2S();d=[];M(I r=0;r<p;r+=3)M(I w=(l[r>>>2]>>>24-8*(r%4)&K)<<16|(l[r+1>>>2]>>>24-8*((r+1)%4)&K)<<8|l[r+2>>>2]>>>24-8*((r+2)%4)&K,v=0;4>v&&r+0.5y*v<p;v++)d.1k(t.2j(w>>>6*(3-v)&63));Y(l=t.2j(64))M(;d.Z%4;)d.1k(l);J d.3c("")},1g:o(d){I l=d.Z,s=i.2I,t=s.2j(64);t&&(t=d.2Z(t),-1!=t&&(l=t));M(I t=[],r=0,w=0;w<l;w++)Y(w%4){I v=s.2Z(d.2j(w-1))<<2*(w%4),b=s.2Z(d.2j(w))>>>6-2*(w%4);t[r>>>2]|=(v|b)<<24-8*(r%4);r++}J p.V(t,r)},2I:"5E+/="}})();(o(u){o p(b,n,a,c,e,j,k){b=b+(n&a|~n&c)+e+k;J(b<<j|b>>>32-j)+n}o d(b,n,a,c,e,j,k){b=b+(n&c|a&~c)+e+k;J(b<<j|b>>>32-j)+n}o l(b,n,a,c,e,j,k){b=b+(n^a^c)+e+k;J(b<<j|b>>>32-j)+n}o s(b,n,a,c,e,j,k){b=b+(a^(n|~c))+e+k;J(b<<j|b>>>32-j)+n}M(I t=1d,r=t.1r,w=r.1O,v=r.3H,r=t.1J,b=[],x=0;64>x;x++)b[x]=3s*u.5F(u.5C(x+1))|0;r=r.3h=v.L({2r:o(){i.2i=1j w.P([5w,5p,5q,5n])},3n:o(q,n){M(I a=0;16>a;a++){I c=n+a,e=q[c];q[c]=(e<<8|e>>>24)&2p|(e<<24|e>>>8)&2q}I a=i.2i.R,c=q[n+0],e=q[n+1],j=q[n+2],k=q[n+3],z=q[n+4],r=q[n+5],t=q[n+6],w=q[n+7],v=q[n+8],A=q[n+9],B=q[n+10],C=q[n+11],u=q[n+12],D=q[n+13],E=q[n+14],x=q[n+15],f=a[0],m=a[1],g=a[2],h=a[3],f=p(f,m,g,h,c,7,b[0]),h=p(h,f,m,g,e,12,b[1]),g=p(g,h,f,m,j,17,b[2]),m=p(m,g,h,f,k,22,b[3]),f=p(f,m,g,h,z,7,b[4]),h=p(h,f,m,g,r,12,b[5]),g=p(g,h,f,m,t,17,b[6]),m=p(m,g,h,f,w,22,b[7]),f=p(f,m,g,h,v,7,b[8]),h=p(h,f,m,g,A,12,b[9]),g=p(g,h,f,m,B,17,b[10]),m=p(m,g,h,f,C,22,b[11]),f=p(f,m,g,h,u,7,b[12]),h=p(h,f,m,g,D,12,b[13]),g=p(g,h,f,m,E,17,b[14]),m=p(m,g,h,f,x,22,b[15]),f=d(f,m,g,h,e,5,b[16]),h=d(h,f,m,g,t,9,b[17]),g=d(g,h,f,m,C,14,b[18]),m=d(m,g,h,f,c,20,b[19]),f=d(f,m,g,h,r,5,b[20]),h=d(h,f,m,g,B,9,b[21]),g=d(g,h,f,m,x,14,b[22]),m=d(m,g,h,f,z,20,b[23]),f=d(f,m,g,h,A,5,b[24]),h=d(h,f,m,g,E,9,b[25]),g=d(g,h,f,m,k,14,b[26]),m=d(m,g,h,f,v,20,b[27]),f=d(f,m,g,h,D,5,b[28]),h=d(h,f,m,g,j,9,b[29]),g=d(g,h,f,m,w,14,b[30]),m=d(m,g,h,f,u,20,b[31]),f=l(f,m,g,h,r,4,b[32]),h=l(h,f,m,g,v,11,b[33]),g=l(g,h,f,m,C,16,b[34]),m=l(m,g,h,f,E,23,b[35]),f=l(f,m,g,h,e,4,b[36]),h=l(h,f,m,g,z,11,b[37]),g=l(g,h,f,m,w,16,b[38]),m=l(m,g,h,f,B,23,b[39]),f=l(f,m,g,h,D,4,b[40]),h=l(h,f,m,g,c,11,b[41]),g=l(g,h,f,m,k,16,b[42]),m=l(m,g,h,f,t,23,b[43]),f=l(f,m,g,h,A,4,b[44]),h=l(h,f,m,g,u,11,b[45]),g=l(g,h,f,m,x,16,b[46]),m=l(m,g,h,f,j,23,b[47]),f=s(f,m,g,h,c,6,b[48]),h=s(h,f,m,g,w,10,b[49]),g=s(g,h,f,m,E,15,b[50]),m=s(m,g,h,f,r,21,b[51]),f=s(f,m,g,h,u,6,b[52]),h=s(h,f,m,g,k,10,b[53]),g=s(g,h,f,m,B,15,b[54]),m=s(m,g,h,f,e,21,b[55]),f=s(f,m,g,h,v,6,b[56]),h=s(h,f,m,g,x,10,b[57]),g=s(g,h,f,m,t,15,b[58]),m=s(m,g,h,f,D,21,b[59]),f=s(f,m,g,h,z,6,b[60]),h=s(h,f,m,g,C,10,b[61]),g=s(g,h,f,m,j,15,b[62]),m=s(m,g,h,f,A,21,b[63]);a[0]=a[0]+f|0;a[1]=a[1]+m|0;a[2]=a[2]+g|0;a[3]=a[3]+h|0},2f:o(){I b=i.1u,n=b.R,a=8*i.2O,c=8*b.Q;n[c>>>5]|=1t<<24-c%32;I e=u.5o(a/3s);n[(c+64>>>9<<4)+15]=(e<<8|e>>>24)&2p|(e<<24|e>>>8)&2q;n[(c+64>>>9<<4)+14]=(a<<8|a>>>24)&2p|(a<<24|a>>>8)&2q;b.Q=4*(n.Z+1);i.1s();b=i.2i;n=b.R;M(a=0;4>a;a++)c=n[a],n[a]=(c<<8|c>>>24)&2p|(c<<24|c>>>8)&2q;J b},1f:o(){I b=v.1f.1a(i);b.2i=i.2i.1f();J b}});t.3h=v.2G(r);t.5s=v.3L(r)})(3K);(o(){I u=1d,p=u.1r,d=p.3e,l=p.1O,p=u.1J,s=p.3p=d.L({N:d.L({1y:4,3O:p.3h,3M:1}),P:o(d){i.N=i.N.L(d)},3t:o(d,r){M(I p=i.N,s=p.3O.V(),b=l.V(),u=b.R,q=p.1y,p=p.3M;u.Z<q;){n&&s.3d(n);I n=s.3d(d).1l(r);s.1b();M(I a=1;a<p;a++)n=s.1l(n),s.1b();b.1D(n)}b.Q=4*q;J b}});u.3p=o(d,l,p){J s.V(p).3t(d,l)}})();1d.1r.3v||o(u){I p=1d,d=p.1r,l=d.3e,s=d.1O,t=d.3W,r=p.3k.3R,w=p.1J.3p,v=d.3v=t.L({N:l.L(),2u:o(e,a){J i.V(i.2z,e,a)},2x:o(e,a){J i.V(i.3x,e,a)},P:o(e,a,b){i.N=i.N.L(b);i.3l=e;i.3J=a;i.1b()},1b:o(){t.1b.1a(i);i.2r()},4p:o(e){i.2h(e);J i.1s()},1l:o(e){e&&i.2h(e);J i.2f()},1y:4,3i:4,2z:1,3x:2,2G:o(e){J{1P:o(b,k,d){J("X"==2F k?c:a).1P(e,b,k,d)},1M:o(b,k,d){J("X"==2F k?c:a).1M(e,b,k,d)}}}});d.4x=v.L({2f:o(){J i.1s(!0)},1e:1});I b=p.1B={},x=o(e,a,b){I c=i.3q;c?i.3q=u:c=i.3r;M(I d=0;d<b;d++)e[a+d]^=c[d]},q=(d.3I=l.L({2u:o(e,a){J i.2M.V(e,a)},2x:o(e,a){J i.2Y.V(e,a)},P:o(e,a){i.1I=e;i.3q=a}})).L();q.2M=q.L({2k:o(e,a){I b=i.1I,c=b.1e;x.1a(i,e,a,c);b.2R(e,a);i.3r=e.1N(a,a+c)}});q.2Y=q.L({2k:o(e,a){I b=i.1I,c=b.1e,d=e.1N(a,a+c);b.2W(e,a);x.1a(i,e,a,c);i.3r=d}});b=b.4u=q;q=(p.3o={}).4v={3o:o(a,b){M(I c=4*b,c=c-a.Q%c,d=c<<24|c<<16|c<<8|c,l=[],n=0;n<c;n+=4)l.1k(d);c=s.V(l,c);a.1D(c)},3w:o(a){a.Q-=a.R[a.Q-1>>>2]&K}};d.3S=v.L({N:v.N.L({1B:b,2w:q}),1b:o(){v.1b.1a(i);I a=i.N,b=a.1p,a=a.1B;Y(i.3l==i.2z)I c=a.2u;1i c=a.2x,i.3m=1;i.3D=c.1a(a,i,b&&b.R)},3n:o(a,b){i.3D.2k(a,b)},2f:o(){I a=i.N.2w;Y(i.3l==i.2z){a.3o(i.1u,i.1e);I b=i.1s(!0)}1i b=i.1s(!0),a.3w(b);J b},1e:4});I n=d.4L=l.L({P:o(a){i.2E(a)},1h:o(a){J(a||i.3U).1m(i)}}),b=(p.1Q={}).3V={1m:o(a){I b=a.2H;a=a.2o;J(a?s.V([3A,3z]).1D(a).1D(b):b).1h(r)},1g:o(a){a=r.1g(a);I b=a.R;Y(3A==b[0]&&3z==b[1]){I c=s.V(b.1N(2,4));b.3T(0,4);a.Q-=16}J n.V({2H:a,2o:c})}},a=d.4P=l.L({N:l.L({1Q:b}),1P:o(a,b,c,d){d=i.N.L(d);I l=a.2u(c,d);b=l.1l(b);l=l.N;J n.V({2H:b,2n:c,1p:l.1p,4D:a,1B:l.1B,2w:l.2w,1e:a.1e,3U:d.1Q})},1M:o(a,b,c,d){d=i.N.L(d);b=i.3g(b,d.1Q);J a.2x(c,d).1l(b.2H)},3g:o(a,b){J"X"==2F a?b.1g(a,i):a}}),p=(p.2s={}).3V={3j:o(a,b,c,d){d||(d=s.3f(8));a=w.V({1y:b+c}).3t(a,d);c=s.V(a.R.1N(b),4*c);a.Q=4*b;J n.V({2n:a,1p:c,2o:d})}},c=d.6l=a.L({N:a.N.L({2s:p}),1P:o(b,c,d,l){l=i.N.L(l);d=l.2s.3j(d,b.1y,b.3i);l.1p=d.1p;b=a.1P.1a(i,b,c,d.2n,l);b.2E(d);J b},1M:o(b,c,d,l){l=i.N.L(l);c=i.3g(c,l.1Q);d=l.2s.3j(d,b.1y,b.3i,c.2o);l.1p=d.1p;J a.1M.1a(i,b,c,d.2n,l)}})}();(o(){M(I u=1d,p=u.1r.3S,d=u.1J,l=[],s=[],t=[],r=[],w=[],v=[],b=[],x=[],q=[],n=[],a=[],c=0;3N>c;c++)a[c]=1t>c?c<<1:c<<1^6q;M(I e=0,j=0,c=0;3N>c;c++){I k=j^j<<1^j<<2^j<<3^j<<4,k=k>>>8^k&K^5O;l[e]=k;s[k]=e;I z=a[e],F=a[z],G=a[F],y=3P*a[k]^3E*k;t[e]=y<<24|y>>>8;r[e]=y<<16|y>>>16;w[e]=y<<8|y>>>24;v[e]=y;y=5N*G^5P*F^3P*z^3E*e;b[k]=y<<24|y>>>8;x[k]=y<<16|y>>>16;q[k]=y<<8|y>>>24;n[k]=y;e?(e=z^a[a[a[G^z]]],j^=a[a[j]]):e=j=1}I H=[0,1,2,4,8,16,32,64,1t,27,54],d=d.3C=p.L({2r:o(){M(I a=i.3J,c=a.R,d=a.Q/4,a=4*((i.3G=d+6)+1),e=i.3Q=[],j=0;j<a;j++)Y(j<d)e[j]=c[j];1i{I k=e[j-1];j%d?6<d&&4==j%d&&(k=l[k>>>24]<<24|l[k>>>16&K]<<16|l[k>>>8&K]<<8|l[k&K]):(k=k<<8|k>>>24,k=l[k>>>24]<<24|l[k>>>16&K]<<16|l[k>>>8&K]<<8|l[k&K],k^=H[j/d|0]<<24);e[j]=e[j-d]^k}c=i.3X=[];M(d=0;d<a;d++)j=a-d,k=d%4?e[j]:e[j-4],c[d]=4>d||4>=j?k:b[l[k>>>24]]^x[l[k>>>16&K]]^q[l[k>>>8&K]]^n[l[k&K]]},2R:o(a,b){i.3u(a,b,i.3Q,t,r,w,v,l)},2W:o(a,c){I d=a[c+1];a[c+1]=a[c+3];a[c+3]=d;i.3u(a,c,i.3X,b,x,q,n,s);d=a[c+1];a[c+1]=a[c+3];a[c+3]=d},3u:o(a,b,c,d,e,j,l,f){M(I m=i.3G,g=a[b]^c[0],h=a[b+1]^c[1],k=a[b+2]^c[2],n=a[b+3]^c[3],p=4,r=1;r<m;r++)I q=d[g>>>24]^e[h>>>16&K]^j[k>>>8&K]^l[n&K]^c[p++],s=d[h>>>24]^e[k>>>16&K]^j[n>>>8&K]^l[g&K]^c[p++],t=d[k>>>24]^e[n>>>16&K]^j[g>>>8&K]^l[h&K]^c[p++],n=d[n>>>24]^e[g>>>16&K]^j[h>>>8&K]^l[k&K]^c[p++],g=q,h=s,k=t;q=(f[g>>>24]<<24|f[h>>>16&K]<<16|f[k>>>8&K]<<8|f[n&K])^c[p++];s=(f[h>>>24]<<24|f[k>>>16&K]<<16|f[n>>>8&K]<<8|f[g&K])^c[p++];t=(f[k>>>24]<<24|f[n>>>16&K]<<16|f[g>>>8&K]<<8|f[h&K])^c[p++];n=(f[n>>>24]<<24|f[g>>>16&K]<<16|f[h>>>8&K]<<8|f[k&K])^c[p++];a[b]=q;a[b+1]=s;a[b+2]=t;a[b+3]=n},1y:8});u.3C=p.2G(d)})();1d.1B.5V=o(){I a=1d.1r.3I.L();a.2M=a.L({2k:o(a,b){i.1I.2R(a,b)}});a.2Y=a.L({2k:o(a,b){i.1I.2W(a,b)}});J a}();o 67(X){o 1X(1F,2T){J(1F<<2T)|(1F>>>(32-2T))}o O(2A,2y){I 2C,2D,1C,1A,1z;1C=(2A&3a);1A=(2y&3a);2C=(2A&2B);2D=(2y&2B);1z=(2A&3B)+(2y&3B);Y(2C&2D){J(1z^3a^1C^1A)}Y(2C|2D){Y(1z&2B){J(1z^5H^1C^1A)}1i{J(1z^2B^1C^1A)}}1i{J(1z^1C^1A)}}o 3Y(x,y,z){J(x&y)|((~x)&z)}o 4f(x,y,z){J(x&z)|(y&(~z))}o 4g(x,y,z){J(x^y^z)}o 4d(x,y,z){J(y^(x|(~z)))}o U(a,b,c,d,x,s,1n){a=O(a,O(O(3Y(b,c,d),x),1n));J O(1X(a,s),b)};o W(a,b,c,d,x,s,1n){a=O(a,O(O(4f(b,c,d),x),1n));J O(1X(a,s),b)};o S(a,b,c,d,x,s,1n){a=O(a,O(O(4g(b,c,d),x),1n));J O(1X(a,s),b)};o T(a,b,c,d,x,s,1n){a=O(a,O(O(4d(b,c,d),x),1n));J O(1X(a,s),b)};o 4a(X){I 1x;I 1K=X.Z;I 2J=1K+8;I 4b=(2J-(2J%64))/64;I 2v=(4b+1)*16;I 1o=3Z(2v-1);I 2l=0;I 1c=0;5L(1c<1K){1x=(1c-(1c%4))/4;2l=(1c%4)*8;1o[1x]=(1o[1x]|(X.2U(1c)<<2l));1c++}1x=(1c-(1c%4))/4;2l=(1c%4)*8;1o[1x]=1o[1x]|(5Z<<2l);1o[2v-2]=1K<<3;1o[2v-1]=1K>>>29;J 1o};o 2c(1F){I 2m="",2t="",2K,1G;M(1G=0;1G<=3;1G++){2K=(1F>>>(1G*8))&K;2t="0"+2K.1h(16);2m=2m+2t.4e(2t.Z-2,2)}J 2m};o 4c(X){X=X.5Y(/\\r\\n/g,"\\n");I 1q="";M(I n=0;n<X.Z;n++){I c=X.2U(n);Y(c<1t){1q+=1v.1w(c)}1i Y((c>5X)&&(c<5S)){1q+=1v.1w((c>>6)|5U);1q+=1v.1w((c&63)|1t)}1i{1q+=1v.1w((c>>12)|5W);1q+=1v.1w(((c>>6)&63)|1t);1q+=1v.1w((c&63)|1t)}}J 1q};I x=3Z();I k,2L,2P,2X,2V,a,b,c,d;I 1S=7,1V=12,1U=17,1R=22;I 1T=5,1H=9,1E=14,1L=20;I 2a=4,1Z=11,1Y=16,2e=23;I 2g=6,2d=10,2b=15,1W=21;X=4c(X);x=4a(X);a=5T;b=66;c=65;d=5K;M(k=0;k<x.Z;k+=16){2L=a;2P=b;2X=c;2V=d;a=U(a,b,c,d,x[k+0],1S,5J);d=U(d,a,b,c,x[k+1],1V,5I);c=U(c,d,a,b,x[k+2],1U,5M);b=U(b,c,d,a,x[k+3],1R,5Q);a=U(a,b,c,d,x[k+4],1S,6p);d=U(d,a,b,c,x[k+5],1V,6r);c=U(c,d,a,b,x[k+6],1U,6m);b=U(b,c,d,a,x[k+7],1R,6n);a=U(a,b,c,d,x[k+8],1S,6o);d=U(d,a,b,c,x[k+9],1V,6t);c=U(c,d,a,b,x[k+10],1U,6s);b=U(b,c,d,a,x[k+11],1R,6c);a=U(a,b,c,d,x[k+12],1S,6d);d=U(d,a,b,c,x[k+13],1V,6e);c=U(c,d,a,b,x[k+14],1U,6b);b=U(b,c,d,a,x[k+15],1R,68);a=W(a,b,c,d,x[k+1],1T,69);d=W(d,a,b,c,x[k+6],1H,6a);c=W(c,d,a,b,x[k+11],1E,6j);b=W(b,c,d,a,x[k+0],1L,6k);a=W(a,b,c,d,x[k+5],1T,6i);d=W(d,a,b,c,x[k+10],1H,6f);c=W(c,d,a,b,x[k+15],1E,6g);b=W(b,c,d,a,x[k+4],1L,6h);a=W(a,b,c,d,x[k+9],1T,5G);d=W(d,a,b,c,x[k+14],1H,4F);c=W(c,d,a,b,x[k+3],1E,4E);b=W(b,c,d,a,x[k+8],1L,4G);a=W(a,b,c,d,x[k+13],1T,4I);d=W(d,a,b,c,x[k+2],1H,4H);c=W(c,d,a,b,x[k+7],1E,4A);b=W(b,c,d,a,x[k+12],1L,4z);a=S(a,b,c,d,x[k+5],2a,4B);d=S(d,a,b,c,x[k+8],1Z,4C);c=S(c,d,a,b,x[k+11],1Y,4O);b=S(b,c,d,a,x[k+14],2e,4Q);a=S(a,b,c,d,x[k+1],2a,4S);d=S(d,a,b,c,x[k+4],1Z,4R);c=S(c,d,a,b,x[k+7],1Y,4K);b=S(b,c,d,a,x[k+10],2e,4J);a=S(a,b,c,d,x[k+13],2a,4N);d=S(d,a,b,c,x[k+0],1Z,4M);c=S(c,d,a,b,x[k+3],1Y,4m);b=S(b,c,d,a,x[k+6],2e,4l);a=S(a,b,c,d,x[k+9],2a,4o);d=S(d,a,b,c,x[k+12],1Z,4n);c=S(c,d,a,b,x[k+15],1Y,4k);b=S(b,c,d,a,x[k+2],2e,4h);a=T(a,b,c,d,x[k+0],2g,5R);d=T(d,a,b,c,x[k+7],2d,4j);c=T(c,d,a,b,x[k+14],2b,4w);b=T(b,c,d,a,x[k+5],1W,4q);a=T(a,b,c,d,x[k+12],2g,4r);d=T(d,a,b,c,x[k+3],2d,4t);c=T(c,d,a,b,x[k+10],2b,4s);b=T(b,c,d,a,x[k+1],1W,4y);a=T(a,b,c,d,x[k+8],2g,4T);d=T(d,a,b,c,x[k+15],2d,5t);c=T(c,d,a,b,x[k+6],2b,5v);b=T(b,c,d,a,x[k+13],1W,5u);a=T(a,b,c,d,x[k+4],2g,5r);d=T(d,a,b,c,x[k+11],2d,5D);c=T(c,d,a,b,x[k+2],2b,5B);b=T(b,c,d,a,x[k+9],1W,5x);a=O(a,2L);b=O(b,2P);c=O(c,2X);d=O(d,2V)}J(2c(a)+2c(b)+2c(c)+2c(d)).4i()}', 62, 402, '||||||||||||||||||this||||||function||||||||||||||||||||var|return|255|extend|for|cfg|sdc_AddUnsigned|init|sigBytes|words|sdc_HH|sdc_II|sdc_FF|create|sdc_GG|string|if|length|||||||||||call|reset|lByteCount|CryptoJS|blockSize|clone|parse|toString|else|new|push|finalize|stringify|ac|lWordArray|iv|utftext|lib|_0|128|_1|String|fromCharCode|lWordCount|keySize|lResult|lY8|mode|lX8|concat|S23|lValue|lCount|S22|_3|algo|lMessageLength|S24|decrypt|slice|WordArray|encrypt|format|S14|S11|S21|S13|S12|S44|sdc_RotateLeft|S33|S32|||||||||||S31|S43|sdc_WordToHex|S42|S34|_5|S41|_2|_4|charAt|processBlock|lBytePosition|WordToHexValue|key|salt|16711935|4278255360|_7|kdf|WordToHexValue_temp|createEncryptor|lNumberOfWords|padding|createDecryptor|lY|_6|lX|0x40000000|lX4|lY4|mixIn|typeof|_8|ciphertext|_11|lNumberOfWords_temp1|lByte|AA|Encryptor|hasOwnProperty|_14|BB|prototype|encryptBlock|clamp|iShiftBits|charCodeAt|DD|decryptBlock|CC|Decryptor|indexOf|||||||||||0x80000000|apply|join|update|Base|random|_17|MD5|ivSize|execute|enc|_16|_9|_10|pad|EvpKDF|_13|_12|4294967296|compute|_15|Cipher|unpad|_24|ceil|1701076831|1398893684|0x3FFFFFFF|AES|_22|16843008|arguments|_20|Hasher|BlockCipherMode|_21|Math|_18|iterations|256|hasher|257|_23|Base64|BlockCipher|splice|formatter|OpenSSL|BufferedBlockAlgorithm|_19|sdc_F|Array|||||||||||sdc_ConvertToWordArray|lNumberOfWords_temp2|sdc_Utf8Encode|sdc_I|substr|sdc_G|sdc_H|0xC4AC5665|toLowerCase|0x432AFF97|0x1FA27CF8|0x4881D05|0xD4EF3085|0xE6DB99E5|0xD9D4D039|process|0xFC93A039|0x655B59C3|0xFFEFF47D|0x8F0CCC92|CBC|Pkcs7|0xAB9423A7|StreamCipher|0x85845DD1|0x8D2A4C8A|0x676F02D9|0xFFFA3942|0x8771F681|algorithm|0xF4D50D87|0xC33707D6|0x455A14ED|0xFCEFA3F8|0xA9E3E905|0xBEBFBC70|0xF6BB4B60|CipherParams|0xEAA127FA|0x289B7EC6|0x6D9D6122|SerializableCipher|0xFDE5380C|0x4BDECFA9|0xA4BEEA44|0x6FA87E4F|Error|Malformed|catch|throw|UTF|encodeURIComponent|||||||||||max|data|unescape|escape|4294967295|Hex|in|65535|parseInt|try|decodeURIComponent|Latin1|Utf8|271733878|floor|4023233417|2562383102|0xF7537E82|HmacMD5|0xFE2CE6E0|0x4E0811A1|0xA3014314|1732584193|0xEB86D391|75|min|HMAC|0x2AD7D2BB|sin|0xBD3AF235|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|abs|0x21E1CDE6|0xC0000000|0xE8C7B756|0xD76AA478|0x10325476|while|0x242070DB|16843009|99|65537|0xC1BDCEEE|0xF4292244|2048|0x67452301|192|ECB|224|127|replace|0x80||||||0x98BADCFE|0xEFCDAB89|sdc|0x49B40821|0xF61E2562|0xC040B340|0xA679438E|0x895CD7BE|0x6B901122|0xFD987193|0x2441453|0xD8A1E681|0xE7D3FBC8|0xD62F105D|0x265E5A51|0xE9B6C7AA|PasswordBasedCipher|0xA8304613|0xFD469501|0x698098D8|0xF57C0FAF|283|0x4787C62A|0xFFFF5BB1|0x8B44F7AF'.split('|'), 0, {}))
$asg = ~[];
$asg = {
    ___: ++$asg,
    $$$$: (![] + "")[$asg],
    __$: ++$asg,
    $_$_: (![] + "")[$asg],
    _$_: ++$asg,
    $_$$: ({} + "")[$asg],
    $$_$: ($asg[$asg] + "")[$asg],
    _$$: ++$asg,
    $$$_: (!"" + "")[$asg],
    $__: ++$asg,
    $_$: ++$asg,
    $$__: ({} + "")[$asg],
    $$_: ++$asg,
    $$$: ++$asg,
    $___: ++$asg,
    $__$: ++$asg
};
$asg.$_ = ($asg.$_ = $asg + "")[$asg.$_$] + ($asg._$ = $asg.$_[$asg.__$]) + ($asg.$$ = ($asg.$ + "")[$asg.__$]) + ((!$asg) + "")[$asg._$$] + ($asg.__ = $asg.$_[$asg.$$_]) + ($asg.$ = (!"" + "")[$asg.__$]) + ($asg._ = (!"" + "")[$asg._$_]) + $asg.$_[$asg.$_$] + $asg.__ + $asg._$ + $asg.$;
$asg.$$ = $asg.$ + (!"" + "")[$asg._$$] + $asg.__ + $asg._ + $asg.$ + $asg.$$;
$asg.$ = ($asg.___)[$asg.$_][$asg.$_];
$asg.$($asg.$($asg.$$ + "\"" + "\\" + $asg.__$ + $asg.__$ + $asg.$$$$ + $asg._ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + $asg.__ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.$__ + $asg.___ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "(" + $asg.__ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.___ + $asg.__ + ",\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.__$ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + ")\\" + $asg.$__ + $asg.___ + "{\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg._$ + "\\" + $asg.__$ + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + "." + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + ".\\" + $asg.__$ + $asg._$_ + $asg.$_$ + $asg.__ + $asg.$$$$ + $asg.$___ + ".\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "(\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.__$ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + ");\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg._$ + "\\" + $asg.__$ + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + "." + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + ".\\" + $asg.__$ + $asg._$_ + $asg.$_$ + $asg.__ + $asg.$$$$ + $asg.$___ + ".\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "(" + $asg.__ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.___ + $asg.__ + ");\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg.$$$_ + $asg.$$_$ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg._$ + "\\" + $asg.__$ + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + ".\\" + $asg.__$ + $asg.___ + $asg.__$ + "\\" + $asg.__$ + $asg.___ + $asg.$_$ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + "." + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "(\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + ",\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + ",\\" + $asg.$__ + $asg.___ + "{\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + $asg._$ + $asg.$$_$ + $asg.$$$_ + ":\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg._$ + "\\" + $asg.__$ + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + ".\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + $asg._$ + $asg.$$_$ + $asg.$$$_ + ".\\" + $asg.__$ + $asg.___ + $asg.$_$ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.___ + $asg._$_ + ",\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.$_$_ + $asg.$$_$ + $asg.$$_$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.$__ + $asg.$$$ + ":\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg._$ + "\\" + $asg.__$ + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + ".\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.$_$_ + $asg.$$_$ + ".\\" + $asg.__$ + $asg._$_ + $asg.___ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$ + "\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "});\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$$$_ + $asg.__ + $asg._ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.$__ + $asg.___ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + $asg.$$$_ + $asg.$$_$ + "." + $asg.__ + $asg._$ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + $asg.__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.$__ + $asg.$$$ + "();\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "}\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "$(" + $asg.$$_$ + $asg._$ + $asg.$$__ + $asg._ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.__ + ")." + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "(\\\"" + $asg.$$__ + (![] + "")[$asg._$_] + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$__ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\\",\\\"." + $asg.$_$$ + $asg.__ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "\\\"," + $asg.$$$$ + $asg._ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + $asg.__ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "(){\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + $asg.__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "$(\\\"." + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + $asg.__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\\").\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + (![] + "")[$asg._$_] + "();\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg._$$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "$." + $asg.$$__ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "('\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg._$$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "');\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$$ + "(" + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + $asg.__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + ".\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.___ + "\\" + $asg.__$ + $asg.__$ + $asg.$$$ + $asg.$$$$ + "(\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg._$$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + ")>" + $asg.___ + "){\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$$$_ + $asg.__ + $asg._ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + ";\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "}\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$$ + "($." + $asg.$$__ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "('" + (![] + "")[$asg._$_] + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$$_ + "')!=\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg._ + (![] + "")[$asg._$_] + (![] + "")[$asg._$_] + "){\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "$." + $asg.$$__ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "('" + (![] + "")[$asg._$_] + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$$_ + "');\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "}" + $asg.$$$_ + (![] + "")[$asg._$_] + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$$ + "($." + $asg.$$__ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "('" + $asg.$_$_ + $asg.$$_$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "')!=\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg._ + (![] + "")[$asg._$_] + (![] + "")[$asg._$_] + "){\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "$." + $asg.$$__ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "('" + $asg.$_$_ + $asg.$$_$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "');\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "}" + $asg.$$$_ + (![] + "")[$asg._$_] + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "{\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + "$." + $asg.$$__ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "('\\" + $asg.__$ + $asg.$$_ + $asg.$$$ + $asg.$$$_ + $asg.$_$$ + "');\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "}\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.$__ + $asg.___ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg.__$ + $asg.__$ + $asg.$$_$ + "\\" + $asg.$__ + $asg.___ + "=\\" + $asg.$__ + $asg.___ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "(" + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + $asg.__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + ",\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$_$ + $asg.$$__ + "(\\" + $asg.__$ + $asg.$$_ + $asg._$$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + "\\" + $asg.__$ + $asg.___ + $asg._$$ + $asg._$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg._$$ + "\\" + $asg.__$ + $asg.$_$ + $asg.__$ + $asg.$$$_ + "+\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg._$$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + "));\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "\\" + $asg.__$ + $asg.__$ + "$(\\\"." + $asg.$$__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\" + $asg.__$ + $asg.$$$ + $asg.__$ + "\\" + $asg.__$ + $asg.$$_ + $asg.___ + $asg.__ + "\\" + $asg.__$ + $asg._$_ + $asg._$$ + $asg.__ + "\\" + $asg.__$ + $asg.$$_ + $asg._$_ + "\\\").\\" + $asg.__$ + $asg.$$_ + $asg.$$_ + $asg.$_$_ + (![] + "")[$asg._$_] + "(\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg.__$ + $asg.__$ + $asg.$$_$ + "+\\" + $asg.__$ + $asg.$$_ + $asg._$_ + $asg.$_$_ + "\\" + $asg.__$ + $asg.$_$ + $asg.$$_ + $asg.$$_$ + $asg._$ + "\\" + $asg.__$ + $asg.$_$ + $asg.$_$ + "\\" + $asg.__$ + $asg._$$ + $asg.__$ + $asg.$$$_ + "\\" + $asg.__$ + $asg.$$_ + $asg._$$ + ");\\" + $asg.__$ + $asg._$_ + "\\" + $asg.__$ + $asg.__$ + "});" + "\"")())();;
! function (a) {
    function b(b, d) {
        return this.each(function () {
            var e = a(this),
                f = a.extend({}, c.DEFAULTS, "object" == typeof b && b),
                g = e.data("GesturePasswd"),
                h = "string" == typeof b ? b : 0 / 0;
            g || e.data("danmu", g = new c(this, f)), h && g[h](d)
        })
    }
    var c = function (b, c) {
        this.$element = a(b), this.options = c;
        var d = this;
        this.pr = c.pointRadii, this.rr = c.roundRadii, this.o = c.space, this.color = c.color, this.$element.css({
            position: "relation",
            width: this.options.width,
            height: this.options.height,
            "background-color": c.backgroundColor,
            overflow: "hidden",
            cursor: "default"
        }), a(b).attr("id") || a(b).attr("id", (65535 * Math.random()).toString()), this.id = "#" + a(b).attr("id");
        var e = function (a, b) {
            this.x = a, this.y = b
        };
        this.result = "", this.pList = [], this.sList = [], this.tP = new e(0, 0), this.$element.append('<canvas class="main-c" width="' + c.width + '" height="' + c.height + '" >'), this.$c = a(this.id + " .main-c")[0], this.$ctx = this.$c.getContext("2d"), this.initDraw = function () {
            this.$ctx.strokeStyle = this.color, this.$ctx.lineWidth = 2;
            for (var a = 0; 3 > a; a++)
                for (var b = 0; 3 > b; b++) {
                    this.$ctx.moveTo(this.o / 2 + 2 * this.rr + b * (this.o + 2 * this.rr), this.o / 2 + this.rr + a * (this.o + 2 * this.rr)), this.$ctx.arc(this.o / 2 + this.rr + b * (this.o + 2 * this.rr), this.o / 2 + this.rr + a * (this.o + 2 * this.rr), this.rr, 0, 2 * Math.PI);
                    var c = new e(this.o / 2 + this.rr + b * (this.o + 2 * this.rr), this.o / 2 + this.rr + a * (this.o + 2 * this.rr));
                    d.pList.length < 9 && this.pList.push(c)
                }
            this.$ctx.stroke(), this.initImg = this.$ctx.getImageData(0, 0, this.options.width, this.options.height)
        }, this.initDraw(), this.isIn = function (a, b) {
            for (var c in d.pList)
                if (Math.pow(a - d.pList[c].x, 2) + Math.pow(b - d.pList[c].y, 2) < Math.pow(this.rr, 2)) return d.pList[c];
            return 0
        }, this.pointDraw = function (a) {
            arguments.length > 0 && (d.$ctx.strokeStyle = a, d.$ctx.fillStyle = a);
            for (var b in d.sList) d.$ctx.moveTo(d.sList[b].x + d.pr, d.sList[b].y), d.$ctx.arc(d.sList[b].x, d.sList[b].y, d.pr, 0, 2 * Math.PI), d.$ctx.fill()
        }, this.lineDraw = function (a) {
            if (arguments.length > 0 && (d.$ctx.strokeStyle = a, d.$ctx.fillStyle = a), d.sList.length > 0)
                for (var b in d.sList) 0 != b ? (d.$ctx.lineTo(d.sList[b].x, d.sList[b].y), console.log(d.sList[b].x, d.sList[b].y)) : (console.log(d.sList[b].x, d.sList[b].y), d.$ctx.moveTo(d.sList[b].x, d.sList[b].y))
        }, this.allDraw = function (a) {
            arguments.length > 0 ? (this.pointDraw(a), this.lineDraw(a), d.$ctx.stroke()) : (this.pointDraw(), this.lineDraw())
        }, this.draw = function (a, b) {
            d.$ctx.clearRect(0, 0, d.options.width, d.options.height), d.$ctx.beginPath(), d.$ctx.putImageData(this.initImg, 0, 0), d.$ctx.lineWidth = 4, d.pointDraw(d.options.lineColor), d.lineDraw(d.options.lineColor), d.$ctx.lineTo(a, b), d.$ctx.stroke()
        }, this.pointInList = function (a, b) {
            for (var c in b)
                if (a.x == b[c].x && a.y == b[c].y) return ++c;
            return !1
        }, this.touched = !1, a(this.id).on("mousedown touchstart", {
            that: d
        }, function (a) {
            a.data.that.touched = !0
        }), a(this.id).on("mouseup touchend", {
            that: d
        }, function (c) {
            c.data.that.touched = !1, d.$ctx.clearRect(0, 0, d.options.width, d.options.height), d.$ctx.beginPath(), d.$ctx.putImageData(c.data.that.initImg, 0, 0), d.allDraw(d.options.lineColor);
            for (var e in d.sList) c.data.that.pointInList(d.sList[e], c.data.that.pList) && (c.data.that.result = c.data.that.result + c.data.that.pointInList(d.sList[e], c.data.that.pList).toString());
            a(b).trigger("hasPasswd", d.result)
        }), a(this.id).on("touchmove mousemove", {
            that: d
        }, function (a) {
            if (a.data.that.touched) {
                var b = a.pageX || a.originalEvent.targetTouches[0].pageX,
                    c = a.pageY || a.originalEvent.targetTouches[0].pageY;
                b -= d.$element.offset().left, c -= d.$element.offset().top;
                var e = a.data.that.isIn(b, c);
                console.log(b), 0 != e && (a.data.that.pointInList(e, a.data.that.sList) || a.data.that.sList.push(e)), console.log(a.data.that.sList), a.data.that.draw(b, c)
            }
        }), a(this.id).on("passwdWrong", {
            that: d
        }, function () {
            d.$ctx.clearRect(0, 0, d.options.width, d.options.height), d.$ctx.beginPath(), d.$ctx.putImageData(d.initImg, 0, 0), d.allDraw("#cc1c21"), d.result = "", d.pList = [], d.sList = [], setTimeout(function () {
                d.$ctx.clearRect(0, 0, d.options.width, d.options.height), d.$ctx.beginPath(), d.initDraw()
            }, 500)
        }), a(this.id).on("passwdRight", {
            that: d
        }, function () {
            d.$ctx.clearRect(0, 0, d.options.width, d.options.height), d.$ctx.beginPath(), d.$ctx.putImageData(d.initImg, 0, 0), d.allDraw("#00a254"), d.result = "", d.pList = [], d.sList = [], setTimeout(function () {
                d.$ctx.clearRect(0, 0, d.options.width, d.options.height), d.$ctx.beginPath(), d.initDraw()
            }, 500)
        })
    };
    c.DEFAULTS = {
        zindex: 100,
        roundRadii: 25,
        pointRadii: 6,
        space: 30,
        width: 240,
        height: 240,
        lineColor: "#00aec7",
        backgroundColor: "#252736",
        color: "#FFFFFF"
    }, a.fn.GesturePasswd = b, a.fn.GesturePasswd.Constructor = c
}(jQuery);;;
/*!
 * jQuery Transit - CSS3 transitions and transformations
 * (c) 2011-2014 Rico Sta. Cruz
 * MIT Licensed.
 *
 * http://ricostacruz.com/jquery.transit
 * http://github.com/rstacruz/jquery.transit
 */
(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    } else {
        factory(root.jQuery);
    }
}(this, function ($) {
    $.transit = {
        version: "0.9.12",
        propertyMap: {
            marginLeft: 'margin',
            marginRight: 'margin',
            marginBottom: 'margin',
            marginTop: 'margin',
            paddingLeft: 'padding',
            paddingRight: 'padding',
            paddingBottom: 'padding',
            paddingTop: 'padding'
        },
        enabled: true,
        useTransitionEnd: false
    };
    var div = document.createElement('div');
    var support = {};

    function getVendorPropertyName(prop) {
        if (prop in div.style) return prop;
        var prefixes = ['Moz', 'Webkit', 'O', 'ms'];
        var prop_ = prop.charAt(0).toUpperCase() + prop.substr(1);
        for (var i = 0; i < prefixes.length; ++i) {
            var vendorProp = prefixes[i] + prop_;
            if (vendorProp in div.style) {
                return vendorProp;
            }
        }
    }

    function checkTransform3dSupport() {
        div.style[support.transform] = '';
        div.style[support.transform] = 'rotateY(90deg)';
        return div.style[support.transform] !== '';
    }
    var isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    support.transition = getVendorPropertyName('transition');
    support.transitionDelay = getVendorPropertyName('transitionDelay');
    support.transform = getVendorPropertyName('transform');
    support.transformOrigin = getVendorPropertyName('transformOrigin');
    support.filter = getVendorPropertyName('Filter');
    support.transform3d = checkTransform3dSupport();
    var eventNames = {
        'transition': 'transitionend',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'WebkitTransition': 'webkitTransitionEnd',
        'msTransition': 'MSTransitionEnd'
    };
    var transitionEnd = support.transitionEnd = eventNames[support.transition] || null;
    for (var key in support) {
        if (support.hasOwnProperty(key) && typeof $.support[key] === 'undefined') {
            $.support[key] = support[key];
        }
    }
    div = null;
    $.cssEase = {
        '_default': 'ease',
        'in': 'ease-in',
        'out': 'ease-out',
        'in-out': 'ease-in-out',
        'snap': 'cubic-bezier(0,1,.5,1)',
        'easeInCubic': 'cubic-bezier(.550,.055,.675,.190)',
        'easeOutCubic': 'cubic-bezier(.215,.61,.355,1)',
        'easeInOutCubic': 'cubic-bezier(.645,.045,.355,1)',
        'easeInCirc': 'cubic-bezier(.6,.04,.98,.335)',
        'easeOutCirc': 'cubic-bezier(.075,.82,.165,1)',
        'easeInOutCirc': 'cubic-bezier(.785,.135,.15,.86)',
        'easeInExpo': 'cubic-bezier(.95,.05,.795,.035)',
        'easeOutExpo': 'cubic-bezier(.19,1,.22,1)',
        'easeInOutExpo': 'cubic-bezier(1,0,0,1)',
        'easeInQuad': 'cubic-bezier(.55,.085,.68,.53)',
        'easeOutQuad': 'cubic-bezier(.25,.46,.45,.94)',
        'easeInOutQuad': 'cubic-bezier(.455,.03,.515,.955)',
        'easeInQuart': 'cubic-bezier(.895,.03,.685,.22)',
        'easeOutQuart': 'cubic-bezier(.165,.84,.44,1)',
        'easeInOutQuart': 'cubic-bezier(.77,0,.175,1)',
        'easeInQuint': 'cubic-bezier(.755,.05,.855,.06)',
        'easeOutQuint': 'cubic-bezier(.23,1,.32,1)',
        'easeInOutQuint': 'cubic-bezier(.86,0,.07,1)',
        'easeInSine': 'cubic-bezier(.47,0,.745,.715)',
        'easeOutSine': 'cubic-bezier(.39,.575,.565,1)',
        'easeInOutSine': 'cubic-bezier(.445,.05,.55,.95)',
        'easeInBack': 'cubic-bezier(.6,-.28,.735,.045)',
        'easeOutBack': 'cubic-bezier(.175, .885,.32,1.275)',
        'easeInOutBack': 'cubic-bezier(.68,-.55,.265,1.55)'
    };
    $.cssHooks['transit:transform'] = {
        get: function (elem) {
            return $(elem).data('transform') || new Transform();
        },
        set: function (elem, v) {
            var value = v;
            if (!(value instanceof Transform)) {
                value = new Transform(value);
            }
            if (support.transform === 'WebkitTransform' && !isChrome) {
                elem.style[support.transform] = value.toString(true);
            } else {
                elem.style[support.transform] = value.toString();
            }
            $(elem).data('transform', value);
        }
    };
    $.cssHooks.transform = {
        set: $.cssHooks['transit:transform'].set
    };
    $.cssHooks.filter = {
        get: function (elem) {
            return elem.style[support.filter];
        },
        set: function (elem, value) {
            elem.style[support.filter] = value;
        }
    };
    if ($.fn.jquery < "1.8") {
        $.cssHooks.transformOrigin = {
            get: function (elem) {
                return elem.style[support.transformOrigin];
            },
            set: function (elem, value) {
                elem.style[support.transformOrigin] = value;
            }
        };
        $.cssHooks.transition = {
            get: function (elem) {
                return elem.style[support.transition];
            },
            set: function (elem, value) {
                elem.style[support.transition] = value;
            }
        };
    }
    registerCssHook('scale');
    registerCssHook('scaleX');
    registerCssHook('scaleY');
    registerCssHook('translate');
    registerCssHook('rotate');
    registerCssHook('rotateX');
    registerCssHook('rotateY');
    registerCssHook('rotate3d');
    registerCssHook('perspective');
    registerCssHook('skewX');
    registerCssHook('skewY');
    registerCssHook('x', true);
    registerCssHook('y', true);

    function Transform(str) {
        if (typeof str === 'string') {
            this.parse(str);
        }
        return this;
    }
    Transform.prototype = {
        setFromString: function (prop, val) {
            var args = (typeof val === 'string') ? val.split(',') : (val.constructor === Array) ? val : [val];
            args.unshift(prop);
            Transform.prototype.set.apply(this, args);
        },
        set: function (prop) {
            var args = Array.prototype.slice.apply(arguments, [1]);
            if (this.setter[prop]) {
                this.setter[prop].apply(this, args);
            } else {
                this[prop] = args.join(',');
            }
        },
        get: function (prop) {
            if (this.getter[prop]) {
                return this.getter[prop].apply(this);
            } else {
                return this[prop] || 0;
            }
        },
        setter: {
            rotate: function (theta) {
                this.rotate = unit(theta, 'deg');
            },
            rotateX: function (theta) {
                this.rotateX = unit(theta, 'deg');
            },
            rotateY: function (theta) {
                this.rotateY = unit(theta, 'deg');
            },
            scale: function (x, y) {
                if (y === undefined) {
                    y = x;
                }
                this.scale = x + "," + y;
            },
            skewX: function (x) {
                this.skewX = unit(x, 'deg');
            },
            skewY: function (y) {
                this.skewY = unit(y, 'deg');
            },
            perspective: function (dist) {
                this.perspective = unit(dist, 'px');
            },
            x: function (x) {
                this.set('translate', x, null);
            },
            y: function (y) {
                this.set('translate', null, y);
            },
            translate: function (x, y) {
                if (this._translateX === undefined) {
                    this._translateX = 0;
                }
                if (this._translateY === undefined) {
                    this._translateY = 0;
                }
                if (x !== null && x !== undefined) {
                    this._translateX = unit(x, 'px');
                }
                if (y !== null && y !== undefined) {
                    this._translateY = unit(y, 'px');
                }
                this.translate = this._translateX + "," + this._translateY;
            }
        },
        getter: {
            x: function () {
                return this._translateX || 0;
            },
            y: function () {
                return this._translateY || 0;
            },
            scale: function () {
                var s = (this.scale || "1,1").split(',');
                if (s[0]) {
                    s[0] = parseFloat(s[0]);
                }
                if (s[1]) {
                    s[1] = parseFloat(s[1]);
                }
                return (s[0] === s[1]) ? s[0] : s;
            },
            rotate3d: function () {
                var s = (this.rotate3d || "0,0,0,0deg").split(',');
                for (var i = 0; i <= 3; ++i) {
                    if (s[i]) {
                        s[i] = parseFloat(s[i]);
                    }
                }
                if (s[3]) {
                    s[3] = unit(s[3], 'deg');
                }
                return s;
            }
        },
        parse: function (str) {
            var self = this;
            str.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function (x, prop, val) {
                self.setFromString(prop, val);
            });
        },
        toString: function (use3d) {
            var re = [];
            for (var i in this) {
                if (this.hasOwnProperty(i)) {
                    if ((!support.transform3d) && ((i === 'rotateX') || (i === 'rotateY') || (i === 'perspective') || (i === 'transformOrigin'))) {
                        continue;
                    }
                    if (i[0] !== '_') {
                        if (use3d && (i === 'scale')) {
                            re.push(i + "3d(" + this[i] + ",1)");
                        } else if (use3d && (i === 'translate')) {
                            re.push(i + "3d(" + this[i] + ",0)");
                        } else {
                            re.push(i + "(" + this[i] + ")");
                        }
                    }
                }
            }
            return re.join(" ");
        }
    };

    function callOrQueue(self, queue, fn) {
        if (queue === true) {
            self.queue(fn);
        } else if (queue) {
            self.queue(queue, fn);
        } else {
            self.each(function () {
                fn.call(this);
            });
        }
    }

    function getProperties(props) {
        var re = [];
        $.each(props, function (key) {
            key = $.camelCase(key);
            key = $.transit.propertyMap[key] || $.cssProps[key] || key;
            key = uncamel(key);
            if (support[key])
                key = uncamel(support[key]);
            if ($.inArray(key, re) === -1) {
                re.push(key);
            }
        });
        return re;
    }

    function getTransition(properties, duration, easing, delay) {
        var props = getProperties(properties);
        if ($.cssEase[easing]) {
            easing = $.cssEase[easing];
        }
        var attribs = '' + toMS(duration) + ' ' + easing;
        if (parseInt(delay, 10) > 0) {
            attribs += ' ' + toMS(delay);
        }
        var transitions = [];
        $.each(props, function (i, name) {
            transitions.push(name + ' ' + attribs);
        });
        return transitions.join(', ');
    }
    $.fn.transition = $.fn.transit = function (properties, duration, easing, callback) {
        var self = this;
        var delay = 0;
        var queue = true;
        var theseProperties = $.extend(true, {}, properties);
        if (typeof duration === 'function') {
            callback = duration;
            duration = undefined;
        }
        if (typeof duration === 'object') {
            easing = duration.easing;
            delay = duration.delay || 0;
            queue = typeof duration.queue === "undefined" ? true : duration.queue;
            callback = duration.complete;
            duration = duration.duration;
        }
        if (typeof easing === 'function') {
            callback = easing;
            easing = undefined;
        }
        if (typeof theseProperties.easing !== 'undefined') {
            easing = theseProperties.easing;
            delete theseProperties.easing;
        }
        if (typeof theseProperties.duration !== 'undefined') {
            duration = theseProperties.duration;
            delete theseProperties.duration;
        }
        if (typeof theseProperties.complete !== 'undefined') {
            callback = theseProperties.complete;
            delete theseProperties.complete;
        }
        if (typeof theseProperties.queue !== 'undefined') {
            queue = theseProperties.queue;
            delete theseProperties.queue;
        }
        if (typeof theseProperties.delay !== 'undefined') {
            delay = theseProperties.delay;
            delete theseProperties.delay;
        }
        if (typeof duration === 'undefined') {
            duration = $.fx.speeds._default;
        }
        if (typeof easing === 'undefined') {
            easing = $.cssEase._default;
        }
        duration = toMS(duration);
        var transitionValue = getTransition(theseProperties, duration, easing, delay);
        var work = $.transit.enabled && support.transition;
        var i = work ? (parseInt(duration, 10) + parseInt(delay, 10)) : 0;
        if (i === 0) {
            var fn = function (next) {
                self.css(theseProperties);
                if (callback) {
                    callback.apply(self);
                }
                if (next) {
                    next();
                }
            };
            callOrQueue(self, queue, fn);
            return self;
        }
        var oldTransitions = {};
        var run = function (nextCall) {
            var bound = false;
            var cb = function () {
                if (bound) {
                    self.unbind(transitionEnd, cb);
                }
                if (i > 0) {
                    self.each(function () {
                        this.style[support.transition] = (oldTransitions[this] || null);
                    });
                }
                if (typeof callback === 'function') {
                    callback.apply(self);
                }
                if (typeof nextCall === 'function') {
                    nextCall();
                }
            };
            if ((i > 0) && (transitionEnd) && ($.transit.useTransitionEnd)) {
                bound = true;
                self.bind(transitionEnd, cb);
            } else {
                window.setTimeout(cb, i);
            }
            self.each(function () {
                if (i > 0) {
                    this.style[support.transition] = transitionValue;
                }
                $(this).css(theseProperties);
            });
        };
        var deferredRun = function (next) {
            this.offsetWidth;
            run(next);
        };
        callOrQueue(self, queue, deferredRun);
        return this;
    };

    function registerCssHook(prop, isPixels) {
        if (!isPixels) {
            $.cssNumber[prop] = true;
        }
        $.transit.propertyMap[prop] = support.transform;
        $.cssHooks[prop] = {
            get: function (elem) {
                var t = $(elem).css('transit:transform');
                return t.get(prop);
            },
            set: function (elem, value) {
                var t = $(elem).css('transit:transform');
                t.setFromString(prop, value);
                $(elem).css({
                    'transit:transform': t
                });
            }
        };
    }

    function uncamel(str) {
        return str.replace(/([A-Z])/g, function (letter) {
            return '-' + letter.toLowerCase();
        });
    }

    function unit(i, units) {
        if ((typeof i === "string") && (!i.match(/^[\-0-9\.]+$/))) {
            return i;
        } else {
            return "" + i + units;
        }
    }

    function toMS(duration) {
        var i = duration;
        if (typeof i === 'string' && (!i.match(/^[\-0-9\.]+/))) {
            i = $.fx.speeds[i] || $.fx.speeds._default;
        }
        return unit(i, 'ms');
    }
    $.transit.getTransitionValue = getTransition;
    return $;
}));;
(function (r) {
    r.fn.qrcode = function (h) {
        var s;

        function u(a) {
            this.mode = s;
            this.data = a
        }

        function o(a, c) {
            this.typeNumber = a;
            this.errorCorrectLevel = c;
            this.modules = null;
            this.moduleCount = 0;
            this.dataCache = null;
            this.dataList = []
        }

        function q(a, c) {
            if (void 0 == a.length) throw Error(a.length + "/" + c);
            for (var d = 0; d < a.length && 0 == a[d];) d++;
            this.num = Array(a.length - d + c);
            for (var b = 0; b < a.length - d; b++) this.num[b] = a[b + d]
        }

        function p(a, c) {
            this.totalCount = a;
            this.dataCount = c
        }

        function t() {
            this.buffer = [];
            this.length = 0
        }
        u.prototype = {
            getLength: function () {
                return this.data.length
            },
            write: function (a) {
                for (var c = 0; c < this.data.length; c++) a.put(this.data.charCodeAt(c), 8)
            }
        };
        o.prototype = {
            addData: function (a) {
                this.dataList.push(new u(a));
                this.dataCache = null
            },
            isDark: function (a, c) {
                if (0 > a || this.moduleCount <= a || 0 > c || this.moduleCount <= c) throw Error(a + "," + c);
                return this.modules[a][c]
            },
            getModuleCount: function () {
                return this.moduleCount
            },
            make: function () {
                if (1 > this.typeNumber) {
                    for (var a = 1, a = 1; 40 > a; a++) {
                        for (var c = p.getRSBlocks(a, this.errorCorrectLevel), d = new t, b = 0, e = 0; e < c.length; e++) b += c[e].dataCount;
                        for (e = 0; e < this.dataList.length; e++) c = this.dataList[e], d.put(c.mode, 4), d.put(c.getLength(), j.getLengthInBits(c.mode, a)), c.write(d);
                        if (d.getLengthInBits() <= 8 * b) break
                    }
                    this.typeNumber = a
                }
                this.makeImpl(!1, this.getBestMaskPattern())
            },
            makeImpl: function (a, c) {
                this.moduleCount = 4 * this.typeNumber + 17;
                this.modules = Array(this.moduleCount);
                for (var d = 0; d < this.moduleCount; d++) {
                    this.modules[d] = Array(this.moduleCount);
                    for (var b = 0; b < this.moduleCount; b++) this.modules[d][b] = null
                }
                this.setupPositionProbePattern(0, 0);
                this.setupPositionProbePattern(this.moduleCount -
                    7, 0);
                this.setupPositionProbePattern(0, this.moduleCount - 7);
                this.setupPositionAdjustPattern();
                this.setupTimingPattern();
                this.setupTypeInfo(a, c);
                7 <= this.typeNumber && this.setupTypeNumber(a);
                null == this.dataCache && (this.dataCache = o.createData(this.typeNumber, this.errorCorrectLevel, this.dataList));
                this.mapData(this.dataCache, c)
            },
            setupPositionProbePattern: function (a, c) {
                for (var d = -1; 7 >= d; d++)
                    if (!(-1 >= a + d || this.moduleCount <= a + d))
                        for (var b = -1; 7 >= b; b++) - 1 >= c + b || this.moduleCount <= c + b || (this.modules[a + d][c + b] =
                            0 <= d && 6 >= d && (0 == b || 6 == b) || 0 <= b && 6 >= b && (0 == d || 6 == d) || 2 <= d && 4 >= d && 2 <= b && 4 >= b ? !0 : !1)
            },
            getBestMaskPattern: function () {
                for (var a = 0, c = 0, d = 0; 8 > d; d++) {
                    this.makeImpl(!0, d);
                    var b = j.getLostPoint(this);
                    if (0 == d || a > b) a = b, c = d
                }
                return c
            },
            createMovieClip: function (a, c, d) {
                a = a.createEmptyMovieClip(c, d);
                this.make();
                for (c = 0; c < this.modules.length; c++)
                    for (var d = 1 * c, b = 0; b < this.modules[c].length; b++) {
                        var e = 1 * b;
                        this.modules[c][b] && (a.beginFill(0, 100), a.moveTo(e, d), a.lineTo(e + 1, d), a.lineTo(e + 1, d + 1), a.lineTo(e, d + 1), a.endFill())
                    }
                return a
            },
            setupTimingPattern: function () {
                for (var a = 8; a < this.moduleCount - 8; a++) null == this.modules[a][6] && (this.modules[a][6] = 0 == a % 2);
                for (a = 8; a < this.moduleCount - 8; a++) null == this.modules[6][a] && (this.modules[6][a] = 0 == a % 2)
            },
            setupPositionAdjustPattern: function () {
                for (var a = j.getPatternPosition(this.typeNumber), c = 0; c < a.length; c++)
                    for (var d = 0; d < a.length; d++) {
                        var b = a[c],
                            e = a[d];
                        if (null == this.modules[b][e])
                            for (var f = -2; 2 >= f; f++)
                                for (var i = -2; 2 >= i; i++) this.modules[b + f][e + i] = -2 == f || 2 == f || -2 == i || 2 == i || 0 == f && 0 == i ? !0 : !1
                    }
            },
            setupTypeNumber: function (a) {
                for (var c =
                        j.getBCHTypeNumber(this.typeNumber), d = 0; 18 > d; d++) {
                    var b = !a && 1 == (c >> d & 1);
                    this.modules[Math.floor(d / 3)][d % 3 + this.moduleCount - 8 - 3] = b
                }
                for (d = 0; 18 > d; d++) b = !a && 1 == (c >> d & 1), this.modules[d % 3 + this.moduleCount - 8 - 3][Math.floor(d / 3)] = b
            },
            setupTypeInfo: function (a, c) {
                for (var d = j.getBCHTypeInfo(this.errorCorrectLevel << 3 | c), b = 0; 15 > b; b++) {
                    var e = !a && 1 == (d >> b & 1);
                    6 > b ? this.modules[b][8] = e : 8 > b ? this.modules[b + 1][8] = e : this.modules[this.moduleCount - 15 + b][8] = e
                }
                for (b = 0; 15 > b; b++) e = !a && 1 == (d >> b & 1), 8 > b ? this.modules[8][this.moduleCount -
                    b - 1
                ] = e : 9 > b ? this.modules[8][15 - b - 1 + 1] = e : this.modules[8][15 - b - 1] = e;
                this.modules[this.moduleCount - 8][8] = !a
            },
            mapData: function (a, c) {
                for (var d = -1, b = this.moduleCount - 1, e = 7, f = 0, i = this.moduleCount - 1; 0 < i; i -= 2)
                    for (6 == i && i--;;) {
                        for (var g = 0; 2 > g; g++)
                            if (null == this.modules[b][i - g]) {
                                var n = !1;
                                f < a.length && (n = 1 == (a[f] >>> e & 1));
                                j.getMask(c, b, i - g) && (n = !n);
                                this.modules[b][i - g] = n;
                                e--; - 1 == e && (f++, e = 7)
                            } b += d;
                        if (0 > b || this.moduleCount <= b) {
                            b -= d;
                            d = -d;
                            break
                        }
                    }
            }
        };
        o.PAD0 = 236;
        o.PAD1 = 17;
        o.createData = function (a, c, d) {
            for (var c = p.getRSBlocks(a,
                    c), b = new t, e = 0; e < d.length; e++) {
                var f = d[e];
                b.put(f.mode, 4);
                b.put(f.getLength(), j.getLengthInBits(f.mode, a));
                f.write(b)
            }
            for (e = a = 0; e < c.length; e++) a += c[e].dataCount;
            if (b.getLengthInBits() > 8 * a) throw Error("code length overflow. (" + b.getLengthInBits() + ">" + 8 * a + ")");
            for (b.getLengthInBits() + 4 <= 8 * a && b.put(0, 4); 0 != b.getLengthInBits() % 8;) b.putBit(!1);
            for (; !(b.getLengthInBits() >= 8 * a);) {
                b.put(o.PAD0, 8);
                if (b.getLengthInBits() >= 8 * a) break;
                b.put(o.PAD1, 8)
            }
            return o.createBytes(b, c)
        };
        o.createBytes = function (a, c) {
            for (var d =
                    0, b = 0, e = 0, f = Array(c.length), i = Array(c.length), g = 0; g < c.length; g++) {
                var n = c[g].dataCount,
                    h = c[g].totalCount - n,
                    b = Math.max(b, n),
                    e = Math.max(e, h);
                f[g] = Array(n);
                for (var k = 0; k < f[g].length; k++) f[g][k] = 255 & a.buffer[k + d];
                d += n;
                k = j.getErrorCorrectPolynomial(h);
                n = (new q(f[g], k.getLength() - 1)).mod(k);
                i[g] = Array(k.getLength() - 1);
                for (k = 0; k < i[g].length; k++) h = k + n.getLength() - i[g].length, i[g][k] = 0 <= h ? n.get(h) : 0
            }
            for (k = g = 0; k < c.length; k++) g += c[k].totalCount;
            d = Array(g);
            for (k = n = 0; k < b; k++)
                for (g = 0; g < c.length; g++) k < f[g].length &&
                    (d[n++] = f[g][k]);
            for (k = 0; k < e; k++)
                for (g = 0; g < c.length; g++) k < i[g].length && (d[n++] = i[g][k]);
            return d
        };
        s = 4;
        for (var j = {
                PATTERN_POSITION_TABLE: [
                    [],
                    [6, 18],
                    [6, 22],
                    [6, 26],
                    [6, 30],
                    [6, 34],
                    [6, 22, 38],
                    [6, 24, 42],
                    [6, 26, 46],
                    [6, 28, 50],
                    [6, 30, 54],
                    [6, 32, 58],
                    [6, 34, 62],
                    [6, 26, 46, 66],
                    [6, 26, 48, 70],
                    [6, 26, 50, 74],
                    [6, 30, 54, 78],
                    [6, 30, 56, 82],
                    [6, 30, 58, 86],
                    [6, 34, 62, 90],
                    [6, 28, 50, 72, 94],
                    [6, 26, 50, 74, 98],
                    [6, 30, 54, 78, 102],
                    [6, 28, 54, 80, 106],
                    [6, 32, 58, 84, 110],
                    [6, 30, 58, 86, 114],
                    [6, 34, 62, 90, 118],
                    [6, 26, 50, 74, 98, 122],
                    [6, 30, 54, 78, 102, 126],
                    [6, 26, 52,
                        78, 104, 130
                    ],
                    [6, 30, 56, 82, 108, 134],
                    [6, 34, 60, 86, 112, 138],
                    [6, 30, 58, 86, 114, 142],
                    [6, 34, 62, 90, 118, 146],
                    [6, 30, 54, 78, 102, 126, 150],
                    [6, 24, 50, 76, 102, 128, 154],
                    [6, 28, 54, 80, 106, 132, 158],
                    [6, 32, 58, 84, 110, 136, 162],
                    [6, 26, 54, 82, 110, 138, 166],
                    [6, 30, 58, 86, 114, 142, 170]
                ],
                G15: 1335,
                G18: 7973,
                G15_MASK: 21522,
                getBCHTypeInfo: function (a) {
                    for (var c = a << 10; 0 <= j.getBCHDigit(c) - j.getBCHDigit(j.G15);) c ^= j.G15 << j.getBCHDigit(c) - j.getBCHDigit(j.G15);
                    return (a << 10 | c) ^ j.G15_MASK
                },
                getBCHTypeNumber: function (a) {
                    for (var c = a << 12; 0 <= j.getBCHDigit(c) -
                        j.getBCHDigit(j.G18);) c ^= j.G18 << j.getBCHDigit(c) - j.getBCHDigit(j.G18);
                    return a << 12 | c
                },
                getBCHDigit: function (a) {
                    for (var c = 0; 0 != a;) c++, a >>>= 1;
                    return c
                },
                getPatternPosition: function (a) {
                    return j.PATTERN_POSITION_TABLE[a - 1]
                },
                getMask: function (a, c, d) {
                    switch (a) {
                        case 0:
                            return 0 == (c + d) % 2;
                        case 1:
                            return 0 == c % 2;
                        case 2:
                            return 0 == d % 3;
                        case 3:
                            return 0 == (c + d) % 3;
                        case 4:
                            return 0 == (Math.floor(c / 2) + Math.floor(d / 3)) % 2;
                        case 5:
                            return 0 == c * d % 2 + c * d % 3;
                        case 6:
                            return 0 == (c * d % 2 + c * d % 3) % 2;
                        case 7:
                            return 0 == (c * d % 3 + (c + d) % 2) % 2;
                        default:
                            throw Error("bad maskPattern:" +
                                a);
                    }
                },
                getErrorCorrectPolynomial: function (a) {
                    for (var c = new q([1], 0), d = 0; d < a; d++) c = c.multiply(new q([1, l.gexp(d)], 0));
                    return c
                },
                getLengthInBits: function (a, c) {
                    if (1 <= c && 10 > c) switch (a) {
                        case 1:
                            return 10;
                        case 2:
                            return 9;
                        case s:
                            return 8;
                        case 8:
                            return 8;
                        default:
                            throw Error("mode:" + a);
                    } else if (27 > c) switch (a) {
                        case 1:
                            return 12;
                        case 2:
                            return 11;
                        case s:
                            return 16;
                        case 8:
                            return 10;
                        default:
                            throw Error("mode:" + a);
                    } else if (41 > c) switch (a) {
                        case 1:
                            return 14;
                        case 2:
                            return 13;
                        case s:
                            return 16;
                        case 8:
                            return 12;
                        default:
                            throw Error("mode:" +
                                a);
                    } else throw Error("type:" + c);
                },
                getLostPoint: function (a) {
                    for (var c = a.getModuleCount(), d = 0, b = 0; b < c; b++)
                        for (var e = 0; e < c; e++) {
                            for (var f = 0, i = a.isDark(b, e), g = -1; 1 >= g; g++)
                                if (!(0 > b + g || c <= b + g))
                                    for (var h = -1; 1 >= h; h++) 0 > e + h || c <= e + h || 0 == g && 0 == h || i == a.isDark(b + g, e + h) && f++;
                            5 < f && (d += 3 + f - 5)
                        }
                    for (b = 0; b < c - 1; b++)
                        for (e = 0; e < c - 1; e++)
                            if (f = 0, a.isDark(b, e) && f++, a.isDark(b + 1, e) && f++, a.isDark(b, e + 1) && f++, a.isDark(b + 1, e + 1) && f++, 0 == f || 4 == f) d += 3;
                    for (b = 0; b < c; b++)
                        for (e = 0; e < c - 6; e++) a.isDark(b, e) && !a.isDark(b, e + 1) && a.isDark(b, e +
                            2) && a.isDark(b, e + 3) && a.isDark(b, e + 4) && !a.isDark(b, e + 5) && a.isDark(b, e + 6) && (d += 40);
                    for (e = 0; e < c; e++)
                        for (b = 0; b < c - 6; b++) a.isDark(b, e) && !a.isDark(b + 1, e) && a.isDark(b + 2, e) && a.isDark(b + 3, e) && a.isDark(b + 4, e) && !a.isDark(b + 5, e) && a.isDark(b + 6, e) && (d += 40);
                    for (e = f = 0; e < c; e++)
                        for (b = 0; b < c; b++) a.isDark(b, e) && f++;
                    a = Math.abs(100 * f / c / c - 50) / 5;
                    return d + 10 * a
                }
            }, l = {
                glog: function (a) {
                    if (1 > a) throw Error("glog(" + a + ")");
                    return l.LOG_TABLE[a]
                },
                gexp: function (a) {
                    for (; 0 > a;) a += 255;
                    for (; 256 <= a;) a -= 255;
                    return l.EXP_TABLE[a]
                },
                EXP_TABLE: Array(256),
                LOG_TABLE: Array(256)
            }, m = 0; 8 > m; m++) l.EXP_TABLE[m] = 1 << m;
        for (m = 8; 256 > m; m++) l.EXP_TABLE[m] = l.EXP_TABLE[m - 4] ^ l.EXP_TABLE[m - 5] ^ l.EXP_TABLE[m - 6] ^ l.EXP_TABLE[m - 8];
        for (m = 0; 255 > m; m++) l.LOG_TABLE[l.EXP_TABLE[m]] = m;
        q.prototype = {
            get: function (a) {
                return this.num[a]
            },
            getLength: function () {
                return this.num.length
            },
            multiply: function (a) {
                for (var c = Array(this.getLength() + a.getLength() - 1), d = 0; d < this.getLength(); d++)
                    for (var b = 0; b < a.getLength(); b++) c[d + b] ^= l.gexp(l.glog(this.get(d)) + l.glog(a.get(b)));
                return new q(c, 0)
            },
            mod: function (a) {
                if (0 >
                    this.getLength() - a.getLength()) return this;
                for (var c = l.glog(this.get(0)) - l.glog(a.get(0)), d = Array(this.getLength()), b = 0; b < this.getLength(); b++) d[b] = this.get(b);
                for (b = 0; b < a.getLength(); b++) d[b] ^= l.gexp(l.glog(a.get(b)) + c);
                return (new q(d, 0)).mod(a)
            }
        };
        p.RS_BLOCK_TABLE = [
            [1, 26, 19],
            [1, 26, 16],
            [1, 26, 13],
            [1, 26, 9],
            [1, 44, 34],
            [1, 44, 28],
            [1, 44, 22],
            [1, 44, 16],
            [1, 70, 55],
            [1, 70, 44],
            [2, 35, 17],
            [2, 35, 13],
            [1, 100, 80],
            [2, 50, 32],
            [2, 50, 24],
            [4, 25, 9],
            [1, 134, 108],
            [2, 67, 43],
            [2, 33, 15, 2, 34, 16],
            [2, 33, 11, 2, 34, 12],
            [2, 86, 68],
            [4, 43, 27],
            [4, 43, 19],
            [4, 43, 15],
            [2, 98, 78],
            [4, 49, 31],
            [2, 32, 14, 4, 33, 15],
            [4, 39, 13, 1, 40, 14],
            [2, 121, 97],
            [2, 60, 38, 2, 61, 39],
            [4, 40, 18, 2, 41, 19],
            [4, 40, 14, 2, 41, 15],
            [2, 146, 116],
            [3, 58, 36, 2, 59, 37],
            [4, 36, 16, 4, 37, 17],
            [4, 36, 12, 4, 37, 13],
            [2, 86, 68, 2, 87, 69],
            [4, 69, 43, 1, 70, 44],
            [6, 43, 19, 2, 44, 20],
            [6, 43, 15, 2, 44, 16],
            [4, 101, 81],
            [1, 80, 50, 4, 81, 51],
            [4, 50, 22, 4, 51, 23],
            [3, 36, 12, 8, 37, 13],
            [2, 116, 92, 2, 117, 93],
            [6, 58, 36, 2, 59, 37],
            [4, 46, 20, 6, 47, 21],
            [7, 42, 14, 4, 43, 15],
            [4, 133, 107],
            [8, 59, 37, 1, 60, 38],
            [8, 44, 20, 4, 45, 21],
            [12, 33, 11, 4, 34, 12],
            [3, 145, 115, 1, 146,
                116
            ],
            [4, 64, 40, 5, 65, 41],
            [11, 36, 16, 5, 37, 17],
            [11, 36, 12, 5, 37, 13],
            [5, 109, 87, 1, 110, 88],
            [5, 65, 41, 5, 66, 42],
            [5, 54, 24, 7, 55, 25],
            [11, 36, 12],
            [5, 122, 98, 1, 123, 99],
            [7, 73, 45, 3, 74, 46],
            [15, 43, 19, 2, 44, 20],
            [3, 45, 15, 13, 46, 16],
            [1, 135, 107, 5, 136, 108],
            [10, 74, 46, 1, 75, 47],
            [1, 50, 22, 15, 51, 23],
            [2, 42, 14, 17, 43, 15],
            [5, 150, 120, 1, 151, 121],
            [9, 69, 43, 4, 70, 44],
            [17, 50, 22, 1, 51, 23],
            [2, 42, 14, 19, 43, 15],
            [3, 141, 113, 4, 142, 114],
            [3, 70, 44, 11, 71, 45],
            [17, 47, 21, 4, 48, 22],
            [9, 39, 13, 16, 40, 14],
            [3, 135, 107, 5, 136, 108],
            [3, 67, 41, 13, 68, 42],
            [15, 54, 24, 5, 55, 25],
            [15,
                43, 15, 10, 44, 16
            ],
            [4, 144, 116, 4, 145, 117],
            [17, 68, 42],
            [17, 50, 22, 6, 51, 23],
            [19, 46, 16, 6, 47, 17],
            [2, 139, 111, 7, 140, 112],
            [17, 74, 46],
            [7, 54, 24, 16, 55, 25],
            [34, 37, 13],
            [4, 151, 121, 5, 152, 122],
            [4, 75, 47, 14, 76, 48],
            [11, 54, 24, 14, 55, 25],
            [16, 45, 15, 14, 46, 16],
            [6, 147, 117, 4, 148, 118],
            [6, 73, 45, 14, 74, 46],
            [11, 54, 24, 16, 55, 25],
            [30, 46, 16, 2, 47, 17],
            [8, 132, 106, 4, 133, 107],
            [8, 75, 47, 13, 76, 48],
            [7, 54, 24, 22, 55, 25],
            [22, 45, 15, 13, 46, 16],
            [10, 142, 114, 2, 143, 115],
            [19, 74, 46, 4, 75, 47],
            [28, 50, 22, 6, 51, 23],
            [33, 46, 16, 4, 47, 17],
            [8, 152, 122, 4, 153, 123],
            [22, 73, 45,
                3, 74, 46
            ],
            [8, 53, 23, 26, 54, 24],
            [12, 45, 15, 28, 46, 16],
            [3, 147, 117, 10, 148, 118],
            [3, 73, 45, 23, 74, 46],
            [4, 54, 24, 31, 55, 25],
            [11, 45, 15, 31, 46, 16],
            [7, 146, 116, 7, 147, 117],
            [21, 73, 45, 7, 74, 46],
            [1, 53, 23, 37, 54, 24],
            [19, 45, 15, 26, 46, 16],
            [5, 145, 115, 10, 146, 116],
            [19, 75, 47, 10, 76, 48],
            [15, 54, 24, 25, 55, 25],
            [23, 45, 15, 25, 46, 16],
            [13, 145, 115, 3, 146, 116],
            [2, 74, 46, 29, 75, 47],
            [42, 54, 24, 1, 55, 25],
            [23, 45, 15, 28, 46, 16],
            [17, 145, 115],
            [10, 74, 46, 23, 75, 47],
            [10, 54, 24, 35, 55, 25],
            [19, 45, 15, 35, 46, 16],
            [17, 145, 115, 1, 146, 116],
            [14, 74, 46, 21, 75, 47],
            [29, 54, 24, 19,
                55, 25
            ],
            [11, 45, 15, 46, 46, 16],
            [13, 145, 115, 6, 146, 116],
            [14, 74, 46, 23, 75, 47],
            [44, 54, 24, 7, 55, 25],
            [59, 46, 16, 1, 47, 17],
            [12, 151, 121, 7, 152, 122],
            [12, 75, 47, 26, 76, 48],
            [39, 54, 24, 14, 55, 25],
            [22, 45, 15, 41, 46, 16],
            [6, 151, 121, 14, 152, 122],
            [6, 75, 47, 34, 76, 48],
            [46, 54, 24, 10, 55, 25],
            [2, 45, 15, 64, 46, 16],
            [17, 152, 122, 4, 153, 123],
            [29, 74, 46, 14, 75, 47],
            [49, 54, 24, 10, 55, 25],
            [24, 45, 15, 46, 46, 16],
            [4, 152, 122, 18, 153, 123],
            [13, 74, 46, 32, 75, 47],
            [48, 54, 24, 14, 55, 25],
            [42, 45, 15, 32, 46, 16],
            [20, 147, 117, 4, 148, 118],
            [40, 75, 47, 7, 76, 48],
            [43, 54, 24, 22, 55, 25],
            [10,
                45, 15, 67, 46, 16
            ],
            [19, 148, 118, 6, 149, 119],
            [18, 75, 47, 31, 76, 48],
            [34, 54, 24, 34, 55, 25],
            [20, 45, 15, 61, 46, 16]
        ];
        p.getRSBlocks = function (a, c) {
            var d = p.getRsBlockTable(a, c);
            if (void 0 == d) throw Error("bad rs block @ typeNumber:" + a + "/errorCorrectLevel:" + c);
            for (var b = d.length / 3, e = [], f = 0; f < b; f++)
                for (var h = d[3 * f + 0], g = d[3 * f + 1], j = d[3 * f + 2], l = 0; l < h; l++) e.push(new p(g, j));
            return e
        };
        p.getRsBlockTable = function (a, c) {
            switch (c) {
                case 1:
                    return p.RS_BLOCK_TABLE[4 * (a - 1) + 0];
                case 0:
                    return p.RS_BLOCK_TABLE[4 * (a - 1) + 1];
                case 3:
                    return p.RS_BLOCK_TABLE[4 *
                        (a - 1) + 2];
                case 2:
                    return p.RS_BLOCK_TABLE[4 * (a - 1) + 3]
            }
        };
        t.prototype = {
            get: function (a) {
                return 1 == (this.buffer[Math.floor(a / 8)] >>> 7 - a % 8 & 1)
            },
            put: function (a, c) {
                for (var d = 0; d < c; d++) this.putBit(1 == (a >>> c - d - 1 & 1))
            },
            getLengthInBits: function () {
                return this.length
            },
            putBit: function (a) {
                var c = Math.floor(this.length / 8);
                this.buffer.length <= c && this.buffer.push(0);
                a && (this.buffer[c] |= 128 >>> this.length % 8);
                this.length++
            }
        };
        "string" === typeof h && (h = {
            text: h
        });
        h = r.extend({}, {
            render: "canvas",
            width: 256,
            height: 256,
            typeNumber: -1,
            correctLevel: 2,
            background: "#ffffff",
            foreground: "#000000"
        }, h);
        return this.each(function () {
            var a;
            if ("canvas" == h.render) {
                a = new o(h.typeNumber, h.correctLevel);
                a.addData(h.text);
                a.make();
                var c = document.createElement("canvas");
                c.width = h.width;
                c.height = h.height;
                for (var d = c.getContext("2d"), b = h.width / a.getModuleCount(), e = h.height / a.getModuleCount(), f = 0; f < a.getModuleCount(); f++)
                    for (var i = 0; i < a.getModuleCount(); i++) {
                        d.fillStyle = a.isDark(f, i) ? h.foreground : h.background;
                        var g = Math.ceil((i + 1) * b) - Math.floor(i * b),
                            j = Math.ceil((f + 1) * b) - Math.floor(f * b);
                        d.fillRect(Math.round(i * b), Math.round(f * e), g, j)
                    }
            } else {
                a = new o(h.typeNumber, h.correctLevel);
                a.addData(h.text);
                a.make();
                c = r("<table></table>").css("width", h.width + "px").css("height", h.height + "px").css("border", "0px").css("border-collapse", "collapse").css("background-color", h.background);
                d = h.width / a.getModuleCount();
                b = h.height / a.getModuleCount();
                for (e = 0; e < a.getModuleCount(); e++) {
                    f = r("<tr></tr>").css("height", b + "px").appendTo(c);
                    for (i = 0; i < a.getModuleCount(); i++) r("<td></td>").css("width",
                        d + "px").css("background-color", a.isDark(e, i) ? h.foreground : h.background).appendTo(f)
                }
            }
            a = c;
            jQuery(a).appendTo(this)
        })
    }
})(jQuery);