<?php

/**
 * 
 * <!-- <div class="wrap">
	<div id="asset-admin">
		Hello from admin
	</div>
	</div> -->
 * 
 * 
 */

defined('ABSPATH') or die('Hey, you can go away ?');
class AdminView
{
  function __construct()
  {
?>
    <div class="wrap">
      <div id="asset-admin">
        Hello from admin
      </div>
      <div>

      </div>
    </div <?php

        }

        function activate()
        {

          flush_rewrite_rules();
        }


        function deactivate()
        {

          flush_rewrite_rules();
        }
      }

      if (class_exists('AdminView')) {
        $adminPlugin = new AdminView();
      }
