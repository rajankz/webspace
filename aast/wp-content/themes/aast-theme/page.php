<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package UMD
 * @subpackage UMD
 * @since UMD 1.0
 */

get_header(); ?>

<div id="primary">

<div id="sidebar">
	<?php get_template_part( 'sidebar', 'page' ); ?>
</div>
<div id="contentWrapper">
	<div id="content" role="main">
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>	

		<?php endwhile; // end of the loop. ?>
		<?php //get_template_part( 'sidebar', 'page' ); ?>

	</div><!-- #content -->
</div><!-- #contentWrapper -->
</div><!-- #primary -->

<?php get_footer(); ?>