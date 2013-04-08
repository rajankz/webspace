<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UMD
 * @since UMD 0.1
 */

get_header(); ?>

		<div id="primary">
			<div id="indexWrapper">
			<div id="content" role="main">
			
			<?php include('index/image-slider.php'); ?>
			
			<div id="contentLeft">
				<?php include ('index/indexLeft.php') ?>
			</div>
			<div id="contentRight">
				<?php include ('index/indexRight.php') ?>
			</div>	
			</div><!-- #content -->
			</div><!-- #indexWrapper -->
		</div><!-- #primary -->

<?php get_footer(); ?>