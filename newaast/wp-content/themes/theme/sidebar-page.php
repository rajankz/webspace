<?php
/**
 * Template Name: Sidebar Template
 * Description: A Page Template that adds a sidebar to pages
 *
 * @package UMD
 * @subpackage UMD
 * @since UMD 1.0
 */

?>



<?php 
if($post->post_parent > 0)
	$id = $post->post_parent;
else
	$id = get_the_ID();
?>

<?php 
// use wp_list_pages to display parent and all child pages all generations (a tree with parent)
$parent = $id;
$args=array(
  'child_of' => $parent
);
$pages = get_pages($args);  
if ($pages) {
  $pageids = array();
  foreach ($pages as $page) {
    $pageids[]= $page->ID;
  }

  $args=array(
    'title_li' => '',
    'include' =>  $parent . ',' . implode(",", $pageids)
  );
  wp_list_pages($args);
}
?>

<?php //wp_list_pages( 'depth=0&sort_column=menu_order&child_of='.$id.'&title_li=' ); ?> 

