jQuery(document).ready(function($) {

  "use strict";

    /**
     * Settings about sticky menu
     */
    var stickyOption = saayaBloggerObject.menu_sticky;
    if( stickyOption === 'on' ) {
        var windowWidth = $( window ).width();
        if( windowWidth < 500 ) {
            var wpAdminBar = 0;
        } else {
            var wpAdminBar = $('#wpadminbar');
        }
        if ( wpAdminBar.length ) {
          $(".mt-social-menu-wrapper").sticky({topSpacing:wpAdminBar.height()});
        } else {
          $(".mt-social-menu-wrapper").sticky({topSpacing:0});
        }
    }

});