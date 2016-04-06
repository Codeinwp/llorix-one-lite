function media_upload(button_class) {

  jQuery('body').on('click', button_class, function(e) {
    var button_id ='#'+jQuery(this).attr('id');
    var display_field = jQuery(this).parent().children('input:text');
    var _custom_media = true;

    wp.media.editor.send.attachment = function(props, attachment){

      if ( _custom_media  ) {
        if(typeof display_field != 'undefined'){
          switch(props.size){
            case 'full':
              display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
              break;
            case 'medium':
              display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
              break;
            case 'thumbnail':
              display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
              break;
            default:
              display_field.val(attachment.url);
                            display_field.trigger('change');
          }
        }
        _custom_media = false;
      } else {
        return wp.media.editor.send.attachment( button_id, [props, attachment] );
      }
    }
    wp.media.editor.open(button_class);
    window.send_to_editor = function(html) {

    }
    return false;
  });
}

/********************************************
*** Generate uniq id ***
*********************************************/
function llorix_one_uniqid(prefix, more_entropy) {

  if (typeof prefix === 'undefined') {
    prefix = '';
  }

  var retId;
  var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
    }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
        .join('0') + seed;
    }
    return seed;
  };

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
  }
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
  }
  this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
      .toFixed(8)
      .toString();
  }

  return retId;
}


/********************************************
*** General Repeater ***
*********************************************/
function llorix_one_refresh_general_control_values(){
  jQuery(".llorix_one_lite_general_control_repeater").each(function(){
    var values = [];
    var th = jQuery(this);
    th.find(".llorix_one_lite_general_control_repeater_container").each(function(){
      var icon_value = jQuery(this).find('.dd-selected-value').val();
      var text = jQuery(this).find(".llorix_one_lite_text_control").val();
      var link = jQuery(this).find(".llorix_one_lite_link_control").val();
      var image_url = jQuery(this).find(".custom_media_url").val();
      var choice = jQuery(this).find(".llorix_one_lite_image_choice").val();
      var title = jQuery(this).find(".llorix_one_lite_title_control").val();
      var subtitle = jQuery(this).find(".llorix_one_lite_subtitle_control").val();
      var id = jQuery(this).find(".llorix_one_lite_box_id").val();
            var shortcode = jQuery(this).find(".llorix_one_lite_shortcode_control").val();
            if( text !='' || image_url!='' || title!='' || subtitle!='' ){
                values.push({
                    "icon_value" : (choice === 'llorix_one_lite_none' ? "" : icon_value) ,
                    "text" :  escapeHtml(text),
                    "link" : link,
                    "image_url" : (choice === 'llorix_one_lite_none' ? "" : image_url),
                    "choice" : choice,
                    "title" : escapeHtml(title),
                    "subtitle" : escapeHtml(subtitle),
          "id" : id,
                    "shortcode" : escapeHtml(shortcode)
                });
            }

        });
        th.find('.llorix_one_lite_repeater_colector').val(JSON.stringify(values));
        th.find('.llorix_one_lite_repeater_colector').trigger('change');
    });
}



jQuery(document).ready(function(){
    jQuery('#customize-theme-controls').on('click','.llorix-one-lite-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible'))
                jQuery(this).css('display','block');
        });
    });
    
    jQuery('#customize-theme-controls').on('change','.llorix_one_lite_image_choice',function() {
        if(jQuery(this).val() == 'llorix_one_lite_image'){
            jQuery(this).parent().parent().find('.llorix_one_lite_general_control_icon').hide();
            jQuery(this).parent().parent().find('.llorix_one_lite_image_control').show();
        }
        if(jQuery(this).val() == 'llorix_one_lite_icon'){
            jQuery(this).parent().parent().find('.llorix_one_lite_general_control_icon').show();
            jQuery(this).parent().parent().find('.llorix_one_lite_image_control').hide();
        }
        if(jQuery(this).val() == 'llorix_one_lite_none'){
            jQuery(this).parent().parent().find('.llorix_one_lite_general_control_icon').hide();
            jQuery(this).parent().parent().find('.llorix_one_lite_image_control').hide();
        }
        
        llorix_one_refresh_general_control_values();
        return false;        
    });
    media_upload('.custom_media_button_llorix_one_lite');
    jQuery(".custom_media_url").live('change',function(){
        llorix_one_refresh_general_control_values();
        return false;
    });
    

  jQuery("#customize-theme-controls").on('change', '.dd-selected-value',function(){
    llorix_one_refresh_general_control_values();
    return false; 
  });

  jQuery(".llorix_one_lite_general_control_new_field").on("click",function(){
   
    var th = jQuery(this).parent();
    var id = 'llorix_one_lite_'+llorix_one_uniqid();
    if(typeof th != 'undefined') {
      
      var field = th.find(".llorix_one_lite_general_control_repeater_container:first").clone();
      
      if(typeof field != 'undefined'){
        field.find(".llorix_one_lite_image_choice").val('llorix_one_lite_icon');
        field.find('.llorix_one_lite_general_control_icon').show();
        
        if(field.find('.llorix_one_lite_general_control_icon').length > 0){
          field.find('.llorix_one_lite_image_control').hide();
        }
        
        field.find(".llorix_one_lite_general_control_remove_field").show();

        /*Reinitialize ddslick*/
        field.find('.dd-container').before('<div class="llorix-one-lite-dd"><select name="llorix_one_services_content" class="llorix_one_lite_icon_control"><option value="No Icon" data-iconclass="No Icon">No Icon</option><option value="fa-500px"  data-iconclass="fa-500px">fa-500px</option><option value="fa-adjust"  data-iconclass="fa-adjust">fa-adjust</option><option value="fa-adn"  data-iconclass="fa-adn">fa-adn</option><option value="fa-align-center"  data-iconclass="fa-align-center">fa-align-center</option><option value="fa-align-justify"  data-iconclass="fa-align-justify">fa-align-justify</option><option value="fa-align-left"  data-iconclass="fa-align-left">fa-align-left</option><option value="fa-align-right"  data-iconclass="fa-align-right">fa-align-right</option><option value="fa-amazon"  data-iconclass="fa-amazon">fa-amazon</option><option value="fa-ambulance"  data-iconclass="fa-ambulance">fa-ambulance</option><option value="fa-anchor"  data-iconclass="fa-anchor">fa-anchor</option><option value="fa-android"  data-iconclass="fa-android">fa-android</option><option value="fa-angellist"  data-iconclass="fa-angellist">fa-angellist</option><option value="fa-angle-double-down"  data-iconclass="fa-angle-double-down">fa-angle-double-down</option><option value="fa-angle-double-left"  data-iconclass="fa-angle-double-left">fa-angle-double-left</option><option value="fa-angle-double-right"  data-iconclass="fa-angle-double-right">fa-angle-double-right</option><option value="fa-angle-double-up"  data-iconclass="fa-angle-double-up">fa-angle-double-up</option><option value="fa-angle-down"  data-iconclass="fa-angle-down">fa-angle-down</option><option value="fa-angle-left"  data-iconclass="fa-angle-left">fa-angle-left</option><option value="fa-angle-right"  data-iconclass="fa-angle-right">fa-angle-right</option><option value="fa-angle-up"  data-iconclass="fa-angle-up">fa-angle-up</option><option value="fa-apple"  data-iconclass="fa-apple">fa-apple</option><option value="fa-archive"  data-iconclass="fa-archive">fa-archive</option><option value="fa-area-chart"  data-iconclass="fa-area-chart">fa-area-chart</option><option value="fa-arrow-circle-down"  data-iconclass="fa-arrow-circle-down">fa-arrow-circle-down</option><option value="fa-arrow-circle-left"  data-iconclass="fa-arrow-circle-left">fa-arrow-circle-left</option><option value="fa-arrow-circle-o-down"  data-iconclass="fa-arrow-circle-o-down">fa-arrow-circle-o-down</option><option value="fa-arrow-circle-o-left"  data-iconclass="fa-arrow-circle-o-left">fa-arrow-circle-o-left</option><option value="fa-arrow-circle-o-right"  data-iconclass="fa-arrow-circle-o-right">fa-arrow-circle-o-right</option><option value="fa-arrow-circle-o-up"  data-iconclass="fa-arrow-circle-o-up">fa-arrow-circle-o-up</option><option value="fa-arrow-circle-right"  data-iconclass="fa-arrow-circle-right">fa-arrow-circle-right</option><option value="fa-arrow-circle-up"  data-iconclass="fa-arrow-circle-up">fa-arrow-circle-up</option><option value="fa-arrow-down"  data-iconclass="fa-arrow-down">fa-arrow-down</option><option value="fa-arrow-left"  data-iconclass="fa-arrow-left">fa-arrow-left</option><option value="fa-arrow-right"  data-iconclass="fa-arrow-right">fa-arrow-right</option><option value="fa-arrow-up"  data-iconclass="fa-arrow-up">fa-arrow-up</option><option value="fa-arrows"  data-iconclass="fa-arrows">fa-arrows</option><option value="fa-arrows-alt"  data-iconclass="fa-arrows-alt">fa-arrows-alt</option><option value="fa-arrows-h"  data-iconclass="fa-arrows-h">fa-arrows-h</option><option value="fa-arrows-v"  data-iconclass="fa-arrows-v">fa-arrows-v</option><option value="fa-asterisk"  data-iconclass="fa-asterisk">fa-asterisk</option><option value="fa-at"  data-iconclass="fa-at">fa-at</option><option value="fa-automobile"  data-iconclass="fa-automobile">fa-automobile</option><option value="fa-backward"  data-iconclass="fa-backward">fa-backward</option><option value="fa-balance-scale"  data-iconclass="fa-balance-scale">fa-balance-scale</option><option value="fa-ban"  data-iconclass="fa-ban">fa-ban</option><option value="fa-bank"  data-iconclass="fa-bank">fa-bank</option><option value="fa-bar-chart"  data-iconclass="fa-bar-chart">fa-bar-chart</option><option value="fa-bar-chart-o"  data-iconclass="fa-bar-chart-o">fa-bar-chart-o</option><option value="fa-barcode"  data-iconclass="fa-barcode">fa-barcode</option><option value="fa-bars"  data-iconclass="fa-bars">fa-bars</option><option value="fa-battery-0"  data-iconclass="fa-battery-0">fa-battery-0</option><option value="fa-battery-1"  data-iconclass="fa-battery-1">fa-battery-1</option><option value="fa-battery-2"  data-iconclass="fa-battery-2">fa-battery-2</option><option value="fa-battery-3"  data-iconclass="fa-battery-3">fa-battery-3</option><option value="fa-battery-4"  data-iconclass="fa-battery-4">fa-battery-4</option><option value="fa-battery-empty"  data-iconclass="fa-battery-empty">fa-battery-empty</option><option value="fa-battery-full"  data-iconclass="fa-battery-full">fa-battery-full</option><option value="fa-battery-half"  data-iconclass="fa-battery-half">fa-battery-half</option><option value="fa-battery-quarter"  data-iconclass="fa-battery-quarter">fa-battery-quarter</option><option value="fa-battery-three-quarters"  data-iconclass="fa-battery-three-quarters">fa-battery-three-quarters</option><option value="fa-bed"  data-iconclass="fa-bed">fa-bed</option><option value="fa-beer"  data-iconclass="fa-beer">fa-beer</option><option value="fa-behance"  data-iconclass="fa-behance">fa-behance</option><option value="fa-behance-square"  data-iconclass="fa-behance-square">fa-behance-square</option><option value="fa-bell"  data-iconclass="fa-bell">fa-bell</option><option value="fa-bell-o"  data-iconclass="fa-bell-o">fa-bell-o</option><option value="fa-bell-slash"  data-iconclass="fa-bell-slash">fa-bell-slash</option><option value="fa-bell-slash-o"  data-iconclass="fa-bell-slash-o">fa-bell-slash-o</option><option value="fa-bicycle"  data-iconclass="fa-bicycle">fa-bicycle</option><option value="fa-binoculars"  data-iconclass="fa-binoculars">fa-binoculars</option><option value="fa-birthday-cake"  data-iconclass="fa-birthday-cake">fa-birthday-cake</option><option value="fa-bitbucket"  data-iconclass="fa-bitbucket">fa-bitbucket</option><option value="fa-bitbucket-square"  data-iconclass="fa-bitbucket-square">fa-bitbucket-square</option><option value="fa-bitcoin"  data-iconclass="fa-bitcoin">fa-bitcoin</option><option value="fa-black-tie"  data-iconclass="fa-black-tie">fa-black-tie</option><option value="fa-bluetooth"  data-iconclass="fa-bluetooth">fa-bluetooth</option><option value="fa-bluetooth-b"  data-iconclass="fa-bluetooth-b">fa-bluetooth-b</option><option value="fa-bold"  data-iconclass="fa-bold">fa-bold</option><option value="fa-bolt"  data-iconclass="fa-bolt">fa-bolt</option><option value="fa-bomb"  data-iconclass="fa-bomb">fa-bomb</option><option value="fa-book"  data-iconclass="fa-book">fa-book</option><option value="fa-bookmark"  data-iconclass="fa-bookmark">fa-bookmark</option><option value="fa-bookmark-o"  data-iconclass="fa-bookmark-o">fa-bookmark-o</option><option value="fa-briefcase"  data-iconclass="fa-briefcase">fa-briefcase</option><option value="fa-btc"  data-iconclass="fa-btc">fa-btc</option><option value="fa-bug"  data-iconclass="fa-bug">fa-bug</option><option value="fa-building"  data-iconclass="fa-building">fa-building</option><option value="fa-building-o"  data-iconclass="fa-building-o">fa-building-o</option><option value="fa-bullhorn"  data-iconclass="fa-bullhorn">fa-bullhorn</option><option value="fa-bullseye"  data-iconclass="fa-bullseye">fa-bullseye</option><option value="fa-bus"  data-iconclass="fa-bus">fa-bus</option><option value="fa-buysellads"  data-iconclass="fa-buysellads">fa-buysellads</option><option value="fa-cab"  data-iconclass="fa-cab">fa-cab</option><option value="fa-calculator"  data-iconclass="fa-calculator">fa-calculator</option><option value="fa-calendar"  data-iconclass="fa-calendar">fa-calendar</option><option value="fa-calendar-check-o"  data-iconclass="fa-calendar-check-o">fa-calendar-check-o</option><option value="fa-calendar-minus-o"  data-iconclass="fa-calendar-minus-o">fa-calendar-minus-o</option><option value="fa-calendar-o"  data-iconclass="fa-calendar-o">fa-calendar-o</option><option value="fa-calendar-plus-o"  data-iconclass="fa-calendar-plus-o">fa-calendar-plus-o</option><option value="fa-calendar-times-o"  data-iconclass="fa-calendar-times-o">fa-calendar-times-o</option><option value="fa-camera"  data-iconclass="fa-camera">fa-camera</option><option value="fa-camera-retro"  data-iconclass="fa-camera-retro">fa-camera-retro</option><option value="fa-car"  data-iconclass="fa-car">fa-car</option><option value="fa-caret-down"  data-iconclass="fa-caret-down">fa-caret-down</option><option value="fa-caret-left"  data-iconclass="fa-caret-left">fa-caret-left</option><option value="fa-caret-right"  data-iconclass="fa-caret-right">fa-caret-right</option><option value="fa-caret-square-o-down"  data-iconclass="fa-caret-square-o-down">fa-caret-square-o-down</option><option value="fa-caret-square-o-left"  data-iconclass="fa-caret-square-o-left">fa-caret-square-o-left</option><option value="fa-caret-square-o-right"  data-iconclass="fa-caret-square-o-right">fa-caret-square-o-right</option><option value="fa-caret-square-o-up"  data-iconclass="fa-caret-square-o-up">fa-caret-square-o-up</option><option value="fa-caret-up"  data-iconclass="fa-caret-up">fa-caret-up</option><option value="fa-cart-arrow-down"  data-iconclass="fa-cart-arrow-down">fa-cart-arrow-down</option><option value="fa-cart-plus"  data-iconclass="fa-cart-plus">fa-cart-plus</option><option value="fa-cc"  data-iconclass="fa-cc">fa-cc</option><option value="fa-cc-amex"  data-iconclass="fa-cc-amex">fa-cc-amex</option><option value="fa-cc-diners-club"  data-iconclass="fa-cc-diners-club">fa-cc-diners-club</option><option value="fa-cc-discover"  data-iconclass="fa-cc-discover">fa-cc-discover</option><option value="fa-cc-jcb"  data-iconclass="fa-cc-jcb">fa-cc-jcb</option><option value="fa-cc-mastercard"  data-iconclass="fa-cc-mastercard">fa-cc-mastercard</option><option value="fa-cc-paypal"  data-iconclass="fa-cc-paypal">fa-cc-paypal</option><option value="fa-cc-stripe"  data-iconclass="fa-cc-stripe">fa-cc-stripe</option><option value="fa-cc-visa"  data-iconclass="fa-cc-visa">fa-cc-visa</option><option value="fa-certificate"  data-iconclass="fa-certificate">fa-certificate</option><option value="fa-chain"  data-iconclass="fa-chain">fa-chain</option><option value="fa-chain-broken"  data-iconclass="fa-chain-broken">fa-chain-broken</option><option value="fa-check"  data-iconclass="fa-check">fa-check</option><option value="fa-check-circle"  data-iconclass="fa-check-circle">fa-check-circle</option><option value="fa-check-circle-o"  data-iconclass="fa-check-circle-o">fa-check-circle-o</option><option value="fa-check-square"  data-iconclass="fa-check-square">fa-check-square</option><option value="fa-check-square-o"  data-iconclass="fa-check-square-o">fa-check-square-o</option><option value="fa-chevron-circle-down"  data-iconclass="fa-chevron-circle-down">fa-chevron-circle-down</option><option value="fa-chevron-circle-left"  data-iconclass="fa-chevron-circle-left">fa-chevron-circle-left</option><option value="fa-chevron-circle-right"  data-iconclass="fa-chevron-circle-right">fa-chevron-circle-right</option><option value="fa-chevron-circle-up"  data-iconclass="fa-chevron-circle-up">fa-chevron-circle-up</option><option value="fa-chevron-down"  data-iconclass="fa-chevron-down">fa-chevron-down</option><option value="fa-chevron-left"  data-iconclass="fa-chevron-left">fa-chevron-left</option><option value="fa-chevron-right"  data-iconclass="fa-chevron-right">fa-chevron-right</option><option value="fa-chevron-up"  data-iconclass="fa-chevron-up">fa-chevron-up</option><option value="fa-child"  data-iconclass="fa-child">fa-child</option><option value="fa-chrome"  data-iconclass="fa-chrome">fa-chrome</option><option value="fa-circle"  data-iconclass="fa-circle">fa-circle</option><option value="fa-circle-o"  data-iconclass="fa-circle-o">fa-circle-o</option><option value="fa-circle-o-notch"  data-iconclass="fa-circle-o-notch">fa-circle-o-notch</option><option value="fa-circle-thin"  data-iconclass="fa-circle-thin">fa-circle-thin</option><option value="fa-clipboard"  data-iconclass="fa-clipboard">fa-clipboard</option><option value="fa-clock-o"  data-iconclass="fa-clock-o">fa-clock-o</option><option value="fa-clone"  data-iconclass="fa-clone">fa-clone</option><option value="fa-close"  data-iconclass="fa-close">fa-close</option><option value="fa-cloud"  data-iconclass="fa-cloud">fa-cloud</option><option value="fa-cloud-download"  data-iconclass="fa-cloud-download">fa-cloud-download</option><option value="fa-cloud-upload"  data-iconclass="fa-cloud-upload">fa-cloud-upload</option><option value="fa-cny"  data-iconclass="fa-cny">fa-cny</option><option value="fa-code"  data-iconclass="fa-code">fa-code</option><option value="fa-code-fork"  data-iconclass="fa-code-fork">fa-code-fork</option><option value="fa-codepen"  data-iconclass="fa-codepen">fa-codepen</option><option value="fa-codiepie"  data-iconclass="fa-codiepie">fa-codiepie</option><option value="fa-coffee"  data-iconclass="fa-coffee">fa-coffee</option><option value="fa-cog"  data-iconclass="fa-cog">fa-cog</option><option value="fa-cogs"  data-iconclass="fa-cogs">fa-cogs</option><option value="fa-columns"  data-iconclass="fa-columns">fa-columns</option><option value="fa-comment"  data-iconclass="fa-comment">fa-comment</option><option value="fa-comment-o"  data-iconclass="fa-comment-o">fa-comment-o</option><option value="fa-commenting"  data-iconclass="fa-commenting">fa-commenting</option><option value="fa-commenting-o"  data-iconclass="fa-commenting-o">fa-commenting-o</option><option value="fa-comments"  data-iconclass="fa-comments">fa-comments</option><option value="fa-comments-o"  data-iconclass="fa-comments-o">fa-comments-o</option><option value="fa-compass"  data-iconclass="fa-compass">fa-compass</option><option value="fa-compress"  data-iconclass="fa-compress">fa-compress</option><option value="fa-connectdevelop"  data-iconclass="fa-connectdevelop">fa-connectdevelop</option><option value="fa-contao"  data-iconclass="fa-contao">fa-contao</option><option value="fa-copy"  data-iconclass="fa-copy">fa-copy</option><option value="fa-copyright"  data-iconclass="fa-copyright">fa-copyright</option><option value="fa-creative-commons"  data-iconclass="fa-creative-commons">fa-creative-commons</option><option value="fa-credit-card"  data-iconclass="fa-credit-card">fa-credit-card</option><option value="fa-credit-card-alt"  data-iconclass="fa-credit-card-alt">fa-credit-card-alt</option><option value="fa-crop"  data-iconclass="fa-crop">fa-crop</option><option value="fa-crosshairs"  data-iconclass="fa-crosshairs">fa-crosshairs</option><option value="fa-css3"  data-iconclass="fa-css3">fa-css3</option><option value="fa-cube"  data-iconclass="fa-cube">fa-cube</option><option value="fa-cubes"  data-iconclass="fa-cubes">fa-cubes</option><option value="fa-cut"  data-iconclass="fa-cut">fa-cut</option><option value="fa-cutlery"  data-iconclass="fa-cutlery">fa-cutlery</option><option value="fa-dashboard"  data-iconclass="fa-dashboard">fa-dashboard</option><option value="fa-dashcube"  data-iconclass="fa-dashcube">fa-dashcube</option><option value="fa-database"  data-iconclass="fa-database">fa-database</option><option value="fa-dedent"  data-iconclass="fa-dedent">fa-dedent</option><option value="fa-delicious"  data-iconclass="fa-delicious">fa-delicious</option><option value="fa-desktop"  data-iconclass="fa-desktop">fa-desktop</option><option value="fa-deviantart"  data-iconclass="fa-deviantart">fa-deviantart</option><option value="fa-diamond"  data-iconclass="fa-diamond">fa-diamond</option><option value="fa-digg"  data-iconclass="fa-digg">fa-digg</option><option value="fa-dollar"  data-iconclass="fa-dollar">fa-dollar</option><option value="fa-dot-circle-o"  data-iconclass="fa-dot-circle-o">fa-dot-circle-o</option><option value="fa-download"  data-iconclass="fa-download">fa-download</option><option value="fa-dribbble"  data-iconclass="fa-dribbble">fa-dribbble</option><option value="fa-dropbox"  data-iconclass="fa-dropbox">fa-dropbox</option><option value="fa-drupal"  data-iconclass="fa-drupal">fa-drupal</option><option value="fa-edge"  data-iconclass="fa-edge">fa-edge</option><option value="fa-edit"  data-iconclass="fa-edit">fa-edit</option><option value="fa-eject"  data-iconclass="fa-eject">fa-eject</option><option value="fa-ellipsis-h"  data-iconclass="fa-ellipsis-h">fa-ellipsis-h</option><option value="fa-ellipsis-v"  data-iconclass="fa-ellipsis-v">fa-ellipsis-v</option><option value="fa-empire"  data-iconclass="fa-empire">fa-empire</option><option value="fa-envelope"   data-iconclass="fa-envelope">fa-envelope</option><option value="fa-envelope-o"  data-iconclass="fa-envelope-o">fa-envelope-o</option><option value="fa-envelope-square"  data-iconclass="fa-envelope-square">fa-envelope-square</option><option value="fa-eraser"  data-iconclass="fa-eraser">fa-eraser</option><option value="fa-eur"  data-iconclass="fa-eur">fa-eur</option><option value="fa-euro"  data-iconclass="fa-euro">fa-euro</option><option value="fa-exchange"  data-iconclass="fa-exchange">fa-exchange</option><option value="fa-exclamation"  data-iconclass="fa-exclamation">fa-exclamation</option><option value="fa-exclamation-circle"  data-iconclass="fa-exclamation-circle">fa-exclamation-circle</option><option value="fa-exclamation-triangle"  data-iconclass="fa-exclamation-triangle">fa-exclamation-triangle</option><option value="fa-expand"  data-iconclass="fa-expand">fa-expand</option><option value="fa-expeditedssl"  data-iconclass="fa-expeditedssl">fa-expeditedssl</option><option value="fa-external-link"  data-iconclass="fa-external-link">fa-external-link</option><option value="fa-external-link-square"  data-iconclass="fa-external-link-square">fa-external-link-square</option><option value="fa-eye"  data-iconclass="fa-eye">fa-eye</option><option value="fa-eye-slash"  data-iconclass="fa-eye-slash">fa-eye-slash</option><option value="fa-eyedropper"  data-iconclass="fa-eyedropper">fa-eyedropper</option><option value="fa-facebook"  data-iconclass="fa-facebook">fa-facebook</option><option value="fa-facebook-f"  data-iconclass="fa-facebook-f">fa-facebook-f</option><option value="fa-facebook-official"  data-iconclass="fa-facebook-official">fa-facebook-official</option><option value="fa-facebook-square"  data-iconclass="fa-facebook-square">fa-facebook-square</option><option value="fa-fast-backward"  data-iconclass="fa-fast-backward">fa-fast-backward</option><option value="fa-fast-forward"  data-iconclass="fa-fast-forward">fa-fast-forward</option><option value="fa-fax"  data-iconclass="fa-fax">fa-fax</option><option value="fa-feed"  data-iconclass="fa-feed">fa-feed</option><option value="fa-female"  data-iconclass="fa-female">fa-female</option><option value="fa-fighter-jet"  data-iconclass="fa-fighter-jet">fa-fighter-jet</option><option value="fa-file"  data-iconclass="fa-file">fa-file</option><option value="fa-file-archive-o"  data-iconclass="fa-file-archive-o">fa-file-archive-o</option><option value="fa-file-audio-o"  data-iconclass="fa-file-audio-o">fa-file-audio-o</option><option value="fa-file-code-o"  data-iconclass="fa-file-code-o">fa-file-code-o</option><option value="fa-file-excel-o"  data-iconclass="fa-file-excel-o">fa-file-excel-o</option><option value="fa-file-image-o"  data-iconclass="fa-file-image-o">fa-file-image-o</option><option value="fa-file-movie-o"  data-iconclass="fa-file-movie-o">fa-file-movie-o</option><option value="fa-file-o"  data-iconclass="fa-file-o">fa-file-o</option><option value="fa-file-pdf-o"  data-iconclass="fa-file-pdf-o">fa-file-pdf-o</option><option value="fa-file-photo-o"  data-iconclass="fa-file-photo-o">fa-file-photo-o</option><option value="fa-file-picture-o"  data-iconclass="fa-file-picture-o">fa-file-picture-o</option><option value="fa-file-powerpoint-o"  data-iconclass="fa-file-powerpoint-o">fa-file-powerpoint-o</option><option value="fa-file-sound-o"  data-iconclass="fa-file-sound-o">fa-file-sound-o</option><option value="fa-file-text"  data-iconclass="fa-file-text">fa-file-text</option><option value="fa-file-text-o"  data-iconclass="fa-file-text-o">fa-file-text-o</option><option value="fa-file-video-o"  data-iconclass="fa-file-video-o">fa-file-video-o</option><option value="fa-file-word-o"  data-iconclass="fa-file-word-o">fa-file-word-o</option><option value="fa-file-zip-o"  data-iconclass="fa-file-zip-o">fa-file-zip-o</option><option value="fa-files-o"  data-iconclass="fa-files-o">fa-files-o</option><option value="fa-film"  data-iconclass="fa-film">fa-film</option><option value="fa-filter"  data-iconclass="fa-filter">fa-filter</option><option value="fa-fire"  data-iconclass="fa-fire">fa-fire</option><option value="fa-fire-extinguisher"  data-iconclass="fa-fire-extinguisher">fa-fire-extinguisher</option><option value="fa-firefox"  data-iconclass="fa-firefox">fa-firefox</option><option value="fa-flag"  data-iconclass="fa-flag">fa-flag</option><option value="fa-flag-checkered"  data-iconclass="fa-flag-checkered">fa-flag-checkered</option><option value="fa-flag-o"  data-iconclass="fa-flag-o">fa-flag-o</option><option value="fa-flash"  data-iconclass="fa-flash">fa-flash</option><option value="fa-flask"  data-iconclass="fa-flask">fa-flask</option><option value="fa-flickr"  data-iconclass="fa-flickr">fa-flickr</option><option value="fa-floppy-o"  data-iconclass="fa-floppy-o">fa-floppy-o</option><option value="fa-folder"  data-iconclass="fa-folder">fa-folder</option><option value="fa-folder-o"  data-iconclass="fa-folder-o">fa-folder-o</option><option value="fa-folder-open"  data-iconclass="fa-folder-open">fa-folder-open</option><option value="fa-folder-open-o"  data-iconclass="fa-folder-open-o">fa-folder-open-o</option><option value="fa-font"  data-iconclass="fa-font">fa-font</option><option value="fa-fonticons"  data-iconclass="fa-fonticons">fa-fonticons</option><option value="fa-fort-awesome"  data-iconclass="fa-fort-awesome">fa-fort-awesome</option><option value="fa-forumbee"  data-iconclass="fa-forumbee">fa-forumbee</option><option value="fa-forward"  data-iconclass="fa-forward">fa-forward</option><option value="fa-foursquare"  data-iconclass="fa-foursquare">fa-foursquare</option><option value="fa-frown-o"  data-iconclass="fa-frown-o">fa-frown-o</option><option value="fa-futbol-o"  data-iconclass="fa-futbol-o">fa-futbol-o</option><option value="fa-gamepad"  data-iconclass="fa-gamepad">fa-gamepad</option><option value="fa-gavel"  data-iconclass="fa-gavel">fa-gavel</option><option value="fa-gbp"  data-iconclass="fa-gbp">fa-gbp</option><option value="fa-ge"  data-iconclass="fa-ge">fa-ge</option><option value="fa-gear"  data-iconclass="fa-gear">fa-gear</option><option value="fa-gears"  data-iconclass="fa-gears">fa-gears</option><option value="fa-genderless"  data-iconclass="fa-genderless">fa-genderless</option><option value="fa-get-pocket"  data-iconclass="fa-get-pocket">fa-get-pocket</option><option value="fa-gg"  data-iconclass="fa-gg">fa-gg</option><option value="fa-gg-circle"  data-iconclass="fa-gg-circle">fa-gg-circle</option><option value="fa-gift"  data-iconclass="fa-gift">fa-gift</option><option value="fa-git"  data-iconclass="fa-git">fa-git</option><option value="fa-git-square"  data-iconclass="fa-git-square">fa-git-square</option><option value="fa-github"  data-iconclass="fa-github">fa-github</option><option value="fa-github-alt"  data-iconclass="fa-github-alt">fa-github-alt</option><option value="fa-github-square"  data-iconclass="fa-github-square">fa-github-square</option><option value="fa-gittip"  data-iconclass="fa-gittip">fa-gittip</option><option value="fa-glass"  data-iconclass="fa-glass">fa-glass</option><option value="fa-globe"  data-iconclass="fa-globe">fa-globe</option><option value="fa-google"  data-iconclass="fa-google">fa-google</option><option value="fa-google-plus"  data-iconclass="fa-google-plus">fa-google-plus</option><option value="fa-google-plus-square"  data-iconclass="fa-google-plus-square">fa-google-plus-square</option><option value="fa-google-wallet"  data-iconclass="fa-google-wallet">fa-google-wallet</option><option value="fa-graduation-cap"  data-iconclass="fa-graduation-cap">fa-graduation-cap</option><option value="fa-gratipay"  data-iconclass="fa-gratipay">fa-gratipay</option><option value="fa-group"  data-iconclass="fa-group">fa-group</option><option value="fa-h-square"  data-iconclass="fa-h-square">fa-h-square</option><option value="fa-hacker-news"  data-iconclass="fa-hacker-news">fa-hacker-news</option><option value="fa-hand-grab-o"  data-iconclass="fa-hand-grab-o">fa-hand-grab-o</option><option value="fa-hand-lizard-o"  data-iconclass="fa-hand-lizard-o">fa-hand-lizard-o</option><option value="fa-hand-o-down"  data-iconclass="fa-hand-o-down">fa-hand-o-down</option><option value="fa-hand-o-left"  data-iconclass="fa-hand-o-left">fa-hand-o-left</option><option value="fa-hand-o-right"  data-iconclass="fa-hand-o-right">fa-hand-o-right</option><option value="fa-hand-o-up"  data-iconclass="fa-hand-o-up">fa-hand-o-up</option><option value="fa-hand-paper-o"  data-iconclass="fa-hand-paper-o">fa-hand-paper-o</option><option value="fa-hand-peace-o"  data-iconclass="fa-hand-peace-o">fa-hand-peace-o</option><option value="fa-hand-pointer-o"  data-iconclass="fa-hand-pointer-o">fa-hand-pointer-o</option><option value="fa-hand-rock-o"  data-iconclass="fa-hand-rock-o">fa-hand-rock-o</option><option value="fa-hand-scissors-o"  data-iconclass="fa-hand-scissors-o">fa-hand-scissors-o</option><option value="fa-hand-spock-o"  data-iconclass="fa-hand-spock-o">fa-hand-spock-o</option><option value="fa-hand-stop-o"  data-iconclass="fa-hand-stop-o">fa-hand-stop-o</option><option value="fa-hashtag"  data-iconclass="fa-hashtag">fa-hashtag</option><option value="fa-hdd-o"  data-iconclass="fa-hdd-o">fa-hdd-o</option><option value="fa-header"  data-iconclass="fa-header">fa-header</option><option value="fa-headphones"  data-iconclass="fa-headphones">fa-headphones</option><option value="fa-heart"  data-iconclass="fa-heart">fa-heart</option><option value="fa-heart-o"  data-iconclass="fa-heart-o">fa-heart-o</option><option value="fa-heartbeat"  data-iconclass="fa-heartbeat">fa-heartbeat</option><option value="fa-history"  data-iconclass="fa-history">fa-history</option><option value="fa-home"  data-iconclass="fa-home">fa-home</option><option value="fa-hospital-o"  data-iconclass="fa-hospital-o">fa-hospital-o</option><option value="fa-hotel"  data-iconclass="fa-hotel">fa-hotel</option><option value="fa-hourglass"  data-iconclass="fa-hourglass">fa-hourglass</option><option value="fa-hourglass-1"  data-iconclass="fa-hourglass-1">fa-hourglass-1</option><option value="fa-hourglass-2"  data-iconclass="fa-hourglass-2">fa-hourglass-2</option><option value="fa-hourglass-3"  data-iconclass="fa-hourglass-3">fa-hourglass-3</option><option value="fa-hourglass-end"  data-iconclass="fa-hourglass-end">fa-hourglass-end</option><option value="fa-hourglass-half"  data-iconclass="fa-hourglass-half">fa-hourglass-half</option><option value="fa-hourglass-o"  data-iconclass="fa-hourglass-o">fa-hourglass-o</option><option value="fa-hourglass-start"  data-iconclass="fa-hourglass-start">fa-hourglass-start</option><option value="fa-houzz"  data-iconclass="fa-houzz">fa-houzz</option><option value="fa-html5"  data-iconclass="fa-html5">fa-html5</option><option value="fa-i-cursor"  data-iconclass="fa-i-cursor">fa-i-cursor</option><option value="fa-ils"  data-iconclass="fa-ils">fa-ils</option><option value="fa-image"  data-iconclass="fa-image">fa-image</option><option value="fa-inbox"  data-iconclass="fa-inbox">fa-inbox</option><option value="fa-indent"  data-iconclass="fa-indent">fa-indent</option><option value="fa-industry"  data-iconclass="fa-industry">fa-industry</option><option value="fa-info"  data-iconclass="fa-info">fa-info</option><option value="fa-info-circle"  data-iconclass="fa-info-circle">fa-info-circle</option><option value="fa-inr"  data-iconclass="fa-inr">fa-inr</option><option value="fa-instagram"  data-iconclass="fa-instagram">fa-instagram</option><option value="fa-institution"  data-iconclass="fa-institution">fa-institution</option><option value="fa-internet-explorer"  data-iconclass="fa-internet-explorer">fa-internet-explorer</option><option value="fa-intersex"  data-iconclass="fa-intersex">fa-intersex</option><option value="fa-ioxhost"  data-iconclass="fa-ioxhost">fa-ioxhost</option><option value="fa-italic"  data-iconclass="fa-italic">fa-italic</option><option value="fa-joomla"  data-iconclass="fa-joomla">fa-joomla</option><option value="fa-jpy"  data-iconclass="fa-jpy">fa-jpy</option><option value="fa-jsfiddle"  data-iconclass="fa-jsfiddle">fa-jsfiddle</option><option value="fa-key"  data-iconclass="fa-key">fa-key</option><option value="fa-keyboard-o"  data-iconclass="fa-keyboard-o">fa-keyboard-o</option><option value="fa-krw"  data-iconclass="fa-krw">fa-krw</option><option value="fa-language"  data-iconclass="fa-language">fa-language</option><option value="fa-laptop"  data-iconclass="fa-laptop">fa-laptop</option><option value="fa-lastfm"  data-iconclass="fa-lastfm">fa-lastfm</option><option value="fa-lastfm-square"  data-iconclass="fa-lastfm-square">fa-lastfm-square</option><option value="fa-leaf"  data-iconclass="fa-leaf">fa-leaf</option><option value="fa-leanpub"  data-iconclass="fa-leanpub">fa-leanpub</option><option value="fa-legal"  data-iconclass="fa-legal">fa-legal</option><option value="fa-lemon-o"  data-iconclass="fa-lemon-o">fa-lemon-o</option><option value="fa-level-down"  data-iconclass="fa-level-down">fa-level-down</option><option value="fa-level-up"  data-iconclass="fa-level-up">fa-level-up</option><option value="fa-life-bouy"  data-iconclass="fa-life-bouy">fa-life-bouy</option><option value="fa-life-buoy"  data-iconclass="fa-life-buoy">fa-life-buoy</option><option value="fa-life-ring"  data-iconclass="fa-life-ring">fa-life-ring</option><option value="fa-life-saver"  data-iconclass="fa-life-saver">fa-life-saver</option><option value="fa-lightbulb-o"  data-iconclass="fa-lightbulb-o">fa-lightbulb-o</option><option value="fa-line-chart"  data-iconclass="fa-line-chart">fa-line-chart</option><option value="fa-link"  data-iconclass="fa-link">fa-link</option><option value="fa-linkedin"  data-iconclass="fa-linkedin">fa-linkedin</option><option value="fa-linkedin-square"  data-iconclass="fa-linkedin-square">fa-linkedin-square</option><option value="fa-linux"  data-iconclass="fa-linux">fa-linux</option><option value="fa-list"  data-iconclass="fa-list">fa-list</option><option value="fa-list-alt"  data-iconclass="fa-list-alt">fa-list-alt</option><option value="fa-list-ol"  data-iconclass="fa-list-ol">fa-list-ol</option><option value="fa-list-ul"  data-iconclass="fa-list-ul">fa-list-ul</option><option value="fa-location-arrow"  data-iconclass="fa-location-arrow">fa-location-arrow</option><option value="fa-lock"  data-iconclass="fa-lock">fa-lock</option><option value="fa-long-arrow-down"  data-iconclass="fa-long-arrow-down">fa-long-arrow-down</option><option value="fa-long-arrow-left"  data-iconclass="fa-long-arrow-left">fa-long-arrow-left</option><option value="fa-long-arrow-right"  data-iconclass="fa-long-arrow-right">fa-long-arrow-right</option><option value="fa-long-arrow-up"  data-iconclass="fa-long-arrow-up">fa-long-arrow-up</option><option value="fa-magic"  data-iconclass="fa-magic">fa-magic</option><option value="fa-magnet"  data-iconclass="fa-magnet">fa-magnet</option><option value="fa-mail-forward"  data-iconclass="fa-mail-forward">fa-mail-forward</option><option value="fa-mail-reply"  data-iconclass="fa-mail-reply">fa-mail-reply</option><option value="fa-mail-reply-all"  data-iconclass="fa-mail-reply-all">fa-mail-reply-all</option><option value="fa-male"  data-iconclass="fa-male">fa-male</option><option value="fa-map"  data-iconclass="fa-map">fa-map</option><option value="fa-map-marker"  data-iconclass="fa-map-marker">fa-map-marker</option><option value="fa-map-o"  data-iconclass="fa-map-o">fa-map-o</option><option value="fa-map-pin"  data-iconclass="fa-map-pin">fa-map-pin</option><option value="fa-map-signs"  data-iconclass="fa-map-signs">fa-map-signs</option><option value="fa-mars"  data-iconclass="fa-mars">fa-mars</option><option value="fa-mars-double"  data-iconclass="fa-mars-double">fa-mars-double</option><option value="fa-mars-stroke"  data-iconclass="fa-mars-stroke">fa-mars-stroke</option><option value="fa-mars-stroke-h"  data-iconclass="fa-mars-stroke-h">fa-mars-stroke-h</option><option value="fa-mars-stroke-v"  data-iconclass="fa-mars-stroke-v">fa-mars-stroke-v</option><option value="fa-maxcdn"  data-iconclass="fa-maxcdn">fa-maxcdn</option><option value="fa-meanpath"  data-iconclass="fa-meanpath">fa-meanpath</option><option value="fa-medium"  data-iconclass="fa-medium">fa-medium</option><option value="fa-medkit"  data-iconclass="fa-medkit">fa-medkit</option><option value="fa-meh-o"  data-iconclass="fa-meh-o">fa-meh-o</option><option value="fa-mercury"  data-iconclass="fa-mercury">fa-mercury</option><option value="fa-microphone"  data-iconclass="fa-microphone">fa-microphone</option><option value="fa-microphone-slash"  data-iconclass="fa-microphone-slash">fa-microphone-slash</option><option value="fa-minus"  data-iconclass="fa-minus">fa-minus</option><option value="fa-minus-circle"  data-iconclass="fa-minus-circle">fa-minus-circle</option><option value="fa-minus-square"  data-iconclass="fa-minus-square">fa-minus-square</option><option value="fa-minus-square-o"  data-iconclass="fa-minus-square-o">fa-minus-square-o</option><option value="fa-mixcloud"  data-iconclass="fa-mixcloud">fa-mixcloud</option><option value="fa-mobile"  data-iconclass="fa-mobile">fa-mobile</option><option value="fa-mobile-phone"  data-iconclass="fa-mobile-phone">fa-mobile-phone</option><option value="fa-modx"  data-iconclass="fa-modx">fa-modx</option><option value="fa-money"  data-iconclass="fa-money">fa-money</option><option value="fa-moon-o"  data-iconclass="fa-moon-o">fa-moon-o</option><option value="fa-mortar-board"  data-iconclass="fa-mortar-board">fa-mortar-board</option><option value="fa-motorcycle"  data-iconclass="fa-motorcycle">fa-motorcycle</option><option value="fa-mouse-pointer"  data-iconclass="fa-mouse-pointer">fa-mouse-pointer</option><option value="fa-music"  data-iconclass="fa-music">fa-music</option><option value="fa-navicon"  data-iconclass="fa-navicon">fa-navicon</option><option value="fa-neuter"  data-iconclass="fa-neuter">fa-neuter</option><option value="fa-newspaper-o"  data-iconclass="fa-newspaper-o">fa-newspaper-o</option><option value="fa-object-group"  data-iconclass="fa-object-group">fa-object-group</option><option value="fa-object-ungroup"  data-iconclass="fa-object-ungroup">fa-object-ungroup</option><option value="fa-odnoklassniki"  data-iconclass="fa-odnoklassniki">fa-odnoklassniki</option><option value="fa-odnoklassniki-square"  data-iconclass="fa-odnoklassniki-square">fa-odnoklassniki-square</option><option value="fa-opencart"  data-iconclass="fa-opencart">fa-opencart</option><option value="fa-openid"  data-iconclass="fa-openid">fa-openid</option><option value="fa-opera"  data-iconclass="fa-opera">fa-opera</option><option value="fa-optin-monster"  data-iconclass="fa-optin-monster">fa-optin-monster</option><option value="fa-outdent"  data-iconclass="fa-outdent">fa-outdent</option><option value="fa-pagelines"  data-iconclass="fa-pagelines">fa-pagelines</option><option value="fa-paint-brush"  data-iconclass="fa-paint-brush">fa-paint-brush</option><option value="fa-paper-plane"  data-iconclass="fa-paper-plane">fa-paper-plane</option><option value="fa-paper-plane-o"  data-iconclass="fa-paper-plane-o">fa-paper-plane-o</option><option value="fa-paperclip"  data-iconclass="fa-paperclip">fa-paperclip</option><option value="fa-paragraph"  data-iconclass="fa-paragraph">fa-paragraph</option><option value="fa-paste"  data-iconclass="fa-paste">fa-paste</option><option value="fa-pause"  data-iconclass="fa-pause">fa-pause</option><option value="fa-pause-circle"  data-iconclass="fa-pause-circle">fa-pause-circle</option><option value="fa-pause-circle-o"  data-iconclass="fa-pause-circle-o">fa-pause-circle-o</option><option value="fa-paw"  data-iconclass="fa-paw">fa-paw</option><option value="fa-paypal"  data-iconclass="fa-paypal">fa-paypal</option><option value="fa-pencil"  data-iconclass="fa-pencil">fa-pencil</option><option value="fa-pencil-square"  data-iconclass="fa-pencil-square">fa-pencil-square</option><option value="fa-pencil-square-o"  data-iconclass="fa-pencil-square-o">fa-pencil-square-o</option><option value="fa-percent"  data-iconclass="fa-percent">fa-percent</option><option value="fa-phone"  data-iconclass="fa-phone">fa-phone</option><option value="fa-phone-square"  data-iconclass="fa-phone-square">fa-phone-square</option><option value="fa-photo"  data-iconclass="fa-photo">fa-photo</option><option value="fa-picture-o"  data-iconclass="fa-picture-o">fa-picture-o</option><option value="fa-pie-chart"  data-iconclass="fa-pie-chart">fa-pie-chart</option><option value="fa-pied-piper"  data-iconclass="fa-pied-piper">fa-pied-piper</option><option value="fa-pied-piper-alt "  data-iconclass="fa-pied-piper-alt ">fa-pied-piper-alt </option><option value="fa-pinterest"  data-iconclass="fa-pinterest">fa-pinterest</option><option value="fa-pinterest-p"  data-iconclass="fa-pinterest-p">fa-pinterest-p</option><option value="fa-pinterest-square"  data-iconclass="fa-pinterest-square">fa-pinterest-square</option><option value="fa-plane"  data-iconclass="fa-plane">fa-plane</option><option value="fa-play"  data-iconclass="fa-play">fa-play</option><option value="fa-play-circle"  data-iconclass="fa-play-circle">fa-play-circle</option><option value="fa-play-circle-o"  data-iconclass="fa-play-circle-o">fa-play-circle-o</option><option value="fa-plug"  data-iconclass="fa-plug">fa-plug</option><option value="fa-plus"  data-iconclass="fa-plus">fa-plus</option><option value="fa-plus-circle"  data-iconclass="fa-plus-circle">fa-plus-circle</option><option value="fa-plus-square"  data-iconclass="fa-plus-square">fa-plus-square</option><option value="fa-plus-square-o"  data-iconclass="fa-plus-square-o">fa-plus-square-o</option><option value="fa-power-off"  data-iconclass="fa-power-off">fa-power-off</option><option value="fa-print"  data-iconclass="fa-print">fa-print</option><option value="fa-product-hunt"  data-iconclass="fa-product-hunt">fa-product-hunt</option><option value="fa-puzzle-piece"  data-iconclass="fa-puzzle-piece">fa-puzzle-piece</option><option value="fa-qq"  data-iconclass="fa-qq">fa-qq</option><option value="fa-qrcode"  data-iconclass="fa-qrcode">fa-qrcode</option><option value="fa-question"  data-iconclass="fa-question">fa-question</option><option value="fa-question-circle"  data-iconclass="fa-question-circle">fa-question-circle</option><option value="fa-quote-left"  data-iconclass="fa-quote-left">fa-quote-left</option><option value="fa-quote-right"  data-iconclass="fa-quote-right">fa-quote-right</option><option value="fa-ra"  data-iconclass="fa-ra">fa-ra</option><option value="fa-random"  data-iconclass="fa-random">fa-random</option><option value="fa-rebel"  data-iconclass="fa-rebel">fa-rebel</option><option value="fa-recycle"  data-iconclass="fa-recycle">fa-recycle</option><option value="fa-reddit"  data-iconclass="fa-reddit">fa-reddit</option><option value="fa-reddit-alien"  data-iconclass="fa-reddit-alien">fa-reddit-alien</option><option value="fa-reddit-square"  data-iconclass="fa-reddit-square">fa-reddit-square</option><option value="fa-refresh"  data-iconclass="fa-refresh">fa-refresh</option><option value="fa-registered"  data-iconclass="fa-registered">fa-registered</option><option value="fa-remove"  data-iconclass="fa-remove">fa-remove</option><option value="fa-renren"  data-iconclass="fa-renren">fa-renren</option><option value="fa-reorder"  data-iconclass="fa-reorder">fa-reorder</option><option value="fa-repeat"  data-iconclass="fa-repeat">fa-repeat</option><option value="fa-reply"  data-iconclass="fa-reply">fa-reply</option><option value="fa-reply-all"  data-iconclass="fa-reply-all">fa-reply-all</option><option value="fa-retweet"  data-iconclass="fa-retweet">fa-retweet</option><option value="fa-rmb"  data-iconclass="fa-rmb">fa-rmb</option><option value="fa-road"  data-iconclass="fa-road">fa-road</option><option value="fa-rocket"  data-iconclass="fa-rocket">fa-rocket</option><option value="fa-rotate-left"  data-iconclass="fa-rotate-left">fa-rotate-left</option><option value="fa-rotate-right"  data-iconclass="fa-rotate-right">fa-rotate-right</option><option value="fa-rouble"  data-iconclass="fa-rouble">fa-rouble</option><option value="fa-rss"  data-iconclass="fa-rss">fa-rss</option><option value="fa-rss-square"  data-iconclass="fa-rss-square">fa-rss-square</option><option value="fa-rub"  data-iconclass="fa-rub">fa-rub</option><option value="fa-ruble"  data-iconclass="fa-ruble">fa-ruble</option><option value="fa-rupee"  data-iconclass="fa-rupee">fa-rupee</option><option value="fa-safari"  data-iconclass="fa-safari">fa-safari</option><option value="fa-save"  data-iconclass="fa-save">fa-save</option><option value="fa-scissors"  data-iconclass="fa-scissors">fa-scissors</option><option value="fa-scribd"  data-iconclass="fa-scribd">fa-scribd</option><option value="fa-search"  data-iconclass="fa-search">fa-search</option><option value="fa-search-minus"  data-iconclass="fa-search-minus">fa-search-minus</option><option value="fa-search-plus"  data-iconclass="fa-search-plus">fa-search-plus</option><option value="fa-sellsy"  data-iconclass="fa-sellsy">fa-sellsy</option><option value="fa-send"  data-iconclass="fa-send">fa-send</option><option value="fa-send-o"  data-iconclass="fa-send-o">fa-send-o</option><option value="fa-server"  data-iconclass="fa-server">fa-server</option><option value="fa-share"  data-iconclass="fa-share">fa-share</option><option value="fa-share-alt"  data-iconclass="fa-share-alt">fa-share-alt</option><option value="fa-share-alt-square"  data-iconclass="fa-share-alt-square">fa-share-alt-square</option><option value="fa-share-square"  data-iconclass="fa-share-square">fa-share-square</option><option value="fa-share-square-o"  data-iconclass="fa-share-square-o">fa-share-square-o</option><option value="fa-shekel"  data-iconclass="fa-shekel">fa-shekel</option><option value="fa-sheqel"  data-iconclass="fa-sheqel">fa-sheqel</option><option value="fa-shield"  data-iconclass="fa-shield">fa-shield</option><option value="fa-ship"  data-iconclass="fa-ship">fa-ship</option><option value="fa-shirtsinbulk"  data-iconclass="fa-shirtsinbulk">fa-shirtsinbulk</option><option value="fa-shopping-bag"  data-iconclass="fa-shopping-bag">fa-shopping-bag</option><option value="fa-shopping-basket"  data-iconclass="fa-shopping-basket">fa-shopping-basket</option><option value="fa-shopping-cart"  data-iconclass="fa-shopping-cart">fa-shopping-cart</option><option value="fa-sign-in"  data-iconclass="fa-sign-in">fa-sign-in</option><option value="fa-sign-out"  data-iconclass="fa-sign-out">fa-sign-out</option><option value="fa-signal"  data-iconclass="fa-signal">fa-signal</option><option value="fa-simplybuilt"  data-iconclass="fa-simplybuilt">fa-simplybuilt</option><option value="fa-sitemap"  data-iconclass="fa-sitemap">fa-sitemap</option><option value="fa-skyatlas"  data-iconclass="fa-skyatlas">fa-skyatlas</option><option value="fa-skype"  data-iconclass="fa-skype">fa-skype</option><option value="fa-slack"  data-iconclass="fa-slack">fa-slack</option><option value="fa-sliders"  data-iconclass="fa-sliders">fa-sliders</option><option value="fa-slideshare"  data-iconclass="fa-slideshare">fa-slideshare</option><option value="fa-smile-o"  data-iconclass="fa-smile-o">fa-smile-o</option><option value="fa-soccer-ball-o"  data-iconclass="fa-soccer-ball-o">fa-soccer-ball-o</option><option value="fa-sort"  data-iconclass="fa-sort">fa-sort</option><option value="fa-sort-alpha-asc"  data-iconclass="fa-sort-alpha-asc">fa-sort-alpha-asc</option><option value="fa-sort-alpha-desc"  data-iconclass="fa-sort-alpha-desc">fa-sort-alpha-desc</option><option value="fa-sort-amount-asc"  data-iconclass="fa-sort-amount-asc">fa-sort-amount-asc</option><option value="fa-sort-amount-desc"  data-iconclass="fa-sort-amount-desc">fa-sort-amount-desc</option><option value="fa-sort-asc"  data-iconclass="fa-sort-asc">fa-sort-asc</option><option value="fa-sort-desc"  data-iconclass="fa-sort-desc">fa-sort-desc</option><option value="fa-sort-down"  data-iconclass="fa-sort-down">fa-sort-down</option><option value="fa-sort-numeric-asc"  data-iconclass="fa-sort-numeric-asc">fa-sort-numeric-asc</option><option value="fa-sort-numeric-desc"  data-iconclass="fa-sort-numeric-desc">fa-sort-numeric-desc</option><option value="fa-sort-up"  data-iconclass="fa-sort-up">fa-sort-up</option><option value="fa-soundcloud"  data-iconclass="fa-soundcloud">fa-soundcloud</option><option value="fa-space-shuttle"  data-iconclass="fa-space-shuttle">fa-space-shuttle</option><option value="fa-spinner"  data-iconclass="fa-spinner">fa-spinner</option><option value="fa-spoon"  data-iconclass="fa-spoon">fa-spoon</option><option value="fa-spotify"  data-iconclass="fa-spotify">fa-spotify</option><option value="fa-square"  data-iconclass="fa-square">fa-square</option><option value="fa-square-o"  data-iconclass="fa-square-o">fa-square-o</option><option value="fa-stack-exchange"  data-iconclass="fa-stack-exchange">fa-stack-exchange</option><option value="fa-stack-overflow"  data-iconclass="fa-stack-overflow">fa-stack-overflow</option><option value="fa-star"  data-iconclass="fa-star">fa-star</option><option value="fa-star-half"  data-iconclass="fa-star-half">fa-star-half</option><option value="fa-star-half-empty"  data-iconclass="fa-star-half-empty">fa-star-half-empty</option><option value="fa-star-half-full"  data-iconclass="fa-star-half-full">fa-star-half-full</option><option value="fa-star-half-o"  data-iconclass="fa-star-half-o">fa-star-half-o</option><option value="fa-star-o"  data-iconclass="fa-star-o">fa-star-o</option><option value="fa-steam"  data-iconclass="fa-steam">fa-steam</option><option value="fa-steam-square"  data-iconclass="fa-steam-square">fa-steam-square</option><option value="fa-step-backward"  data-iconclass="fa-step-backward">fa-step-backward</option><option value="fa-step-forward"  data-iconclass="fa-step-forward">fa-step-forward</option><option value="fa-stethoscope"  data-iconclass="fa-stethoscope">fa-stethoscope</option><option value="fa-sticky-note"  data-iconclass="fa-sticky-note">fa-sticky-note</option><option value="fa-sticky-note-o"  data-iconclass="fa-sticky-note-o">fa-sticky-note-o</option><option value="fa-stop"  data-iconclass="fa-stop">fa-stop</option><option value="fa-stop-circle"  data-iconclass="fa-stop-circle">fa-stop-circle</option><option value="fa-stop-circle-o"  data-iconclass="fa-stop-circle-o">fa-stop-circle-o</option><option value="fa-street-view"  data-iconclass="fa-street-view">fa-street-view</option><option value="fa-strikethrough"  data-iconclass="fa-strikethrough">fa-strikethrough</option><option value="fa-stumbleupon"  data-iconclass="fa-stumbleupon">fa-stumbleupon</option><option value="fa-stumbleupon-circle"  data-iconclass="fa-stumbleupon-circle">fa-stumbleupon-circle</option><option value="fa-subscript"  data-iconclass="fa-subscript">fa-subscript</option><option value="fa-subway"  data-iconclass="fa-subway">fa-subway</option><option value="fa-suitcase"  data-iconclass="fa-suitcase">fa-suitcase</option><option value="fa-sun-o"  data-iconclass="fa-sun-o">fa-sun-o</option><option value="fa-superscript"  data-iconclass="fa-superscript">fa-superscript</option><option value="fa-support"  data-iconclass="fa-support">fa-support</option><option value="fa-table"  data-iconclass="fa-table">fa-table</option><option value="fa-tablet"  data-iconclass="fa-tablet">fa-tablet</option><option value="fa-tachometer"  data-iconclass="fa-tachometer">fa-tachometer</option><option value="fa-tag"  data-iconclass="fa-tag">fa-tag</option><option value="fa-tags"  data-iconclass="fa-tags">fa-tags</option><option value="fa-tasks"  data-iconclass="fa-tasks">fa-tasks</option><option value="fa-taxi"  data-iconclass="fa-taxi">fa-taxi</option><option value="fa-television"  data-iconclass="fa-television">fa-television</option><option value="fa-tencent-weibo"  data-iconclass="fa-tencent-weibo">fa-tencent-weibo</option><option value="fa-terminal"  data-iconclass="fa-terminal">fa-terminal</option><option value="fa-text-height"  data-iconclass="fa-text-height">fa-text-height</option><option value="fa-text-width"  data-iconclass="fa-text-width">fa-text-width</option><option value="fa-th"  data-iconclass="fa-th">fa-th</option><option value="fa-th-large"  data-iconclass="fa-th-large">fa-th-large</option><option value="fa-th-list"  data-iconclass="fa-th-list">fa-th-list</option><option value="fa-thumb-tack"  data-iconclass="fa-thumb-tack">fa-thumb-tack</option><option value="fa-thumbs-down"  data-iconclass="fa-thumbs-down">fa-thumbs-down</option><option value="fa-thumbs-o-down"  data-iconclass="fa-thumbs-o-down">fa-thumbs-o-down</option><option value="fa-thumbs-o-up"  data-iconclass="fa-thumbs-o-up">fa-thumbs-o-up</option><option value="fa-thumbs-up"  data-iconclass="fa-thumbs-up">fa-thumbs-up</option><option value="fa-ticket"  data-iconclass="fa-ticket">fa-ticket</option><option value="fa-times"  data-iconclass="fa-times">fa-times</option><option value="fa-times-circle"  data-iconclass="fa-times-circle">fa-times-circle</option><option value="fa-times-circle-o"  data-iconclass="fa-times-circle-o">fa-times-circle-o</option><option value="fa-tint"  data-iconclass="fa-tint">fa-tint</option><option value="fa-toggle-down"  data-iconclass="fa-toggle-down">fa-toggle-down</option><option value="fa-toggle-left"  data-iconclass="fa-toggle-left">fa-toggle-left</option><option value="fa-toggle-off"  data-iconclass="fa-toggle-off">fa-toggle-off</option><option value="fa-toggle-on"  data-iconclass="fa-toggle-on">fa-toggle-on</option><option value="fa-toggle-right"  data-iconclass="fa-toggle-right">fa-toggle-right</option><option value="fa-toggle-up"  data-iconclass="fa-toggle-up">fa-toggle-up</option><option value="fa-trademark"  data-iconclass="fa-trademark">fa-trademark</option><option value="fa-train"  data-iconclass="fa-train">fa-train</option><option value="fa-transgender"  data-iconclass="fa-transgender">fa-transgender</option><option value="fa-transgender-alt"  data-iconclass="fa-transgender-alt">fa-transgender-alt</option><option value="fa-trash"  data-iconclass="fa-trash">fa-trash</option><option value="fa-trash-o"  data-iconclass="fa-trash-o">fa-trash-o</option><option value="fa-tree"  data-iconclass="fa-tree">fa-tree</option><option value="fa-trello"  data-iconclass="fa-trello">fa-trello</option><option value="fa-tripadvisor"  data-iconclass="fa-tripadvisor">fa-tripadvisor</option><option value="fa-trophy"  data-iconclass="fa-trophy">fa-trophy</option><option value="fa-truck"  data-iconclass="fa-truck">fa-truck</option><option value="fa-try"  data-iconclass="fa-try">fa-try</option><option value="fa-tty"  data-iconclass="fa-tty">fa-tty</option><option value="fa-tumblr"  data-iconclass="fa-tumblr">fa-tumblr</option><option value="fa-tumblr-square"  data-iconclass="fa-tumblr-square">fa-tumblr-square</option><option value="fa-turkish-lira"  data-iconclass="fa-turkish-lira">fa-turkish-lira</option><option value="fa-tv"  data-iconclass="fa-tv">fa-tv</option><option value="fa-twitch"  data-iconclass="fa-twitch">fa-twitch</option><option value="fa-twitter"  data-iconclass="fa-twitter">fa-twitter</option><option value="fa-twitter-square"  data-iconclass="fa-twitter-square">fa-twitter-square</option><option value="fa-umbrella"  data-iconclass="fa-umbrella">fa-umbrella</option><option value="fa-underline"  data-iconclass="fa-underline">fa-underline</option><option value="fa-undo"  data-iconclass="fa-undo">fa-undo</option><option value="fa-university"  data-iconclass="fa-university">fa-university</option><option value="fa-unlink"  data-iconclass="fa-unlink">fa-unlink</option><option value="fa-unlock"  data-iconclass="fa-unlock">fa-unlock</option><option value="fa-unlock-alt"  data-iconclass="fa-unlock-alt">fa-unlock-alt</option><option value="fa-unsorted"  data-iconclass="fa-unsorted">fa-unsorted</option><option value="fa-upload"  data-iconclass="fa-upload">fa-upload</option><option value="fa-usb"  data-iconclass="fa-usb">fa-usb</option><option value="fa-usd"  data-iconclass="fa-usd">fa-usd</option><option value="fa-user"  data-iconclass="fa-user">fa-user</option><option value="fa-user-md"  data-iconclass="fa-user-md">fa-user-md</option><option value="fa-user-plus"  data-iconclass="fa-user-plus">fa-user-plus</option><option value="fa-user-secret"  data-iconclass="fa-user-secret">fa-user-secret</option><option value="fa-user-times"  data-iconclass="fa-user-times">fa-user-times</option><option value="fa-users"  data-iconclass="fa-users">fa-users</option><option value="fa-venus"  data-iconclass="fa-venus">fa-venus</option><option value="fa-venus-double"  data-iconclass="fa-venus-double">fa-venus-double</option><option value="fa-venus-mars"  data-iconclass="fa-venus-mars">fa-venus-mars</option><option value="fa-viacoin"  data-iconclass="fa-viacoin">fa-viacoin</option><option value="fa-video-camera"  data-iconclass="fa-video-camera">fa-video-camera</option><option value="fa-vimeo"  data-iconclass="fa-vimeo">fa-vimeo</option><option value="fa-vimeo-square"  data-iconclass="fa-vimeo-square">fa-vimeo-square</option><option value="fa-vine"  data-iconclass="fa-vine">fa-vine</option><option value="fa-vk"  data-iconclass="fa-vk">fa-vk</option><option value="fa-volume-down"  data-iconclass="fa-volume-down">fa-volume-down</option><option value="fa-volume-off"  data-iconclass="fa-volume-off">fa-volume-off</option><option value="fa-volume-up"  data-iconclass="fa-volume-up">fa-volume-up</option><option value="fa-warning"  data-iconclass="fa-warning">fa-warning</option><option value="fa-wechat"  data-iconclass="fa-wechat">fa-wechat</option><option value="fa-weibo"  data-iconclass="fa-weibo">fa-weibo</option><option value="fa-weixin"  data-iconclass="fa-weixin">fa-weixin</option><option value="fa-whatsapp"  data-iconclass="fa-whatsapp">fa-whatsapp</option><option value="fa-wheelchair"  data-iconclass="fa-wheelchair">fa-wheelchair</option><option value="fa-wifi"  data-iconclass="fa-wifi">fa-wifi</option><option value="fa-wikipedia-w"  data-iconclass="fa-wikipedia-w">fa-wikipedia-w</option><option value="fa-windows"  data-iconclass="fa-windows">fa-windows</option><option value="fa-won"  data-iconclass="fa-won">fa-won</option><option value="fa-wordpress"  data-iconclass="fa-wordpress">fa-wordpress</option><option value="fa-wrench"  data-iconclass="fa-wrench">fa-wrench</option><option value="fa-xing"  data-iconclass="fa-xing">fa-xing</option><option value="fa-xing-square"  data-iconclass="fa-xing-square">fa-xing-square</option><option value="fa-y-combinator"  data-iconclass="fa-y-combinator">fa-y-combinator</option><option value="fa-y-combinator-square"  data-iconclass="fa-y-combinator-square">fa-y-combinator-square</option><option value="fa-yahoo"  data-iconclass="fa-yahoo">fa-yahoo</option><option value="fa-yc"  data-iconclass="fa-yc">fa-yc</option><option value="fa-yc-square"  data-iconclass="fa-yc-square">fa-yc-square</option><option value="fa-yelp"  data-iconclass="fa-yelp">fa-yelp</option><option value="fa-yen"  data-iconclass="fa-yen">fa-yen</option><option value="fa-youtube"  data-iconclass="fa-youtube">fa-youtube</option><option value="fa-youtube-play"  data-iconclass="fa-youtube-play">fa-youtube-play</option><option value="fa-youtube-square"  data-iconclass="fa-youtube-square">fa-youtube-square</option></select></div>');
        field.find('.dd-container').remove();

        /*Initialize ddslick for the new box*/
        field.find('.llorix-one-lite-dd').ddslick({
          onSelected: function(selectedData){
          }
        });

                field.find(".llorix_one_lite_icon_control").val('');
                field.find(".llorix_one_lite_text_control").val('');
                field.find(".llorix_one_lite_link_control").val('');
                field.find(".llorix_one_lite_box_id").val(id);
                field.find(".custom_media_url").val('');
                field.find(".llorix_one_lite_title_control").val('');
                field.find(".llorix_one_lite_subtitle_control").val('');
                field.find(".llorix_one_lite_shortcode_control").val('');
                th.find(".llorix_one_lite_general_control_repeater_container:first").parent().append(field);
                llorix_one_refresh_general_control_values();
            }
      
    }
    return false;
   });
   
  jQuery("#customize-theme-controls").on("click", ".llorix_one_lite_general_control_remove_field",function(){
    if( typeof  jQuery(this).parent() != 'undefined'){
      jQuery(this).parent().parent().remove();
      llorix_one_refresh_general_control_values();
    }
    return false;
  });


  jQuery("#customize-theme-controls").on('keyup', '.llorix_one_lite_title_control',function(){
     llorix_one_refresh_general_control_values();
  });

  jQuery("#customize-theme-controls").on('keyup', '.llorix_one_lite_subtitle_control',function(){
     llorix_one_refresh_general_control_values();
  });
    
    jQuery("#customize-theme-controls").on('keyup', '.llorix_one_lite_shortcode_control',function(){
     llorix_one_refresh_general_control_values();
  });
    
  jQuery("#customize-theme-controls").on('keyup', '.llorix_one_lite_text_control',function(){
     llorix_one_refresh_general_control_values();
  });
  
  jQuery("#customize-theme-controls").on('keyup', '.llorix_one_lite_link_control',function(){
    llorix_one_refresh_general_control_values();
  });
  
  /*Drag and drop to change icons order*/
  jQuery(".llorix_one_lite_general_control_droppable").sortable({
    update: function( event, ui ) {
      llorix_one_refresh_general_control_values();
    }
  }); 

});

var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;',
  };

  function escapeHtml(string) {
    string = String(string).replace(/\\/g,'&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
  }
/********************************************
*** Parallax effect
*********************************************/

jQuery(document).ready(function(){
  
    jQuery('.llorix-one-lite-dd').ddslick({
    onSelected: function(selectedData){
      //callback function: do something with selectedData;
    }
  });

  var sh = jQuery('#customize-control-llorix_one_lite_enable_move').find('input:checkbox');
  if(!sh.is(':checked')){
    jQuery('#customize-control-llorix_one_lite_first_layer').hide();
    jQuery('#customize-control-llorix_one_lite_second_layer').hide();
    jQuery('#customize-control-header_image').show();
  } else {
    jQuery('#customize-control-llorix_one_lite_first_layer').show();
    jQuery('#customize-control-llorix_one_lite_second_layer').show();
    jQuery('#customize-control-header_image').hide();
  }
  
  sh.on('change',function(){
    if(jQuery(this).is(':checked')){
      jQuery('#customize-control-llorix_one_lite_first_layer').fadeIn();
      jQuery('#customize-control-llorix_one_lite_second_layer').fadeIn();
      jQuery('#customize-control-header_image').fadeOut();
    } else {
      jQuery('#customize-control-llorix_one_lite_first_layer').fadeOut();
      jQuery('#customize-control-llorix_one_lite_second_layer').fadeOut();
      jQuery('#customize-control-header_image').fadeIn();
    } 
  });
});

/********************************************
*** Alpha Opacity
*********************************************/

jQuery(document).ready(function($) {
 
  Color.prototype.toString = function(remove_alpha) {
    if (remove_alpha == 'no-alpha') {
      return this.toCSS('rgba', '1').replace(/\s+/g, '');
    }
    if (this._alpha < 1) {
      return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
    }
    var hex = parseInt(this._color, 10).toString(16);
    if (this.error) return '';
    if (hex.length < 6) {
      for (var i = 6 - hex.length - 1; i >= 0; i--) {
        hex = '0' + hex;
      }
    }
    return '#' + hex;
  };
   
    $('.pluto-color-control').each(function() {
    var $control = $(this),
      value = $control.val().replace(/\s+/g, '');
    // Manage Palettes
    var palette_input = $control.attr('data-palette');
    if (palette_input == 'false' || palette_input == false) {
      var palette = false;
    } else if (palette_input == 'true' || palette_input == true) {
      var palette = true;
    } else {
      var palette = $control.attr('data-palette').split(",");
    }
    $control.wpColorPicker({ // change some things with the color picker
       clear: function(event, ui) {
      // TODO reset Alpha Slider to 100
       },
      change: function(event, ui) {
        // send ajax request to wp.customizer to enable Save & Publish button
        var _new_value = $control.val();
        var key = $control.attr('data-customize-setting-link');
        wp.customize(key, function(obj) {
          obj.set(_new_value);
        });
        // change the background color of our transparency container whenever a color is updated
        var $transparency = $control.parents('.wp-picker-container:first').find('.transparency');
        // we only want to show the color at 100% alpha
        $transparency.css('backgroundColor', ui.color.toString('no-alpha'));
      },
      palettes: palette // remove the color palettes
    });
    $('<div class="llorix-one-lite-alpha-container"><div class="slider-alpha"></div><div class="transparency"></div></div>').appendTo($control.parents('.wp-picker-container'));
    var $alpha_slider = $control.parents('.wp-picker-container:first').find('.slider-alpha');
    // if in format RGBA - grab A channel value
    if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
      var alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
      var alpha_val = parseInt(alpha_val);
    } else {
      var alpha_val = 100;
    }
    $alpha_slider.slider({
      slide: function(event, ui) {
        $(this).find('.ui-slider-handle').text(ui.value); // show value on slider handle
        // send ajax request to wp.customizer to enable Save & Publish button
        var _new_value = $control.val();
        var key = $control.attr('data-customize-setting-link');
        wp.customize(key, function(obj) {
          obj.set(_new_value);
        });
      },
      create: function(event, ui) {
        var v = $(this).slider('value');
        $(this).find('.ui-slider-handle').text(v);
      },
      value: alpha_val,
      range: "max",
      step: 1,
      min: 1,
      max: 100
    }); // slider
    $alpha_slider.slider().on('slidechange', function(event, ui) {
      var new_alpha_val = parseFloat(ui.value),
        iris = $control.data('a8cIris'),
        color_picker = $control.data('wpWpColorPicker');
      iris._color._alpha = new_alpha_val / 100.0;
      $control.val(iris._color.toString());
      color_picker.toggler.css({
        backgroundColor: $control.val()
      });
      // fix relationship between alpha slider and the 'side slider not updating.
      var get_val = $control.val();
      $($control).wpColorPicker('color', get_val);
    });
  });

 
});