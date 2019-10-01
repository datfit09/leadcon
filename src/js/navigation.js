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