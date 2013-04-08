<?php
/**
 * Template Name: Sidebar Template
 * Description: A Post Template that adds a sidebar to posts
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
//hack hack: assigning stay connected post id
$id = '55';	
?>

<?php 
// use wp_list_pages to display parent and all child pages all generations (a tree with parent)
/*
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
*/
?>

<?php //wp_list_pages( 'depth=0&sort_column=menu_order&child_of='.$id.'&title_li=' ); ?> 
<?php
  $current = $post->ID;
  $parent = $post->post_parent;
  $parent = '55';
  $parentPost = get_post($parent);
  $grandparent = $parentPost->post_parent;	


  if($parentPost->post_parent) {
  $children = wp_list_pages("title_li=&child_of=".$parentPost->post_parent."&echo=0");
  $titlenamer = get_the_title($parentPost->post_parent);
  }
  

  else {
  $children = wp_list_pages("title_li=&child_of=".$parentPost->ID."&echo=0");
  $titlenamer = get_the_title($parentPost->ID);
  }
  if ($children) { ?>

  <h2> <?php echo $titlenamer; ?> </h2>
  <ul>
  <?php echo $children; ?>
  </ul>

<?php } ?>
