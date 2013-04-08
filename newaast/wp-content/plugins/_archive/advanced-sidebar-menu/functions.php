<?php 


         /**
          * These Functions are Specific to the Advanced Sidebar Menu
          * @author Mat Lipe
          * @since 6/3/12
          */
         


class advanced_sidebar_menu_functions{
	     protected $bad = array();  //for 3.2 version
	     protected $cat_file = ''; //for 3.2 version


/**
 * Validate the views for the new structure
 * @since 6/3/12
 */
function validate_3_2(){
	
	
/** Note to self -- Remove this at the new version **/
if ( $cat_file = locate_template(array('advanced-sidebar-menu/category_list.php')) ) {

	$data = explode("\n", file_get_contents( $cat_file )); //create array separate by new line
	
	//print_r( $data );
	
	foreach( $data as $line => $content ){
		
		$line++;
		
		if( strpos( $content, " class=\"advanced-sidebar-menu widget advanced-sidebar-category\">" ) ){
			$bad[$line] = htmlentities( $content );
		}
		
		if( strpos( $content, "<div class=\"widget-wrap\">';"  ) ){
			$bad[$line] = htmlentities( $content );
		}
		
		
		if( strpos( $content, "</div></div><!-- END #advanced-sidebar-cat-menu -->';"  ) ){

			$bad[$line] = htmlentities( $content );
		}
	
	}

	if( !empty( $bad ) ){
		$this->bad = $bad;
		$this->cat_file = get_bloginfo( 'stylesheet_directory' ) . 'advanced-sidebar-menu/category_list.php';
		add_action( 'admin_notices', array( $this, 'notice_3_2') );
	}

}

}


/**
 * Adds an admin notice if there are issues with the view
 * @since 6/3/12
 */
function notice_3_2( ){
	echo '<div class="error">';
	echo 'To use version 3.2 of <b>Advanced Sidebar Menu</b> you must delete the following lines from <b>"' . $this->cat_file . '"</b><br>';

	foreach( $this->bad as $line => $content ){
		echo '<b>line' . $line . ': </b> '. $content . '<br>';
	}
	
	echo '</div>';
	
}





/**
 * Allows for Overwritting files in the child theme
 * @since 6/3/12
 */
         
 static function file_hyercy( $file ){
	
	if ( $theme_file = locate_template(array('advanced-sidebar-menu/'.$file)) ) {
		$file = $theme_file;
	} else {
		$file = ADVANCED_SIDEBAR_VIEWS_DIR . $file;
	}
	return $file;
	
}

} //End class

