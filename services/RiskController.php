<?php

namespace Serv;

use Ent\Assesment;
use Ent\RiskCategory;
use Ent\Risk;

class RiskController
{

  public   function create_risk_routes()
  {
    register_rest_route('assetmanagerplugin/v1', '/risk-categories', [
      'methods' => 'GET',
      'callback' => [$this, 'get_risk_categories'],
      'permission_callback' => [$this, 'callback'],
    ]);
    register_rest_route('assetmanagerplugin/v1', '/risk-categories', [
      'methods' => 'POST',
      'callback' => [$this, 'create_risk_category'],
      'permission_callback' => [$this, 'callback'],
    ]);
    register_rest_route('assetmanagerplugin/v1', '/risk-categories/(?P<id>[a-zA-Z0-9-]+)', [
      'methods' => 'GET',
      'callback' => [$this, 'get_category_by_id'],
      'permission_callback' => [$this, 'callback'],
    ]);
    register_rest_route('assetmanagerplugin/v1', '/risk-categories/(?P<category>[a-zA-Z0-9-]+)/risks', [
      'methods' => 'GET',
      'callback' => [$this, 'get_risks_by_category'],
      'permission_callback' => [$this, 'callback'],
    ]);
    register_rest_route('assetmanagerplugin/v1', '/risk-categories/(?P<category>[a-zA-Z0-9-]+)/risks', [
      'methods' => 'POST',
      'callback' => [$this, 'create_risk'],
      'permission_callback' => [$this, 'callback'],
    ]);
    register_rest_route('assetmanagerplugin/v1', '/assessments/(?P<riskId>[0-9]+)', [
      'methods' => 'POST',
      'callback' => [$this, 'create_assessment'],
      'permission_callback' => [$this, 'callback'],
    ]);
  }
  function create_assessment($request)
  {
    $riskId = $request['riskId'];
    $body = json_decode($request->get_body(), true);
    return  Assesment::insert_assessment($riskId, $body);
  }

  function create_risk($request)
  {
    $categoryId = $request['category'];
    $body = json_decode($request->get_body(), true);
    return Risk::create_risk($categoryId, $body);
  }
  function get_risks_by_category($requesst)
  {
    $categoryId = $requesst['category'];
    return Risk::get_risk_by_category_id($categoryId);
  }


  function get_category_by_id($requesst)
  {
    $categoryId = $requesst['id'];
    return RiskCategory::get_risk_category_by_id($categoryId);
  }

  function get_risk_categories($request)
  {
    $data = RiskCategory::get_all_categories();
    return $data;
  }

  function create_risk_category($requesst)
  {
    $body = $requesst->get_body();
    $jsonBody = json_decode($body, true);

    return RiskCategory::create_risk_category($jsonBody);
  }
  function callback()
  {
    return true;
  }
}
