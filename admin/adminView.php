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

defined( 'ABSPATH' ) or die( 'Hey, you can go away ?' );
class AdminView {
	function __construct()
	{
		?>
		<div class="wrap">
			<div id="asset-admin">
				Hello from admin
			</div>
		</div
		<?php
		
	}

}

if ( class_exists('AdminView') ) {
	$adminPlugin = new AdminView();
}

