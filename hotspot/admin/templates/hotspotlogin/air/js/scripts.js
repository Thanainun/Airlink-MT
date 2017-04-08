/* -----------------------------------------------------------------------------

    Prospero
    by Shakespeare Themes

----------------------------------------------------------------------------- */


/* -----------------------------------------------------------------------------

    TABLE OF CONTENT

    1.) General Variables
    2.) Typography
    3.) Components
    4.) Various Scripts
    5.) Header
    6.) Sections
    7.) Window Resize
    8.) Style Switcher
    9.) Initialize Page

----------------------------------------------------------------------------- */

(function($){
    "use strict";
    var ThePage = function(){

/* -----------------------------------------------------------------------------

        1.) GENERAL VARIABLES

----------------------------------------------------------------------------- */

        /* ---------------------------------------------------------------------
            PAGE VAR
        --------------------------------------------------------------------- */

        var thepage = this;

        /* ---------------------------------------------------------------------
            OLD IE
        --------------------------------------------------------------------- */

        var oldIE = ($.support.leadingWhitespace) ? false : true;

        /* ---------------------------------------------------------------------
            SCREEN WIDTH
        --------------------------------------------------------------------- */

        thepage.get_window_width = function() {
            var width;
            // fix for IE
            if(oldIE) {
                width = 1199;
            }
            else {
                width = $('#screen-width').css('content');
                width = width.replace("\"","").replace("\"","").replace("\'","").replace("\'","");
                if(isNaN(parseInt(width,10))){
                    $('#screen-width span').each(function(){
                        width = window.getComputedStyle(this,':before').content;
                    });
                    width = width.replace("\"","").replace("\"","").replace("\'","").replace("\'","");
                }
            }
            return width;
        };
        var screen_width = thepage.get_window_width();


/* -----------------------------------------------------------------------------

        2.) TYPOGRAPHY

----------------------------------------------------------------------------- */

        /* ---------------------------------------------------------------------
            CREATE DEFAULT LISTS
        --------------------------------------------------------------------- */

        thepage.create_default_lists = function(){
            $( '.various-content ul:not(.custom-list)' ).each(function() {
                $(this).addClass( 'default-list' );
                $(this).find( '> li' ).prepend( '<i class="ico icon-angle-right"></i>' );
            });
        };
        thepage.create_default_lists();


        /* ---------------------------------------------------------------------
            CREATE ALTERNATING LISTS
        --------------------------------------------------------------------- */

        thepage.create_alternating_lists = function(){
            $( 'ul.alternating' ).each(function() {
                $(this).find( '> li:nth-child(2n)' ).addClass( 'even' );
            });
        };
        thepage.create_alternating_lists();


/* -----------------------------------------------------------------------------

        3.) COMPONENTS

----------------------------------------------------------------------------- */

        /* ---------------------------------------------------------------------
            PRICING TABLE ORDER ACTION
        --------------------------------------------------------------------- */

        $( '.pricing-table .submit a' ).click(function(){
            if ( $( '#contact-form' ).length > 0 ){

                $( '#contact-form .form-fields' ).show();
                $( '#contact-form .alert.success' ).remove();

                var subject = $(this).data( 'subject' );
                var message = $(this).data( 'message' );

                if ( subject || message ) {

                    if ( subject ) {

                        $( '#contact-form #field_subject' ).removeClass( 'placeholder' ).val( subject );

                    }
                    if ( message ) {

                        $( '#contact-form #field_message' ).removeClass( 'placeholder' ).val( message );

                    }

                }

            }
        });

        /* ---------------------------------------------------------------------
            PROGRESS BARS
        --------------------------------------------------------------------- */

        $( '.progressbar' ).each( function() {

            var percentage = $(this).data( 'percentage' );
            if ( percentage ) {
                $(this).find( 'span' ).css( 'width', percentage + '%');
            }

        });


/* -----------------------------------------------------------------------------

        4.) VARIOUS SCRIPTS

----------------------------------------------------------------------------- */

        /* ---------------------------------------------------------------------
            INIT DEFAULT FORMS
        --------------------------------------------------------------------- */

        thepage.default_form_init = function(){

            $( 'form.default-form input, form.default-form textarea' ).each( function() {

                if ( $(this).val() === $(this).data( 'placeholder' ) ) {
                    $(this).addClass( 'placeholder' );
                }

            });

            $( 'form.default-form input, form.default-form textarea' ).focus( function() {

                if ( $(this).val() === $(this).data( 'placeholder' ) ) {
                    $(this).val( '' );
                    $(this).removeClass( 'placeholder' );
                }

            });
            $( 'form.default-form input, form.default-form textarea' ).blur( function() {

                if ( $.trim( $(this).val() ) === '' ) {
                    $(this).val( $(this).data( 'placeholder' ) );
                    $(this).addClass( 'placeholder' );
                }

            });

        };
        thepage.default_form_init();

        /* ---------------------------------------------------------------------
            FORM VALIDATION
        --------------------------------------------------------------------- */

        /* EMAIL REGEX */

        function validate_email(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        /* VALIDATE FIELD */

        thepage.validate_field = function(field){

            var value = field.val();
            var placeholder = field.data( 'placeholder' );
            var error_indicator = '<i class="error-ico icon-remove"></i>';

            // CHECK IF EMAIL

            if ( field.hasClass( 'email' ) ) {

                if(value.length < 1 || !validate_email(value)){
                    field.next('.error-ico').remove();
                    field.after( error_indicator );
                    field.addClass( 'error' );
                    return false;
                }
                else {
                    field.next( '.error-ico' ).fadeOut(300);
                    field.removeClass( 'error' );
                    return true;
                }

            }

            // CHECK IF SELECT

            else if ( field.prop( 'tagName' ).toLowerCase() === 'select' ){
                if ( value === null ){
                    field.next( '.error-ico' ).remove();
                    field.after( error_indicator );
                    field.addClass( 'error' );
                    return false;
                }
                else {
                    field.next( '.error-ico' ).fadeOut(300);
                    field.removeClass( 'error' );
                    return true;
                }
            }

            // CHECK IF OTHER

            else {

                if ( value.length < 1 || value === placeholder ) {
                    field.next( '.error-ico' ).remove();
                    field.after( error_indicator );
                    field.addClass( 'error' );
                    return false;
                }
                else {
                    field.next( '.error-ico' ).fadeOut(300);
                    field.removeClass( 'error' );
                    return true;
                }
            }

            return true;

        };

        /* ---------------------------------------------------------------------
            CONTACT FORM SUBMIT
        --------------------------------------------------------------------- */

        $( '#contact-form' ).submit(function(e){

            var form = $(this);
            var form_valid = true;
            var submit_btn = form.find( '.submit' );
            e.preventDefault();

            if ( !form.find( '.submit' ).hasClass( 'loading' ) ) {

                // VALIDATE FORM

                form.find( 'input.required, select.required, textarea.required' ).each(function(){

                    form.find( '.alert' ).slideUp(300);

                    // VALIDATE FIELD

                    var field = $(this);
                    if(!thepage.validate_field(field)){
                        form_valid = false;

                        // set validation on field change
                        field.bind('keypress change focus blur mouseenter', function(){
                            setTimeout(function(){
                                thepage.validate_field(field);
                            }, 100);
                        });

                    }

                });

                // SHOW ERROR MESSAGE IF NOT VALID

                if(!form_valid){

                    var body_offset = $( 'body' ).hasClass( 'fixed-header' ) ? $( 'header' ).height() : 0;
                    form.find('p.alert.warning.validation').slideDown(300);
                    $('html, body').animate({
                        scrollTop: form.offset().top - body_offset - 20
                    }, 500);
                    return false;

                }

                // SEND AJAX REQUEST IF VALID

                else {

                    submit_btn.addClass( 'loading' );
                    submit_btn.attr( 'data-label', submit_btn.text() );
                    submit_btn.text( submit_btn.data( 'loading-label' ) );

                    // disable inputs with placeholders

                    form.find( '.placeholder' ).attr( 'disabled', 'disabled' );

                    // Ajax request

                    $.ajax({
                      type: 'POST',
                      url: form.attr( 'action' ),
                      data: form.serialize(),
                      //Wait for a response
                      success: function( data ){

                        form.find( '.alert.validation' ).hide();
                        form.prepend( data );
                        form.find( '.alert.success, .alert.phpvalidation' ).slideDown(300);
                        submit_btn.removeClass( 'loading' );
                        submit_btn.text( submit_btn.attr( 'data-label' ) );

                        // reset all inputs and hide form

                        if ( data.indexOf( 'success' ) > 0 ) {

                            form.find( 'input, textarea' ).each( function() {
                                $(this).val( $(this).data( 'placeholder' ) ).addClass( 'placeholder' );
                            });
                            form.find( '.placeholder' ).removeAttr( 'disabled' );

                            form.find( '.form-fields' ).hide();

                        }

                      },
                      error: function(){

                        form.find( '.alert.validation' ).slideUp(300);
                        form.find( '.alert.request' ).slideDown(300);
                        submit_btn.removeClass( 'loading' );
                        submit_btn.text( submit_btn.attr( 'data-label' ) );

                      }
                    });

                }

            }

        });

        /* ---------------------------------------------------------------------
            LIGHTBOX
            Initialize Magnific Popup with "lightbox" class
        --------------------------------------------------------------------- */

        // create lightbox gallery

        function mp_lightbox_set( selector, enable_gallery ){

            // video
            if ( selector.hasClass( 'mp-video' ) ) {

                selector.magnificPopup({
                    type: 'iframe'
                });

            }
            // image
            else {

                selector.magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: enable_gallery
                    }
                });

            }

        }

        // create single gallery


        thepage.create_lightboxes = function(){
            if($.fn.magnificPopup) {

                $('a.mp-lightbox').each(function(){

                    if($(this).data('lightbox-group') && $('a.mp-lightbox[data-lightbox-group="' + $(this).data('lightbox-group') + '"]').length > 1){
                        mp_lightbox_set( $('a.mp-lightbox[data-lightbox-group="' + $(this).data('lightbox-group') + '"]'), true );
                    }
                    else {
                        mp_lightbox_set( $(this), false );
                    }

                });

            }
        };
        thepage.create_lightboxes();

        /* ---------------------------------------------------------------------
            SUBSCRIBE FORM SUBMIT
        --------------------------------------------------------------------- */

        $( '#subscribe-form' ).submit(function(e){

            var form = $(this);
            var form_valid = true;
            var submit_btn = form.find( '.submit' );
            e.preventDefault();

            if ( !form.find( '.submit' ).hasClass( 'loading' ) ) {

                form.find( '.alert' ).slideUp(300);

                // VALIDATE FORM

                form.find( 'input.required' ).each(function(){

                    // VALIDATE FIELD

                    var field = $(this);
                    if(!thepage.validate_field(field)){
                        form_valid = false;

                        // set validation on field change
                        field.bind('keypress change focus blur mouseenter', function(){
                            setTimeout(function(){
                                thepage.validate_field(field);
                            }, 100);
                        });

                    }

                });

                // SHOW ERROR MESSAGE IF NOT VALID

                if(!form_valid){

                    var body_offset = $( 'body' ).hasClass( 'fixed-header' ) ? $( 'header' ).height() : 0;
                    form.find('p.alert.warning.validation').slideDown(300);
                    $('html, body').animate({
                        scrollTop: form.offset().top - body_offset
                    }, 500);
                    return false;

                }

                // SEND AJAX REQUEST IF VALID

                else {

                    submit_btn.addClass( 'loading' );
                    submit_btn.attr( 'data-label', submit_btn.text() );
                    submit_btn.find( 'span' ).text( submit_btn.data( 'loading-label' ) );

                    // Ajax request

                    $.ajax({
                        type: form.attr( 'method' ),
                        url: form.attr( 'action' ),
                        data: form.serialize(),
                        cache : false,
                        dataType : 'json',
                        contentType: "application/json; charset=utf-8",
                        //Wait for a response
                        success: function( data ){

                            if ( data.result === 'success' ) {

                                form.find( '.alert' ).hide();
                                form.find( '.alert.success' ).append( '<br>' + data.msg );
                                form.find( '.alert.success' ).slideDown(300);
                                submit_btn.removeClass( 'loading' );
                                submit_btn.find( 'span' ).text( submit_btn.attr( 'data-label' ) );

                                form.find( 'input' ).each( function() {
                                    $(this).val( $(this).data( 'placeholder' ) ).addClass( 'placeholder' );
                                });

                                form.find( '.form-fields' ).hide();

                            }
                            else {

                                form.find( '.alert.validation' ).slideUp(300);
                                form.find( '.alert.request' ).slideDown(300);
                                submit_btn.removeClass( 'loading' );
                                submit_btn.text( submit_btn.attr( 'data-label' ) );

                            }

                        },
                        error: function(){

                            form.find( '.alert.validation' ).slideUp(300);
                            form.find( '.alert.request' ).slideDown(300);
                            submit_btn.removeClass( 'loading' );
                            submit_btn.find( 'span' ).text( submit_btn.attr( 'data-label' ) );

                        }
                    });

                }

            }

        });

        /* ---------------------------------------------------------------------
            LOAD HIRES IMAGES
        --------------------------------------------------------------------- */

        thepage.load_hires_images = function(){

            if( window.devicePixelRatio > 1 ){

                $('a[data-hires]').each(function(){
                    $(this).attr('href', $(this).data('hires'));
                });
                $('img[data-hires]').each(function(){
                    $(this).attr('src', $(this).data('hires'));
                });

            }

        };
        thepage.load_hires_images();

/* -----------------------------------------------------------------------------

        5.) HEADER

----------------------------------------------------------------------------- */

        /* ---------------------------------------------------------------------
            NAVBAR
        --------------------------------------------------------------------- */

        /* SET CLASS FOR LAST ITEMS OF LVL1 */

        $( 'nav.main > ul > li:last-child' ).addClass( 'last' );
        $( 'nav.main > ul > li:last-child' ).prev().addClass( 'penultimate' );


        /* HOVER ACTION LVL 1 */

        $( 'nav.main > ul > li' ).hover(function(){

            // show submenu

            $(this).find( '> ul' ).stop( true, true ).slideDown(300);

        }, function(){
            
            // hide submenu

            $(this).find( '> ul' ).slideUp(300);

        });


        /* ---------------------------------------------------------------------
            NAVBAR INDICATOR
        --------------------------------------------------------------------- */

        /* SET INDICATOR */

        var set_mainnav_indicator = function( active_item ){

            var indicator = $( 'nav.main .indicator' );
            var offset = Math.floor( active_item.position().left ) + 27;
            var width = Math.floor( active_item.find( '> a' ).width() );

            indicator.stop( 1, 0 ).fadeIn( 300 );
            indicator.animate({
                'left' : offset,
                'width' : width,
                'opacity' : 1
            }, 300);

        };
        if ( $( 'nav.main > ul > li.active' ).first().length > 0 ) {
            set_mainnav_indicator( $( 'nav.main > ul > li.active' ).first() );
        }

        /* HOVER ACTION */

        $('nav.main > ul > li').hover(function(){

            if(screen_width > 979){

                $(this).addClass( 'hover' );

                // set indicator

                set_mainnav_indicator( $(this) );

            }
        }, function(){
            if(screen_width > 979){

                $(this).removeClass( 'hover' );

                // reset indicator

                if ( $( 'nav.main > ul > li.active' ).first().length > 0 ) {
                    set_mainnav_indicator( $( 'nav.main > ul > li.active' ).first() );
                }
                else {
                    //$( 'nav.main .indicator' )
                    $( 'nav.main .indicator' ).animate({
                        'opacity' : 0,
                        'left' : 0
                    }, 300, function() {
                        $(this).removeAttr( 'style' ).hide();
                    });
                }

            }
        });


        /* ---------------------------------------------------------------------
            FRONTPAGE SCROLLSPY
        --------------------------------------------------------------------- */

        thepage.scrollspy_refresh = function(){

            var body_offset = $( 'body' ).hasClass( 'fixed-header' ) ? $( 'header' ).height() : 0;
            var from_top = $(window).scrollTop() + body_offset + 100;

            // Get id of current scroll item
            var cur = scroll_items.map(function(){
                if ( $(this).offset().top < from_top ) {
                    return this;
                }
            });

            // Get the id of the current element
            cur = cur[ cur.length - 1 ];

            var id = cur && cur.length ? cur[0].id : '';
            if ( last_id !== id ) {
                last_id = id;

                // Set/remove active class

                $( 'nav.main li.active' ).removeClass( 'active' );
                var active_item = menu_items.filter( 'a[href=#' + id + ']' ).first();

                if ( active_item.parent().parent().hasClass( 'submenu' ) ) {
                    
                    menu_items.filter( '[href=#' + id + ']' ).parents( 'li' ).addClass( 'active' );
                }
                else {
                    menu_items.filter( '[href=#' + id + ']' ).parent().addClass( 'active' );
                }

                //menu_items.parent().removeClass( 'active' ).end().filter( '[href=#' + id + ']' ).parent().addClass( 'active' );

                if ( history.pushState ) {
                    history.pushState( null, null, '#' + id );
                }

                if ( screen_width > 979 ) {
                    // Set main nav indicator
                    if ( $( 'nav.main > ul > li.active' ).first().length > 0 ) {
                        set_mainnav_indicator( $( 'nav.main > ul > li.active' ).first() );
                    }
                    else {
                        $( 'nav.main .indicator' ).fadeOut( 300 );
                    }
                }

            }

        };

        if( $( 'body' ).hasClass( 'frontpage' ) ) {

              // VARS

              var last_id,
              menu_items = $( 'nav.main' ).find( 'a[href^="#"]' ),
              scroll_items = menu_items.map(function(){
                  var item = $( $(this).attr( 'href' ) );
                  if ( item.length ) { return item; }
              });

            // INIT

            thepage.scrollspy_refresh();

            // LINK CLICK

            $( 'a[href^="#"]' ).click(function(e) {

                var href = $(this).attr( 'href' );
                if ( href.length > 1 ) {

                    var body_offset = $( 'body' ).hasClass( 'fixed-header' ) ? $( 'header' ).height() : 0;


                    var top_offset = $( href ).offset().top - body_offset;

                    if ( history.pushState ) {

                        $( 'html, body' ).stop().animate({
                            scrollTop : top_offset
                        }, 300, function(){

                            thepage.scrollspy_refresh();
                            history.pushState(null, null, href);

                        });

                        e.preventDefault();

                    }
                    else {

                        e.preventDefault();
                        window.location.hash = href;
                        $( 'html, body' ).scrollTop( top_offset );
                        thepage.scrollspy_refresh();

                    }

                }

            });

            // PAGE SCROLL

            $(window).scroll(function(){

                if ( $( 'nav.main li.hover' ).length < 1 ) {
                    thepage.scrollspy_refresh();
                }

            });

        }

        /* ---------------------------------------------------------------------
            RESPONSIVE NAV
        --------------------------------------------------------------------- */

        // TOGGLE

        $( 'header .nav-toggle' ).click( function() {

            $(this).toggleClass( 'active' );
            $( 'nav.main' ).slideToggle(300);

        });

        // SELECT

        $( 'nav.main select' ).change(function(){

            var href = $(this).val();

            if ( href.charAt( 0 ) === '#' ) {
            
                $( 'nav.main .active' ).removeClass( 'active' );
                var body_offset = $( 'body' ).hasClass( 'fixed-header' ) ? $( 'header' ).height() : 0;
                var top_offset = $( href ).offset().top - body_offset;
                $( 'html, body' ).stop().animate({
                    scrollTop : top_offset
                }, 300, function(){
                    thepage.scrollspy_refresh();
                });
                //return false;
                document.location.hash = href;

            }
            else {

                document.location.href = href;

            }

        });


/* -----------------------------------------------------------------------------

        6.) SECTIONS

----------------------------------------------------------------------------- */

        /* ---------------------------------------------------------------------
            PORTFOLIO THUMBS
        --------------------------------------------------------------------- */

        // INIT

        if ( ! oldIE ) {

            $( '#portfolio .portfolio-list' ).imagesLoaded( function(){

                $( '#portfolio .section-content .loading-anim' ).fadeOut(300);
                $( '#portfolio .section-content-inner' ).fadeIn( 300, function(){

                    $( '#portfolio .section-content' ).removeClass( 'loading' );
                    $(this).removeAttr( 'style' );

                    $( '#portfolio .portfolio-list' ).isotope({
                        itemSelector : '.item',
                        layoutMode : 'fitRows'
                    });

                } );


            });

        }
        else {

            $( '#portfolio .section-content' ).removeClass( 'loading' );

            $( '#portfolio .portfolio-list' ).isotope({
                itemSelector : '.item',
                layoutMode : 'fitRows'
            });

        }

        // FILTER

        $( '#portfolio .category-list button' ).click(function(){

            if ( ! $(this).parent().hasClass( 'active' ) ) {

                $( '#portfolio .category-list .active' ).removeClass( 'active' );
                $(this).parent().addClass( 'active' );
                var filter = $(this).data( 'category' );
                if ( filter !== '*' ) {
                    filter = '[data-category="' + filter + '"]';
                }
                $( '#portfolio .portfolio-list' ).isotope({ filter: filter });

            }

        });

        /* ---------------------------------------------------------------------
            TWITTER FEED
        --------------------------------------------------------------------- */

        if ( $( '#twitter-feed' ).length > 0 ) {

            var username = $( '#twitter-feed' ).data( 'username' );
            var count = $( '#twitter-feed' ).data( 'count' );

            $('#twitter-feed .feed').tweet({
                username: username,
                modpath: './assets/twitter/',
                count: count,
                loading_text: '<span class="loading-anim"><span><i class="icon-spinner"></i></span></span>',
            });

        }


/* -----------------------------------------------------------------------------

        7.) WINDOW RESIZE

----------------------------------------------------------------------------- */

        var screen_transition = false;
        var actual_screen_width = screen_width;

        $(window).resize(function(){

            screen_width = thepage.get_window_width();

            // CHECK FOR SCREEN TRANSITION

            if(screen_width !== actual_screen_width){
                screen_transition = true;
                actual_screen_width = screen_width;
            }
            else {
                screen_transition = false;
            }

            // IF TRANSITION

            if(screen_transition){

                if ( screen_width > 979 ) {

                    // main nav refresh

                    $( 'nav.main' ).removeAttr( 'style' );
                    $( 'header .nav-toggle' ).removeClass( 'active' );

                    // scrollspy refresh

                    if( $( 'body' ).hasClass( 'frontpage' ) ) {
                        thepage.scrollspy_refresh();
                    }

                    // main nav indicator

                    if ( $( 'nav.main > ul > li.active' ).first().length > 0 ) {
                        set_mainnav_indicator( $( 'nav.main > ul > li.active' ).first() );
                    }

                }
                else {
                    $( 'nav.main .indicator' ).hide();
                }

            }

        });

/* -----------------------------------------------------------------------------

        8.) STYLE SWITCHER

----------------------------------------------------------------------------- */

        $('#style-switcher').each(function(){

            var switcher = $(this);

            // TOGGLE

            switcher.find('.style-switcher-title button').click(function(){
                switcher.toggleClass('opened');
            });

            // SWITCH LAYOUT

            switcher.find( '.style-switcher-layout button' ).click( function(){

                $(this).toggleClass( 'active' );
                $( '#wrapper' ).toggleClass( 'container' );
                $( 'body' ).toggleClass( 'boxed' );

            } );

            // SWITCH COLORS

            switcher.find('.style-switcher-colors button').click(function(){

                if(!$(this).hasClass('active')){

                    switcher.find('.style-switcher-colors button.active').removeClass('active');
                    $(this).addClass('active');

                    $('#style-switcher-temp').remove();
                    if ( $(this).data('skin') !== 'default' ) {
                        $('head').append('<link id="style-switcher-temp" rel="stylesheet" href="assets/skin/' + $(this).data('skin') + '.css" type="text/css">');
                    }

                    // CHANGE LOGO

                    var logo = $(this).data( 'logo' );
                    var logo_hires = $(this).data( 'logo-hires' );

                    if ( logo ) {
                        $( 'header .branding img' ).attr( 'src', logo );
                    }
                    if ( logo_hires ) {
                        $( 'header .branding img' ).attr( 'data-hires', logo_hires );
                    }

                }

            });

        });



/* -----------------------------------------------------------------------------

        END.

----------------------------------------------------------------------------- */

    };

    $.fn.initpage = function( options ) {
        return this.each( function() {
            var element = $(this);
            // Return early if this element already has a plugin instance
            if( element.data( 'initpage' ) ) { return; }
            // pass options to plugin constructor
            var initpage = new ThePage( this, options );
            // Store plugin object in this element's data
            element.data( 'initpage', initpage );
        });
    };


})(jQuery);


/* -----------------------------------------------------------------------------

        9.) INITIALIZE PAGE

----------------------------------------------------------------------------- */

$(document).ready(function(){

    "use strict";
    $('body').initpage().data('initpage');

});