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

/**
 * Constants for working with URL and paths of the plugin
 */

 defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

class AssetManager {

	function __construct()
	{
		define('WORKING_PATH', trailingslashit(plugin_dir_path(__FILE__)));
		define('WORKING_URL', trailingslashit(plugin_dir_url(__FILE__)) );
	   	add_action('admin_menu', [$this, 'adminMenuFunction']);
		add_action('admin_enqueue_scripts', [$this, 'reactScripts'] );
		
		
	}
	
	function activate() {
		// AssetRepository.create_required_tables();
	}

	function deactivate() {
		global $wpdb;
		$wpdb->query("
			DROP TABLE wp_asset_customers
		");

	}

	function uninstall() {
		

	}

	function reactScripts() {
		wp_enqueue_script('wp-react-kickoff', WORKING_URL.'assets/build/index.bundle.js',
		['jquery', 'wp-element'], wp_rand(), true );
	}


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
}

if ( class_exists( 'AssetManager' ) ) {
	$assetManager = new AssetManager();
}

register_activation_hook(__FILE__, [$assetManager, 'activate'] );

register_deactivation_hook(__FILE__, [$assetManager, 'deactivate']);