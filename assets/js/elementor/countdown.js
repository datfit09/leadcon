(function($) {
    'use strict';
    /**
     * @param $scope The widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCountdownHandler = function($scope, $) {
        var countDown = function countDown() {
            var el = document.getElementsByClassName('flash-sale-cd'),
                elen = el.length,
                i = void 0;
            if (elen < 1) return;
            for (i = 0; i < elen; i++) {
                var _date = el[i].getAttribute('data-date'),
                    hours_id = el[i].getElementsByClassName('cd-time')[0].id,
                    mins_id = el[i].getElementsByClassName('cd-time')[1].id,
                    secs_id = el[i].getElementsByClassName('cd-time')[2].id;
                var counter = Doom({
                    targetDate: _date,
                    ids: {
                        hours: hours_id,
                        mins: mins_id,
                        secs: secs_id
                    }
                });
                counter.doom();
            }
        };
        var comingSoon = function comingSoon() {
            var countdowns = document.querySelectorAll('.leadcon-countdown-wrapper');
            if (!countdowns) return;
            countdowns.forEach(function(countdownContainer) {
                var digits = Array.from(countdownContainer.children);
                var targetDate = countdownContainer.getAttribute('data-date');
                var countdown = Doom({
                    targetDate: targetDate,
                    ids: {
                        hours: digits[0].querySelector('.leadcon-countdown-digit').id,
                        mins: digits[1].querySelector('.leadcon-countdown-digit').id,
                        secs: digits[2].querySelector('.leadcon-countdown-digit').id
                    }
                });
                countdown.doom();
            });
        };
        countDown();
        comingSoon();
    };
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/leadcon-countdown.default', WidgetCountdownHandler);
    });
})(jQuery);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJlbGVtZW50b3IvY291bnRkb3duLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigkKSB7XHJcbiAgICAndXNlIHN0cmljdCc7XHJcbiAgICAvKipcclxuICAgICAqIEBwYXJhbSAkc2NvcGUgVGhlIHdpZGdldCB3cmFwcGVyIGVsZW1lbnQgYXMgYSBqUXVlcnkgZWxlbWVudFxyXG4gICAgICogQHBhcmFtICQgVGhlIGpRdWVyeSBhbGlhc1xyXG4gICAgICovXHJcbiAgICB2YXIgV2lkZ2V0Q291bnRkb3duSGFuZGxlciA9IGZ1bmN0aW9uKCRzY29wZSwgJCkge1xyXG4gICAgICAgIHZhciBjb3VudERvd24gPSBmdW5jdGlvbiBjb3VudERvd24oKSB7XHJcbiAgICAgICAgICAgIHZhciBlbCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoJ2ZsYXNoLXNhbGUtY2QnKSxcclxuICAgICAgICAgICAgICAgIGVsZW4gPSBlbC5sZW5ndGgsXHJcbiAgICAgICAgICAgICAgICBpID0gdm9pZCAwO1xyXG4gICAgICAgICAgICBpZiAoZWxlbiA8IDEpIHJldHVybjtcclxuICAgICAgICAgICAgZm9yIChpID0gMDsgaSA8IGVsZW47IGkrKykge1xyXG4gICAgICAgICAgICAgICAgdmFyIF9kYXRlID0gZWxbaV0uZ2V0QXR0cmlidXRlKCdkYXRhLWRhdGUnKSxcclxuICAgICAgICAgICAgICAgICAgICBob3Vyc19pZCA9IGVsW2ldLmdldEVsZW1lbnRzQnlDbGFzc05hbWUoJ2NkLXRpbWUnKVswXS5pZCxcclxuICAgICAgICAgICAgICAgICAgICBtaW5zX2lkID0gZWxbaV0uZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSgnY2QtdGltZScpWzFdLmlkLFxyXG4gICAgICAgICAgICAgICAgICAgIHNlY3NfaWQgPSBlbFtpXS5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKCdjZC10aW1lJylbMl0uaWQ7XHJcbiAgICAgICAgICAgICAgICB2YXIgY291bnRlciA9IERvb20oe1xyXG4gICAgICAgICAgICAgICAgICAgIHRhcmdldERhdGU6IF9kYXRlLFxyXG4gICAgICAgICAgICAgICAgICAgIGlkczoge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBob3VyczogaG91cnNfaWQsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1pbnM6IG1pbnNfaWQsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHNlY3M6IHNlY3NfaWRcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIGNvdW50ZXIuZG9vbSgpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfTtcclxuICAgICAgICB2YXIgY29taW5nU29vbiA9IGZ1bmN0aW9uIGNvbWluZ1Nvb24oKSB7XHJcbiAgICAgICAgICAgIHZhciBjb3VudGRvd25zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmxlYWRjb24tY291bnRkb3duLXdyYXBwZXInKTtcclxuICAgICAgICAgICAgaWYgKCFjb3VudGRvd25zKSByZXR1cm47XHJcbiAgICAgICAgICAgIGNvdW50ZG93bnMuZm9yRWFjaChmdW5jdGlvbihjb3VudGRvd25Db250YWluZXIpIHtcclxuICAgICAgICAgICAgICAgIHZhciBkaWdpdHMgPSBBcnJheS5mcm9tKGNvdW50ZG93bkNvbnRhaW5lci5jaGlsZHJlbik7XHJcbiAgICAgICAgICAgICAgICB2YXIgdGFyZ2V0RGF0ZSA9IGNvdW50ZG93bkNvbnRhaW5lci5nZXRBdHRyaWJ1dGUoJ2RhdGEtZGF0ZScpO1xyXG4gICAgICAgICAgICAgICAgdmFyIGNvdW50ZG93biA9IERvb20oe1xyXG4gICAgICAgICAgICAgICAgICAgIHRhcmdldERhdGU6IHRhcmdldERhdGUsXHJcbiAgICAgICAgICAgICAgICAgICAgaWRzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGhvdXJzOiBkaWdpdHNbMF0ucXVlcnlTZWxlY3RvcignLmxlYWRjb24tY291bnRkb3duLWRpZ2l0JykuaWQsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1pbnM6IGRpZ2l0c1sxXS5xdWVyeVNlbGVjdG9yKCcubGVhZGNvbi1jb3VudGRvd24tZGlnaXQnKS5pZCxcclxuICAgICAgICAgICAgICAgICAgICAgICAgc2VjczogZGlnaXRzWzJdLnF1ZXJ5U2VsZWN0b3IoJy5sZWFkY29uLWNvdW50ZG93bi1kaWdpdCcpLmlkXHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICAgICBjb3VudGRvd24uZG9vbSgpO1xyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9O1xyXG4gICAgICAgIGNvdW50RG93bigpO1xyXG4gICAgICAgIGNvbWluZ1Nvb24oKTtcclxuICAgIH07XHJcbiAgICAkKHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKCdmcm9udGVuZC9lbGVtZW50X3JlYWR5L2xlYWRjb24tY291bnRkb3duLmRlZmF1bHQnLCBXaWRnZXRDb3VudGRvd25IYW5kbGVyKTtcclxuICAgIH0pO1xyXG59KShqUXVlcnkpOyJdLCJmaWxlIjoiZWxlbWVudG9yL2NvdW50ZG93bi5qcyJ9
