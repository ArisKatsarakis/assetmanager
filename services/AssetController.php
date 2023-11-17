<?php

namespace Serv; 
use WP_REST_Response;
class AssetController {


    public  function create_rest_routes() {
        register_rest_route( 'assetmanagerplugin/v1', '/customers', array(
            'methods' => 'GET',
            'callback' => [ $this, 'getCustomers'],
            'permission_callback' => [$this, 'callback'],
          ) );
    }

    function getCustomers ( $request ) {
        global $wpdb;
        $clientsTableName = $wpdb->prefix . 'customers';
        $customers = $wpdb->get_results( "SELECT * FROM $clientsTableName" );
        return new WP_REST_Response(
            $customers,
            200
        );
    }

    function callback() {
        return true;
    }

    

}