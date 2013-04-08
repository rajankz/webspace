<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package UMD
 * @since UMD 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the  <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );	
	
	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="http://www.umd.edu/wrapper/wrapper/2012/css/xhtml-962px.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/fonts.css" />

<!--
<?php //if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
-->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/index/slider.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/index/tinyfader.js"></script>


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- ----- ----------- -->
<div id="site_container">
  <div id="header_container">
    <a href="http://www.umd.edu/"><img src="http://www.umd.edu/wrapper/wrapper/2012/images/umd_logo.png" alt="University of Maryland" class="logo" /></a>

<div id="aastSearch">	
<form method="get" action="http://www.searchum.umd.edu/search">
    <input type="hidden" name="site" value="UMCP"/>
    <input type="hidden" name="client" value="UMCP"/>
    <input type="hidden" name="proxystylesheet" value="UMCP"/>
    <input type="hidden" name="output" value="xml_no_dtd"/>
    <input type="hidden" name="as_oq" value="site:www.aast.umd.edu" />
    <div id="header_search_text">
      <input id="search" type="text" name="q" size="45" class="text" value="Search Asian American Studies"  onblur="if(this.value=='')this.value=this.defaultValue" onfocus="if(this.value==this.defaultValue)this.value=''"/>
    </div>
    <input type="submit" value="Search" />
	</form>
	</div>

  </div>
  
<!-- ----- ----------- -->

<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
	
	<header>
		<div id="branding" role="banner">
			<a href=<?php echo site_url(); ?> ><img src="<?php echo site_url().'/' ?>aast/images/aast-banner1.jpg"  alt="AAST Banner" height="88px" width="962px" /></a>
		</div>
		<!-- <a href=<?php //echo site_url(); ?> ><img src="aast/images/aast-banner1.jpg"  alt="AAST Banner" height="88px" width="962px" /></a>
        <!-- <div style="clear:both"></div>
	<!--
		<hgroup>
			<h1 id="site-title"><a href="<?php //echo home_url( '/' ); ?>" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php //bloginfo( 'description' ); ?></h2>
		</hgroup>
	-->
		<nav id="access" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		<!--	
		<div id="aastSearch">	
		<form method="get" action="http://www.searchum.umd.edu/search">
	        <input type="hidden" name="site" value="UMCP"/>
	        <input type="hidden" name="client" value="UMCP"/>
	        <input type="hidden" name="proxystylesheet" value="UMCP"/>
	        <input type="hidden" name="output" value="xml_no_dtd"/>
	        <input type="hidden" name="as_oq" value="site:www.aast.umd.edu" />
	        <div id="header_search_text">
	          <input id="search" type="text" name="q" size="45" class="text" value="Search Asian American Studies"  onblur="if(this.value=='')this.value=this.defaultValue" onfocus="if(this.value==this.defaultValue)this.value=''"/>
	        </div
      	</form>
      	</div>
			-->
		</nav><!-- #access -->
	</header><!-- #branding -->

	<div id="main">