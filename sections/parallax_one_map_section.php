<!-- =========================
INTERGEO MAPS 
============================== -->
<?php
    $llorix_one_frontpage_map_shortcode = get_theme_mod('llorix_one_frontpage_map_shortcode');
    if( !empty($llorix_one_frontpage_map_shortcode) ){
?>
        <div id="container-fluid">
            <div class="parallax_one_map_overlay"></div>
            <div id="cd-google-map">
                <?php echo do_shortcode($llorix_one_frontpage_map_shortcode);?>
            </div>
        </div><!-- .container-fluid -->
<?php   
     }
?>
