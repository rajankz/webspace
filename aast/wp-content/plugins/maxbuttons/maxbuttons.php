<?php
/*
Plugin Name: MaxButtons
Plugin URI: http://maxbuttons.com
Description: CSS3 button generator for WordPress. This is the free version; the Pro version <a href="http://maxbuttons.com">can be found here</a>.
Version: 1.8.0
Author: Max Foundry
Author URI: http://maxfoundry.com

Copyright 2011 Max Foundry, LLC (http://maxfoundry.com)
*/

define('MAXBUTTONS_VERSION_KEY', 'maxbuttons_version');
define('MAXBUTTONS_VERSION_NUM', '1.8.0');

$maxbuttons_installed_version = get_option('MAXBUTTONS_VERSION_KEY');

maxbuttons_set_global_paths();
maxbuttons_set_activation_hooks();

function maxbuttons_set_global_paths() {	
	if (!defined('MAXBUTTONS_PLUGIN_NAME'))
		define('MAXBUTTONS_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

	if (!defined('MAXBUTTONS_PLUGIN_DIR'))
		define('MAXBUTTONS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MAXBUTTONS_PLUGIN_NAME);

	if (!defined('MAXBUTTONS_PLUGIN_URL'))
		define('MAXBUTTONS_PLUGIN_URL', WP_PLUGIN_URL . '/' . MAXBUTTONS_PLUGIN_NAME);
}

function maxbuttons_set_activation_hooks() {
	register_activation_hook(__FILE__, 'maxbuttons_register_activation_hook');
	register_deactivation_hook(__FILE__, 'maxbuttons_register_deactivation_hook');
}

function maxbuttons_register_activation_hook() {
	if (function_exists('is_multisite') && is_multisite()) {
		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
			maxbuttons_call_function_for_each_site('maxbuttons_activate');
			return;
		}
	}
	
	// Otherwise do it for a single blog/site
	maxbuttons_activate();
}

function maxbuttons_activate() {
	maxbuttons_create_database_table();
	update_option(MAXBUTTONS_VERSION_KEY, MAXBUTTONS_VERSION_NUM);
}

function maxbuttons_register_deactivation_hook() {
	if (function_exists('is_multisite') && is_multisite()) {
		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
			maxbuttons_call_function_for_each_site('maxbuttons_deactivate');
			return;
		}
	}
	
	// Otherwise do it for a single blog/site
	maxbuttons_deactivate();
}

function maxbuttons_deactivate() {
	delete_option(MAXBUTTONS_VERSION_KEY);
}

function maxbuttons_call_function_for_each_site($function) {
	global $wpdb;
	
	// Hold this so we can switch back to it
	$root_blog = $wpdb->blogid;
	
	// Get all the blogs/sites in the network and invoke the function for each one
	$blog_ids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
	foreach ($blog_ids as $blog_id) {
		switch_to_blog($blog_id);
		call_user_func($function);
	}
	
	// Now switch back to the root blog
	switch_to_blog($root_blog);
}

add_filter('plugin_action_links', 'maxbuttons_plugin_action_links', 10, 2);
function maxbuttons_plugin_action_links($links, $file) {
	static $this_plugin;
	
	if (!$this_plugin) {
		$this_plugin = plugin_basename(__FILE__);
	}
	
	if ($file == $this_plugin) {
		$dashboard_link = '<a href="' . admin_url() . 'admin.php?page=maxbuttons-controller&action=list">Buttons</a>';
		array_unshift($links, $dashboard_link);
	}

	return $links;
}

add_filter('plugin_row_meta', 'maxbuttons_plugin_row_meta', 10, 2);
function maxbuttons_plugin_row_meta($links, $file) {
	if ($file == plugin_basename(dirname(__FILE__) . '/maxbuttons.php')) {
		$links[] = '<a href="http://maxbuttons.com" target="_blank">Upgrade to Pro Version</a>';
	}
	
	return $links;
}

add_action('admin_menu', 'maxbuttons_admin_menu');
function maxbuttons_admin_menu() {
	$admin_pages = array();

	$page_title = 'MaxButtons : Buttons';
	$menu_title = 'MaxButtons';
	$capability = 'manage_options';
	$menu_slug = 'maxbuttons-controller';
	$function = 'maxbuttons_controller';
	$icon_url = MAXBUTTONS_PLUGIN_URL . '/images/mb-16.png';
	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
	
	// We add this submenu page with the same slug as the parent to ensure we don't get duplicates
	$sub_menu_title = 'Buttons';
	$admin_pages[] = add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);
	
	// Now add the submenu page for the Add New page
	$submenu_page_title = 'MaxButtons Pro : Add/Edit Button';
	$submenu_title = 'Add New';
	$submenu_slug = 'maxbuttons-button';
	$submenu_function = 'maxbuttons_button';
	$admin_pages[] = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
	
	// Now add the submenu page for the Go Pro page
	$submenu_page_title = 'MaxButtons : Go Pro';
	$submenu_title = 'Go Pro';
	$submenu_slug = 'maxbuttons-pro';
	$submenu_function = 'maxbuttons_pro';
	$admin_pages[] = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);

	// Now add the submenu page for the Support page
	$submenu_page_title = 'MaxButtons : Support';
	$submenu_title = 'Support';
	$submenu_slug = 'maxbuttons-support';
	$submenu_function = 'maxbuttons_support';
	$admin_pages[] = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
	
	foreach ($admin_pages as $admin_page) {
		add_action("admin_print_styles-{$admin_page}", 'maxbuttons_add_admin_styles');
		add_action("admin_print_scripts-{$admin_page}", 'maxbuttons_add_admin_scripts');
	}
}

function maxbuttons_controller() {
	include_once 'includes/maxbuttons-controller.php';
}

function maxbuttons_button() {
	include_once 'includes/maxbuttons-button.php';
}

function maxbuttons_pro() {
	include_once 'includes/maxbuttons-pro.php';
}

function maxbuttons_support() {
	include_once 'includes/maxbuttons-support.php';
}

function maxbuttons_add_admin_styles() {	
	wp_enqueue_style('maxbuttons-css', MAXBUTTONS_PLUGIN_URL . '/styles.css');
	wp_enqueue_style('maxbuttons-colorpicker-css', MAXBUTTONS_PLUGIN_URL . '/js/colorpicker/css/colorpicker.css');
}

function maxbuttons_add_admin_scripts() {	
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('maxbuttons-colorpicker-js', MAXBUTTONS_PLUGIN_URL . '/js/colorpicker/colorpicker.js', array('jquery'));
}

function maxbuttons_create_database_table() {
	global $maxbuttons_installed_version;
	
	$table_name = maxbuttons_get_buttons_table_name();
	
	// IMPORTANT: There MUST be two spaces between the PRIMARY KEY keywords
	// and the column name, and the column name MUST be in parenthesis.
	$sql = "CREATE TABLE " . $table_name . " (
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(100) NULL,
				description VARCHAR(500) NULL,
				url VARCHAR(250) NULL,
				text VARCHAR(100) NULL,
				text_font_family VARCHAR(50) NULL,
				text_font_size VARCHAR(10) NULL,
				text_font_style VARCHAR(10) NULL,
				text_font_weight VARCHAR(10) NULL,
				text_color VARCHAR(10) NULL,
				text_color_hover VARCHAR(10) NULL,
				text_shadow_offset_left VARCHAR(10) NULL,
				text_shadow_offset_top VARCHAR(10) NULL,
				text_shadow_width VARCHAR(10) NULL,
				text_shadow_color VARCHAR(10) NULL,
				text_shadow_color_hover VARCHAR(10) NULL,
				text_padding_top VARCHAR(10) NULL,
				text_padding_bottom VARCHAR(10) NULL,
				text_padding_left VARCHAR(10) NULL,
				text_padding_right VARCHAR(10) NULL,
				border_radius_top_left VARCHAR(10) NULL,
				border_radius_top_right VARCHAR(10) NULL,
				border_radius_bottom_left VARCHAR(10) NULL,
				border_radius_bottom_right VARCHAR(10) NULL,
				border_style VARCHAR(10) NULL,
				border_width VARCHAR(10) NULL,
				border_color VARCHAR(10) NULL,
				border_color_hover VARCHAR(10) NULL,
				box_shadow_offset_left VARCHAR(10) NULL,
				box_shadow_offset_top VARCHAR(10) NULL,
				box_shadow_width VARCHAR(10) NULL,
				box_shadow_color VARCHAR(10) NULL,
				box_shadow_color_hover VARCHAR(10) NULL,
				gradient_start_color VARCHAR(10) NULL,
				gradient_start_color_hover VARCHAR(10) NULL,
				gradient_end_color VARCHAR(10) NULL,
				gradient_end_color_hover VARCHAR(10) NULL,
				gradient_stop VARCHAR(2) NULL,
				new_window VARCHAR(10) NULL,
				container_enabled VARCHAR(5) NULL,
				container_width VARCHAR(5) NULL,
				container_margin_top VARCHAR(5) NULL,
				container_margin_right VARCHAR(5) NULL,
				container_margin_bottom VARCHAR(5) NULL,
				container_margin_left VARCHAR(5) NULL,
				container_alignment VARCHAR(25) NULL,
				container_center_div_wrap_enabled VARCHAR(5) NULL,
				nofollow VARCHAR(5) NULL,
				status VARCHAR(10) DEFAULT 'publish' NOT NULL,
				PRIMARY KEY  (id)
			);";

	if (!maxbuttons_database_table_exists($table_name)) {
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	if (maxbuttons_database_table_exists($table_name) && $maxbuttons_installed_version != MAXBUTTONS_VERSION_NUM) {
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
}

function maxbuttons_get_buttons_table_name() {
	global $wpdb;
	return $wpdb->prefix . 'maxbuttons_buttons';
}

function maxbuttons_database_table_exists($table_name) {
	global $wpdb;
	return strtolower($wpdb->get_var("SHOW TABLES LIKE '$table_name'")) == strtolower($table_name);
}

function maxbuttons_get_button($id) {
	global $wpdb;
	return $wpdb->get_row($wpdb->prepare("SELECT * FROM " . maxbuttons_get_buttons_table_name() . " WHERE id = %d", $id));
}

function maxbuttons_get_published_buttons() {
	global $wpdb;
	return $wpdb->get_results("SELECT * FROM " . maxbuttons_get_buttons_table_name() . " WHERE status <> 'trash'");
}

function maxbuttons_get_published_buttons_count() {
	global $wpdb;
	return $wpdb->get_var("SELECT COUNT(*) FROM " . maxbuttons_get_buttons_table_name() . " WHERE status <> 'trash'");
}

function maxbuttons_get_trashed_buttons() {
	global $wpdb;
	return $wpdb->get_results("SELECT * FROM " . maxbuttons_get_buttons_table_name() . " WHERE status = 'trash'");
}

function maxbuttons_get_trashed_buttons_count() {
	global $wpdb;
	return $wpdb->get_var("SELECT COUNT(*) FROM " . maxbuttons_get_buttons_table_name() . " WHERE status = 'trash'");
}

function maxbuttons_button_restore($id) {
	global $wpdb;
	$wpdb->query($wpdb->prepare("UPDATE " . maxbuttons_get_buttons_table_name() . " SET status = 'publish' WHERE id = %d", $id));
}

function maxbuttons_button_move_to_trash($id) {
	global $wpdb;
	$wpdb->query($wpdb->prepare("UPDATE " . maxbuttons_get_buttons_table_name() . " SET status = 'trash' WHERE id = %d", $id));
}

function maxbuttons_button_delete_permanently($id) {
	global $wpdb;
	$wpdb->query($wpdb->prepare("DELETE FROM " . maxbuttons_get_buttons_table_name() . " WHERE id = %d", $id));
}

function maxbuttons_log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

add_filter('widget_text', 'do_shortcode');
include_once 'includes/shortcode.php';
?>