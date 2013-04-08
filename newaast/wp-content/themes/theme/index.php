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
			<div id="content" role="main">
			
			<?php //vslider('index'); ?>
			<?php //if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
			
			<?php //slidedeck( 83, array( 'width' => '100%', 'height' => '370px' ) ); ?>
			
			<?php //slidedeck( 84, array( 'width' => '100%', 'height' => '300px' ) ); ?>
			
			<?php //if (function_exists('easing_slider')){ easing_slider(); }; ?>
			
			<?php //if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>
			
			<!-- <br /><hr /> -->
			
			<div id="indexSlider">
				<?php include('index/nivo-slider/aast/indexSlider.php'); ?>
			</div>
			
			<div id="contentLeft">
				<?php include ('index/indexLeft.php') ?>
			</div>
			<div id="contentRight">
				<?php include ('index/indexRight.php') ?>
			</div>

			
			</div><!-- #content -->
		</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>