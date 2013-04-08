<?php
/*
Template Name: Archives
*/
get_header(); ?>

		<div id="primary">
		<div id="sidebar">
			<?php get_template_part( 'sidebar', 'single' ); ?>
		</div>
		<div id="content" role="main">
	
			<?php the_post(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<?php get_search_form(); ?>
			
			<h2>Archives by Month:</h2>
			<ul>
				<?php wp_get_archives(); ?>
			</ul>
	
		</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>



