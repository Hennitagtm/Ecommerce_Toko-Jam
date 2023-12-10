jQuery(document).ready(function($) {
    "use strict";

    /**
     * Preloader
     */
    if ($('#preloader-background').length > 0) {
        setTimeout(function() {
            $('#preloader-background').hide();
        }, 600);
    }
    var grid = document.querySelector('.saaya-content-masonry'),
        masonry;
    if (grid && typeof Masonry !== undefined && typeof imagesLoaded !== undefined) {
        imagesLoaded(grid, function(instance) {
            masonry = new Masonry(grid, {
                itemSelector: '.hentry'
            });
        });
    }

    /**
     * Header Search script
     */
    $('.mt-menu-search .mt-search-icon').click(function() {
        $('.mt-form-wrap').toggleClass('search-activate');
        var element = document.querySelector('.mt-form-wrap.search-activate');
        if (element) {
            $(document).on('keydown', function(e) {
                var focusable = element.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                var firstFocusable = focusable[0];
                var lastFocusable = focusable[focusable.length - 1];
                saaya_focus_trap(firstFocusable, lastFocusable, e);
            })
        }
    });

    /**
     * Responsive
     */
    $('.mt-logo-row-wrapper .menu-toggle').click(function(event) {
        $('.mt-logo-row-wrapper #site-navigation').toggleClass('isActive').slideToggle('slow');
        var element = document.querySelector('.mt-header-menu-wrap');
        if (element) {
            $(document).on('keydown', function(e) {
                if (element.querySelectorAll('.mt-logo-row-wrapper #site-navigation.isActive').length === 1) {
                    var focusable = element.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    var firstFocusable = focusable[0];
                    var lastFocusable = focusable[focusable.length - 1];
                    saaya_focus_trap(firstFocusable, lastFocusable, e);
                }
            })
        }
    });

    /**
     * responsive sub menu toggle
     */
    $('<a class="sub-toggle" href="javascript:void(0);"><i class="fa fa-angle-right"></i></a>').insertAfter('#site-navigation .menu-item-has-children>a, #site-navigation .page_item_has_children>a');
    $('#site-navigation .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        jQuery(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
        $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });

    $('.mt-menu-search .mt-form-close').click(function() {
        $('.mt-form-wrap').toggleClass('search-activate');
        var focusElement = $(this).data('focus');
        $(focusElement).focus();
    });

    /**
     * Close popups on escape key.
     */
    $(document).on('keydown', function(event) {
        if (event.keyCode === 27) {
            event.preventDefault();
            $('.mt-menu-search .mt-form-wrap').removeClass('search-activate');
        }
    });

    /**
     * Settings about WOW animation
     */
    var wowOption = saayaObject.wow_effect;
    if (wowOption === 'on') {
        new WOW().init();
    }
    
    /**
     * Settings about sticky menu
     */
    var stickyOption = saayaObject.menu_sticky;
    if (stickyOption === 'on') {
        var windowWidth = $(window).width();
        if (windowWidth < 500) {
            var wpAdminBar = 0;
        } else {
            var wpAdminBar = $('#wpadminbar');
        }
        if (wpAdminBar.length) {
            $(".mt-logo-row-wrapper").sticky({
                topSpacing: wpAdminBar.height()
            });
        } else {
            $(".mt-logo-row-wrapper").sticky({
                topSpacing: 0
            });
        }
    }

    /**
     * Scroll To Top
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#mt-scrollup').fadeIn('slow');
        } else {
            $('#mt-scrollup').fadeOut('slow');
        }
    });
    $('#mt-scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    /**
     * Focus trap in popup.
     */
    var KEYCODE_TAB = 9;

    function saaya_focus_trap(firstFocusable, lastFocusable, e) {
        if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
            if (e.shiftKey) /* shift + tab */ {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if (document.activeElement === lastFocusable) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var modeSwitcher = document.getElementById("mode-switcher");
    var templateBodyClass = document.body;

    function setSiteMode(mode) {
        localStorage.setItem("site-mode", mode);
    }

    function getSiteMode() {
        return localStorage.getItem("site-mode");
    }
    // Check if a site mode is stored in local storage and set the mode accordingly
    var modeStored = getSiteMode();
    if (modeStored) {
        if (modeStored === "dark-mode") {
            // Set dark mode
            modeSwitcher.classList.remove("light-mode");
            modeSwitcher.classList.add("dark-mode");
            modeSwitcher.setAttribute("data-site-mode", "dark-mode");
            templateBodyClass.classList.remove('site-mode--light');
            templateBodyClass.classList.add('site-mode--dark');
        } else {
            // Set light mode (or default)
            modeSwitcher.classList.remove("dark-mode");
            modeSwitcher.classList.add("light-mode");
            modeSwitcher.setAttribute("data-site-mode", "light-mode");
            templateBodyClass.classList.remove('site-mode--dark');
            templateBodyClass.classList.add('site-mode--light');
        }
    }
    // Add click event listener to mode switcher
    modeSwitcher.addEventListener("click", function(e) {
        e.preventDefault();
        var currentMode = modeSwitcher.getAttribute("data-site-mode");
        if (currentMode === "light-mode") {
            // Switch to dark mode
            setSiteMode("dark-mode");
            modeSwitcher.classList.remove("light-mode");
            modeSwitcher.classList.add("dark-mode");
            modeSwitcher.setAttribute("data-site-mode", "dark-mode");
            templateBodyClass.classList.remove('site-mode--light');
            templateBodyClass.classList.add('site-mode--dark');
        } else {
            // Switch to light mode
            setSiteMode("light-mode");
            modeSwitcher.classList.remove("dark-mode");
            modeSwitcher.classList.add("light-mode");
            modeSwitcher.setAttribute("data-site-mode", "light-mode");
            templateBodyClass.classList.remove('site-mode--dark');
            templateBodyClass.classList.add('site-mode--light');
        }
    });
});