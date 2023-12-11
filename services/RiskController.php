<?php
namespace Serv;
use Ent\RiskCategory;
class RiskController {

    public   function create_risk_routes() {
        register_rest_route('assetmanagerplugin/v1', '/risk-categories', [
            'methods' => 'GET',
            'callback' => [ $this, 'get_risk_categories'],
            'permission_callback' => [$this, 'callback'],
        ]);
        register_rest_route('assetmanagerplugin/v1', '/risk-categories', [
            'methods' => 'POST',
            'callback' => [ $this, 'create_risk_category'],
            'permission_callback' => [$this, 'callback'],
        ]);
    }

    function get_risk_categories( $request ) {
        $data = RiskCategory::get_all_categories();
        return $data;
    }

    function create_risk_category( $requesst ) {
        $body = $requesst->get_body();
        $jsonBody = json_decode($body, true);
        
        return RiskCategory::create_risk_category($jsonBody);
    }
    function callback() {
        return true;
    }
     
}