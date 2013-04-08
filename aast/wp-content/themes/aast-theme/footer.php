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
		<div id="footerUMD" class="left">
			<a href="http://www.umd.edu"><img src="<?php echo site_url()?>/aast/images/webglobelg.gif" /></a>
		</div>

		<div id="footerAAST" class="right"><a href="<?php echo site_url()?>">
			<img src=<?php echo site_url().'/aast/images/logo.png' ?> /></a>
		</div>
		
		<div id="footerText" class="footerText">
			<b>Asian American Studies Program</b>
			<br /><hr />
			1145 Cole Student Activities Building<br />
			University of Maryland - College Park<br />
			MARYLAND - 20742<br />
			Phone: 301-405-0996<br />
			Fax: 301-314-6575
		</div>
		<br />
		<div class="center">Asian American Studies Program - University of Maryland &copy; 2012</div>
		
		<!--<div id="site-generator">
		</div> -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</div><!-- #site-container -->

</body>
</html>