/* -----------------------------------------------------------------------------

    CSS3 FIXES FOR OLD IE

----------------------------------------------------------------------------- */

var css3pie_initialize = function(){

    // select elements which needs to have their CSS3 attributes fixed
    var elements = '.button, .rounded, #team .team-member, .progressbar, .progressbar span, .pricing-table .column .title .label span, .default-form input, .default-form textarea, .content-box, #portfolio .category-list li, .alert';
    var border_radius_exceptions = "";

    $(function() {
        if (window.PIE) {

            $(elements).each(function() {
                PIE.attach(this);
            });
            $(border_radius_exceptions).each(function() {
                PIE.detach(this);
            });
        }
    });

}

$(document).ready(function(){

    css3pie_initialize();

});