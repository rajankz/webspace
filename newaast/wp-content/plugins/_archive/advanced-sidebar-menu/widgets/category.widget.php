<?php 


          /**
           * Creates a Widget of parent Child Categories
           * 
           * @author mat lipe
           * @since 6/4/12
           * @package Advanced Sidebar Menu
           *
           */




class advanced_sidebar_menu_category extends WP_Widget {

#-----------------------------------------------------------------------------------------------------------------------------------
	  // this creates the widget form for the dashboard
	function form( $instance ) {
				  	//	 require( ADVANCED_SIDEBAR_DIR . 'advanced-sidebar-menu.js' );
			?>
			
			
			
            <p> Include Parent Category <input id="<?php echo $this->get_field_name('include_parent'); ?>" 
            	name="<?php echo $this->get_field_name('include_parent'); ?>" type="checkbox" value="checked" 
            	<?php echo $instance['include_parent']; ?>/></p>
			
            			
			<p> Include Parent Even With No Children <input id="<?php echo $this->get_field_name('include_childless_parent'); ?>"
			name="<?php echo $this->get_field_name('include_childless_parent'); ?>" type="checkbox" value="checked" 
					<?php echo $instance['include_childless_parent']; ?>/></p>
					
			<p> Use Built in Styling <input id="<?php echo $this->get_field_name('css'); ?>"
			name="<?php echo $this->get_field_name('css'); ?>" type="checkbox" value="checked" 
					<?php echo $instance['css']; ?>/></p>
					
			<p> Display Categories on Single Post Page's <input id="<?php echo $this->get_field_name('single'); ?>"
			name="<?php echo $this->get_field_name('single'); ?>" type="checkbox" value="checked" 
			onclick="javascript:asm_reveal_element( 'new-widget-<?php echo $this->get_field_name('new_widget'); ?>' )"
					<?php echo $instance['single']; ?>/></p>	
			
			<span id="new-widget-<?php echo $this->get_field_name('new_widget'); ?>" style="<?php 
                  if( $instance['single'] == checked ){
                  	echo 'display:block';
                  } else {
                  	echo 'display:none';
                  } ?>"> 		
				 <p>Display Each Single Post's Category 
			 		<select id="<?php echo $this->get_field_name('new_widget'); ?>" 
            				name="<?php echo $this->get_field_name('new_widget'); ?>">
            		<?php 
            			if( $instance['new_widget'] == 'widget' ){
            				echo '<option value="widget" selected> In a new widget </option>';
            				echo '<option value="list"> In another list in the same widget </option>';
            			} else {
            				echo '<option value="widget"> In a new widget </option>';
            				echo '<option value="list" selected> In another list in the same widget </option>';
            			}
            		
            		?></select>
            	 </p>
            </span>
         
            	
					
			<p> Categories to Exclude, Comma Separated:<input id="<?php echo $this->get_field_name('exclude'); ?>" 
            	name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php echo $instance['exclude']; ?>"/></p>
            	
            <p> Always Display Child Categories <input id="<?php echo $this->get_field_name('display_all'); ?>" 
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
			$instance['single'] = strip_tags($new_instance['single']);  //Display on single pages
			$instance['new_widget'] = strip_tags($new_instance['new_widget']); //Create a new widget for each single category
			return $instance;
		}

#-------------------------------------------------------------------------------------------------------------------------

  	// This decides the name of the widget
	function advanced_sidebar_menu_category( ) {
				/* Widget settings. */
		$widget_ops = array( 'classname' => 'sidebar-menu-category', 'description' => 'Creates a menu of all the Categories using the child/parent relationship' );
        $control_ops = array( 'width' => 290 );
		/* Create the widget. */
		$this->WP_Widget( 'advanced_sidebar_menu_category', 'Advanced Sidebar Categories Menu', $widget_ops, $control_ops );
		}


#---------------------------------------------------------------------------------------------------------------------------

    // adds the output to the widget area on the page
	function widget($args, $instance) {
		#-- Create a usable array of the excluded pages
		$exclude = explode(',', $instance['exclude']);
		$cat_ids = $already_top = array();
		$asm_once = $asm_cat_widget_count = false; //keeps track of how many widgets this created
		$count = null;
		
		
		
		//If on a single page create an array of each category and create a list for each
		if( is_single() && ($instance['single'] == 'checked') ){
			$category_array = get_the_category();
			foreach( get_the_category() as $id => $cat ){
				$cat_ids[] = $cat->term_id;
			}
			
		//IF on a category page get the id of the category
		} elseif( is_category() ){
		    $cat_ids[] = get_query_var('cat');	
		}
		
		//print_r( get_the_category() );
		
		///print_r( $cat_ids );
		
	     //Bring in the Styling
        			if( $instance['css'] == 'checked' ){
        				echo '<style type="text/css">';
        					include( advanced_sidebar_menu_functions::file_hyercy( 'sidebar-menu.css' ) );
        		   		 echo '</style>';
        			}
			
        //Go through each category there will be only one if this is a category page mulitple possible if this is single
        foreach( $cat_ids as $cat_id ){
       		 $cat_ancestors = array ();
             $cat_ancestors[] = $cat_id ;
       
        	do {
             	$cat_id = get_category($cat_id );
             	$cat_id = $cat_id->parent;
             	$cat_ancestors[] = $cat_id ; }
       		 while ($cat_id );
       
            
       		 //Reverse the array to start at the last
       		 $cat_ancestors = array_reverse( $cat_ancestors );
       		 //forget the [0] because the parent of top parent is always 0
       		 $top_cat = $cat_ancestors[1];
  
       		 
       		 //Keeps track or already used top levels so this won't double up
       		 if( in_array( $top_cat, $already_top ) ){
       		 	continue;
       		 }
       		 $already_top[] = $top_cat;
       		 
       
         	//Check for children
        	$all = get_categories( array( 'child_of' => $top_cat ) );

        	
            	//If there are any child categories or the include childless parent is checked
        		if( !empty($all ) || ($instance['include_childless_parent'] == 'checked' && !in_array($top_cat, $exclude))  ){
        		
        			
        			//Creates a new widget for each category the single page has if the options are selected to do so
					if( !$asm_once || ($instance['new_widget'] == 'widget') ){

						echo '<div id="'.$args['widget_id']. $count .'" class="advanced-sidebar-menu widget advanced-sidebar-category">
								<div class="widget-wrap">';

							$count++; // To change the id of the widget if there are multiple
							$asm_once = true;  //There has been a div
							$close = true; //The div should be closed at the end
							if($instance['new_widget'] == 'list'){ $close = false;} //If this is a list leave it open for possible late ones

					} else {
						$close = false;
					}
					
					
        			     //Bring in the view
        					require( advanced_sidebar_menu_functions::file_hyercy( 'category_list.php' ) );
        					
        			
        			if( $close ){
        				//End the Widget Area
						   echo '</div>
						    </div><!-- END #advanced-sidebar-cat-menu -->';
        			}
        		
        			
        		
            
      			}  //End if any children or include childless parent
        } //End of each cat loop
        
        
        //IF we were waiting for all the individual lists to complete
        if( !$close && $asm_once ){
        	//End the Widget Area
						   echo '</div>
						    </div><!-- END #advanced-sidebar-cat-menu -->';
        	
        }
			
	
     	     
	} #== /widget()
	
} #== /Clas