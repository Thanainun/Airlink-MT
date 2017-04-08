/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-csstransitions-testprop-testallprops-domprefixes
 */
;window.Modernizr=function(a,b,c){function w(a){i.cssText=a}function x(a,b){return w(prefixes.join(a+";")+(b||""))}function y(a,b){return typeof a===b}function z(a,b){return!!~(""+a).indexOf(b)}function A(a,b){for(var d in a){var e=a[d];if(!z(e,"-")&&i[e]!==c)return b=="pfx"?e:!0}return!1}function B(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:y(f,"function")?f.bind(d||b):f}return!1}function C(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+m.join(d+" ")+d).split(" ");return y(b,"string")||y(b,"undefined")?A(e,b):(e=(a+" "+n.join(d+" ")+d).split(" "),B(e,b,c))}var d="2.6.2",e={},f=b.documentElement,g="modernizr",h=b.createElement(g),i=h.style,j,k={}.toString,l="Webkit Moz O ms",m=l.split(" "),n=l.toLowerCase().split(" "),o={},p={},q={},r=[],s=r.slice,t,u={}.hasOwnProperty,v;!y(u,"undefined")&&!y(u.call,"undefined")?v=function(a,b){return u.call(a,b)}:v=function(a,b){return b in a&&y(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=s.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(s.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(s.call(arguments)))};return e}),o.csstransitions=function(){return C("transition")};for(var D in o)v(o,D)&&(t=D.toLowerCase(),e[t]=o[D](),r.push((e[t]?"":"no-")+t));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)v(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof enableClasses!="undefined"&&enableClasses&&(f.className+=" "+(b?"":"no-")+a),e[a]=b}return e},w(""),h=j=null,e._version=d,e._domPrefixes=n,e._cssomPrefixes=m,e.testProp=function(a){return A([a])},e.testAllProps=C,e}(this,this.document);
(function(d, $){

    /***********************************
    Slider
    ***********************************/
    $(d).ready(function() {
        // Fire up the device carousel
        $(".device-carousel").responsiveSlides({
            pager: true,
            nav: true,
            pagerMarkup: '&bull;'
        });

        // Fire up the testimonial carousel
        $(".testimonials-carousel").responsiveSlides({
            pager: true,
            pagerMarkup: '&bull;'
        });
    });


    /***********************************
    Scroll Animations
    ***********************************/
    $(".fadein").each(function(){
        var elem = $(this);
        var delay = elem.data('animation-delay') || 0;
        elem.css('-webkit-transition-delay', delay + 'ms' )
            .css('-moz-transition-delay', delay + 'ms')
            .css('-ms-transition-delay', delay + 'ms')
            .css('-o-transition-delay', delay + 'ms')
            .css('transition-delay', delay + 'ms');
    });

    $('.fadein').waypoint(function(){
        var elem = $(this);
        var animDelay = elem.data('animation-delay') || 0;

        if(Modernizr.csstransitions){
            // Adding the animate class, triggers the css animation
            // Animation styles are in the style sheet
            elem.addClass('animate');

            // reset delay when the animation is done.
            setTimeout(function(){
                elem.css('-webkit-transition-delay', '0ms' )
                    .css('-moz-transition-delay', '0ms')
                    .css('-ms-transition-delay', '0ms')
                    .css('-o-transition-delay', '0ms')
                    .css('transition-delay', '0ms');
            }, animDelay);

        }else{
            // js fallback for older browsers
            setTimeout(function(){
                elem.animate({
                    opacity : 1
                }, 450 );
            }, animDelay);
        }
    }, { offset: '75%' });


    /***********************************
    PlaceHolders - Cross Browser
    ***********************************/
    // Uses the placeholder attribute and makes it work on older browsers.
    var input = d.createElement("input");
    if(('placeholder' in input) === false) {
        $('[placeholder]').focus(function() {
            var i = $(this);
            if(i.val() === i.attr('placeholder')) {
                i.val('').removeClass('placeholder');
                if(i.hasClass('password')) {
                    i.removeClass('password');
                    this.type='password';
                }
            }
        }).blur(function() {
            var i = $(this);
            if(i.val() === '' || i.val() === i.attr('placeholder')) {
                if(this.type === 'password') {
                    i.addClass('password');
                    this.type='text';
                }
                i.addClass('placeholder').val(i.attr('placeholder'));
            }
        }).blur().parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var i = $(this);
                if(i.val() === i.attr('placeholder')){
                    i.val('');
                }
            });
        });
    }
})(document, jQuery, window);