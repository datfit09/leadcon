/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
'use strict';
// Function Mega menu.

var leadcon_mega_menu = function () {
    if (window.width < 1300) {
      return;
    }

    var mega = document.querySelectorAll('#primary-menu .menu-item-has-children'),
        mega1 = document.querySelectorAll('#sticky-navigation .menu-item-has-children');
    if (!mega.length) {
        return;
    }
    if (!mega1.length) {
        return;
    }


    var menu_layouts = document.querySelectorAll('#primary-menu .sub-menu .sub-menu'),
        menu_layouts1 = document.querySelectorAll('#sticky-navigation .sub-menu .sub-menu');
    if (!menu_layouts.length) {
      return;
    }
    if (!menu_layouts1.length) {
      return;
    }

    menu_layouts.forEach(function (element) {
        var _rect = element.getBoundingClientRect(),
            _ww = document.body.clientWidth,
            _right = _ww - _rect.right;

        if (_right < 0) {
          element.classList.add('menu-in-right');
        } else {
          element.classList.remove('menu-in-right');
        }

    });
    menu_layouts1.forEach(function (element) {
        var _rect = element.getBoundingClientRect(),
            _ww = document.body.clientWidth,
            _right = _ww - _rect.right;

        if (_right < 0) {
          element.classList.add('menu-in-right');
        } else {
          element.classList.remove('menu-in-right');
        }

    });
};


jQuery(function($) {
//----------------------------------- Window load function -----------------------------------//

    $(window).load(function() {

        // MEGA MENU.
        leadcon_mega_menu();

    }); // end window load function

//------------------------------- Window resize-----------------------------------//
    $( window ).resize(function() {
        // MEGA MENU.
        leadcon_mega_menu();
    }); // end window resize function
    
}); // end jquery function

// Menu .arrow-icon
function nav() {
    var e = document.getElementsByClassName("toggle-sidebar-menu-btn");
    if (e)
        for (var n = 0, s = e.length; n < s; n++) e[n].addEventListener("click", function() {
            document.documentElement.classList.add("sidebar-menu-open"), closeAll()
        })
}

function sidebarMenu(e) {
    var n = 0 < arguments.length && void 0 !== e ? jQuery(e) : jQuery("#primary-menu"),
        s = n.find(".menu-item-has-children");
    s.length && s.prepend('<span class="arrow-icon"></span>');
    var a = n.find(".arrow-icon");
    jQuery(a).on("click", function(e) {
        e.preventDefault();
        var n = jQuery(this),
            s = n.siblings("ul"),
            a = n.parent().parent().find(".arrow-icon"),
            i = n.parent().parent().find("li .sub-menu");
        s.hasClass("show") ? (s.slideUp(200, function() {
            jQuery(this).removeClass("show")
        }), n.removeClass("active")) : (i.slideUp(200, function() {
            jQuery(this).removeClass("show")
        }), s.slideToggle(200, function() {
            jQuery(this).toggleClass("show")
        }), a.removeClass("active"), n.addClass("active"))
    })
}
document.addEventListener("DOMContentLoaded", function() {
    nav(), sidebarMenu()
});

/**
 * Off-canvas menu
 */
(function ($) {
    var offCanvasToggle = $('.js-canvas-toggle');
    var offCanvas = $('.js-canvas');
    var closeOffCanvasBtn = $('.js-close-off-canvas');

    var toggleOffCanvas = function (e) {
        offCanvas.attr('tabindex', '0');
        e.preventDefault();

        var _this = $(e.currentTarget);

        offCanvas.toggleClass('is-opened');
        offCanvas.attr('aria-hidden', !offCanvas.hasClass('is-opened'));
        _this.attr('aria-expanded', offCanvas.hasClass('is-opened'));
    };

    var closeOffCanvas = function () {
        offCanvas.removeClass('is-opened');
        offCanvasToggle.attr('aria-expanded', 'false');
    };

    // Toggle off-canvas
    offCanvasToggle.on('click', toggleOffCanvas);

    $(closeOffCanvasBtn).on('click', closeOffCanvas);

    // Close off-canvas when hit `ESC` button
    $(document).on('keyup', function (e) {
        if (e.keyCode === 27) {
            closeOffCanvas();
        }
    });

    $('.sub-menu .menu-item-has-children').on('hover', function () {

        var width = $(this).offset().left,
            windowWidth = $(window).width(),
            range = windowWidth - width;

        if ( range < 400 ) {
            $(this).find('.sub-menu').css({ "left" : 'auto', "top": "100%", "right": "50%" });
        }
    });
})(jQuery);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJuYXZpZ2F0aW9uLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBGaWxlIG5hdmlnYXRpb24uanMuXHJcbiAqXHJcbiAqIEhhbmRsZXMgdG9nZ2xpbmcgdGhlIG5hdmlnYXRpb24gbWVudSBmb3Igc21hbGwgc2NyZWVucyBhbmQgZW5hYmxlcyBUQUIga2V5XHJcbiAqIG5hdmlnYXRpb24gc3VwcG9ydCBmb3IgZHJvcGRvd24gbWVudXMuXHJcbiAqL1xyXG4ndXNlIHN0cmljdCc7XHJcbi8vIEZ1bmN0aW9uIE1lZ2EgbWVudS5cclxuXHJcbnZhciBsZWFkY29uX21lZ2FfbWVudSA9IGZ1bmN0aW9uICgpIHtcclxuICAgIGlmICh3aW5kb3cud2lkdGggPCAxMzAwKSB7XHJcbiAgICAgIHJldHVybjtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgbWVnYSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJyNwcmltYXJ5LW1lbnUgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKSxcclxuICAgICAgICBtZWdhMSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJyNzdGlja3ktbmF2aWdhdGlvbiAubWVudS1pdGVtLWhhcy1jaGlsZHJlbicpO1xyXG4gICAgaWYgKCFtZWdhLmxlbmd0aCkge1xyXG4gICAgICAgIHJldHVybjtcclxuICAgIH1cclxuICAgIGlmICghbWVnYTEubGVuZ3RoKSB7XHJcbiAgICAgICAgcmV0dXJuO1xyXG4gICAgfVxyXG5cclxuXHJcbiAgICB2YXIgbWVudV9sYXlvdXRzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnI3ByaW1hcnktbWVudSAuc3ViLW1lbnUgLnN1Yi1tZW51JyksXHJcbiAgICAgICAgbWVudV9sYXlvdXRzMSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJyNzdGlja3ktbmF2aWdhdGlvbiAuc3ViLW1lbnUgLnN1Yi1tZW51Jyk7XHJcbiAgICBpZiAoIW1lbnVfbGF5b3V0cy5sZW5ndGgpIHtcclxuICAgICAgcmV0dXJuO1xyXG4gICAgfVxyXG4gICAgaWYgKCFtZW51X2xheW91dHMxLmxlbmd0aCkge1xyXG4gICAgICByZXR1cm47XHJcbiAgICB9XHJcblxyXG4gICAgbWVudV9sYXlvdXRzLmZvckVhY2goZnVuY3Rpb24gKGVsZW1lbnQpIHtcclxuICAgICAgICB2YXIgX3JlY3QgPSBlbGVtZW50LmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpLFxyXG4gICAgICAgICAgICBfd3cgPSBkb2N1bWVudC5ib2R5LmNsaWVudFdpZHRoLFxyXG4gICAgICAgICAgICBfcmlnaHQgPSBfd3cgLSBfcmVjdC5yaWdodDtcclxuXHJcbiAgICAgICAgaWYgKF9yaWdodCA8IDApIHtcclxuICAgICAgICAgIGVsZW1lbnQuY2xhc3NMaXN0LmFkZCgnbWVudS1pbi1yaWdodCcpO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICBlbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ21lbnUtaW4tcmlnaHQnKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgfSk7XHJcbiAgICBtZW51X2xheW91dHMxLmZvckVhY2goZnVuY3Rpb24gKGVsZW1lbnQpIHtcclxuICAgICAgICB2YXIgX3JlY3QgPSBlbGVtZW50LmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpLFxyXG4gICAgICAgICAgICBfd3cgPSBkb2N1bWVudC5ib2R5LmNsaWVudFdpZHRoLFxyXG4gICAgICAgICAgICBfcmlnaHQgPSBfd3cgLSBfcmVjdC5yaWdodDtcclxuXHJcbiAgICAgICAgaWYgKF9yaWdodCA8IDApIHtcclxuICAgICAgICAgIGVsZW1lbnQuY2xhc3NMaXN0LmFkZCgnbWVudS1pbi1yaWdodCcpO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICBlbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ21lbnUtaW4tcmlnaHQnKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgfSk7XHJcbn07XHJcblxyXG5cclxualF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuLy8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBXaW5kb3cgbG9hZCBmdW5jdGlvbiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS8vXHJcblxyXG4gICAgJCh3aW5kb3cpLmxvYWQoZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgICAgIC8vIE1FR0EgTUVOVS5cclxuICAgICAgICBsZWFkY29uX21lZ2FfbWVudSgpO1xyXG5cclxuICAgIH0pOyAvLyBlbmQgd2luZG93IGxvYWQgZnVuY3Rpb25cclxuXHJcbi8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBXaW5kb3cgcmVzaXplLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0vL1xyXG4gICAgJCggd2luZG93ICkucmVzaXplKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIC8vIE1FR0EgTUVOVS5cclxuICAgICAgICBsZWFkY29uX21lZ2FfbWVudSgpO1xyXG4gICAgfSk7IC8vIGVuZCB3aW5kb3cgcmVzaXplIGZ1bmN0aW9uXHJcbiAgICBcclxufSk7IC8vIGVuZCBqcXVlcnkgZnVuY3Rpb25cclxuXHJcbi8vIE1lbnUgLmFycm93LWljb25cclxuZnVuY3Rpb24gbmF2KCkge1xyXG4gICAgdmFyIGUgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKFwidG9nZ2xlLXNpZGViYXItbWVudS1idG5cIik7XHJcbiAgICBpZiAoZSlcclxuICAgICAgICBmb3IgKHZhciBuID0gMCwgcyA9IGUubGVuZ3RoOyBuIDwgczsgbisrKSBlW25dLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LmNsYXNzTGlzdC5hZGQoXCJzaWRlYmFyLW1lbnUtb3BlblwiKSwgY2xvc2VBbGwoKVxyXG4gICAgICAgIH0pXHJcbn1cclxuXHJcbmZ1bmN0aW9uIHNpZGViYXJNZW51KGUpIHtcclxuICAgIHZhciBuID0gMCA8IGFyZ3VtZW50cy5sZW5ndGggJiYgdm9pZCAwICE9PSBlID8galF1ZXJ5KGUpIDogalF1ZXJ5KFwiI3ByaW1hcnktbWVudVwiKSxcclxuICAgICAgICBzID0gbi5maW5kKFwiLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW5cIik7XHJcbiAgICBzLmxlbmd0aCAmJiBzLnByZXBlbmQoJzxzcGFuIGNsYXNzPVwiYXJyb3ctaWNvblwiPjwvc3Bhbj4nKTtcclxuICAgIHZhciBhID0gbi5maW5kKFwiLmFycm93LWljb25cIik7XHJcbiAgICBqUXVlcnkoYSkub24oXCJjbGlja1wiLCBmdW5jdGlvbihlKSB7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgIHZhciBuID0galF1ZXJ5KHRoaXMpLFxyXG4gICAgICAgICAgICBzID0gbi5zaWJsaW5ncyhcInVsXCIpLFxyXG4gICAgICAgICAgICBhID0gbi5wYXJlbnQoKS5wYXJlbnQoKS5maW5kKFwiLmFycm93LWljb25cIiksXHJcbiAgICAgICAgICAgIGkgPSBuLnBhcmVudCgpLnBhcmVudCgpLmZpbmQoXCJsaSAuc3ViLW1lbnVcIik7XHJcbiAgICAgICAgcy5oYXNDbGFzcyhcInNob3dcIikgPyAocy5zbGlkZVVwKDIwMCwgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGpRdWVyeSh0aGlzKS5yZW1vdmVDbGFzcyhcInNob3dcIilcclxuICAgICAgICB9KSwgbi5yZW1vdmVDbGFzcyhcImFjdGl2ZVwiKSkgOiAoaS5zbGlkZVVwKDIwMCwgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGpRdWVyeSh0aGlzKS5yZW1vdmVDbGFzcyhcInNob3dcIilcclxuICAgICAgICB9KSwgcy5zbGlkZVRvZ2dsZSgyMDAsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICBqUXVlcnkodGhpcykudG9nZ2xlQ2xhc3MoXCJzaG93XCIpXHJcbiAgICAgICAgfSksIGEucmVtb3ZlQ2xhc3MoXCJhY3RpdmVcIiksIG4uYWRkQ2xhc3MoXCJhY3RpdmVcIikpXHJcbiAgICB9KVxyXG59XHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIGZ1bmN0aW9uKCkge1xyXG4gICAgbmF2KCksIHNpZGViYXJNZW51KClcclxufSk7XHJcblxyXG4vKipcclxuICogT2ZmLWNhbnZhcyBtZW51XHJcbiAqL1xyXG4oZnVuY3Rpb24gKCQpIHtcclxuICAgIHZhciBvZmZDYW52YXNUb2dnbGUgPSAkKCcuanMtY2FudmFzLXRvZ2dsZScpO1xyXG4gICAgdmFyIG9mZkNhbnZhcyA9ICQoJy5qcy1jYW52YXMnKTtcclxuICAgIHZhciBjbG9zZU9mZkNhbnZhc0J0biA9ICQoJy5qcy1jbG9zZS1vZmYtY2FudmFzJyk7XHJcblxyXG4gICAgdmFyIHRvZ2dsZU9mZkNhbnZhcyA9IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgb2ZmQ2FudmFzLmF0dHIoJ3RhYmluZGV4JywgJzAnKTtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG4gICAgICAgIHZhciBfdGhpcyA9ICQoZS5jdXJyZW50VGFyZ2V0KTtcclxuXHJcbiAgICAgICAgb2ZmQ2FudmFzLnRvZ2dsZUNsYXNzKCdpcy1vcGVuZWQnKTtcclxuICAgICAgICBvZmZDYW52YXMuYXR0cignYXJpYS1oaWRkZW4nLCAhb2ZmQ2FudmFzLmhhc0NsYXNzKCdpcy1vcGVuZWQnKSk7XHJcbiAgICAgICAgX3RoaXMuYXR0cignYXJpYS1leHBhbmRlZCcsIG9mZkNhbnZhcy5oYXNDbGFzcygnaXMtb3BlbmVkJykpO1xyXG4gICAgfTtcclxuXHJcbiAgICB2YXIgY2xvc2VPZmZDYW52YXMgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgb2ZmQ2FudmFzLnJlbW92ZUNsYXNzKCdpcy1vcGVuZWQnKTtcclxuICAgICAgICBvZmZDYW52YXNUb2dnbGUuYXR0cignYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xyXG4gICAgfTtcclxuXHJcbiAgICAvLyBUb2dnbGUgb2ZmLWNhbnZhc1xyXG4gICAgb2ZmQ2FudmFzVG9nZ2xlLm9uKCdjbGljaycsIHRvZ2dsZU9mZkNhbnZhcyk7XHJcblxyXG4gICAgJChjbG9zZU9mZkNhbnZhc0J0bikub24oJ2NsaWNrJywgY2xvc2VPZmZDYW52YXMpO1xyXG5cclxuICAgIC8vIENsb3NlIG9mZi1jYW52YXMgd2hlbiBoaXQgYEVTQ2AgYnV0dG9uXHJcbiAgICAkKGRvY3VtZW50KS5vbigna2V5dXAnLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgIGlmIChlLmtleUNvZGUgPT09IDI3KSB7XHJcbiAgICAgICAgICAgIGNsb3NlT2ZmQ2FudmFzKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG4gICAgJCgnLnN1Yi1tZW51IC5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJykub24oJ2hvdmVyJywgZnVuY3Rpb24gKCkge1xyXG5cclxuICAgICAgICB2YXIgd2lkdGggPSAkKHRoaXMpLm9mZnNldCgpLmxlZnQsXHJcbiAgICAgICAgICAgIHdpbmRvd1dpZHRoID0gJCh3aW5kb3cpLndpZHRoKCksXHJcbiAgICAgICAgICAgIHJhbmdlID0gd2luZG93V2lkdGggLSB3aWR0aDtcclxuXHJcbiAgICAgICAgaWYgKCByYW5nZSA8IDQwMCApIHtcclxuICAgICAgICAgICAgJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKS5jc3MoeyBcImxlZnRcIiA6ICdhdXRvJywgXCJ0b3BcIjogXCIxMDAlXCIsIFwicmlnaHRcIjogXCI1MCVcIiB9KTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufSkoalF1ZXJ5KTsiXSwiZmlsZSI6Im5hdmlnYXRpb24uanMifQ==
