/*
jDoom — A pure Javascript countdown timer
Copyright (c) 2013 Zean Tsoi http://zeantsoi.com
MIT License: http://opensource.org/licenses/MIT
*/
'use strict';
var Doom = function(b) {
    function e() {
        var a, d = new Date,
            c = d.getTime() / 1E3;
        a = parseInt(c / 3600) % 24;
        var b = parseInt(c / 60) % 60,
            c = Math.floor(c % 60),
            d = [d.getMonth() + 1, d.getDate(), d.getFullYear()].join("/");
        a = [a, b, c].join(":");
        a = [d, a].join(" ");
        a = k(a);
        c = a < f ? f - a : a - f;
        a = isNaN(c) ? NaN : {
            secsPart: g(Math.floor(c / 1E3 % 60)),
            minsPart: g(Math.floor(c / 6E4 % 60)),
            hoursPart: g(Math.floor(c / 36E5 % 24)),
            daysPart: g(Math.floor(c / 864E5))
        };
        b = [l, m, n, p];
        d = ["days", "hours", "mins", "secs"];
        1E3 > c && (q || clearInterval(r), h || (s(), h = !0));
        for (c = 0; c < b.length; c++) {
            var e = document.getElementById(b[c]);
            null !== e && (e.innerHTML = a[d[c] + "Part"])
        }
    }

    function g(a) {
        return t ? 1 === a.toString().length ? "0" + a : a : a
    }

    function k(a) {
        return new Date(Date.parse(a))
    }

    function v(a) {
        var b;
        a ? (b = a.charAt(0), a = a.substring(1).split(":"), a = 3600 * +a[0] + 60 * +a[1], a = -Math.abs(60 * date.getTimezoneOffset()) + eval(b + a), b = a / 3600, a = Math.abs(a / 60 % 60), b = [b, a].join(":")) : b = null;
        return b
    }
    var t, s, q, f, u, l, m, n, p, r, h;
    (function() {
        var a = b.targetDate || null,
            d = b.targetTime || "00:00:00";
        u = v(b.utcOffset || null);
        l = b.ids ? b.ids.days || "days" : "days";
        m = b.ids ? b.ids.hours || "hours" : "hours";
        n = b.ids ? b.ids.mins || "mins" : "mins";
        p = b.ids ? b.ids.secs || "secs" : "secs";
        t = !1 === b.addZero ? !1 : !0;
        s = b.callback || function() {};
        q = b.biDirectional || !1;
        f = k([a, d, u].join(" "));
        h = !1
    })();
    return {
        doom: function() {
            e();
            r = setInterval(e, 1E3)
        }
    }
};