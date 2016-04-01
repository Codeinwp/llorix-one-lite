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
                field.find('.dd-container').before('<div class="llorix-one-lite-dd"><select name="llorix_one_lite_very_top_social_icons" class="llorix_one_lite_icon_control"><option value="fa-500px" >fa-500px</option><option value="fa-adjust" >fa-adjust</option><option value="fa-adn" >fa-adn</option><option value="fa-align-center" >fa-align-center</option><option value="fa-align-justify" >fa-align-justify</option><option value="fa-align-left" >fa-align-left</option><option value="fa-align-right" >fa-align-right</option><option value="fa-amazon" >fa-amazon</option><option value="fa-ambulance" >fa-ambulance</option><option value="fa-anchor" >fa-anchor</option><option value="fa-android" >fa-android</option><option value="fa-angellist" >fa-angellist</option><option value="fa-angle-double-down" >fa-angle-double-down</option><option value="fa-angle-double-left" >fa-angle-double-left</option><option value="fa-angle-double-right" >fa-angle-double-right</option><option value="fa-angle-double-up" >fa-angle-double-up</option><option value="fa-angle-down" >fa-angle-down</option><option value="fa-angle-left" >fa-angle-left</option><option value="fa-angle-right" >fa-angle-right</option><option value="fa-angle-up" >fa-angle-up</option><option value="fa-apple" >fa-apple</option><option value="fa-archive" >fa-archive</option><option value="fa-area-chart" >fa-area-chart</option><option value="fa-arrow-circle-down" >fa-arrow-circle-down</option><option value="fa-arrow-circle-left" >fa-arrow-circle-left</option><option value="fa-arrow-circle-o-down" >fa-arrow-circle-o-down</option><option value="fa-arrow-circle-o-left" >fa-arrow-circle-o-left</option><option value="fa-arrow-circle-o-right" >fa-arrow-circle-o-right</option><option value="fa-arrow-circle-o-up" >fa-arrow-circle-o-up</option><option value="fa-arrow-circle-right" >fa-arrow-circle-right</option><option value="fa-arrow-circle-up" >fa-arrow-circle-up</option><option value="fa-arrow-down" >fa-arrow-down</option><option value="fa-arrow-left" >fa-arrow-left</option><option value="fa-arrow-right" >fa-arrow-right</option><option value="fa-arrow-up" >fa-arrow-up</option><option value="fa-arrows" >fa-arrows</option><option value="fa-arrows-alt" >fa-arrows-alt</option><option value="fa-arrows-h" >fa-arrows-h</option><option value="fa-arrows-v" >fa-arrows-v</option><option value="fa-asterisk" >fa-asterisk</option><option value="fa-at" >fa-at</option><option value="fa-automobile" >fa-automobile</option><option value="fa-backward" >fa-backward</option><option value="fa-balance-scale" >fa-balance-scale</option><option value="fa-ban" >fa-ban</option><option value="fa-bank" >fa-bank</option><option value="fa-bar-chart" >fa-bar-chart</option><option value="fa-bar-chart-o" >fa-bar-chart-o</option><option value="fa-barcode" >fa-barcode</option><option value="fa-bars" >fa-bars</option><option value="fa-battery-0" >fa-battery-0</option><option value="fa-battery-1" >fa-battery-1</option><option value="fa-battery-2" >fa-battery-2</option><option value="fa-battery-3" >fa-battery-3</option><option value="fa-battery-4" >fa-battery-4</option><option value="fa-battery-empty" >fa-battery-empty</option><option value="fa-battery-full" >fa-battery-full</option><option value="fa-battery-half" >fa-battery-half</option><option value="fa-battery-quarter" >fa-battery-quarter</option><option value="fa-battery-three-quarters" >fa-battery-three-quarters</option><option value="fa-bed" >fa-bed</option><option value="fa-beer" >fa-beer</option><option value="fa-behance" >fa-behance</option><option value="fa-behance-square" >fa-behance-square</option><option value="fa-bell" >fa-bell</option><option value="fa-bell-o" >fa-bell-o</option><option value="fa-bell-slash" >fa-bell-slash</option><option value="fa-bell-slash-o" >fa-bell-slash-o</option><option value="fa-bicycle" >fa-bicycle</option><option value="fa-binoculars" >fa-binoculars</option><option value="fa-birthday-cake" >fa-birthday-cake</option><option value="fa-bitbucket" >fa-bitbucket</option><option value="fa-bitbucket-square" >fa-bitbucket-square</option><option value="fa-bitcoin" >fa-bitcoin</option><option value="fa-black-tie" >fa-black-tie</option><option value="fa-bluetooth" >fa-bluetooth</option><option value="fa-bluetooth-b" >fa-bluetooth-b</option><option value="fa-bold" >fa-bold</option><option value="fa-bolt" >fa-bolt</option><option value="fa-bomb" >fa-bomb</option><option value="fa-book" >fa-book</option><option value="fa-bookmark" >fa-bookmark</option><option value="fa-bookmark-o" >fa-bookmark-o</option><option value="fa-briefcase" >fa-briefcase</option><option value="fa-btc" >fa-btc</option><option value="fa-bug" >fa-bug</option><option value="fa-building" >fa-building</option><option value="fa-building-o" >fa-building-o</option><option value="fa-bullhorn" >fa-bullhorn</option><option value="fa-bullseye" >fa-bullseye</option><option value="fa-bus" >fa-bus</option><option value="fa-buysellads" >fa-buysellads</option><option value="fa-cab" >fa-cab</option><option value="fa-calculator" >fa-calculator</option><option value="fa-calendar" >fa-calendar</option><option value="fa-calendar-check-o" >fa-calendar-check-o</option><option value="fa-calendar-minus-o" >fa-calendar-minus-o</option><option value="fa-calendar-o" >fa-calendar-o</option><option value="fa-calendar-plus-o" >fa-calendar-plus-o</option><option value="fa-calendar-times-o" >fa-calendar-times-o</option><option value="fa-camera" >fa-camera</option><option value="fa-camera-retro" >fa-camera-retro</option><option value="fa-car" >fa-car</option><option value="fa-caret-down" >fa-caret-down</option><option value="fa-caret-left" >fa-caret-left</option><option value="fa-caret-right" >fa-caret-right</option><option value="fa-caret-square-o-down" >fa-caret-square-o-down</option><option value="fa-caret-square-o-left" >fa-caret-square-o-left</option><option value="fa-caret-square-o-right" >fa-caret-square-o-right</option><option value="fa-caret-square-o-up" >fa-caret-square-o-up</option><option value="fa-caret-up" >fa-caret-up</option><option value="fa-cart-arrow-down" >fa-cart-arrow-down</option><option value="fa-cart-plus" >fa-cart-plus</option><option value="fa-cc" >fa-cc</option><option value="fa-cc-amex" >fa-cc-amex</option><option value="fa-cc-diners-club" >fa-cc-diners-club</option><option value="fa-cc-discover" >fa-cc-discover</option><option value="fa-cc-jcb" >fa-cc-jcb</option><option value="fa-cc-mastercard" >fa-cc-mastercard</option><option value="fa-cc-paypal" >fa-cc-paypal</option><option value="fa-cc-stripe" >fa-cc-stripe</option><option value="fa-cc-visa" >fa-cc-visa</option><option value="fa-certificate" >fa-certificate</option><option value="fa-chain" >fa-chain</option><option value="fa-chain-broken" >fa-chain-broken</option><option value="fa-check" >fa-check</option><option value="fa-check-circle" >fa-check-circle</option><option value="fa-check-circle-o" >fa-check-circle-o</option><option value="fa-check-square" >fa-check-square</option><option value="fa-check-square-o" >fa-check-square-o</option><option value="fa-chevron-circle-down" >fa-chevron-circle-down</option><option value="fa-chevron-circle-left" >fa-chevron-circle-left</option><option value="fa-chevron-circle-right" >fa-chevron-circle-right</option><option value="fa-chevron-circle-up" >fa-chevron-circle-up</option><option value="fa-chevron-down" >fa-chevron-down</option><option value="fa-chevron-left" >fa-chevron-left</option><option value="fa-chevron-right" >fa-chevron-right</option><option value="fa-chevron-up" >fa-chevron-up</option><option value="fa-child" >fa-child</option><option value="fa-chrome" >fa-chrome</option><option value="fa-circle" >fa-circle</option><option value="fa-circle-o" >fa-circle-o</option><option value="fa-circle-o-notch" >fa-circle-o-notch</option><option value="fa-circle-thin" >fa-circle-thin</option><option value="fa-clipboard" >fa-clipboard</option><option value="fa-clock-o" >fa-clock-o</option><option value="fa-clone" >fa-clone</option><option value="fa-close" >fa-close</option><option value="fa-cloud" >fa-cloud</option><option value="fa-cloud-download" >fa-cloud-download</option><option value="fa-cloud-upload" >fa-cloud-upload</option><option value="fa-cny" >fa-cny</option><option value="fa-code" >fa-code</option><option value="fa-code-fork" >fa-code-fork</option><option value="fa-codepen" >fa-codepen</option><option value="fa-codiepie" >fa-codiepie</option><option value="fa-coffee" >fa-coffee</option><option value="fa-cog" >fa-cog</option><option value="fa-cogs" >fa-cogs</option><option value="fa-columns" >fa-columns</option><option value="fa-comment" >fa-comment</option><option value="fa-comment-o" >fa-comment-o</option><option value="fa-commenting" >fa-commenting</option><option value="fa-commenting-o" >fa-commenting-o</option><option value="fa-comments" >fa-comments</option><option value="fa-comments-o" >fa-comments-o</option><option value="fa-compass" >fa-compass</option><option value="fa-compress" >fa-compress</option><option value="fa-connectdevelop" >fa-connectdevelop</option><option value="fa-contao" >fa-contao</option><option value="fa-copy" >fa-copy</option><option value="fa-copyright" >fa-copyright</option><option value="fa-creative-commons" >fa-creative-commons</option><option value="fa-credit-card" >fa-credit-card</option><option value="fa-credit-card-alt" >fa-credit-card-alt</option><option value="fa-crop" >fa-crop</option><option value="fa-crosshairs" >fa-crosshairs</option><option value="fa-css3" >fa-css3</option><option value="fa-cube" >fa-cube</option><option value="fa-cubes" >fa-cubes</option><option value="fa-cut" >fa-cut</option><option value="fa-cutlery" >fa-cutlery</option><option value="fa-dashboard" >fa-dashboard</option><option value="fa-dashcube" >fa-dashcube</option><option value="fa-database" >fa-database</option><option value="fa-dedent" >fa-dedent</option><option value="fa-delicious" >fa-delicious</option><option value="fa-desktop" >fa-desktop</option><option value="fa-deviantart" >fa-deviantart</option><option value="fa-diamond" >fa-diamond</option><option value="fa-digg" >fa-digg</option><option value="fa-dollar" >fa-dollar</option><option value="fa-dot-circle-o" >fa-dot-circle-o</option><option value="fa-download" >fa-download</option><option value="fa-dribbble" >fa-dribbble</option><option value="fa-dropbox" >fa-dropbox</option><option value="fa-drupal" >fa-drupal</option><option value="fa-edge" >fa-edge</option><option value="fa-edit" >fa-edit</option><option value="fa-eject" >fa-eject</option><option value="fa-ellipsis-h" >fa-ellipsis-h</option><option value="fa-ellipsis-v" >fa-ellipsis-v</option><option value="fa-empire" >fa-empire</option><option value="fa-envelope" >fa-envelope</option><option value="fa-envelope-o" >fa-envelope-o</option><option value="fa-envelope-square" >fa-envelope-square</option><option value="fa-eraser" >fa-eraser</option><option value="fa-eur" >fa-eur</option><option value="fa-euro" >fa-euro</option><option value="fa-exchange" >fa-exchange</option><option value="fa-exclamation" >fa-exclamation</option><option value="fa-exclamation-circle" >fa-exclamation-circle</option><option value="fa-exclamation-triangle" >fa-exclamation-triangle</option><option value="fa-expand" >fa-expand</option><option value="fa-expeditedssl" >fa-expeditedssl</option><option value="fa-external-link" >fa-external-link</option><option value="fa-external-link-square" >fa-external-link-square</option><option value="fa-eye" >fa-eye</option><option value="fa-eye-slash" >fa-eye-slash</option><option value="fa-eyedropper" >fa-eyedropper</option><option value="fa-facebook">fa-facebook</option><option value="fa-facebook-f" >fa-facebook-f</option><option value="fa-facebook-official" >fa-facebook-official</option><option value="fa-facebook-square" >fa-facebook-square</option><option value="fa-fast-backward" >fa-fast-backward</option><option value="fa-fast-forward" >fa-fast-forward</option><option value="fa-fax" >fa-fax</option><option value="fa-feed" >fa-feed</option><option value="fa-female" >fa-female</option><option value="fa-fighter-jet" >fa-fighter-jet</option><option value="fa-file" >fa-file</option><option value="fa-file-archive-o" >fa-file-archive-o</option><option value="fa-file-audio-o" >fa-file-audio-o</option><option value="fa-file-code-o" >fa-file-code-o</option><option value="fa-file-excel-o" >fa-file-excel-o</option><option value="fa-file-image-o" >fa-file-image-o</option><option value="fa-file-movie-o" >fa-file-movie-o</option><option value="fa-file-o" >fa-file-o</option><option value="fa-file-pdf-o" >fa-file-pdf-o</option><option value="fa-file-photo-o" >fa-file-photo-o</option><option value="fa-file-picture-o" >fa-file-picture-o</option><option value="fa-file-powerpoint-o" >fa-file-powerpoint-o</option><option value="fa-file-sound-o" >fa-file-sound-o</option><option value="fa-file-text" >fa-file-text</option><option value="fa-file-text-o" >fa-file-text-o</option><option value="fa-file-video-o" >fa-file-video-o</option><option value="fa-file-word-o" >fa-file-word-o</option><option value="fa-file-zip-o" >fa-file-zip-o</option><option value="fa-files-o" >fa-files-o</option><option value="fa-film" >fa-film</option><option value="fa-filter" >fa-filter</option><option value="fa-fire" >fa-fire</option><option value="fa-fire-extinguisher" >fa-fire-extinguisher</option><option value="fa-firefox" >fa-firefox</option><option value="fa-flag" >fa-flag</option><option value="fa-flag-checkered" >fa-flag-checkered</option><option value="fa-flag-o" >fa-flag-o</option><option value="fa-flash" >fa-flash</option><option value="fa-flask" >fa-flask</option><option value="fa-flickr" >fa-flickr</option><option value="fa-floppy-o" >fa-floppy-o</option><option value="fa-folder" >fa-folder</option><option value="fa-folder-o" >fa-folder-o</option><option value="fa-folder-open" >fa-folder-open</option><option value="fa-folder-open-o" >fa-folder-open-o</option><option value="fa-font" >fa-font</option><option value="fa-fonticons" >fa-fonticons</option><option value="fa-fort-awesome" >fa-fort-awesome</option><option value="fa-forumbee" >fa-forumbee</option><option value="fa-forward" >fa-forward</option><option value="fa-foursquare" >fa-foursquare</option><option value="fa-frown-o" >fa-frown-o</option><option value="fa-futbol-o" >fa-futbol-o</option><option value="fa-gamepad" >fa-gamepad</option><option value="fa-gavel" >fa-gavel</option><option value="fa-gbp" >fa-gbp</option><option value="fa-ge" >fa-ge</option><option value="fa-gear" >fa-gear</option><option value="fa-gears" >fa-gears</option><option value="fa-genderless" >fa-genderless</option><option value="fa-get-pocket" >fa-get-pocket</option><option value="fa-gg" >fa-gg</option><option value="fa-gg-circle" >fa-gg-circle</option><option value="fa-gift" >fa-gift</option><option value="fa-git" >fa-git</option><option value="fa-git-square" >fa-git-square</option><option value="fa-github" >fa-github</option><option value="fa-github-alt" >fa-github-alt</option><option value="fa-github-square" >fa-github-square</option><option value="fa-gittip" >fa-gittip</option><option value="fa-glass" >fa-glass</option><option value="fa-globe" >fa-globe</option><option value="fa-google" >fa-google</option><option value="fa-google-plus" >fa-google-plus</option><option value="fa-google-plus-square" >fa-google-plus-square</option><option value="fa-google-wallet" >fa-google-wallet</option><option value="fa-graduation-cap" >fa-graduation-cap</option><option value="fa-gratipay" >fa-gratipay</option><option value="fa-group" >fa-group</option><option value="fa-h-square" >fa-h-square</option><option value="fa-hacker-news" >fa-hacker-news</option><option value="fa-hand-grab-o" >fa-hand-grab-o</option><option value="fa-hand-lizard-o" >fa-hand-lizard-o</option><option value="fa-hand-o-down" >fa-hand-o-down</option><option value="fa-hand-o-left" >fa-hand-o-left</option><option value="fa-hand-o-right" >fa-hand-o-right</option><option value="fa-hand-o-up" >fa-hand-o-up</option><option value="fa-hand-paper-o" >fa-hand-paper-o</option><option value="fa-hand-peace-o" >fa-hand-peace-o</option><option value="fa-hand-pointer-o" >fa-hand-pointer-o</option><option value="fa-hand-rock-o" >fa-hand-rock-o</option><option value="fa-hand-scissors-o" >fa-hand-scissors-o</option><option value="fa-hand-spock-o" >fa-hand-spock-o</option><option value="fa-hand-stop-o" >fa-hand-stop-o</option><option value="fa-hashtag" >fa-hashtag</option><option value="fa-hdd-o" >fa-hdd-o</option><option value="fa-header" >fa-header</option><option value="fa-headphones" >fa-headphones</option><option value="fa-heart" >fa-heart</option><option value="fa-heart-o" >fa-heart-o</option><option value="fa-heartbeat" >fa-heartbeat</option><option value="fa-history" >fa-history</option><option value="fa-home" >fa-home</option><option value="fa-hospital-o" >fa-hospital-o</option><option value="fa-hotel" >fa-hotel</option><option value="fa-hourglass" >fa-hourglass</option><option value="fa-hourglass-1" >fa-hourglass-1</option><option value="fa-hourglass-2" >fa-hourglass-2</option><option value="fa-hourglass-3" >fa-hourglass-3</option><option value="fa-hourglass-end" >fa-hourglass-end</option><option value="fa-hourglass-half" >fa-hourglass-half</option><option value="fa-hourglass-o" >fa-hourglass-o</option><option value="fa-hourglass-start" >fa-hourglass-start</option><option value="fa-houzz" >fa-houzz</option><option value="fa-html5" >fa-html5</option><option value="fa-i-cursor" >fa-i-cursor</option><option value="fa-ils" >fa-ils</option><option value="fa-image" >fa-image</option><option value="fa-inbox" >fa-inbox</option><option value="fa-indent" >fa-indent</option><option value="fa-industry" >fa-industry</option><option value="fa-info" >fa-info</option><option value="fa-info-circle" >fa-info-circle</option><option value="fa-inr" >fa-inr</option><option value="fa-instagram" >fa-instagram</option><option value="fa-institution" >fa-institution</option><option value="fa-internet-explorer" >fa-internet-explorer</option><option value="fa-intersex" >fa-intersex</option><option value="fa-ioxhost" >fa-ioxhost</option><option value="fa-italic" >fa-italic</option><option value="fa-joomla" >fa-joomla</option><option value="fa-jpy" >fa-jpy</option><option value="fa-jsfiddle" >fa-jsfiddle</option><option value="fa-key" >fa-key</option><option value="fa-keyboard-o" >fa-keyboard-o</option><option value="fa-krw" >fa-krw</option><option value="fa-language" >fa-language</option><option value="fa-laptop" >fa-laptop</option><option value="fa-lastfm" >fa-lastfm</option><option value="fa-lastfm-square" >fa-lastfm-square</option><option value="fa-leaf" >fa-leaf</option><option value="fa-leanpub" >fa-leanpub</option><option value="fa-legal" >fa-legal</option><option value="fa-lemon-o" >fa-lemon-o</option><option value="fa-level-down" >fa-level-down</option><option value="fa-level-up" >fa-level-up</option><option value="fa-life-bouy" >fa-life-bouy</option><option value="fa-life-buoy" >fa-life-buoy</option><option value="fa-life-ring" >fa-life-ring</option><option value="fa-life-saver" >fa-life-saver</option><option value="fa-lightbulb-o" >fa-lightbulb-o</option><option value="fa-line-chart" >fa-line-chart</option><option value="fa-link" >fa-link</option><option value="fa-linkedin" >fa-linkedin</option><option value="fa-linkedin-square" >fa-linkedin-square</option><option value="fa-linux" >fa-linux</option><option value="fa-list" >fa-list</option><option value="fa-list-alt" >fa-list-alt</option><option value="fa-list-ol" >fa-list-ol</option><option value="fa-list-ul" >fa-list-ul</option><option value="fa-location-arrow" >fa-location-arrow</option><option value="fa-lock" >fa-lock</option><option value="fa-long-arrow-down" >fa-long-arrow-down</option><option value="fa-long-arrow-left" >fa-long-arrow-left</option><option value="fa-long-arrow-right" >fa-long-arrow-right</option><option value="fa-long-arrow-up" >fa-long-arrow-up</option><option value="fa-magic" >fa-magic</option><option value="fa-magnet" >fa-magnet</option><option value="fa-mail-forward" >fa-mail-forward</option><option value="fa-mail-reply" >fa-mail-reply</option><option value="fa-mail-reply-all" >fa-mail-reply-all</option><option value="fa-male" >fa-male</option><option value="fa-map" >fa-map</option><option value="fa-map-marker" >fa-map-marker</option><option value="fa-map-o" >fa-map-o</option><option value="fa-map-pin" >fa-map-pin</option><option value="fa-map-signs" >fa-map-signs</option><option value="fa-mars" >fa-mars</option><option value="fa-mars-double" >fa-mars-double</option><option value="fa-mars-stroke" >fa-mars-stroke</option><option value="fa-mars-stroke-h" >fa-mars-stroke-h</option><option value="fa-mars-stroke-v" >fa-mars-stroke-v</option><option value="fa-maxcdn" >fa-maxcdn</option><option value="fa-meanpath" >fa-meanpath</option><option value="fa-medium" >fa-medium</option><option value="fa-medkit" >fa-medkit</option><option value="fa-meh-o" >fa-meh-o</option><option value="fa-mercury" >fa-mercury</option><option value="fa-microphone" >fa-microphone</option><option value="fa-microphone-slash" >fa-microphone-slash</option><option value="fa-minus" >fa-minus</option><option value="fa-minus-circle" >fa-minus-circle</option><option value="fa-minus-square" >fa-minus-square</option><option value="fa-minus-square-o" >fa-minus-square-o</option><option value="fa-mixcloud" >fa-mixcloud</option><option value="fa-mobile" >fa-mobile</option><option value="fa-mobile-phone" >fa-mobile-phone</option><option value="fa-modx" >fa-modx</option><option value="fa-money" >fa-money</option><option value="fa-moon-o" >fa-moon-o</option><option value="fa-mortar-board" >fa-mortar-board</option><option value="fa-motorcycle" >fa-motorcycle</option><option value="fa-mouse-pointer" >fa-mouse-pointer</option><option value="fa-music" >fa-music</option><option value="fa-navicon" >fa-navicon</option><option value="fa-neuter" >fa-neuter</option><option value="fa-newspaper-o" >fa-newspaper-o</option><option value="fa-object-group" >fa-object-group</option><option value="fa-object-ungroup" >fa-object-ungroup</option><option value="fa-odnoklassniki" >fa-odnoklassniki</option><option value="fa-odnoklassniki-square" >fa-odnoklassniki-square</option><option value="fa-opencart" >fa-opencart</option><option value="fa-openid" >fa-openid</option><option value="fa-opera" >fa-opera</option><option value="fa-optin-monster" >fa-optin-monster</option><option value="fa-outdent" >fa-outdent</option><option value="fa-pagelines" >fa-pagelines</option><option value="fa-paint-brush" >fa-paint-brush</option><option value="fa-paper-plane" >fa-paper-plane</option><option value="fa-paper-plane-o" >fa-paper-plane-o</option><option value="fa-paperclip" >fa-paperclip</option><option value="fa-paragraph" >fa-paragraph</option><option value="fa-paste" >fa-paste</option><option value="fa-pause" >fa-pause</option><option value="fa-pause-circle" >fa-pause-circle</option><option value="fa-pause-circle-o" >fa-pause-circle-o</option><option value="fa-paw" >fa-paw</option><option value="fa-paypal" >fa-paypal</option><option value="fa-pencil" >fa-pencil</option><option value="fa-pencil-square" >fa-pencil-square</option><option value="fa-pencil-square-o" >fa-pencil-square-o</option><option value="fa-percent" >fa-percent</option><option value="fa-phone" >fa-phone</option><option value="fa-phone-square" >fa-phone-square</option><option value="fa-photo" >fa-photo</option><option value="fa-picture-o" >fa-picture-o</option><option value="fa-pie-chart" >fa-pie-chart</option><option value="fa-pied-piper" >fa-pied-piper</option><option value="fa-pied-piper-alt " >fa-pied-piper-alt </option><option value="fa-pinterest" >fa-pinterest</option><option value="fa-pinterest-p" >fa-pinterest-p</option><option value="fa-pinterest-square" >fa-pinterest-square</option><option value="fa-plane" >fa-plane</option><option value="fa-play" >fa-play</option><option value="fa-play-circle" >fa-play-circle</option><option value="fa-play-circle-o" >fa-play-circle-o</option><option value="fa-plug" >fa-plug</option><option value="fa-plus" >fa-plus</option><option value="fa-plus-circle" >fa-plus-circle</option><option value="fa-plus-square" >fa-plus-square</option><option value="fa-plus-square-o" >fa-plus-square-o</option><option value="fa-power-off" >fa-power-off</option><option value="fa-print" >fa-print</option><option value="fa-product-hunt" >fa-product-hunt</option><option value="fa-puzzle-piece" >fa-puzzle-piece</option><option value="fa-qq" >fa-qq</option><option value="fa-qrcode" >fa-qrcode</option><option value="fa-question" >fa-question</option><option value="fa-question-circle" >fa-question-circle</option><option value="fa-quote-left" >fa-quote-left</option><option value="fa-quote-right" >fa-quote-right</option><option value="fa-ra" >fa-ra</option><option value="fa-random" >fa-random</option><option value="fa-rebel" >fa-rebel</option><option value="fa-recycle" >fa-recycle</option><option value="fa-reddit" >fa-reddit</option><option value="fa-reddit-alien" >fa-reddit-alien</option><option value="fa-reddit-square" >fa-reddit-square</option><option value="fa-refresh" >fa-refresh</option><option value="fa-registered" >fa-registered</option><option value="fa-remove" >fa-remove</option><option value="fa-renren" >fa-renren</option><option value="fa-reorder" >fa-reorder</option><option value="fa-repeat" >fa-repeat</option><option value="fa-reply" >fa-reply</option><option value="fa-reply-all" >fa-reply-all</option><option value="fa-retweet" >fa-retweet</option><option value="fa-rmb" >fa-rmb</option><option value="fa-road" >fa-road</option><option value="fa-rocket" >fa-rocket</option><option value="fa-rotate-left" >fa-rotate-left</option><option value="fa-rotate-right" >fa-rotate-right</option><option value="fa-rouble" >fa-rouble</option><option value="fa-rss" >fa-rss</option><option value="fa-rss-square" >fa-rss-square</option><option value="fa-rub" >fa-rub</option><option value="fa-ruble" >fa-ruble</option><option value="fa-rupee" >fa-rupee</option><option value="fa-safari" >fa-safari</option><option value="fa-save" >fa-save</option><option value="fa-scissors" >fa-scissors</option><option value="fa-scribd" >fa-scribd</option><option value="fa-search" >fa-search</option><option value="fa-search-minus" >fa-search-minus</option><option value="fa-search-plus" >fa-search-plus</option><option value="fa-sellsy" >fa-sellsy</option><option value="fa-send" >fa-send</option><option value="fa-send-o" >fa-send-o</option><option value="fa-server" >fa-server</option><option value="fa-share" >fa-share</option><option value="fa-share-alt" >fa-share-alt</option><option value="fa-share-alt-square" >fa-share-alt-square</option><option value="fa-share-square" >fa-share-square</option><option value="fa-share-square-o" >fa-share-square-o</option><option value="fa-shekel" >fa-shekel</option><option value="fa-sheqel" >fa-sheqel</option><option value="fa-shield" >fa-shield</option><option value="fa-ship" >fa-ship</option><option value="fa-shirtsinbulk" >fa-shirtsinbulk</option><option value="fa-shopping-bag" >fa-shopping-bag</option><option value="fa-shopping-basket" >fa-shopping-basket</option><option value="fa-shopping-cart" >fa-shopping-cart</option><option value="fa-sign-in" >fa-sign-in</option><option value="fa-sign-out" >fa-sign-out</option><option value="fa-signal" >fa-signal</option><option value="fa-simplybuilt" >fa-simplybuilt</option><option value="fa-sitemap" >fa-sitemap</option><option value="fa-skyatlas" >fa-skyatlas</option><option value="fa-skype" >fa-skype</option><option value="fa-slack" >fa-slack</option><option value="fa-sliders" >fa-sliders</option><option value="fa-slideshare" >fa-slideshare</option><option value="fa-smile-o" >fa-smile-o</option><option value="fa-soccer-ball-o" >fa-soccer-ball-o</option><option value="fa-sort" >fa-sort</option><option value="fa-sort-alpha-asc" >fa-sort-alpha-asc</option><option value="fa-sort-alpha-desc" >fa-sort-alpha-desc</option><option value="fa-sort-amount-asc" >fa-sort-amount-asc</option><option value="fa-sort-amount-desc" >fa-sort-amount-desc</option><option value="fa-sort-asc" >fa-sort-asc</option><option value="fa-sort-desc" >fa-sort-desc</option><option value="fa-sort-down" >fa-sort-down</option><option value="fa-sort-numeric-asc" >fa-sort-numeric-asc</option><option value="fa-sort-numeric-desc" >fa-sort-numeric-desc</option><option value="fa-sort-up" >fa-sort-up</option><option value="fa-soundcloud" >fa-soundcloud</option><option value="fa-space-shuttle" >fa-space-shuttle</option><option value="fa-spinner" >fa-spinner</option><option value="fa-spoon" >fa-spoon</option><option value="fa-spotify" >fa-spotify</option><option value="fa-square" >fa-square</option><option value="fa-square-o" >fa-square-o</option><option value="fa-stack-exchange" >fa-stack-exchange</option><option value="fa-stack-overflow" >fa-stack-overflow</option><option value="fa-star" >fa-star</option><option value="fa-star-half" >fa-star-half</option><option value="fa-star-half-empty" >fa-star-half-empty</option><option value="fa-star-half-full" >fa-star-half-full</option><option value="fa-star-half-o" >fa-star-half-o</option><option value="fa-star-o" >fa-star-o</option><option value="fa-steam" >fa-steam</option><option value="fa-steam-square" >fa-steam-square</option><option value="fa-step-backward" >fa-step-backward</option><option value="fa-step-forward" >fa-step-forward</option><option value="fa-stethoscope" >fa-stethoscope</option><option value="fa-sticky-note" >fa-sticky-note</option><option value="fa-sticky-note-o" >fa-sticky-note-o</option><option value="fa-stop" >fa-stop</option><option value="fa-stop-circle" >fa-stop-circle</option><option value="fa-stop-circle-o" >fa-stop-circle-o</option><option value="fa-street-view" >fa-street-view</option><option value="fa-strikethrough" >fa-strikethrough</option><option value="fa-stumbleupon" >fa-stumbleupon</option><option value="fa-stumbleupon-circle" >fa-stumbleupon-circle</option><option value="fa-subscript" >fa-subscript</option><option value="fa-subway" >fa-subway</option><option value="fa-suitcase" >fa-suitcase</option><option value="fa-sun-o" >fa-sun-o</option><option value="fa-superscript" >fa-superscript</option><option value="fa-support" >fa-support</option><option value="fa-table" >fa-table</option><option value="fa-tablet" >fa-tablet</option><option value="fa-tachometer" >fa-tachometer</option><option value="fa-tag" >fa-tag</option><option value="fa-tags" >fa-tags</option><option value="fa-tasks" >fa-tasks</option><option value="fa-taxi" >fa-taxi</option><option value="fa-television" >fa-television</option><option value="fa-tencent-weibo" >fa-tencent-weibo</option><option value="fa-terminal" >fa-terminal</option><option value="fa-text-height" >fa-text-height</option><option value="fa-text-width" >fa-text-width</option><option value="fa-th" >fa-th</option><option value="fa-th-large" >fa-th-large</option><option value="fa-th-list" >fa-th-list</option><option value="fa-thumb-tack" >fa-thumb-tack</option><option value="fa-thumbs-down" >fa-thumbs-down</option><option value="fa-thumbs-o-down" >fa-thumbs-o-down</option><option value="fa-thumbs-o-up" >fa-thumbs-o-up</option><option value="fa-thumbs-up" >fa-thumbs-up</option><option value="fa-ticket" >fa-ticket</option><option value="fa-times" >fa-times</option><option value="fa-times-circle" >fa-times-circle</option><option value="fa-times-circle-o" >fa-times-circle-o</option><option value="fa-tint" >fa-tint</option><option value="fa-toggle-down" >fa-toggle-down</option><option value="fa-toggle-left" >fa-toggle-left</option><option value="fa-toggle-off" >fa-toggle-off</option><option value="fa-toggle-on" >fa-toggle-on</option><option value="fa-toggle-right" >fa-toggle-right</option><option value="fa-toggle-up" >fa-toggle-up</option><option value="fa-trademark" >fa-trademark</option><option value="fa-train" >fa-train</option><option value="fa-transgender" >fa-transgender</option><option value="fa-transgender-alt" >fa-transgender-alt</option><option value="fa-trash" >fa-trash</option><option value="fa-trash-o" >fa-trash-o</option><option value="fa-tree" >fa-tree</option><option value="fa-trello" >fa-trello</option><option value="fa-tripadvisor" >fa-tripadvisor</option><option value="fa-trophy" >fa-trophy</option><option value="fa-truck" >fa-truck</option><option value="fa-try" >fa-try</option><option value="fa-tty" >fa-tty</option><option value="fa-tumblr" >fa-tumblr</option><option value="fa-tumblr-square" >fa-tumblr-square</option><option value="fa-turkish-lira" >fa-turkish-lira</option><option value="fa-tv" >fa-tv</option><option value="fa-twitch" >fa-twitch</option><option value="fa-twitter" >fa-twitter</option><option value="fa-twitter-square" >fa-twitter-square</option><option value="fa-umbrella" >fa-umbrella</option><option value="fa-underline" >fa-underline</option><option value="fa-undo" >fa-undo</option><option value="fa-university" >fa-university</option><option value="fa-unlink" >fa-unlink</option><option value="fa-unlock" >fa-unlock</option><option value="fa-unlock-alt" >fa-unlock-alt</option><option value="fa-unsorted" >fa-unsorted</option><option value="fa-upload" >fa-upload</option><option value="fa-usb" >fa-usb</option><option value="fa-usd" >fa-usd</option><option value="fa-user" >fa-user</option><option value="fa-user-md" >fa-user-md</option><option value="fa-user-plus" >fa-user-plus</option><option value="fa-user-secret" >fa-user-secret</option><option value="fa-user-times" >fa-user-times</option><option value="fa-users" >fa-users</option><option value="fa-venus" >fa-venus</option><option value="fa-venus-double" >fa-venus-double</option><option value="fa-venus-mars" >fa-venus-mars</option><option value="fa-viacoin" >fa-viacoin</option><option value="fa-video-camera" >fa-video-camera</option><option value="fa-vimeo" >fa-vimeo</option><option value="fa-vimeo-square" >fa-vimeo-square</option><option value="fa-vine" >fa-vine</option><option value="fa-vk" >fa-vk</option><option value="fa-volume-down" >fa-volume-down</option><option value="fa-volume-off" >fa-volume-off</option><option value="fa-volume-up" >fa-volume-up</option><option value="fa-warning" >fa-warning</option><option value="fa-wechat" >fa-wechat</option><option value="fa-weibo" >fa-weibo</option><option value="fa-weixin" >fa-weixin</option><option value="fa-whatsapp" >fa-whatsapp</option><option value="fa-wheelchair" >fa-wheelchair</option><option value="fa-wifi" >fa-wifi</option><option value="fa-wikipedia-w" >fa-wikipedia-w</option><option value="fa-windows" >fa-windows</option><option value="fa-won" >fa-won</option><option value="fa-wordpress" >fa-wordpress</option><option value="fa-wrench" >fa-wrench</option><option value="fa-xing" >fa-xing</option><option value="fa-xing-square" >fa-xing-square</option><option value="fa-y-combinator" >fa-y-combinator</option><option value="fa-y-combinator-square" >fa-y-combinator-square</option><option value="fa-yahoo" >fa-yahoo</option><option value="fa-yc" >fa-yc</option><option value="fa-yc-square" >fa-yc-square</option><option value="fa-yelp" >fa-yelp</option><option value="fa-yen" >fa-yen</option><option value="fa-youtube" >fa-youtube</option><option value="fa-youtube-play" >fa-youtube-play</option><option value="fa-youtube-square" >fa-youtube-square</option></select></div>');
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
		if( typeof	jQuery(this).parent() != 'undefined'){
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