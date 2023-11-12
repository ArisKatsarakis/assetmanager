<?php

/*
 * Plugin Name:       Asset Manager Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      8.0
 * Author:            Zaxarias Katsarakis
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 */
add_action('admin_menu', 'adminMenuFunction');


function adminMenuFunction() {
	add_menu_page(
		'WPOrg',
		'Asset Manager',
		'manage_options',
		plugin_dir_path(__FILE__) . 'admin/adminView.php',
		null,
		'dashicons-welcome-widgets-menus',
		20
	);
}