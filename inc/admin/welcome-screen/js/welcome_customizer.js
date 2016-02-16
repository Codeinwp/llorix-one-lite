jQuery(document).ready(function() {
    var llorix_one_aboutpage = llorixOneWelcomeScreenCustomizerObject.aboutpage;
    var llorix_one_nr_actions_required = llorixOneWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof llorix_one_aboutpage !== 'undefined') && (typeof llorix_one_nr_actions_required !== 'undefined') && (llorix_one_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + llorix_one_aboutpage + '"><span class="parallax-one-actions-count">' + llorix_one_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".llorix-one-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section llorix-one-upsells">');
    }
    if (typeof llorix_one_aboutpage !== 'undefined') {
        jQuery('.llorix-one-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + llorix_one_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', llorixOneWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".llorix-one-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});