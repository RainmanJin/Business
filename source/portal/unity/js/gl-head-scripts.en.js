/* All javascript needed for the global header and footer, and some utility functions.

   @file        gl-head-scripts.en.js
   @author      marionm
   ========================================================================== */

var gl_Wrapper = '#gl-outer-wrapper'; // outer wrapper element selector
var gl_Header = '#gl-header'; // header element selector
var gl_HeaderFullHeight = 100; // maximum height of header, should always match height of #gl-header in /common/css/gl-styles.en.css
var gl_HeaderCompactHeight = 42; // minimum height of header, should always match height of #gl-header.gl-compact in /common/css/gl-styles.en.css
var gl_HeaderOffset = 60; // clearance needed to properly offset linked elements from the compact header, should always match height of .gl-anchor in /common/css/gl-styles.en.css
var gl_Footer = '#gl-footer'; // footer element selector
var gl_FooterLanguages = '#gl-footer-lang'; // footer language menu element selector
var gl_FooterDifference = '#gl-footer-difference'; // footer difference element selector

/* Return an element's "true" top offset that has been adjusted to account for its margin-top, border-top, and (optionally) the header offset.

   @function    gl_GetAdjustedOffset
   @param       elem {string} [default=false] the element to assess, can be any standard jQuery selector
   @param       header {boolean} [default=true] optional, if true, subtract gl_HeaderOffset from the offset value
   @return      {integer} or {float}
   ========================================================================== */

function gl_GetAdjustedOffset(elem, header) {
    var elem = elem || false;
    var header = header || true;
    if (elem && $(elem).length > 0) {
        // element found, calculate its top offset
        var offset = parseFloat($(elem).offset().top);
        var difference = parseFloat($(elem).css('margin-top')) + parseFloat($(elem).css('border-top-width'));
        // difference found, subtract it
        if (difference > 0) offset -= difference;
        // header found, subtract its designated offset
        if (header && $(gl_Header).length > 0) offset -= gl_HeaderOffset;
    } else {
        // element not found
        offset = 0;
    }
    return offset;
}

/* Return the height of the header or (optionally) subtract the header offset from a specific value.

   @function    gl_GetHeaderHeight
   @param       top {integer} or {float} [default=0] optional, subtract gl_HeaderOffset from this value and return it
   @return      {integer} or {float}
   ========================================================================== */

function gl_GetHeaderHeight(top) {
    if ($(gl_Header).length > 0) {
        // header found
        var top = top || 0;
        var height = gl_HeaderFullHeight;
        // top parameter set, subtract the header offset from it
        if (top > 0 && top >= height) height = top - gl_HeaderOffset;
    } else {
        // header not found
        height = 0;
    }
    return height;
}

/* Offset scrollTop on hash urls to compensate for the fixed position header.

   @function    gl_SetAnchorOffset
   @bind        $('body').on('click', 'a')
   @return      nothing
   ========================================================================== */

function gl_SetAnchorOffset() {
    if ($(this).attr('href')) {
        // use the anchor's href attribute as url
        var url = $(this).attr('href');
    } else {
        // use current page location as url
        var url = $(location).attr('href');
    }

    // search the url for a hash, quit if not found
    var hash = url.indexOf('#');
    if (hash == -1) return;

    // search for identifiers on the page, quit if not found
    var id = url.slice(hash);
    var name = 'a[name=' + id.replace('#', '') + ']';
    if ($(id).length == 0 && $(name).length == 0) return;

    // determine which element selector to use, quit if no eligible elements found
    if ($(id).length > 0) {
        // use element id
        var select = id;
    } else if ($(id).length == 0 && $(name).length > 0) {
        // use element name (for anchors)
        var select = name;
    } else {
        return;
    }

    // insert a dummy span in front of the element so we always get an accurate offset
    $(select).before('<span class="gl-anchor"></span>');
    // get dummy span offset
    var top = $('.gl-anchor').offset().top;
    // remove the dummy span now that we have the offset
    $('.gl-anchor').remove();

    // scroll to the new offset (the delay makes it more reliable)
    setTimeout(function() {
        $(window).scrollTop(top);
    }, 1);

    return;
}

/* Limit the rate at which a function can trigger, greatly improves performance in some situations.

   @function    gl_ThrottleFunction
   @param       func {function} function to throttle
   @param       wait {integer} [default=250] maximum rate at which the function is permitted to trigger, in milliseconds
   @param       immediate {boolean} [default=true] if true, trigger the function before the wait; if false, trigger the function after the wait
   @return      function
   ========================================================================== */

function gl_ThrottleFunction(func, wait, immediate) {
    var timeout;
    var wait = wait || 250;
    var immediate = immediate || true;
    return function() {
        var context = this;
        var args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            timeout = null;
            // trigger after the wait
            if (!immediate) func.apply(context, args);
        }, wait);
        // trigger before the wait
        if (immediate) func.apply(context, args);
    };
};

/* Move the footer to the bottom of the viewport on short pages.

   @variable    gl_SetBodyHeightDifference
   @bind        $(window).on('load resize')
   @return      function
   ========================================================================== */

var gl_SetBodyHeightDifference = gl_ThrottleFunction(function() {
    if ($(gl_Wrapper).length > 0 && $(gl_FooterDifference).length > 0) {
        // remove any existing difference from the calculation
        $(gl_FooterDifference).hide();
        // get the height difference between the viewport and the outer wrapper
        var difference = parseInt($(window).height() - $(gl_Wrapper).height());
        if (difference > 0) {
            // difference found, set height on a placeholder div (more reliable than a margin)
            $(gl_FooterDifference).show().height(difference);
        } else {
            // no difference found, hide placeholder div
            $(gl_FooterDifference).hide().height(0);
        }
    }
});

/* Prevent javascript errors on this old, obsolete function call.

   @function    set_domain
   @return      nothing
   ========================================================================== */

function set_domain() {};

$(document).ready(function() {

/* header
   ========================================================================== */

    // only run if the header has been included
    if ($(gl_Header).length > 0) {

    /* enable fixed header only in js-enabled environments ================== */

        $('#gl-header, #gl-header-bg, #gl-header-offset').addClass('gl-header-fixed');

    /* adjust header on page scroll ========================================= */

        var gl_OffsetLeft = $(gl_Header).offset().left + (0 - $(window).scrollLeft());
        var gl_FirstRun = true;

        $(window).on('scroll resize', gl_ThrottleFunction(function() {
            // create ability to toggle the compact menu
            if ($('body.gl-header-nocompact').length > 0) {
                // don't use the compact header (the rest is done with css)
                gl_FirstRun = false;
            } else {
                // switch to compact mode when page is loaded/reloaded while scrolled down
                if (gl_FirstRun && $(window).scrollTop() > gl_HeaderFullHeight - gl_HeaderCompactHeight) {
                    $('#gl-header, #gl-header-bg, #gl-header-offset').addClass('gl-compact gl-onload');
                    gl_FirstRun = false;
                    return;
                }
                gl_FirstRun = false;

                // toggle modes on scroll
                if ($(window).scrollTop() > gl_HeaderFullHeight - gl_HeaderCompactHeight) {
                    // switch to compact mode when user scrolls down
                    $('#gl-header, #gl-header-bg, #gl-header-offset').addClass('gl-compact');
                } else {
                    // use full size mode by default and switch to it when user scrolls up
                    $('#gl-header, #gl-header-bg, #gl-header-offset').removeClass('gl-compact');
                }
            }

            // emulate horizontal scroll effect on fixed position element
            $(gl_Header).offset({
                left: gl_OffsetLeft
            });
        }));

    /* adjust header offset on named anchors ================================ */

        gl_SetAnchorOffset();
        $('body').on('click', 'a', gl_SetAnchorOffset);

    /* show submenus ======================================================== */

        if (!!(('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0))) {
            // force touch devices make better use of the :hover and :active pseudo-classes
            $('body').attr({
                ontouchstart: '',
                onmouseover: ''
            });

            // prevent videos from absorbing click/touch events from the global header
            var gl_Clicked = false;
            $('#gl-header a').off('click tap hover').on('click tap', function(e) {
                if (gl_Clicked === true) {
                    gl_Clicked = false;
                    e.preventDefault();
                    return;
                }
                gl_Clicked = true;
                // add classes to videos, hiding them so they can't steal focus
                $('video').addClass('gl-hidden');
                // make sure they're hidden before triggering the click event
                setTimeout(function() {
                    $(this).trigger('click tap');
                }, 1);
            });

            // show submenus on click/tap for touch-enabled devices
            $('#gl-menu .gl-has-submenu > a').off('click tap hover').on('click tap', function(e) {
                // prevent href from triggering
                e.preventDefault();

                // close submenu when clicked/tapped a 2nd time
                if ($(this).parent().hasClass('gl-open')) {
                    $(this).parent().removeClass('gl-open');
                    // prevent videos from absorbing click/touch events from the global header
                    $('video.gl-hidden').removeClass('gl-hidden');
                    return;
                }

                // close any other submenus that may be open
                var gl_IsOpen = $('#gl-menu').find('.gl-open');
                if (gl_IsOpen) $(gl_IsOpen).removeClass('gl-open');

                // toggle the submenu
                $(this).parent().toggleClass('gl-open');
                if ($(this).parent().attr('id') === 'gl-menu-search') {
                    // focus on the search input field
                    $('#gl-search').focus();
                } else {
                    // focus on the submenu
                    $(this).parent().children('.gl-submenu').focus();
                }

                // add classes to videos and remove their controls
                $('video').addClass('gl-hidden');
            });
        } else {
            // show submenus on timed hover for other devices
            var gl_HoverConfig = {
                over: function() {
                    $(this).addClass('gl-open');
                    if ($(this).attr('id') === 'gl-menu-search') {
                        // focus on the search input field
                        $('#gl-search').focus();
                    } else {
                        // focus on the submenu
                        $(this).children('.gl-submenu').focus();
                    }
                },
                out: function() {
                    $(this).removeClass('gl-open').focus();
                },
                interval: 50, // default = 100
                timeout: 50, // default = 0
                sensitivity: 500 // default = 6
            };
            //$('#gl-menu .gl-has-submenu, #gl-menu #gl-menu-search.gl-has-submenu').hoverIntent(gl_HoverConfig);
        }

    /* search input ========================================================= */

        // ensure default localized placeholder text is being used
        //$('#gl-submenu-search form').get(0).reset();

        var gl_SearchDefault = $('#gl-search').val();

        // change placeholder text to a blank string on submit
        $('#gl-submenu-search form').submit(function() {
            if ($('#gl-search').val() == gl_SearchDefault) $('#gl-search').val('');
        });
        $('#gl-search').focus(function() {
            // deselect input text and change style on focus
            var gl_SearchCurrent = $(this).val();
            if (gl_SearchCurrent !== gl_SearchDefault) {
                // terms found, un-italicize
                $(this).removeClass('italics').addClass('normal active');
            } else {
                // no terms found, italicize
                $(this).val('').val(gl_SearchDefault).removeClass('normal active').addClass('italics');
                if ($(this)[0].setSelectionRange) $(this)[0].setSelectionRange(0, 0);
            }
        }).keydown(function() {
            // change placeholder text to a blank string and un-italicize on keypress
            if ($(this).val() == gl_SearchDefault) $(this).val('').removeClass('italics').addClass('normal active');
        }).focusout(function() {
            // change everything back to default on focusout when input is blank
            if ($(this).val() == '') {
                $(this).val(gl_SearchDefault).removeClass('normal active').addClass('italics');
                if ($(this)[0].setSelectionRange) $(this)[0].setSelectionRange(0, 0);
            }
        }).click(function() {
            // refocus on click, fixes bug with flash movies stealing focus in Firefox on OSX
            $(this).blur().focus();
        });
    }

/* footer
   ========================================================================== */

    // move footer to the bottom of the viewport if the global footer has been included
    if ($(gl_Footer).length > 0) $(window).on('load resize', gl_SetBodyHeightDifference);

    // move language menu content into position if the global localization menu has been included
    if ($(gl_FooterLanguages).length > 0) $(gl_FooterLanguages).appendTo('#gl-footer-copyright .gl-col1');

});