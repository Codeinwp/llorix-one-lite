<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Llorix_One_Lite_General_Repeater extends WP_Customize_Control {

    public $id;
    private $llorix_one_lite_image_control = false;
    private $llorix_one_lite_icon_control = false;
    private $llorix_one_lite_title_control = false;
    private $llorix_one_lite_subtitle_control = false;
    private $llorix_one_lite_text_control = false;
    private $llorix_one_lite_link_control = false;
    private $llorix_one_lite_shortcode_control = false;


    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        if(!empty($args['llorix_one_lite_image_control'])){
            $this->llorix_one_lite_image_control = $args['llorix_one_lite_image_control'];
        }
        if(!empty($args['llorix_one_lite_icon_control'])){
            $this->llorix_one_lite_icon_control = $args['llorix_one_lite_icon_control'];
        }
        if(!empty($args['llorix_one_lite_title_control'])){
            $this->llorix_one_lite_title_control = $args['llorix_one_lite_title_control'];
        }
        if(!empty($args['llorix_one_lite_subtitle_control'])){
            $this->llorix_one_lite_subtitle_control = $args['llorix_one_lite_subtitle_control'];
        }
        if(!empty($args['llorix_one_lite_text_control'])){
            $this->llorix_one_lite_text_control = $args['llorix_one_lite_text_control'];
        }
        if(!empty($args['llorix_one_lite_link_control'])){
            $this->llorix_one_lite_link_control = $args['llorix_one_lite_link_control'];
        }
        if(!empty($args['llorix_one_lite_shortcode_control'])){
            $this->llorix_one_lite_shortcode_control = $args['llorix_one_lite_shortcode_control'];
        }
        if(!empty($args['section'])){
            $this->id = $args['section'];
        }
    }

    public function render_content() {


        $this_default = json_decode($this->setting->default);

        $values = $this->value();
        $json = json_decode($values);
        if(!is_array($json)) {
            $json = array($values);
        } ?>

        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="llorix_one_lite_general_control_repeater llorix_one_lite_general_control_droppable">
            <?php
            if(empty($json)) {
                if(!empty($this_default)){
                    $this->iterate_array($this_default); ?>
                    <input type="hidden" id="llorix_one_lite_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="llorix_one_lite_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
                    <?php
                } else {
                    $this->iterate_array(); ?>
                    <input type="hidden" id="llorix_one_lite_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="llorix_one_lite_repeater_colector" />
                    <?php
                }
            } else {
                $this->iterate_array($json); ?>
                <input type="hidden" id="llorix_one_lite_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="llorix_one_lite_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
                <?php
            } ?>
        </div>

        <button type="button"   class="button add_field llorix_one_lite_general_control_new_field">
            <?php esc_html_e('Add new field','llorix-one-lite'); ?>
        </button>

        <?php
    }

    /**
     * Enqueue required scripts and styles.
     */
    public function enqueue() {
        wp_enqueue_script( 'llorix-one-lite-fontawesome-iconpicker', llorix_one_lite_get_file( '/inc/icon-picker/js/fontawesome-iconpicker.min.js'), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'llorix-one-lite-iconpicker-control', llorix_one_lite_get_file( '/inc/icon-picker/js/iconpicker-control.js'), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_style( 'llorix-one-lite-fontawesome-iconpicker', llorix_one_lite_get_file( '/inc/icon-picker/css/fontawesome-iconpicker.min.css' ));
        wp_enqueue_style( 'llorix-one-lite-fontawesome-admin', llorix_one_lite_get_file( '/css/font-awesome.min.css' ),array(), '4.5.0');
    }

    private function icon_picker_control($value = '', $show = ''){ ?>
        <div class="llorix_one_lite_general_control_icon" <?php if( $show === 'llorix_one_lite_image' ) echo 'style="display:none;"' ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Icon','llorix-one-lite'); ?>
            </span>
            <span class="description customize-control-description">
                <?php
                echo sprintf(
                    __( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s', 'llorix-one-lite' ),
                    sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__( 'http://fontawesome.io/icons/', 'themotion' ) )
                ); ?>
            </span>
            <div class="input-group icp-container">
                <input data-placement="bottomRight" class="icp icp-auto" value="<?php echo esc_attr( $value ); ?>" type="text">
                <span class="input-group-addon"></span>
            </div>
        </div>
        <?php
    }

    private function image_control($value = '', $show = ''){ ?>
        <p class="llorix_one_lite_image_control" <?php if( $show === 'llorix_one_lite_icon' ) echo 'style="display:none;"' ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Image','llorix-one-lite')?>
            </span>
            <input type="text" class="widefat custom_media_url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-primary custom_media_button_llorix_one_lite" value="<?php esc_html_e('Upload Image','llorix-one-lite'); ?>" />
        </p>
        <?php
    }

    private function icon_type_choice($value='llorix_one_lite_icon'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Image type','llorix-one-lite');?>
        </span>
        <select class="llorix_one_lite_image_choice">
            <option value="llorix_one_lite_icon" <?php selected($value,'llorix_one_lite_icon');?>><?php esc_html_e('Icon','llorix-one-lite'); ?></option>
            <option value="llorix_one_lite_image" <?php selected($value,'llorix_one_lite_image');?>><?php esc_html_e('Image','llorix-one-lite'); ?></option>
            <option value="llorix_one_lite_none" <?php selected($value,'llorix_one_lite_none');?>><?php esc_html_e('None','llorix-one-lite'); ?></option>
        </select>
        <?php
    }

    private function input_control($options, $value=''){ ?>
        <span class="customize-control-title"><?php echo $options['label']; ?></span>
        <?php
        if( !empty($options['type']) && $options['type'] === 'textarea' ){ ?>
            <textarea class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo $options['label']; ?>"><?php echo ( !empty($options['sanitize_callback']) ?  apply_filters( $options['sanitize_callback'] , $value) : esc_attr($value) ); ?></textarea>
            <?php
        } else { ?>
            <input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  apply_filters( $options['sanitize_callback'] , $value) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo $options['label']; ?>"/>
            <?php
        }
    }

    private function iterate_array($array = array()){
        $it = 0;
        if(!empty($array)){
            foreach($array as $icon){ ?>
                <div class="llorix_one_lite_general_control_repeater_container llorix_one_lite_draggable">
                    <div class="llorix-one-lite-customize-control-title">
                        <?php esc_html_e('Llorix One','llorix-one-lite')?>
                    </div>
                    <div class="llorix-one-lite-box-content-hidden">
                        <?php
                        $choice = 'llorix_one_lite_icon';
                        $image_url = $icon_value = $title = $subtitle = $text = $link = $shortcode = '';

                        if(!empty($icon->choice)){
                            $choice = $icon->choice;
                        }
                        if(!empty($icon->image_url)){
                            $image_url = $icon->image_url;
                        }
                        if(!empty($icon->icon_value)){
                            $icon_value = $icon->icon_value;
                        }
                        if(!empty($icon->title)){
                            $title = $icon->title;
                        }
                        if(!empty($icon->subtitle)){
                            $subtitle =  $icon->subtitle;
                        }
                        if(!empty($icon->text)){
                            $text = $icon->text;
                        }
                        if(!empty($icon->link)){
                            $link = $icon->link;
                        }
                        if(!empty($icon->shortcode)){
                            $shortcode = $icon->shortcode;
                        }


                        if($this->llorix_one_lite_image_control == true && $this->llorix_one_lite_icon_control == true) {

                            $this->icon_type_choice( $choice );
                        }

                        if($this->llorix_one_lite_image_control == true){
                            $this->image_control($image_url, $choice);
                        }

                        if($this->llorix_one_lite_icon_control == true){
                            $this->icon_picker_control($icon_value, $choice);
                        }

                        if($this->llorix_one_lite_title_control==true){
                            $this->input_control(array(
                                'label' => __('Title','llorix-one-lite'),
                                'class' => 'llorix_one_lite_title_control',
                            ), $title);
                        }

                        if($this->llorix_one_lite_subtitle_control==true){
                            $this->input_control(array(
                                'label' => __('Subtitle','llorix-one-lite'),
                                'class' => 'llorix_one_lite_subtitle_control',
                            ), $subtitle);
                        }

                        if($this->llorix_one_lite_text_control==true){
                            $this->input_control(array(
                                'label' => __('Text','llorix-one-lite'),
                                'class' => 'llorix_one_lite_text_control',
                                'type'  => 'textarea'
                            ), $text);
                        }

                        if($this->llorix_one_lite_link_control){
                            $this->input_control(array(
                                'label' => __('Link','llorix-one-lite'),
                                'class' => 'llorix_one_lite_link_control',
                                'sanitize_callback' => 'esc_url'
                            ), $link);
                        }

                        if($this->llorix_one_lite_shortcode_control==true){
                            $this->input_control(array(
                                'label' => __('Shortcode','llorix-one-lite'),
                                'class' => 'llorix_one_lite_shortcode_control',
                            ), $shortcode);
                        } ?>
                        <input type="hidden" class="llorix_one_lite_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                        <button type="button" class="llorix_one_lite_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','llorix-one-lite'); ?></button>
                    </div>
                </div>

                <?php
                $it++;
            }
        } else { ?>
            <div class="llorix_one_lite_general_control_repeater_container">
                <div
                    class="llorix-one-lite-customize-control-title"><?php esc_html_e( 'Llorix One', 'llorix-one-lite' ) ?></div>
                <div class="llorix-one-lite-box-content-hidden">
                    <?php
                    if ( $this->llorix_one_lite_image_control == true && $this->llorix_one_lite_icon_control == true ) {
                        $this->icon_type_choice();
                    }

                    if ( $this->llorix_one_lite_image_control == true ) {
                        $this->image_control();
                    }

                    if ( $this->llorix_one_lite_icon_control == true ) {
                        $this->icon_picker_control();
                    }

                    if ( $this->llorix_one_lite_title_control == true ) {
                        $this->input_control( array(
                            'label' => __( 'Title', 'llorix-one-lite' ),
                            'class' => 'llorix_one_lite_title_control',
                        ) );
                    }

                    if ( $this->llorix_one_lite_subtitle_control == true ) {
                        $this->input_control( array(
                            'label' => __( 'Subtitle', 'llorix-one-lite' ),
                            'class' => 'llorix_one_lite_subtitle_control'
                        ) );
                    }


                    if ( $this->llorix_one_lite_text_control == true ) {
                        $this->input_control( array(
                            'label' => __( 'Text', 'llorix-one-lite' ),
                            'class' => 'llorix_one_lite_text_control',
                            'type'  => 'textarea'
                        ) );
                    }

                    if ( $this->llorix_one_lite_link_control == true ) {
                        $this->input_control( array(
                            'label' => __( 'Link', 'llorix-one-lite' ),
                            'class' => 'llorix_one_lite_link_control'
                        ) );
                    }

                    if ( $this->llorix_one_lite_shortcode_control == true ) {
                        $this->input_control( array(
                            'label' => __( 'Shortcode', 'llorix-one-lite' ),
                            'class' => 'llorix_one_lite_shortcode_control'
                        ) );
                    }
                    ?>
                    <input type="hidden" class="llorix_one_lite_box_id">
                    <button type="button" class="llorix_one_lite_general_control_remove_field button"
                            style="display:none;"><?php esc_html_e( 'Delete field', 'llorix-one-lite' ); ?></button>
                </div>
            </div>
            <?php
        }
    }
}