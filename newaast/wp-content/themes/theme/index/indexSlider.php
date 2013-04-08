<section id="in-the-news">
<h2>IN THE <b>NEWS</b></h2>
<?php query_posts('category_name=news');//&orderby=date&order=dec'); ?>
<?php if(have_posts()): ?>
<table id="hot-topics"><tbody>
<?php while ( have_posts() ) : the_post(); ?>
	<tr>
	<td class="oneNewsItem">
	<div class="highlight-title">
	<a href=<?php the_permalink() ?> > <?php the_title() ?></a></div>
	<div class="postedDate"><i>Posted:
	<?php the_time('F jS, Y'); ?>
	</i></div>
	<div class="highlight-content">
	<?php the_excerpt(); ?>
	</div>
	</td>
	</tr>
	<?php endwhile; ?>
</tbody></table>
			 
	<?php //echo custom_news_posts(5); ?>
	<?php //echo showWPPosts(3); ?>
<?php else : ?>
	<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'toolbox' ); ?></p>
	<?php get_search_form(); ?>
	</div><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; ?>
<?php wp_reset_query(); ?>
</section>
