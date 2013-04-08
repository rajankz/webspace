<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package UMD
 * @since UMD 0.1
 */
?>

	</div><!-- #main -->

	<footer id="colophon">
		<div id="leftFooter" class="footerText">
			Asian American Studies Program<br />
			1145 Cole Student Activities Building<br />
			University of Maryland, College Park, MD 20742<br />
			Ph: 301-405-0996
		</div>
		<div id="footerLogo">
			<img src=<?php echo site_url().'/aast/images/logo.png' ?> />
		</div>
		<!--<div id="site-generator">
		</div> -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</div><!-- #site-container -->

</body>
</html>