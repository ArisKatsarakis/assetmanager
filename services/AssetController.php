<?php

namespace Serv; 
use WP_REST_Response;
use Serv\AssetRepository;
class AssetController {


    public  function create_rest_routes() {
        register_rest_route( 'assetmanagerplugin/v1', '/customers', array(
            'methods' => 'GET',
            'callback' => [ $this, 'getCustomers'],
            'permission_callback' => [$this, 'callback'],
          ) );
        register_rest_route( 'assetmanagerplugin/v1', '/customers/(?P<id>[a-zA-Z0-9-]+)',
        [
            'methods' => 'GET',
            'callback' => [ $this, 'getCustomerById'],
            'permission_callback' => [ $this, 'callback']
        ] 
        );
        register_rest_route( 'assetmanagerplugin/v1', '/customers',
        [
            'methods' => 'POST',
            'callback' => [ $this, 'createCustomer'],
            'permission_callback' => [ $this, 'callback']
        ] 
        );
    }

    function createCustomer ( $request ) {
        $data = $request->get_body();
        $jsonData = json_decode($data, true);
        if ($data && !empty($data) ) {
            AssetRepository::create_new_customer($jsonData);
            return new WP_REST_Response($jsonData, 200);
        }else {
            return new WP_Error('no_data', 'No data received', array('status' => 400));
        }
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

    function getCustomerById( $request ) {
        $id = $request['id'];
        global $wpdb;
        $clientsTableName = $wpdb->prefix . 'customers';
        $customer = $wpdb->get_results( "SELECT * FROM $clientsTableName WHERE company_id = '$id' " );

        return new WP_REST_Response(
            $customer,
            200
        );
    }
    function callback() {
        return true;
    }

    

}