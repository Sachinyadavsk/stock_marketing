/**
 * Minified by jsDelivr using Terser v5.3.5.
 * Original file: /npm/simple-datatables@3.0.2/dist/umd/simple-datatables.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
! function(t) {
  if ("object" == typeof exports && "undefined" != typeof module) module.exports = t();
  else if ("function" == typeof define && define.amd) define([], t);
  else {
    ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).simpleDatatables = t()
  }
}((function() {
  return function t(e, s, i) {
    function a(r, h) {
      if (!s[r]) {
        if (!e[r]) {
          var o = "function" == typeof require && require;
          if (!h && o) return o(r, !0);
          if (n) return n(r, !0);
          var l = new Error("Cannot find module '" + r + "'");
          throw l.code = "MODULE_NOT_FOUND", l
        }
        var d = s[r] = {
          exports: {}
        };
        e[r][0].call(d.exports, (function(t) {
          return a(e[r][1][t] || t)
        }), d, d.exports, t, e, s, i)
      }
      return s[r].exports
    }
    for (var n = "function" == typeof require && require, r = 0; r < i.length; r++) a(i[r]);
    return a
  }({
    1: [function(t, e, s) {
      (function(t) {
        (function() {
          "use strict";

          function e(t, e) {
            return t(e = {
              exports: {}
            }, e.exports), e.exports
          }
          "undefined" != typeof globalThis ? globalThis : "undefined" != typeof window ? window : void 0 !== t || "undefined" != typeof self && self;
          var i = e((function(t, e) {
              t.exports = function() {
                var t = "millisecond",
                  e = "second",
                  s = "minute",
                  i = "hour",
                  a = "day",
                  n = "week",
                  r = "month",
                  h = "quarter",
                  o = "year",
                  l = "date",
                  d = /^(\d{4})[-/]?(\d{1,2})?[-/]?(\d{0,2})[^0-9]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?[.:]?(\d+)?$/,
                  c = /\[([^\]]+)]|Y{1,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,
                  u = {
                    name: "en",
                    weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
                    months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_")
                  },
                  p = function(t, e, s) {
                    var i = String(t);
                    return !i || i.length >= e ? t : "" + Array(e + 1 - i.length).join(s) + t
                  },
                  f = {
                    s: p,
                    z: function(t) {
                      var e = -t.utcOffset(),
                        s = Math.abs(e),
                        i = Math.floor(s / 60),
                        a = s % 60;
                      return (e <= 0 ? "+" : "-") + p(i, 2, "0") + ":" + p(a, 2, "0")
                    },
                    m: function t(e, s) {
                      if (e.date() < s.date()) return -t(s, e);
                      var i = 12 * (s.year() - e.year()) + (s.month() - e.month()),
                        a = e.clone().add(i, r),
                        n = s - a < 0,
                        h = e.clone().add(i + (n ? -1 : 1), r);
                      return +(-(i + (s - a) / (n ? a - h : h - a)) || 0)
                    },
                    a: function(t) {
                      return t < 0 ? Math.ceil(t) || 0 : Math.floor(t)
                    },
                    p: function(d) {
                      return {
                        M: r,
                        y: o,
                        w: n,
                        d: a,
                        D: l,
                        h: i,
                        m: s,
                        s: e,
                        ms: t,
                        Q: h
                      } [d] || String(d || "").toLowerCase().replace(/s$/, "")
                    },
                    u: function(t) {
                      return void 0 === t
                    }
                  },
                  g = "en",
                  m = {};
                m[g] = u;
                var b = function(t) {
                    return t instanceof C
                  },
                  y = function(t, e, s) {
                    var i;
                    if (!t) return g;
                    if ("string" == typeof t) m[t] && (i = t), e && (m[t] = e, i = t);
                    else {
                      var a = t.name;
                      m[a] = t, i = a
                    }
                    return !s && i && (g = i), i || !s && g
                  },
                  v = function(t, e) {
                    if (b(t)) return t.clone();
                    var s = "object" == typeof e ? e : {};
                    return s.date = t, s.args = arguments, new C(s)
                  },
                  w = f;
                w.l = y, w.i = b, w.w = function(t, e) {
                  return v(t, {
                    locale: e.$L,
                    utc: e.$u,
                    x: e.$x,
                    $offset: e.$offset
                  })
                };
                var C = function() {
                    function u(t) {
                      this.$L = y(t.locale, null, !0), this.parse(t)
                    }
                    var p = u.prototype;
                    return p.parse = function(t) {
                      this.$d = function(t) {
                        var e = t.date,
                          s = t.utc;
                        if (null === e) return new Date(NaN);
                        if (w.u(e)) return new Date;
                        if (e instanceof Date) return new Date(e);
                        if ("string" == typeof e && !/Z$/i.test(e)) {
                          var i = e.match(d);
                          if (i) {
                            var a = i[2] - 1 || 0,
                              n = (i[7] || "0").substring(0, 3);
                            return s ? new Date(Date.UTC(i[1], a, i[3] || 1, i[4] || 0, i[5] || 0, i[6] || 0, n)) : new Date(i[1], a, i[3] || 1, i[4] || 0, i[5] || 0, i[6] || 0, n)
                          }
                        }
                        return new Date(e)
                      }(t), this.$x = t.x || {}, this.init()
                    }, p.init = function() {
                      var t = this.$d;
                      this.$y = t.getFullYear(), this.$M = t.getMonth(), this.$D = t.getDate(), this.$W = t.getDay(), this.$H = t.getHours(), this.$m = t.getMinutes(), this.$s = t.getSeconds(), this.$ms = t.getMilliseconds()
                    }, p.$utils = function() {
                      return w
                    }, p.isValid = function() {
                      return !("Invalid Date" === this.$d.toString())
                    }, p.isSame = function(t, e) {
                      var s = v(t);
                      return this.startOf(e) <= s && s <= this.endOf(e)
                    }, p.isAfter = function(t, e) {
                      return v(t) < this.startOf(e)
                    }, p.isBefore = function(t, e) {
                      return this.endOf(e) < v(t)
                    }, p.$g = function(t, e, s) {
                      return w.u(t) ? this[e] : this.set(s, t)
                    }, p.unix = function() {
                      return Math.floor(this.valueOf() / 1e3)
                    }, p.valueOf = function() {
                      return this.$d.getTime()
                    }, p.startOf = function(t, h) {
                      var d = this,
                        c = !!w.u(h) || h,
                        u = w.p(t),
                        p = function(t, e) {
                          var s = w.w(d.$u ? Date.UTC(d.$y, e, t) : new Date(d.$y, e, t), d);
                          return c ? s : s.endOf(a)
                        },
                        f = function(t, e) {
                          return w.w(d.toDate()[t].apply(d.toDate("s"), (c ? [0, 0, 0, 0] : [23, 59, 59, 999]).slice(e)), d)
                        },
                        g = this.$W,
                        m = this.$M,
                        b = this.$D,
                        y = "set" + (this.$u ? "UTC" : "");
                      switch (u) {
                        case o:
                          return c ? p(1, 0) : p(31, 11);
                        case r:
                          return c ? p(1, m) : p(0, m + 1);
                        case n:
                          var v = this.$locale().weekStart || 0,
                            C = (g < v ? g + 7 : g) - v;
                          return p(c ? b - C : b + (6 - C), m);
                        case a:
                        case l:
                          return f(y + "Hours", 0);
                        case i:
                          return f(y + "Minutes", 1);
                        case s:
                          return f(y + "Seconds", 2);
                        case e:
                          return f(y + "Milliseconds", 3);
                        default:
                          return this.clone()
                      }
                    }, p.endOf = function(t) {
                      return this.startOf(t, !1)
                    }, p.$set = function(n, h) {
                      var d, c = w.p(n),
                        u = "set" + (this.$u ? "UTC" : ""),
                        p = (d = {}, d[a] = u + "Date", d[l] = u + "Date", d[r] = u + "Month", d[o] = u + "FullYear", d[i] = u + "Hours", d[s] = u + "Minutes", d[e] = u + "Seconds", d[t] = u + "Milliseconds", d)[c],
                        f = c === a ? this.$D + (h - this.$W) : h;
                      if (c === r || c === o) {
                        var g = this.clone().set(l, 1);
                        g.$d[p](f), g.init(), this.$d = g.set(l, Math.min(this.$D, g.daysInMonth())).$d
                      } else p && this.$d[p](f);
                      return this.init(), this
                    }, p.set = function(t, e) {
                      return this.clone().$set(t, e)
                    }, p.get = function(t) {
                      return this[w.p(t)]()
                    }, p.add = function(t, h) {
                      var l, d = this;
                      t = Number(t);
                      var c = w.p(h),
                        u = function(e) {
                          var s = v(d);
                          return w.w(s.date(s.date() + Math.round(e * t)), d)
                        };
                      if (c === r) return this.set(r, this.$M + t);
                      if (c === o) return this.set(o, this.$y + t);
                      if (c === a) return u(1);
                      if (c === n) return u(7);
                      var p = (l = {}, l[s] = 6e4, l[i] = 36e5, l[e] = 1e3, l)[c] || 1,
                        f = this.$d.getTime() + t * p;
                      return w.w(f, this)
                    }, p.subtract = function(t, e) {
                      return this.add(-1 * t, e)
                    }, p.format = function(t) {
                      var e = this;
                      if (!this.isValid()) return "Invalid Date";
                      var s = t || "YYYY-MM-DDTHH:mm:ssZ",
                        i = w.z(this),
                        a = this.$locale(),
                        n = this.$H,
                        r = this.$m,
                        h = this.$M,
                        o = a.weekdays,
                        l = a.months,
                        d = function(t, i, a, n) {
                          return t && (t[i] || t(e, s)) || a[i].substr(0, n)
                        },
                        u = function(t) {
                          return w.s(n % 12 || 12, t, "0")
                        },
                        p = a.meridiem || function(t, e, s) {
                          var i = t < 12 ? "AM" : "PM";
                          return s ? i.toLowerCase() : i
                        },
                        f = {
                          YY: String(this.$y).slice(-2),
                          YYYY: this.$y,
                          M: h + 1,
                          MM: w.s(h + 1, 2, "0"),
                          MMM: d(a.monthsShort, h, l, 3),
                          MMMM: d(l, h),
                          D: this.$D,
                          DD: w.s(this.$D, 2, "0"),
                          d: String(this.$W),
                          dd: d(a.weekdaysMin, this.$W, o, 2),
                          ddd: d(a.weekdaysShort, this.$W, o, 3),
                          dddd: o[this.$W],
                          H: String(n),
                          HH: w.s(n, 2, "0"),
                          h: u(1),
                          hh: u(2),
                          a: p(n, r, !0),
                          A: p(n, r, !1),
                          m: String(r),
                          mm: w.s(r, 2, "0"),
                          s: String(this.$s),
                          ss: w.s(this.$s, 2, "0"),
                          SSS: w.s(this.$ms, 3, "0"),
                          Z: i
                        };
                      return s.replace(c, (function(t, e) {
                        return e || f[t] || i.replace(":", "")
                      }))
                    }, p.utcOffset = function() {
                      return 15 * -Math.round(this.$d.getTimezoneOffset() / 15)
                    }, p.diff = function(t, l, d) {
                      var c, u = w.p(l),
                        p = v(t),
                        f = 6e4 * (p.utcOffset() - this.utcOffset()),
                        g = this - p,
                        m = w.m(this, p);
                      return m = (c = {}, c[o] = m / 12, c[r] = m, c[h] = m / 3, c[n] = (g - f) / 6048e5, c[a] = (g - f) / 864e5, c[i] = g / 36e5, c[s] = g / 6e4, c[e] = g / 1e3, c)[u] || g, d ? m : w.a(m)
                    }, p.daysInMonth = function() {
                      return this.endOf(r).$D
                    }, p.$locale = function() {
                      return m[this.$L]
                    }, p.locale = function(t, e) {
                      if (!t) return this.$L;
                      var s = this.clone(),
                        i = y(t, e, !0);
                      return i && (s.$L = i), s
                    }, p.clone = function() {
                      return w.w(this.$d, this)
                    }, p.toDate = function() {
                      return new Date(this.valueOf())
                    }, p.toJSON = function() {
                      return this.isValid() ? this.toISOString() : null
                    }, p.toISOString = function() {
                      return this.$d.toISOString()
                    }, p.toString = function() {
                      return this.$d.toUTCString()
                    }, u
                  }(),
                  x = C.prototype;
                return v.prototype = x, [
                  ["$ms", t],
                  ["$s", e],
                  ["$m", s],
                  ["$H", i],
                  ["$W", a],
                  ["$M", r],
                  ["$y", o],
                  ["$D", l]
                ].forEach((function(t) {
                  x[t[1]] = function(e) {
                    return this.$g(e, t[0], t[1])
                  }
                })), v.extend = function(t, e) {
                  return t.$i || (t(e, C, v), t.$i = !0), v
                }, v.locale = y, v.isDayjs = b, v.unix = function(t) {
                  return v(1e3 * t)
                }, v.en = m[g], v.Ls = m, v.p = {}, v
              }()
            })),
            a = e((function(t, e) {
              var s, i, a, n, r, h, o, l, d, c, u, p, f;
              t.exports = (s = {
                LTS: "h:mm:ss A",
                LT: "h:mm A",
                L: "MM/DD/YYYY",
                LL: "MMMM D, YYYY",
                LLL: "MMMM D, YYYY h:mm A",
                LLLL: "dddd, MMMM D, YYYY h:mm A"
              }, i = function(t, e) {
                return t.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g, (function(t, i, a) {
                  var n = a && a.toUpperCase();
                  return i || e[a] || s[a] || e[n].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g, (function(t, e, s) {
                    return e || s.slice(1)
                  }))
                }))
              }, a = /(\[[^[]*\])|([-:/.()\s]+)|(A|a|YYYY|YY?|MM?M?M?|Do|DD?|hh?|HH?|mm?|ss?|S{1,3}|z|ZZ?)/g, o = {}, d = [/[+-]\d\d:?(\d\d)?/, function(t) {
                (this.zone || (this.zone = {})).offset = function(t) {
                  if (!t) return 0;
                  var e = t.match(/([+-]|\d\d)/g),
                    s = 60 * e[1] + (+e[2] || 0);
                  return 0 === s ? 0 : "+" === e[0] ? -s : s
                }(t)
              }], c = function(t) {
                var e = o[t];
                return e && (e.indexOf ? e : e.s.concat(e.f))
              }, u = function(t, e) {
                var s, i = o.meridiem;
                if (i) {
                  for (var a = 1; a <= 24; a += 1)
                    if (t.indexOf(i(a, 0, e)) > -1) {
                      s = a > 12;
                      break
                    }
                } else s = t === (e ? "pm" : "PM");
                return s
              }, p = {
                A: [h = /\d*[^\s\d-:/()]+/, function(t) {
                  this.afternoon = u(t, !1)
                }],
                a: [h, function(t) {
                  this.afternoon = u(t, !0)
                }],
                S: [/\d/, function(t) {
                  this.milliseconds = 100 * +t
                }],
                SS: [n = /\d\d/, function(t) {
                  this.milliseconds = 10 * +t
                }],
                SSS: [/\d{3}/, function(t) {
                  this.milliseconds = +t
                }],
                s: [r = /\d\d?/, (l = function(t) {
                  return function(e) {
                    this[t] = +e
                  }
                })("seconds")],
                ss: [r, l("seconds")],
                m: [r, l("minutes")],
                mm: [r, l("minutes")],
                H: [r, l("hours")],
                h: [r, l("hours")],
                HH: [r, l("hours")],
                hh: [r, l("hours")],
                D: [r, l("day")],
                DD: [n, l("day")],
                Do: [h, function(t) {
                  var e = o.ordinal,
                    s = t.match(/\d+/);
                  if (this.day = s[0], e)
                    for (var i = 1; i <= 31; i += 1) e(i).replace(/\[|\]/g, "") === t && (this.day = i)
                }],
                M: [r, l("month")],
                MM: [n, l("month")],
                MMM: [h, function(t) {
                  var e = c("months"),
                    s = (c("monthsShort") || e.map((function(t) {
                      return t.substr(0, 3)
                    }))).indexOf(t) + 1;
                  if (s < 1) throw new Error;
                  this.month = s % 12 || s
                }],
                MMMM: [h, function(t) {
                  var e = c("months").indexOf(t) + 1;
                  if (e < 1) throw new Error;
                  this.month = e % 12 || e
                }],
                Y: [/[+-]?\d+/, l("year")],
                YY: [n, function(t) {
                  t = +t, this.year = t + (t > 68 ? 1900 : 2e3)
                }],
                YYYY: [/\d{4}/, l("year")],
                Z: d,
                ZZ: d
              }, f = function(t, e, s) {
                try {
                  var n = function(t) {
                      for (var e = (t = i(t, o && o.formats)).match(a), s = e.length, n = 0; n < s; n += 1) {
                        var r = e[n],
                          h = p[r],
                          l = h && h[0],
                          d = h && h[1];
                        e[n] = d ? {
                          regex: l,
                          parser: d
                        } : r.replace(/^\[|\]$/g, "")
                      }
                      return function(t) {
                        for (var i = {}, a = 0, n = 0; a < s; a += 1) {
                          var r = e[a];
                          if ("string" == typeof r) n += r.length;
                          else {
                            var h = r.regex,
                              o = r.parser,
                              l = t.substr(n),
                              d = h.exec(l)[0];
                            o.call(i, d), t = t.replace(d, "")
                          }
                        }
                        return function(t) {
                          var e = t.afternoon;
                          if (void 0 !== e) {
                            var s = t.hours;
                            e ? s < 12 && (t.hours += 12) : 12 === s && (t.hours = 0), delete t.afternoon
                          }
                        }(i), i
                      }
                    }(e)(t),
                    r = n.year,
                    h = n.month,
                    l = n.day,
                    d = n.hours,
                    c = n.minutes,
                    u = n.seconds,
                    f = n.milliseconds,
                    g = n.zone,
                    m = new Date,
                    b = l || (r || h ? 1 : m.getDate()),
                    y = r || m.getFullYear(),
                    v = 0;
                  r && !h || (v = h > 0 ? h - 1 : m.getMonth());
                  var w = d || 0,
                    C = c || 0,
                    x = u || 0,
                    M = f || 0;
                  return g ? new Date(Date.UTC(y, v, b, w, C, x, M + 60 * g.offset * 1e3)) : s ? new Date(Date.UTC(y, v, b, w, C, x, M)) : new Date(y, v, b, w, C, x, M)
                } catch (t) {
                  return new Date("")
                }
              }, function(t, e, s) {
                s.p.customParseFormat = !0;
                var i = e.prototype,
                  a = i.parse;
                i.parse = function(t) {
                  var e = t.date,
                    i = t.utc,
                    n = t.args;
                  this.$u = i;
                  var r = n[1];
                  if ("string" == typeof r) {
                    var h = !0 === n[2],
                      l = !0 === n[3],
                      d = h || l,
                      c = n[2];
                    l && (c = n[2]), o = this.$locale(), !h && c && (o = s.Ls[c]), this.$d = f(e, r, i), this.init(), c && !0 !== c && (this.$L = this.locale(c).$L), d && e !== this.format(r) && (this.$d = new Date("")), o = {}
                  } else if (r instanceof Array)
                    for (var u = r.length, p = 1; p <= u; p += 1) {
                      n[1] = r[p - 1];
                      var g = s.apply(this, n);
                      if (g.isValid()) {
                        this.$d = g.$d, this.$L = g.$L, this.init();
                        break
                      }
                      p === u && (this.$d = new Date(""))
                    } else a.call(this, t)
                }
              })
            }));
          i.extend(a), s.parseDate = (t, e) => {
            let s = !1;
            if (e) switch (e) {
              case "ISO_8601":
                s = t;
                break;
              case "RFC_2822":
                s = i(t, "ddd, MM MMM YYYY HH:mm:ss ZZ").format("YYYYMMDD");
                break;
              case "MYSQL":
                s = i(t, "YYYY-MM-DD hh:mm:ss").format("YYYYMMDD");
                break;
              case "UNIX":
                s = i(t).unix();
                break;
              default:
                s = i(t, e).format("YYYYMMDD")
            }
            return s
          }
        }).call(this)
      }).call(this, "undefined" != typeof global ? global : "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
    }, {}],
    2: [function(t, e, s) {
      "use strict";
      Object.defineProperty(s, "__esModule", {
        value: !0
      });
      const i = t => "[object Object]" === Object.prototype.toString.call(t),
        a = (t, e) => {
          const s = document.createElement(t);
          if (e && "object" == typeof e)
            for (const t in e) "html" === t ? s.innerHTML = e[t] : s.setAttribute(t, e[t]);
          return s
        },
        n = t => {
          t instanceof NodeList ? t.forEach((t => n(t))) : t.innerHTML = ""
        },
        r = (t, e, s) => a("li", {
          class: t,
          html: `<a href="#" data-page="${e}">${s}</a>`
        }),
        h = (t, e) => {
          let s, i;
          1 === e ? (s = 0, i = t.length) : -1 === e && (s = t.length - 1, i = -1);
          for (let a = !0; a;) {
            a = !1;
            for (let n = s; n != i; n += e)
              if (t[n + e] && t[n].value > t[n + e].value) {
                const s = t[n],
                  i = t[n + e],
                  r = s;
                t[n] = i, t[n + e] = r, a = !0
              }
          }
          return t
        };
      class o {
        constructor(t, e) {
          return this.dt = t, this.rows = e, this
        }
        build(t) {
          const e = a("tr");
          let s = this.dt.headings;
          return s.length || (s = t.map((() => ""))), s.forEach(((s, i) => {
            const n = a("td");
            t[i] && t[i].length || (t[i] = ""), n.innerHTML = t[i], n.data = t[i], e.appendChild(n)
          })), e
        }
        render(t) {
          return t
        }
        add(t) {
          if (Array.isArray(t)) {
            const e = this.dt;
            Array.isArray(t[0]) ? t.forEach((t => {
              e.data.push(this.build(t))
            })) : e.data.push(this.build(t)), e.data.length && (e.hasRows = !0), this.update(), e.columns().rebuild()
          }
        }
        remove(t) {
          const e = this.dt;
          Array.isArray(t) ? (t.sort(((t, e) => e - t)), t.forEach((t => {
            e.data.splice(t, 1)
          }))) : "all" == t ? e.data = [] : e.data.splice(t, 1), e.data.length || (e.hasRows = !1), this.update(), e.columns().rebuild()
        }
        update() {
          this.dt.data.forEach(((t, e) => {
            t.dataIndex = e
          }))
        }
      }
      class l {
        constructor(t) {
          return this.dt = t, this
        }
        swap(t) {
          if (t.length && 2 === t.length) {
            const e = [];
            this.dt.headings.forEach(((t, s) => {
              e.push(s)
            }));
            const s = t[0],
              i = t[1],
              a = e[i];
            e[i] = e[s], e[s] = a, this.order(e)
          }
        }
        order(t) {
          let e, s, i, a, n, r, h;
          const o = [
              [],
              [],
              [],
              []
            ],
            l = this.dt;
          t.forEach(((t, i) => {
            n = l.headings[t], r = "false" !== n.getAttribute("data-sortable"), e = n.cloneNode(!0), e.originalCellIndex = i, e.sortable = r, o[0].push(e), l.hiddenColumns.includes(t) || (s = n.cloneNode(!0), s.originalCellIndex = i, s.sortable = r, o[1].push(s))
          })), l.data.forEach(((e, s) => {
            i = e.cloneNode(!1), a = e.cloneNode(!1), i.dataIndex = a.dataIndex = s, null !== e.searchIndex && void 0 !== e.searchIndex && (i.searchIndex = a.searchIndex = e.searchIndex), t.forEach((t => {
              h = e.cells[t].cloneNode(!0), h.data = e.cells[t].data, i.appendChild(h), l.hiddenColumns.includes(t) || (h = e.cells[t].cloneNode(!0), h.data = e.cells[t].data, a.appendChild(h))
            })), o[2].push(i), o[3].push(a)
          })), l.headings = o[0], l.activeHeadings = o[1], l.data = o[2], l.activeRows = o[3], l.update()
        }
        hide(t) {
          if (t.length) {
            const e = this.dt;
            t.forEach((t => {
              e.hiddenColumns.includes(t) || e.hiddenColumns.push(t)
            })), this.rebuild()
          }
        }
        show(t) {
          if (t.length) {
            let e;
            const s = this.dt;
            t.forEach((t => {
              e = s.hiddenColumns.indexOf(t), e > -1 && s.hiddenColumns.splice(e, 1)
            })), this.rebuild()
          }
        }
        visible(t) {
          let e;
          const s = this.dt;
          return t = t || s.headings.map((t => t.originalCellIndex)), isNaN(t) ? Array.isArray(t) && (e = [], t.forEach((t => {
            e.push(!s.hiddenColumns.includes(t))
          }))) : e = !s.hiddenColumns.includes(t), e
        }
        add(t) {
          let e;
          const s = document.createElement("th");
          if (!this.dt.headings.length) return this.dt.insert({
            headings: [t.heading],
            data: t.data.map((t => [t]))
          }), void this.rebuild();
          this.dt.hiddenHeader ? s.innerHTML = "" : t.heading.nodeName ? s.appendChild(t.heading) : s.innerHTML = t.heading, this.dt.headings.push(s), this.dt.data.forEach(((s, i) => {
            t.data[i] && (e = document.createElement("td"), t.data[i].nodeName ? e.appendChild(t.data[i]) : e.innerHTML = t.data[i], e.data = e.innerHTML, t.render && (e.innerHTML = t.render.call(this, e.data, e, s)), s.appendChild(e))
          })), t.type && s.setAttribute("data-type", t.type), t.format && s.setAttribute("data-format", t.format), t.hasOwnProperty("sortable") && (s.sortable = t.sortable, s.setAttribute("data-sortable", !0 === t.sortable ? "true" : "false")), this.rebuild(), this.dt.renderHeader()
        }
        remove(t) {
          Array.isArray(t) ? (t.sort(((t, e) => e - t)), t.forEach((t => this.remove(t)))) : (this.dt.headings.splice(t, 1), this.dt.data.forEach((e => {
            e.removeChild(e.cells[t])
          }))), this.rebuild()
        }
        filter(t, e, s, i) {
          const a = this.dt;
          if (a.filterState || (a.filterState = {
              originalData: a.data
            }), !a.filterState[t]) {
            const e = [...i, () => !0];
            a.filterState[t] = function() {
              let t = 0;
              return () => e[t++ % e.length]
            }()
          }
          const n = a.filterState[t](),
            r = Array.from(a.filterState.originalData).filter((e => {
              const s = e.cells[t],
                i = s.hasAttribute("data-content") ? s.getAttribute("data-content") : s.innerText;
              return "function" == typeof n ? n(i) : i === n
            }));
          a.data = r, this.rebuild(), a.update(), s || a.emit("datatable.sort", t, e)
        }
        sort(e, s, i) {
          const a = this.dt;
          if (a.hasHeadings && (e < 0 || e > a.headings.length)) return !1;
          const n = a.options.filters && a.options.filters[a.headings[e].textContent];
          if (n && 0 !== n.length) return void this.filter(e, s, i, n);
          a.sorting = !0, i || a.emit("datatable.sorting", e, s);
          let r = a.data;
          const o = [],
            l = [];
          let d = 0,
            c = 0;
          const u = a.headings[e],
            p = [];
          if ("date" === u.getAttribute("data-type")) {
            let e = !1;
            u.hasAttribute("data-format") && (e = u.getAttribute("data-format")), p.push(Promise.resolve().then((function() {
              return t("./date-cd1c23ce.js")
            })).then((({
              parseDate: t
            }) => s => t(s, e))))
          }
          Promise.all(p).then((t => {
            const n = t[0];
            let p, f;
            Array.from(r).forEach((t => {
              const s = t.cells[e],
                i = s.hasAttribute("data-content") ? s.getAttribute("data-content") : s.innerText;
              let a;
              a = n ? n(i) : "string" == typeof i ? i.replace(/(\$|,|\s|%)/g, "") : i, parseFloat(a) == a ? l[c++] = {
                value: Number(a),
                row: t
              } : o[d++] = {
                value: "string" == typeof i ? i.toLowerCase() : i,
                row: t
              }
            })), s || (s = u.classList.contains("asc") ? "desc" : "asc"), "desc" == s ? (p = h(o, -1), f = h(l, -1), u.classList.remove("asc"), u.classList.add("desc")) : (p = h(l, 1), f = h(o, 1), u.classList.remove("desc"), u.classList.add("asc")), a.lastTh && u != a.lastTh && (a.lastTh.classList.remove("desc"), a.lastTh.classList.remove("asc")), a.lastTh = u, r = p.concat(f), a.data = [];
            const g = [];
            r.forEach(((t, e) => {
              a.data.push(t.row), null !== t.row.searchIndex && void 0 !== t.row.searchIndex && g.push(e)
            })), a.searchData = g, this.rebuild(), a.update(), i || a.emit("datatable.sort", e, s)
          }))
        }
        rebuild() {
          let t, e, s, i;
          const a = this.dt,
            n = [];
          a.activeRows = [], a.activeHeadings = [], a.headings.forEach(((t, e) => {
            t.originalCellIndex = e, t.sortable = "false" !== t.getAttribute("data-sortable"), a.hiddenColumns.includes(e) || a.activeHeadings.push(t)
          })), a.data.forEach(((r, h) => {
            t = r.cloneNode(!1), e = r.cloneNode(!1), t.dataIndex = e.dataIndex = h, null !== r.searchIndex && void 0 !== r.searchIndex && (t.searchIndex = e.searchIndex = r.searchIndex), Array.from(r.cells).forEach((n => {
              s = n.cloneNode(!0), s.data = n.data, t.appendChild(s), a.hiddenColumns.includes(s.cellIndex) || (i = s.cloneNode(!0), i.data = s.data, e.appendChild(i))
            })), n.push(t), a.activeRows.push(e)
          })), a.data = n, a.update()
        }
      }
      const d = function(t) {
          let e = !1,
            s = !1;
          if ((t = t || this.options.data).headings) {
            e = a("thead");
            const s = a("tr");
            t.headings.forEach((t => {
              const e = a("th", {
                html: t
              });
              s.appendChild(e)
            })), e.appendChild(s)
          }
          t.data && t.data.length && (s = a("tbody"), t.data.forEach((e => {
            if (t.headings && t.headings.length !== e.length) throw new Error("The number of rows do not match the number of headings.");
            const i = a("tr");
            e.forEach((t => {
              const e = a("td", {
                html: t
              });
              i.appendChild(e)
            })), s.appendChild(i)
          }))), e && (null !== this.table.tHead && this.table.removeChild(this.table.tHead), this.table.appendChild(e)), s && (this.table.tBodies.length && this.table.removeChild(this.table.tBodies[0]), this.table.appendChild(s))
        },
        c = {
          sortable: !0,
          searchable: !0,
          paging: !0,
          perPage: 15,
          perPageSelect: [15],
          nextPrev: !0,
          firstLast: !1,
          prevText: "&lsaquo;",
          nextText: "&rsaquo;",
          firstText: "&laquo;",
          lastText: "&raquo;",
          ellipsisText: "&hellip;",
          ascText: "â–´",
          descText: "â–¾",
          truncatePager: !0,
          pagerDelta: 2,
          scrollY: "",
          fixedColumns: !0,
          fixedHeight: !1,
          header: !0,
          hiddenHeader: !1,
          footer: !1,
          labels: {
            placeholder: "Search...",
            perPage: "Show {select} entries",
            noRows: "No entries found",
            info: "Showing {start} to {end} of {rows} entries"
          },
          layout: {
            top: "{select}{search}",
            bottom: "{info}{pager}"
          }
        };
      class u {
        constructor(t, e = {}) {
          if (this.initialized = !1, this.options = {
              ...c,
              ...e,
              layout: {
                ...c.layout,
                ...e.layout
              },
              labels: {
                ...c.labels,
                ...e.labels
              }
            }, "string" == typeof t && (t = document.querySelector(t)), this.initialLayout = t.innerHTML, this.initialSortable = this.options.sortable, this.options.header || (this.options.sortable = !1), null === t.tHead && (!this.options.data || this.options.data && !this.options.data.headings) && (this.options.sortable = !1), t.tBodies.length && !t.tBodies[0].rows.length && this.options.data && !this.options.data.data) throw new Error("You seem to be using the data option, but you've not defined any rows.");
          this.table = t, this.listeners = {
            onResize: t => this.onResize(t)
          }, this.init()
        }
        static extend(t, e) {
          "function" == typeof e ? u.prototype[t] = e : u[t] = e
        }
        init(t) {
          if (this.initialized || this.table.classList.contains("dataTable-table")) return !1;
          Object.assign(this.options, t || {}), this.currentPage = 1, this.onFirstPage = !0, this.hiddenColumns = [], this.columnRenderers = [], this.selectedColumns = [], this.render(), setTimeout((() => {
            this.emit("datatable.init"), this.initialized = !0, this.options.plugins && Object.entries(this.options.plugins).forEach((([t, e]) => {
              this[t] && "function" == typeof this[t] && (this[t] = this[t](e, {
                createElement: a
              }), e.enabled && this[t].init && "function" == typeof this[t].init && this[t].init())
            }))
          }), 10)
        }
        render(t) {
          if (t) {
            switch (t) {
              case "page":
                this.renderPage();
                break;
              case "pager":
                this.renderPager();
                break;
              case "header":
                this.renderHeader()
            }
            return !1
          }
          const e = this.options;
          let s = "";
          if (e.data && d.call(this), this.body = this.table.tBodies[0], this.head = this.table.tHead, this.foot = this.table.tFoot, this.body || (this.body = a("tbody"), this.table.appendChild(this.body)), this.hasRows = this.body.rows.length > 0, !this.head) {
            const t = a("thead"),
              s = a("tr");
            this.hasRows && (Array.from(this.body.rows[0].cells).forEach((() => {
              s.appendChild(a("th"))
            })), t.appendChild(s)), this.head = t, this.table.insertBefore(this.head, this.body), this.hiddenHeader = e.hiddenHeader
          }
          if (this.headings = [], this.hasHeadings = this.head.rows.length > 0, this.hasHeadings && (this.header = this.head.rows[0], this.headings = [].slice.call(this.header.cells)), e.header || this.head && this.table.removeChild(this.table.tHead), e.footer ? this.head && !this.foot && (this.foot = a("tfoot", {
              html: this.head.innerHTML
            }), this.table.appendChild(this.foot)) : this.foot && this.table.removeChild(this.table.tFoot), this.wrapper = a("div", {
              class: "dataTable-wrapper dataTable-loading"
            }), s += "<div class='dataTable-top'>", s += e.layout.top, s += "</div>", e.scrollY.length ? s += `<div class='dataTable-container' style='height: ${e.scrollY}; overflow-Y: auto;'></div>` : s += "<div class='dataTable-container'></div>", s += "<div class='dataTable-bottom'>", s += e.layout.bottom, s += "</div>", s = s.replace("{info}", e.paging ? "<div class='dataTable-info'></div>" : ""), e.paging && e.perPageSelect) {
            let t = "<div class='dataTable-dropdown'><label>";
            t += e.labels.perPage, t += "</label></div>";
            const i = a("select", {
              class: "dataTable-selector"
            });
            e.perPageSelect.forEach((t => {
              const s = t === e.perPage,
                a = new Option(t, t, s, s);
              i.add(a)
            })), t = t.replace("{select}", i.outerHTML), s = s.replace("{select}", t)
          } else s = s.replace("{select}", "");
          if (e.searchable) {
            const t = `<div class='dataTable-search'><input class='dataTable-input' placeholder='${e.labels.placeholder}' type='text'></div>`;
            s = s.replace("{search}", t)
          } else s = s.replace("{search}", "");
          this.hasHeadings && this.render("header"), this.table.classList.add("dataTable-table");
          const i = a("nav", {
              class: "dataTable-pagination"
            }),
            n = a("ul", {
              class: "dataTable-pagination-list"
            });
          i.appendChild(n), s = s.replace(/\{pager\}/g, i.outerHTML), this.wrapper.innerHTML = s, this.container = this.wrapper.querySelector(".dataTable-container"), this.pagers = this.wrapper.querySelectorAll(".dataTable-pagination-list"), this.label = this.wrapper.querySelector(".dataTable-info"), this.table.parentNode.replaceChild(this.wrapper, this.table), this.container.appendChild(this.table), this.rect = this.table.getBoundingClientRect(), this.data = Array.from(this.body.rows), this.activeRows = this.data.slice(), this.activeHeadings = this.headings.slice(), this.update(), this.setColumns(), this.fixHeight(), this.fixColumns(), e.header || this.wrapper.classList.add("no-header"), e.footer || this.wrapper.classList.add("no-footer"), e.sortable && this.wrapper.classList.add("sortable"), e.searchable && this.wrapper.classList.add("searchable"), e.fixedHeight && this.wrapper.classList.add("fixed-height"), e.fixedColumns && this.wrapper.classList.add("fixed-columns"), this.bindEvents()
        }
        renderPage() {
          if (this.hasHeadings && (n(this.header), this.activeHeadings.forEach((t => this.header.appendChild(t)))), this.hasRows && this.totalPages) {
            this.currentPage > this.totalPages && (this.currentPage = 1);
            const t = this.currentPage - 1,
              e = document.createDocumentFragment();
            this.pages[t].forEach((t => e.appendChild(this.rows().render(t)))), this.clear(e), this.onFirstPage = 1 === this.currentPage, this.onLastPage = this.currentPage === this.lastPage
          } else this.setMessage(this.options.labels.noRows);
          let t, e = 0,
            s = 0,
            i = 0;
          if (this.totalPages && (e = this.currentPage - 1, s = e * this.options.perPage, i = s + this.pages[e].length, s += 1, t = this.searching ? this.searchData.length : this.data.length), this.label && this.options.labels.info.length) {
            const e = this.options.labels.info.replace("{start}", s).replace("{end}", i).replace("{page}", this.currentPage).replace("{pages}", this.totalPages).replace("{rows}", t);
            this.label.innerHTML = t ? e : ""
          }
          1 == this.currentPage && this.fixHeight()
        }
        renderPager() {
          if (n(this.pagers), this.totalPages > 1) {
            const t = "pager",
              e = document.createDocumentFragment(),
              s = this.onFirstPage ? 1 : this.currentPage - 1,
              i = this.onLastPage ? this.totalPages : this.currentPage + 1;
            this.options.firstLast && e.appendChild(r(t, 1, this.options.firstText)), this.options.nextPrev && e.appendChild(r(t, s, this.options.prevText));
            let n = this.links;
            this.options.truncatePager && (n = ((t, e, s, i, n) => {
              let r;
              const h = 2 * (i = i || 2);
              let o = e - i,
                l = e + i;
              const d = [],
                c = [];
              e < 4 - i + h ? l = 3 + h : e > s - (3 - i + h) && (o = s - (2 + h));
              for (let e = 1; e <= s; e++)
                if (1 == e || e == s || e >= o && e <= l) {
                  const s = t[e - 1];
                  s.classList.remove("active"), d.push(s)
                } return d.forEach((e => {
                const s = e.children[0].getAttribute("data-page");
                if (r) {
                  const e = r.children[0].getAttribute("data-page");
                  if (s - e == 2) c.push(t[e]);
                  else if (s - e != 1) {
                    const t = a("li", {
                      class: "ellipsis",
                      html: `<a href="#">${n}</a>`
                    });
                    c.push(t)
                  }
                }
                c.push(e), r = e
              })), c
            })(this.links, this.currentPage, this.pages.length, this.options.pagerDelta, this.options.ellipsisText)), this.links[this.currentPage - 1].classList.add("active"), n.forEach((t => {
              t.classList.remove("active"), e.appendChild(t)
            })), this.links[this.currentPage - 1].classList.add("active"), this.options.nextPrev && e.appendChild(r(t, i, this.options.nextText)), this.options.firstLast && e.appendChild(r(t, this.totalPages, this.options.lastText)), this.pagers.forEach((t => {
              t.appendChild(e.cloneNode(!0))
            }))
          }
        }
        renderHeader() {
          this.labels = [], this.headings && this.headings.length && this.headings.forEach(((t, e) => {
            if (this.labels[e] = t.textContent, t.firstElementChild && t.firstElementChild.classList.contains("dataTable-sorter") && (t.innerHTML = t.firstElementChild.innerHTML), t.sortable = "false" !== t.getAttribute("data-sortable"), t.originalCellIndex = e, this.options.sortable && t.sortable) {
              const e = a("a", {
                href: "#",
                class: "dataTable-sorter",
                html: t.innerHTML
              });
              t.innerHTML = "", t.setAttribute("data-sortable", ""), t.appendChild(e)
            }
          })), this.fixColumns()
        }
        bindEvents() {
          const t = this.options;
          if (t.perPageSelect) {
            const e = this.wrapper.querySelector(".dataTable-selector");
            e && e.addEventListener("change", (() => {
              t.perPage = parseInt(e.value, 10), this.update(), this.fixHeight(), this.emit("datatable.perpage", t.perPage)
            }), !1)
          }
          t.searchable && (this.input = this.wrapper.querySelector(".dataTable-input"), this.input && this.input.addEventListener("keyup", (() => this.search(this.input.value)), !1)), this.wrapper.addEventListener("click", (e => {
            const s = e.target.closest("a");
            s && "a" === s.nodeName.toLowerCase() && (s.hasAttribute("data-page") ? (this.page(s.getAttribute("data-page")), e.preventDefault()) : t.sortable && s.classList.contains("dataTable-sorter") && "false" != s.parentNode.getAttribute("data-sortable") && (this.columns().sort(this.headings.indexOf(s.parentNode)), e.preventDefault()))
          }), !1), window.addEventListener("resize", this.listeners.onResize)
        }
        onResize() {
          this.rect = this.container.getBoundingClientRect(), this.rect.width && this.fixColumns()
        }
        setColumns(t) {
          t || this.data.forEach((t => {
            Array.from(t.cells).forEach((t => {
              t.data = t.innerHTML
            }))
          })), this.options.columns && this.headings.length && this.options.columns.forEach((t => {
            Array.isArray(t.select) || (t.select = [t.select]), t.hasOwnProperty("render") && "function" == typeof t.render && (this.selectedColumns = this.selectedColumns.concat(t.select), this.columnRenderers.push({
              columns: t.select,
              renderer: t.render
            })), t.select.forEach((e => {
              const s = this.headings[e];
              t.type && s.setAttribute("data-type", t.type), t.format && s.setAttribute("data-format", t.format), t.hasOwnProperty("sortable") && s.setAttribute("data-sortable", t.sortable), t.hasOwnProperty("hidden") && !1 !== t.hidden && this.columns().hide([e]), t.hasOwnProperty("sort") && 1 === t.select.length && this.columns().sort(t.select[0], t.sort, !0)
            }))
          })), this.hasRows && (this.data.forEach(((t, e) => {
            t.dataIndex = e, Array.from(t.cells).forEach((t => {
              t.data = t.innerHTML
            }))
          })), this.selectedColumns.length && this.data.forEach((t => {
            Array.from(t.cells).forEach(((e, s) => {
              this.selectedColumns.includes(s) && this.columnRenderers.forEach((i => {
                i.columns.includes(s) && (e.innerHTML = i.renderer.call(this, e.data, e, t))
              }))
            }))
          })), this.columns().rebuild()), this.render("header")
        }
        destroy() {
          this.table.innerHTML = this.initialLayout, this.table.classList.remove("dataTable-table"), this.wrapper.parentNode.replaceChild(this.table, this.wrapper), this.initialized = !1, window.removeEventListener("resize", this.listeners.onResize)
        }
        update() {
          this.wrapper.classList.remove("dataTable-empty"), this.paginate(this), this.render("page"), this.links = [];
          let t = this.pages.length;
          for (; t--;) {
            const e = t + 1;
            this.links[t] = r(0 === t ? "active" : "", e, e)
          }
          this.sorting = !1, this.render("pager"), this.rows().update(), this.emit("datatable.update")
        }
        paginate() {
          const t = this.options.perPage;
          let e = this.activeRows;
          return this.searching && (e = [], this.searchData.forEach((t => e.push(this.activeRows[t])))), this.options.paging ? this.pages = e.map(((s, i) => i % t == 0 ? e.slice(i, i + t) : null)).filter((t => t)) : this.pages = [e], this.totalPages = this.lastPage = this.pages.length, this.totalPages
        }
        fixColumns() {
          if ((this.options.scrollY.length || this.options.fixedColumns) && this.activeHeadings && this.activeHeadings.length) {
            let t, e = !1;
            if (this.columnWidths = [], this.table.tHead) {
              if (this.options.scrollY.length && (e = a("thead"), e.appendChild(a("tr")), e.style.height = "0px", this.headerTable && (this.table.tHead = this.headerTable.tHead)), this.activeHeadings.forEach((t => {
                  t.style.width = ""
                })), this.activeHeadings.forEach(((t, s) => {
                  const i = t.offsetWidth,
                    n = i / this.rect.width * 100;
                  if (t.style.width = n + "%", this.columnWidths[s] = i, this.options.scrollY.length) {
                    const t = a("th");
                    e.firstElementChild.appendChild(t), t.style.width = n + "%", t.style.paddingTop = "0", t.style.paddingBottom = "0", t.style.border = "0"
                  }
                })), this.options.scrollY.length) {
                const t = this.table.parentElement;
                if (!this.headerTable) {
                  this.headerTable = a("table", {
                    class: "dataTable-table"
                  });
                  const e = a("div", {
                    class: "dataTable-headercontainer"
                  });
                  e.appendChild(this.headerTable), t.parentElement.insertBefore(e, t)
                }
                const s = this.table.tHead;
                this.table.replaceChild(e, s), this.headerTable.tHead = s, this.headerTable.parentElement.style.paddingRight = this.headerTable.clientWidth - this.table.clientWidth + parseInt(this.headerTable.parentElement.style.paddingRight || "0", 10) + "px", t.scrollHeight > t.clientHeight && (t.style.overflowY = "scroll")
              }
            } else {
              t = [], e = a("thead");
              const s = a("tr");
              Array.from(this.table.tBodies[0].rows[0].cells).forEach((() => {
                const e = a("th");
                s.appendChild(e), t.push(e)
              })), e.appendChild(s), this.table.insertBefore(e, this.body);
              const i = [];
              t.forEach(((t, e) => {
                const s = t.offsetWidth,
                  a = s / this.rect.width * 100;
                i.push(a), this.columnWidths[e] = s
              })), this.data.forEach((t => {
                Array.from(t.cells).forEach(((t, e) => {
                  this.columns(t.cellIndex).visible() && (t.style.width = i[e] + "%")
                }))
              })), this.table.removeChild(e)
            }
          }
        }
        fixHeight() {
          this.options.fixedHeight && (this.container.style.height = null, this.rect = this.container.getBoundingClientRect(), this.container.style.height = this.rect.height + "px")
        }
        search(t) {
          return !!this.hasRows && (t = t.toLowerCase(), this.currentPage = 1, this.searching = !0, this.searchData = [], t.length ? (this.clear(), this.data.forEach(((e, s) => {
            const i = this.searchData.includes(e);
            t.split(" ").reduce(((t, s) => {
              let i = !1,
                a = null,
                n = null;
              for (let t = 0; t < e.cells.length; t++)
                if (a = e.cells[t], n = a.hasAttribute("data-content") ? a.getAttribute("data-content") : a.textContent, n.toLowerCase().includes(s) && this.columns(a.cellIndex).visible()) {
                  i = !0;
                  break
                } return t && i
            }), !0) && !i ? (e.searchIndex = s, this.searchData.push(s)) : e.searchIndex = null
          })), this.wrapper.classList.add("search-results"), this.searchData.length ? this.update() : (this.wrapper.classList.remove("search-results"), this.setMessage(this.options.labels.noRows)), void this.emit("datatable.search", t, this.searchData)) : (this.searching = !1, this.update(), this.emit("datatable.search", t, this.searchData), this.wrapper.classList.remove("search-results"), !1))
        }
        page(t) {
          return t != this.currentPage && (isNaN(t) || (this.currentPage = parseInt(t, 10)), !(t > this.pages.length || t < 0) && (this.render("page"), this.render("pager"), void this.emit("datatable.page", t)))
        }
        sortColumn(t, e) {
          this.columns().sort(t, e)
        }
        insert(t) {
          let e = [];
          if (i(t)) {
            if (t.headings && !this.hasHeadings && !this.hasRows) {
              const e = a("tr");
              t.headings.forEach((t => {
                const s = a("th", {
                  html: t
                });
                e.appendChild(s)
              })), this.head.appendChild(e), this.header = e, this.headings = [].slice.call(e.cells), this.hasHeadings = !0, this.options.sortable = this.initialSortable, this.render("header"), this.activeHeadings = this.headings.slice()
            }
            t.data && Array.isArray(t.data) && (e = t.data)
          } else Array.isArray(t) && t.forEach((t => {
            const s = [];
            Object.entries(t).forEach((([t, e]) => {
              const i = this.labels.indexOf(t);
              i > -1 && (s[i] = e)
            })), e.push(s)
          }));
          e.length && (this.rows().add(e), this.hasRows = !0), this.update(), this.setColumns(), this.fixColumns()
        }
        refresh() {
          this.options.searchable && (this.input.value = "", this.searching = !1), this.currentPage = 1, this.onFirstPage = !0, this.update(), this.emit("datatable.refresh")
        }
        clear(t) {
          this.body && n(this.body);
          let e = this.body;
          this.body || (e = this.table), t && ("string" == typeof t && (document.createDocumentFragment().innerHTML = t), e.appendChild(t))
        }
        export (t) {
          if (!this.hasHeadings && !this.hasRows) return !1;
          const e = this.activeHeadings;
          let s = [];
          const a = [];
          let n, r, h, o;
          if (!i(t)) return !1;
          const l = {
            download: !0,
            skipColumn: [],
            lineDelimiter: "\n",
            columnDelimiter: ",",
            tableName: "myTable",
            replacer: null,
            space: 4,
            ...t
          };
          if (l.type) {
            if ("txt" !== l.type && "csv" !== l.type || (s[0] = this.header), l.selection)
              if (isNaN(l.selection)) {
                if (Array.isArray(l.selection))
                  for (n = 0; n < l.selection.length; n++) s = s.concat(this.pages[l.selection[n] - 1])
              } else s = s.concat(this.pages[l.selection - 1]);
            else s = s.concat(this.activeRows);
            if (s.length) {
              if ("txt" === l.type || "csv" === l.type) {
                for (h = "", n = 0; n < s.length; n++) {
                  for (r = 0; r < s[n].cells.length; r++)
                    if (!l.skipColumn.includes(e[r].originalCellIndex) && this.columns(e[r].originalCellIndex).visible()) {
                      let t = s[n].cells[r].textContent;
                      t = t.trim(), t = t.replace(/\s{2,}/g, " "), t = t.replace(/\n/g, "  "), t = t.replace(/"/g, '""'), t = t.replace(/#/g, "%23"), t.includes(",") && (t = `"${t}"`), h += t + l.columnDelimiter
                    } h = h.trim().substring(0, h.length - 1), h += l.lineDelimiter
                }
                h = h.trim().substring(0, h.length - 1), l.download && (h = "data:text/csv;charset=utf-8," + h)
              } else if ("sql" === l.type) {
                for (h = `INSERT INTO \`${l.tableName}\` (`, n = 0; n < e.length; n++) !l.skipColumn.includes(e[n].originalCellIndex) && this.columns(e[n].originalCellIndex).visible() && (h += `\`${e[n].textContent}\`,`);
                for (h = h.trim().substring(0, h.length - 1), h += ") VALUES ", n = 0; n < s.length; n++) {
                  for (h += "(", r = 0; r < s[n].cells.length; r++) !l.skipColumn.includes(e[r].originalCellIndex) && this.columns(e[r].originalCellIndex).visible() && (h += `"${s[n].cells[r].textContent}",`);
                  h = h.trim().substring(0, h.length - 1), h += "),"
                }
                h = h.trim().substring(0, h.length - 1), h += ";", l.download && (h = "data:application/sql;charset=utf-8," + h)
              } else if ("json" === l.type) {
                for (r = 0; r < s.length; r++)
                  for (a[r] = a[r] || {}, n = 0; n < e.length; n++) !l.skipColumn.includes(e[n].originalCellIndex) && this.columns(e[n].originalCellIndex).visible() && (a[r][e[n].textContent] = s[r].cells[n].textContent);
                h = JSON.stringify(a, l.replacer, l.space), l.download && (h = "data:application/json;charset=utf-8," + h)
              }
              return l.download && (l.filename = l.filename || "datatable_export", l.filename += "." + l.type, h = encodeURI(h), o = document.createElement("a"), o.href = h, o.download = l.filename, document.body.appendChild(o), o.click(), document.body.removeChild(o)), h
            }
          }
          return !1
        }
        import(t) {
          let e = !1;
          if (!i(t)) return !1;
          const s = {
            lineDelimiter: "\n",
            columnDelimiter: ",",
            ...t
          };
          if (s.data.length || i(s.data)) {
            if ("csv" === s.type) {
              e = {
                data: []
              };
              const t = s.data.split(s.lineDelimiter);
              t.length && (s.headings && (e.headings = t[0].split(s.columnDelimiter), t.shift()), t.forEach(((t, i) => {
                e.data[i] = [];
                const a = t.split(s.columnDelimiter);
                a.length && a.forEach((t => {
                  e.data[i].push(t)
                }))
              })))
            } else if ("json" === s.type) {
              const t = (t => {
                let e = !1;
                try {
                  e = JSON.parse(t)
                } catch (t) {
                  return !1
                }
                return !(null === e || !Array.isArray(e) && !i(e)) && e
              })(s.data);
              t && (e = {
                headings: [],
                data: []
              }, t.forEach(((t, s) => {
                e.data[s] = [], Object.entries(t).forEach((([t, i]) => {
                  e.headings.includes(t) || e.headings.push(t), e.data[s].push(i)
                }))
              })))
            }
            i(s.data) && (e = s.data), e && this.insert(e)
          }
          return !1
        }
        print() {
          const t = this.activeHeadings,
            e = this.activeRows,
            s = a("table"),
            i = a("thead"),
            n = a("tbody"),
            r = a("tr");
          t.forEach((t => {
            r.appendChild(a("th", {
              html: t.textContent
            }))
          })), i.appendChild(r), e.forEach((t => {
            const e = a("tr");
            Array.from(t.cells).forEach((t => {
              e.appendChild(a("td", {
                html: t.textContent
              }))
            })), n.appendChild(e)
          })), s.appendChild(i), s.appendChild(n);
          const h = window.open();
          h.document.body.appendChild(s), h.print()
        }
        setMessage(t) {
          let e = 1;
          this.hasRows ? e = this.data[0].cells.length : this.activeHeadings.length && (e = this.activeHeadings.length), this.wrapper.classList.add("dataTable-empty"), this.label && (this.label.innerHTML = ""), this.totalPages = 0, this.render("pager"), this.clear(a("tr", {
            html: `<td class="dataTables-empty" colspan="${e}">${t}</td>`
          }))
        }
        columns(t) {
          return new l(this, t)
        }
        rows(t) {
          return new o(this, t)
        }
        on(t, e) {
          this.events = this.events || {}, this.events[t] = this.events[t] || [], this.events[t].push(e)
        }
        off(t, e) {
          this.events = this.events || {}, t in this.events != 0 && this.events[t].splice(this.events[t].indexOf(e), 1)
        }
        emit(t) {
          if (this.events = this.events || {}, t in this.events != 0)
            for (let e = 0; e < this.events[t].length; e++) this.events[t][e].apply(this, Array.prototype.slice.call(arguments, 1))
        }
      }
      s.DataTable = u
    }, {
      "./date-cd1c23ce.js": 1
    }]
  }, {}, [2])(2)
}));
//# sourceMappingURL=/sm/b71d1fdf2e18834149b01e90c6fb68c49c8720f6f79466e6360b5d5b6793e05e.map