<?php 


          /**
           * Creates a Widget of parent Child Pages
           * 
           * @author mat lipe
           * @since 6/3/12
           * @package Advanced Sidebar Menu
           *
           */


class advanced_sidebar_menu_page extends WP_Widget {

#-----------------------------------------------------------------------------------------------------------------------------------
	  // this creates the widget form for the dashboard
	function form( $instance ) {
			//	  		require( ADVANCED_SIDEBAR_DIR . 'advanced-sidebar-menu.js' );
			?>
			
			
			
            <p> Include Parent Page <input id="<?php echo $this->get_field_name('include_parent'); ?>" 
            	name="<?php echo $this->get_field_name('include_parent'); ?>" type="checkbox" value="checked" 
            	<?php echo $instance['include_parent']; ?>/></p>
			
            			
			<p> Include Parent Even With No Children<input id="<?php echo $this->get_field_name('include_childless_parent'); ?>"
			name="<?php echo $this->get_field_name('include_childless_parent'); ?>" type="checkbox" value="checked" 
					<?php echo $instance['include_childless_parent']; ?>/></p>
					
			<p> Use Built in Styling <input id="<?php echo $this->get_field_name('css'); ?>"
			name="<?php echo $this->get_field_name('css'); ?>" type="checkbox" value="checked" 
					<?php echo $instance['css']; ?>/></p>
					
			<p> Pages to Exclude, Comma Separated:<input id="<?php echo $this->get_field_name('exclude'); ?>" 
            	name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php echo $instance['exclude']; ?>"/></p>
            	
            <p> Always Display Child Pages <input id="<?php echo $this->get_field_name('display_all'); ?>" 
            	name="<?php echo $this->get_field_name('display_all'); ?>" type="checkbox" value="checked" 
            	onclick="javascript:asm_reveal_element( 'levels-<?php echo $this->get_field_name('levels'); ?>' )"
            	<?php echo $instance['display_all']; ?>/></p>
            
            <span id="levels-<?php echo $this->get_field_name('levels'); ?>" style="<?php 
                  if( $instance['display_all'] == checked ){
                  	echo 'display:block';
                  } else {
                  	echo 'display:none';
                  } ?>"> 
            <p> Levels to Display <select id="<?php echo $this->get_field_name('levels'); ?>" 
            name="<?php echo $this->get_field_name('levels'); ?>">
            <?php 
            	for( $i= 1; $i<6; $i++ ){
            		if( $i == $instance['levels'] ){
            			echo '<option value="'.$i.'" selected>'.$i.'</option>';
            		} else {
            			echo '<option value="'.$i.'">'.$i.'</option>';
            		}
            	} 
            	echo '</select></p></span>';
		}

#------------------------------------------------------------------------------------------------------------------------------
	// this allows more than one instance

	function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['include_childless_parent'] = strip_tags($new_instance['include_childless_parent']);
			$instance['include_parent'] = strip_tags($new_instance['include_parent']);
			$instance['exclude'] = strip_tags($new_instance['exclude']);
			$instance['display_all'] = strip_tags($new_instance['display_all']);
			$instance['levels'] = strip_tags($new_instance['levels']);
			$instance['css'] = strip_tags($new_instance['css']);
			return $instance;
		}

#-------------------------------------------------------------------------------------------------------------------------

  	// This decides the name of the widget
	function advanced_sidebar_menu_page( ) {
				/* Widget settings. */
		$widget_ops = array( 'classname' => 'sidebar-menu', 'description' => 'Creates a menu of all the pages using the child/parent relationship' );


		/* Create the widget. */
		$this->WP_Widget( 'advanced_sidebar_menu', 'Advanced Sidebar Pages Menu', $widget_ops);
		}


#---------------------------------------------------------------------------------------------------------------------------

    // adds the output to the widget area on the page
	function widget($args, $instance) {
			
			if( is_page() ){
			
	 		 global $wpdb;
	 		 global $p;
	  		 global $post;
	  		 
	  		 #-- Create a usable array of the excluded pages
	  		 $exclude = explode(',', $instance['exclude']);
		   
           
	    	 #-- if the post has parrents
			if($post->ancestors){
			
				$parent = $wpdb->get_var( "SELECT post_parent from wp_posts WHERE ID=".$post->ID );
			 
				//--- If there is a parent of the post set $p to it and check if there is a parent as well
				while($parent != FALSE){
						$p = $parent;
				    	$parent = $wpdb->get_var( "SELECT post_parent from wp_posts WHERE ID=".$parent);
				}
		
			} else {
				#--------- If this is the parent ------------------------------------------------
				$p = $post->ID;
			}
		
			#-- Makes this work with all table prefixes
			#-- Added 1/22/12
			global $table_prefix;
			

			$result = $wpdb->get_results( "SELECT ID FROM ".$table_prefix."posts WHERE post_parent = $p AND post_type='page' Order by menu_order" );
	   
			#---- if there are no children do not display the parent unless it is check to do so
			if($result != false || ( $instance['include_childless_parent'] == 'checked' && !in_array($p, $exclude) )  ){
			
				if( $instance['css'] == 'checked' ){
					echo '<style type="text/css">';
					include( advanced_sidebar_menu_functions::file_hyercy('sidebar-menu.css' ) );
			
					echo '</style>';
			
			
				}
			
			
				#-- Bring in the output
    			require( advanced_sidebar_menu_functions::file_hyercy( 'page_list.php' ) );
				
			}
			}
	} #== /widget()
	
} #== /Clas