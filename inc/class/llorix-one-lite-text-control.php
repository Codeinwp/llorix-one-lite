<?php
class Llorix_One_Message extends WP_Customize_Control{
    private $message = '';
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        if(!empty($args['llorix_one_lite_message'])){
            $this->message = $args['llorix_one_lite_message'];
        }
    }
    
    public function render_content(){
        echo '<span class="customize-control-title">'.$this->label.'</span>';
        echo $this->message;
    }
}

class Llorix_One_Frontpage_Templates extends WP_Customize_Control{
   
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
    }
    
    public function render_content(){
		
        $llorix_one_all_pages_array = array(); // new array with all pages
		
		$llorix_one_all_pages = get_pages(); // get all pages
		
		if( !empty($llorix_one_all_pages) ):
		
			$llorix_one_all_pages_array[0] = "&#45;&#45; Select &#45;&#45;";
		
			foreach ( $llorix_one_all_pages as $llorix_one_page ):
			
				if( !empty($llorix_one_page->ID) && !empty($llorix_one_page->post_title) ):
					$llorix_one_all_pages_array[$llorix_one_page->ID] = $llorix_one_page->post_title;
				endif;	
				
			endforeach;
		endif;
		
		if( !empty($llorix_one_all_pages_array) ): // change the frontpage control with the new array
			echo '<label>';
			echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
			echo '<select data-customize-setting-link="page_on_front" name="_customize-dropdown-pages-page_on_front" id="_customize-dropdown-pages-page_on_front">';
				foreach($llorix_one_all_pages_array as $llorix_one_all_pages_array_k => $llorix_one_all_pages_array_v):
				
					$llorix_one_page_template = get_page_template_slug($llorix_one_all_pages_array_k);
					
					if( !empty($llorix_one_page_template) ):
						echo '<option value="'.$llorix_one_all_pages_array_k.'" template="'.$llorix_one_page_template.'">'.$llorix_one_all_pages_array_v.'</option>';
					else:
						echo '<option value="'.$llorix_one_all_pages_array_k.'" template="default">'.$llorix_one_all_pages_array_v.'</option>';
					endif;	
					
					
				endforeach;
			echo '</select>';
			echo '</label>';
		endif;
		
    }
}
?>