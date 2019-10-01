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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJjb3VudGRvd24uanMiXSwic291cmNlc0NvbnRlbnQiOlsiLypcclxuakRvb20g4oCUIEEgcHVyZSBKYXZhc2NyaXB0IGNvdW50ZG93biB0aW1lclxyXG5Db3B5cmlnaHQgKGMpIDIwMTMgWmVhbiBUc29pIGh0dHA6Ly96ZWFudHNvaS5jb21cclxuTUlUIExpY2Vuc2U6IGh0dHA6Ly9vcGVuc291cmNlLm9yZy9saWNlbnNlcy9NSVRcclxuKi9cclxuJ3VzZSBzdHJpY3QnO1xyXG52YXIgRG9vbSA9IGZ1bmN0aW9uKGIpIHtcclxuICAgIGZ1bmN0aW9uIGUoKSB7XHJcbiAgICAgICAgdmFyIGEsIGQgPSBuZXcgRGF0ZSxcclxuICAgICAgICAgICAgYyA9IGQuZ2V0VGltZSgpIC8gMUUzO1xyXG4gICAgICAgIGEgPSBwYXJzZUludChjIC8gMzYwMCkgJSAyNDtcclxuICAgICAgICB2YXIgYiA9IHBhcnNlSW50KGMgLyA2MCkgJSA2MCxcclxuICAgICAgICAgICAgYyA9IE1hdGguZmxvb3IoYyAlIDYwKSxcclxuICAgICAgICAgICAgZCA9IFtkLmdldE1vbnRoKCkgKyAxLCBkLmdldERhdGUoKSwgZC5nZXRGdWxsWWVhcigpXS5qb2luKFwiL1wiKTtcclxuICAgICAgICBhID0gW2EsIGIsIGNdLmpvaW4oXCI6XCIpO1xyXG4gICAgICAgIGEgPSBbZCwgYV0uam9pbihcIiBcIik7XHJcbiAgICAgICAgYSA9IGsoYSk7XHJcbiAgICAgICAgYyA9IGEgPCBmID8gZiAtIGEgOiBhIC0gZjtcclxuICAgICAgICBhID0gaXNOYU4oYykgPyBOYU4gOiB7XHJcbiAgICAgICAgICAgIHNlY3NQYXJ0OiBnKE1hdGguZmxvb3IoYyAvIDFFMyAlIDYwKSksXHJcbiAgICAgICAgICAgIG1pbnNQYXJ0OiBnKE1hdGguZmxvb3IoYyAvIDZFNCAlIDYwKSksXHJcbiAgICAgICAgICAgIGhvdXJzUGFydDogZyhNYXRoLmZsb29yKGMgLyAzNkU1ICUgMjQpKSxcclxuICAgICAgICAgICAgZGF5c1BhcnQ6IGcoTWF0aC5mbG9vcihjIC8gODY0RTUpKVxyXG4gICAgICAgIH07XHJcbiAgICAgICAgYiA9IFtsLCBtLCBuLCBwXTtcclxuICAgICAgICBkID0gW1wiZGF5c1wiLCBcImhvdXJzXCIsIFwibWluc1wiLCBcInNlY3NcIl07XHJcbiAgICAgICAgMUUzID4gYyAmJiAocSB8fCBjbGVhckludGVydmFsKHIpLCBoIHx8IChzKCksIGggPSAhMCkpO1xyXG4gICAgICAgIGZvciAoYyA9IDA7IGMgPCBiLmxlbmd0aDsgYysrKSB7XHJcbiAgICAgICAgICAgIHZhciBlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoYltjXSk7XHJcbiAgICAgICAgICAgIG51bGwgIT09IGUgJiYgKGUuaW5uZXJIVE1MID0gYVtkW2NdICsgXCJQYXJ0XCJdKVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBmdW5jdGlvbiBnKGEpIHtcclxuICAgICAgICByZXR1cm4gdCA/IDEgPT09IGEudG9TdHJpbmcoKS5sZW5ndGggPyBcIjBcIiArIGEgOiBhIDogYVxyXG4gICAgfVxyXG5cclxuICAgIGZ1bmN0aW9uIGsoYSkge1xyXG4gICAgICAgIHJldHVybiBuZXcgRGF0ZShEYXRlLnBhcnNlKGEpKVxyXG4gICAgfVxyXG5cclxuICAgIGZ1bmN0aW9uIHYoYSkge1xyXG4gICAgICAgIHZhciBiO1xyXG4gICAgICAgIGEgPyAoYiA9IGEuY2hhckF0KDApLCBhID0gYS5zdWJzdHJpbmcoMSkuc3BsaXQoXCI6XCIpLCBhID0gMzYwMCAqICthWzBdICsgNjAgKiArYVsxXSwgYSA9IC1NYXRoLmFicyg2MCAqIGRhdGUuZ2V0VGltZXpvbmVPZmZzZXQoKSkgKyBldmFsKGIgKyBhKSwgYiA9IGEgLyAzNjAwLCBhID0gTWF0aC5hYnMoYSAvIDYwICUgNjApLCBiID0gW2IsIGFdLmpvaW4oXCI6XCIpKSA6IGIgPSBudWxsO1xyXG4gICAgICAgIHJldHVybiBiXHJcbiAgICB9XHJcbiAgICB2YXIgdCwgcywgcSwgZiwgdSwgbCwgbSwgbiwgcCwgciwgaDtcclxuICAgIChmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgYSA9IGIudGFyZ2V0RGF0ZSB8fCBudWxsLFxyXG4gICAgICAgICAgICBkID0gYi50YXJnZXRUaW1lIHx8IFwiMDA6MDA6MDBcIjtcclxuICAgICAgICB1ID0gdihiLnV0Y09mZnNldCB8fCBudWxsKTtcclxuICAgICAgICBsID0gYi5pZHMgPyBiLmlkcy5kYXlzIHx8IFwiZGF5c1wiIDogXCJkYXlzXCI7XHJcbiAgICAgICAgbSA9IGIuaWRzID8gYi5pZHMuaG91cnMgfHwgXCJob3Vyc1wiIDogXCJob3Vyc1wiO1xyXG4gICAgICAgIG4gPSBiLmlkcyA/IGIuaWRzLm1pbnMgfHwgXCJtaW5zXCIgOiBcIm1pbnNcIjtcclxuICAgICAgICBwID0gYi5pZHMgPyBiLmlkcy5zZWNzIHx8IFwic2Vjc1wiIDogXCJzZWNzXCI7XHJcbiAgICAgICAgdCA9ICExID09PSBiLmFkZFplcm8gPyAhMSA6ICEwO1xyXG4gICAgICAgIHMgPSBiLmNhbGxiYWNrIHx8IGZ1bmN0aW9uKCkge307XHJcbiAgICAgICAgcSA9IGIuYmlEaXJlY3Rpb25hbCB8fCAhMTtcclxuICAgICAgICBmID0gayhbYSwgZCwgdV0uam9pbihcIiBcIikpO1xyXG4gICAgICAgIGggPSAhMVxyXG4gICAgfSkoKTtcclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgZG9vbTogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGUoKTtcclxuICAgICAgICAgICAgciA9IHNldEludGVydmFsKGUsIDFFMylcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn07Il0sImZpbGUiOiJjb3VudGRvd24uanMifQ==
