<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Llorix_One_Lite_General_Repeater extends WP_Customize_Control {

        private $options = array();

        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
            $this->options = $args;
        }

        public function render_content() {


            $this_default = json_decode($this->setting->default);


            $values = $this->value();
            $json = json_decode($values);
            if(!is_array($json)) $json = array($values);
            $it = 0;
            $it2 = 0;

            $options = $this->options;
            if(!empty($options['llorix_one_lite_image_control'])){
                $llorix_one_lite_image_control = $options['llorix_one_lite_image_control'];
            } else {
                $llorix_one_lite_image_control = false;
            }
            if(!empty($options['llorix_one_lite_icon_control'])){
                $llorix_one_lite_icon_control = $options['llorix_one_lite_icon_control'];
                $icons_array = array( 'No Icon','fa-envelope','fa-map-marker','fa-500px','fa-amazon','fa-android','fa-behance','fa-behance-square','fa-bitbucket','fa-bitbucket-square','fa-cc-amex','fa-cc-diners-club','fa-cc-discover','fa-cc-jcb','fa-cc-mastercard','fa-paypal','fa-cc-stripe','fa-cc-visa','fa-codepen','fa-css3','fa-delicious','fa-deviantart','fa-digg','fa-dribbble','fa-dropbox','fa-drupal','fa-facebook','fa-facebook-official','fa-facebook-square','fa-flickr','fa-foursquare','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-google','fa-google-plus','fa-google-plus-square','fa-html5','fa-instagram','fa-joomla','fa-jsfiddle','fa-linkedin','fa-linkedin-square','fa-opencart','fa-openid','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-rebel','fa-reddit','fa-reddit-square','fa-share-alt','fa-share-alt-square','fa-skype','fa-slack','fa-soundcloud','fa-spotify','fa-stack-overflow','fa-steam','fa-steam-square','fa-tripadvisor','fa-tumblr','fa-tumblr-square','fa-twitch','fa-twitter','fa-twitter-square','fa-vimeo','fa-vimeo-square','fa-vine','fa-whatsapp','fa-wordpress','fa-yahoo','fa-youtube','fa-youtube-play','fa-youtube-square');
            } else {
                 $llorix_one_lite_icon_control = false;
            }
            if(!empty($options['llorix_one_lite_title_control'])){
                $llorix_one_lite_title_control = $options['llorix_one_lite_title_control'];
            } else {
                $llorix_one_lite_title_control = false;
            }
            if(!empty($options['llorix_one_lite_subtitle_control'])){
                $llorix_one_lite_subtitle_control = $options['llorix_one_lite_subtitle_control'];
            } else {
                $llorix_one_lite_subtitle_control = false;
            }                        
            if(!empty($options['llorix_one_lite_text_control'])){
                $llorix_one_lite_text_control = $options['llorix_one_lite_text_control'];
            } else {
                $llorix_one_lite_text_control = false;
            }
            if(!empty($options['llorix_one_lite_link_control'])){
                $llorix_one_lite_link_control = $options['llorix_one_lite_link_control'];
            } else {
                $llorix_one_lite_link_control = false;
            }
            if(!empty($options['llorix_one_lite_shortcode_control'])){
                $llorix_one_lite_shortcode_control = $options['llorix_one_lite_shortcode_control'];
            } else {
                $llorix_one_lite_shortcode_control = false;
            }
            

 ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="llorix_one_lite_general_control_repeater llorix_one_lite_general_control_droppable">
                <?php
                    if(empty($json)) {
                        
                ?>
                        <div class="llorix_one_lite_general_control_repeater_container">
                            <div class="llorix-one-lite-customize-control-title"><?php esc_html_e('Llorix One','llorix-one-lite')?></div>
                            <div class="llorix-one-lite-box-content-hidden">
                                <?php
                                    if($llorix_one_lite_image_control == true && $llorix_one_lite_icon_control == true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Image type','llorix-one-lite');?></span>
                                        <select class="llorix_one_lite_image_choice">
                                            <option value="llorix_one_lite_icon" selected><?php esc_html_e('Icon','llorix-one-lite'); ?></option>
                                            <option value="llorix_one_lite_image"><?php esc_html_e('Image','llorix-one-lite'); ?></option>
                                            <option value="llorix_one_lite_none"><?php esc_html_e('None','llorix-one-lite'); ?></option>
                                        </select>

                                        <p class="llorix_one_lite_image_control" style="display:none">
                                            <span class="customize-control-title"><?php esc_html_e('Image','llorix-one-lite')?></span>
                                            <input type="text" class="widefat custom_media_url">
                                            <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
                                        </p>

                                        <div class="llorix_one_lite_general_control_icon">
                                            <span class="customize-control-title"><?php esc_html_e('Icon','llorix-one-lite');?></span>
                                            <select class="llorix_one_lite_icon_control">
                                            <?php
                                                foreach($icons_array as $contact_icon) {
                                                    echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                <?php
                                    } else {
                                        if($llorix_one_lite_image_control ==true){	?>
                                            <span class="customize-control-title"><?php esc_html_e('Image','llorix-one-lite')?></span>
                                            <p class="llorix_one_lite_image_control">
                                                <input type="text" class="widefat custom_media_url">
                                                <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
                                            </p>
                                <?php
                                        }

                                       if($llorix_one_lite_icon_control ==true){
                                ?>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','llorix-one-lite')?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="llorix_one_lite_icon_control">
                                                <?php
                                                    foreach($icons_array as $contact_icon) {
                                                        echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                    }
                                                ?>
                                            </select>
                                <?php   }
                                    }
                        
                                    if($llorix_one_lite_title_control==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Title','llorix-one-lite')?></span>
                                        <input type="text" class="llorix_one_lite_title_control" placeholder="<?php esc_html_e('Title','llorix-one-lite'); ?>"/>
                                <?php
                                    }
                        
                                    if($llorix_one_lite_subtitle_control==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Subtitle','llorix-one-lite')?></span>
                                        <input type="text" class="llorix_one_lite_subtitle_control" placeholder="<?php esc_html_e('Subtitle','llorix-one-lite'); ?>"/>
                                <?php
                                    }
 

                                    if($llorix_one_lite_text_control==true){?>
                                        <span class="customize-control-title"><?php esc_html_e('Text','llorix-one-lite')?></span>
                                        <textarea class="llorix_one_lite_text_control" placeholder="<?php esc_html_e('Text','llorix-one-lite'); ?>"></textarea>
                                <?php }

                                    if($llorix_one_lite_link_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Link','llorix-one-lite')?></span>
                                        <input type="text" class="llorix_one_lite_link_control" placeholder="<?php esc_html_e('Link','llorix-one-lite'); ?>"/>
                                <?php } 
                                    if($llorix_one_lite_shortcode_control==true){
                                    ?>
                                        <span class="customize-control-title"><?php esc_html_e('Shortcode','llorix-one-lite')?></span>
                                        <input type="text" class="llorix_one_lite_shortcode_control" placeholder="<?php esc_html_e('Shortcode','llorix-one-lite'); ?>"/>
                                 <?php   
                                    }
                                ?>
                                <input type="hidden" class="llorix_one_lite_box_id">
                            <button type="button" class="llorix_one_lite_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','llorix-one-lite'); ?></button>
                            </div>
                        </div>
                <?php
                    } else {
                        if ( !empty($this_default) && empty($json)) {
                            foreach($this_default as $icon){
                             
                ?>
                                <div class="llorix_one_lite_general_control_repeater_container llorix_one_lite_draggable">
                                    <div class="llorix-one-lite-customize-control-title"><?php esc_html_e('Llorix One','llorix-one-lite')?></div>
                                    <div class="llorix-one-lite-box-content-hidden">
                                         <?php
                                            if($llorix_one_lite_image_control == true && $llorix_one_lite_icon_control == true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Image type','llorix-one-lite');?></span>
                                                <select class="llorix_one_lite_image_choice">
                                                    <option value="llorix_one_lite_icon" <?php selected($icon->choice,'llorix_one_lite_icon');?>><?php esc_html_e('Icon','llorix-one-lite');?></option>
                                                    <option value="llorix_one_lite_image" <?php selected($icon->choice,'llorix_one_lite_image');?>><?php esc_html_e('Image','llorix-one-lite');?></option>
                                                    <option value="llorix_one_lite_none" <?php selected($icon->choice,'llorix_one_lite_none');?>><?php esc_html_e('None','llorix-one-lite');?></option>
                                                </select>

                                                <p class="llorix_one_lite_image_control"  <?php if(!empty($icon->choice) && $icon->choice!='llorix_one_lite_image'){ echo 'style="display:none"';}?>>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','llorix-one-lite');?></span>
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                    <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
                                                </p>

                                                <div class="llorix_one_lite_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='llorix_one_lite_icon'){ echo 'style="display:none"';}?>>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','llorix-one-lite');?></span>
                                                    <select name="<?php echo esc_attr($this->id); ?>" class="llorix_one_lite_icon_control">
                                                        <?php
                                                            foreach($icons_array as $contact_icon) {
                                                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                        <?php
                                            } else {
                                        ?>
                                        <?php	if($llorix_one_lite_image_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','llorix-one-lite')?></span>
                                                    <p class="llorix_one_lite_image_control">
                                                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                        <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
                                                    </p>
                                        <?php	}

                                                if($llorix_one_lite_icon_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','llorix-one-lite')?></span>
                                                    <select name="<?php echo esc_attr($this->id); ?>" class="llorix_one_lite_icon_control">
                                                        <?php
                                                            foreach($icons_array as $contact_icon) {
                                                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                        <?php
                                                }
                                            }
                                                if($llorix_one_lite_title_control==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Title','llorix-one-lite')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="llorix_one_lite_title_control" placeholder="<?php esc_html_e('Title','llorix-one-lite'); ?>"/>
                                        <?php
                                                }

                                                if($llorix_one_lite_subtitle_control==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Subtitle','llorix-one-lite')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="llorix_one_lite_subtitle_control" placeholder="<?php esc_html_e('Subtitle','llorix-one-lite'); ?>"/>
                                        <?php
                                                }
 
                                                if($llorix_one_lite_text_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Text','llorix-one-lite')?></span>
                                                    <textarea placeholder="<?php esc_html_e('Text','llorix-one-lite'); ?>" class="llorix_one_lite_text_control"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                                        <?php	}
                                                if($llorix_one_lite_link_control){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Link','llorix-one-lite')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="llorix_one_lite_link_control" placeholder="<?php esc_html_e('Link','llorix-one-lite'); ?>"/>
                                        <?php	}
                                                if($llorix_one_lite_shortcode_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Shortcode','llorix-one-lite')?></span>
                                        <input type="text" value='<?php if(!empty($icon->shortcode)) echo $icon->shortcode; ?>' class="llorix_one_lite_shortcode_control" placeholder="<?php esc_html_e('Shortcode','llorix-one-lite'); ?>"/>
                                  <?php  }
                                        ?>
                                        <input type="hidden" class="llorix_one_lite_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                    <button type="button" class="llorix_one_lite_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','llorix-one-lite'); ?></button>
                                    </div>

                                </div>

                <?php
                                $it++;
                            }
                        } else {
                            foreach($json as $icon){
                    ?>
                                <div class="llorix_one_lite_general_control_repeater_container llorix_one_lite_draggable">
                                    <div class="llorix-one-lite-customize-control-title"><?php esc_html_e('Llorix One','llorix-one-lite')?></div>
                                    <div class="llorix-one-lite-box-content-hidden">
                                    <?php
                                    if($llorix_one_lite_image_control == true && $llorix_one_lite_icon_control == true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Image type','llorix-one-lite');?></span>
                                        <select class="llorix_one_lite_image_choice">
                                            <option value="llorix_one_lite_icon" <?php selected($icon->choice,'llorix_one_lite_icon');?>><?php esc_html_e('Icon','llorix-one-lite');?></option>
                                            <option value="llorix_one_lite_image" <?php selected($icon->choice,'llorix_one_lite_image');?>><?php esc_html_e('Image','llorix-one-lite');?></option>
                                            <option value="llorix_one_lite_none" <?php selected($icon->choice,'llorix_one_lite_none');?>><?php esc_html_e('None','llorix-one-lite');?></option>
                                        </select>


                                        <p class="llorix_one_lite_image_control" <?php if(!empty($icon->choice) && $icon->choice!='llorix_one_lite_image'){ echo 'style="display:none"';}?>>
                                            <span class="customize-control-title"><?php esc_html_e('Image','llorix-one-lite');?></span>
                                            <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                            <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
                                        </p>

                                        <div class="llorix_one_lite_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='llorix_one_lite_icon'){ echo 'style="display:none"';}?>>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','llorix-one-lite');?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="llorix_one_lite_icon_control">
                                            <?php
                                                foreach($icons_array as $contact_icon) {
                                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    <?php

                                    } else {
                                    ?>
                                        <?php
                                            if($llorix_one_lite_image_control == true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Image','llorix-one-lite')?></span>
                                                <p class="llorix_one_lite_image_control">
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                    <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
                                                </p>
                                        <?php }

                                            if($llorix_one_lite_icon_control==true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Icon','llorix-one-lite')?></span>
                                                <select name="<?php echo esc_attr($this->id); ?>" class="llorix_one_lite_icon_control">
                                                <?php
                                                    foreach($icons_array as $contact_icon) {
                                                        echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                    }
                                                ?>
                                                </select>
                                        <?php
                                            }
                                        }
                                        if($llorix_one_lite_title_control==true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Title','llorix-one-lite')?></span>
                                            <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="llorix_one_lite_title_control" placeholder="<?php esc_html_e('Title','llorix-one-lite'); ?>"/>
                                        <?php
                                                }

                                        if($llorix_one_lite_subtitle_control==true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Subtitle','llorix-one-lite')?></span>
                                            <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="llorix_one_lite_subtitle_control" placeholder="<?php esc_html_e('Subtitle','llorix-one-lite'); ?>"/>
                                        <?php
                                        }
                                        if($llorix_one_lite_text_control==true ){?>
                                            <span class="customize-control-title"><?php esc_html_e('Text','llorix-one-lite')?></span>
                                            <textarea class="llorix_one_lite_text_control" placeholder="<?php esc_html_e('Text','llorix-one-lite'); ?>"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                                        <?php }

                                        if($llorix_one_lite_link_control){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Link','llorix-one-lite')?></span>
                                            <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="llorix_one_lite_link_control" placeholder="<?php esc_html_e('Link','llorix-one-lite'); ?>"/>
                                        <?php }
                                        
                                
                                        if($llorix_one_lite_shortcode_control==true){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Shortcode','llorix-one-lite')?></span>
                                            <input type="text" value='<?php if(!empty($icon->shortcode)) echo $icon->shortcode; ?>' class="llorix_one_lite_shortcode_control" placeholder="<?php esc_html_e('Shortcode','llorix-one-lite'); ?>"/>
                                  <?php  }
                                        ?>
                                        <input type="hidden" class="llorix_one_lite_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                        <button type="button" class="llorix_one_lite_general_control_remove_field button" <?php
                                            if ($it == 0)
                                            echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','llorix-one-lite'); ?></button>
                                    </div>

                                </div>
                    <?php
                                $it++;
                                
                            }
                        }
                    }

                if ( !empty($this_default) && empty($json)) {
                     
                ?>
                    <input type="hidden" id="llorix_one_lite_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="llorix_one_lite_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
            <?php } else {	?>
                    <input type="hidden" id="llorix_one_lite_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="llorix_one_lite_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
            <?php } ?>
            </div>

            <button type="button"   class="button add_field llorix_one_lite_general_control_new_field"

            ><?php esc_html_e('Add new field','llorix-one-lite'); ?></button>

            <?php

    }

}