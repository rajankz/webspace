/**
 * Function to show top posts in the index page
 */
 function showWPPosts($limit = 10){
 	define('WP_USE_THEMES', false);
 	$html = '';
 	query_posts('showposts='.$limit);
 	if(have_posts()):
 		$html .= '<table id="hot-topics"><tbody>';
 		while(have_posts()): //the_post();
 			$html .= '<tr>';
 			$html .= '<td class="oneNewsItem">';
 			$html .= '<div class="highlight-title">';
 			$html .= '<a href="'. get_permalink() .'">'.the_title().'</a></div>';
 			$html .= '<div class="postedDate"><i>Posted:';
 			$html .= the_time('F jS, Y');
 			$html .= '</i></div>'; 
 			$html .= '<div class="highlight-content">';
 			$html .= the_excerpt();
 			$html .= '</div>';
			$html .= '</td>';
			$html .= '</tr>';
			the_post();
 		endwhile;
 		$html .= '</tbody></table>';
 	endif;
 	return $html;
 }
 
 function custom_prev_posts($limit = 10){
	global $wpdb, $post;
	$html = '';
	$prev_posts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_status = 'publish' ORDER BY $wpdb->posts.post_date DESC LIMIT $limit") ); 
 
 	$html .= '<table id="hot-topics"><tbody>'; 
	if($prev_posts){
		foreach ( $prev_posts as $prev_post  ) {
			$html .= '<tr>';
			$html .= '<td class="oneNewsItem">';
			$html .= '<div class="highlight-title">';
			$html .= '<a href="' . get_permalink( $prev_post->ID ) . '">' .$prev_post->post_title . '</a></div>';
			$html .= '<div class="postedDate"><i>Posted:';
			$html .= strftime('%d %b %Y',$prev_post->post_date);
			$html .= '</i></div>'; 
			$html .= '<div class="highlight-content">';
			//$html .= the_excerpt();
			$html .= $prev_post->post_excerpt;
			$html .= '</div>';
			$html .= '</td>';
			$html .= '</tr>';
		}
	}
	$html .= '</tbody></table>';
	return $html;
 }