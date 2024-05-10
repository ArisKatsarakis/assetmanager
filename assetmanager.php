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
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Serv\AssetRepository;
use Serv\AssetController;

class AssetManager
{

  function __construct()
  {
    define('WORKING_PATH', trailingslashit(plugin_dir_path(__FILE__)));
    define('WORKING_URL', trailingslashit(plugin_dir_url(__FILE__)));
    add_action('admin_menu', [$this, 'adminMenuFunction']);
    add_action('admin_enqueue_scripts', [$this, 'reactScripts']);
    $controller = new AssetController();
    add_action('rest_api_init', [$controller, 'create_rest_routes']);
  }

  function activate()
  {
    AssetRepository::create_required_tables();
  }

  function deactivate()
  {
  }

  function uninstall()
  {
  }

  function reactScripts()
  {
    wp_enqueue_script(
      'wp-react-kickoff',
      WORKING_URL . 'assets/build/index.bundle.js',
      ['jquery', 'wp-element'],
      wp_rand(),
      true
    );
  }


  function adminMenuFunction()
  {
    add_menu_page(
      'WPOrg',
      'Asset Manager',
      'manage_options',
      plugin_dir_path(__FILE__) . 'admin/adminView.php',
      null,
      'dashicons-welcome-widgets-menus',
      20
    );
    add_submenu_page(
      plugin_dir_path(__FILE__) . 'admin/adminView.php',
      'Customers',
      'Customers',
      'manage_options',
      'customer_sub_menu',
      [$this, 'customer_sub_menu'],
    );
    add_submenu_page(
      plugin_dir_path(__FILE__) . 'admin/adminView.php',
      'Assets',
      'Assets',
      'manage_options',
      'assets_sub_menu',
      [$this, 'assets_sub_menu'],
    );
  }

  function customer_sub_menu()
  {
?>
    <div class="wrap">
      <div id="customer-react"> hello from sub menu page <div>
        </div>
      <?php
    }
    function assets_sub_menu()
    {
      ?>
        <div class="wrap">
          <div id="assets-react"> </div>
        </div>
    <?php
    }
  }

  if (class_exists('AssetManager')) {
    $assetManager = new AssetManager();
  }

  register_activation_hook(__FILE__, [$assetManager, 'activate']);

  register_deactivation_hook(__FILE__, [$assetManager, 'deactivate']);
