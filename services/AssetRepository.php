<?php

namespace Serv;

use Ent\RiskCategory;
use Ent\Risk;
use Ent\Assesment;
use Ent\Customer;

class AssetRepository
{

  public static function  create_required_tables()
  {
    Customer::create_customer_table();
    RiskCategory::create_risk_category_table();
    Risk::create_risk_table();
    Assesment::create_assesment_table();
  }


  public static function delete_required_tables()
  {
    global $wpdb;
    $clientsTableName = $wpdb->prefix . 'customers';
    $wpdb->query("
			DROP TABLE IF EXISTS $clientsTableName
		");
  }


  public static function create_new_customer($customerJson)
  {
    global $wpdb;
    $clientsTableName = $wpdb->prefix . 'customers';
    $query =  "INSERT INTO   $clientsTableName ( `company_name`, `company_email`, `company_afm`, `comapny_address` , `mobile`, `phone` ) VALUES ('" . $customerJson['companyName'] . "','" . $customerJson['companyEmail'] . "','" . $customerJson['companyAfm'] . "','" . $customerJson['companyAddress'] . "', '" . $customerJson['mobile'] . "', '" . $customerJson['phone'] . "' )";
    $result = $wpdb->query(
      $query
    );

    return $result;
  }

  public static function deleteCustomerById($customerId)
  {
    global $wpdb;
    $clientsTableName = $wpdb->prefix . 'customers';
    $wpdb->delete($clientsTableName, [
      'company_id' => $customerId
    ]);
  }

  public static function updateCustomer($customerData)
  {
    global $wpdb;
    $clientsTableName = $wpdb->prefix . 'customers';
    $updatedData = [
      'company_name' => $customerData['company_name'],
      'company_email'  => $customerData['company_email'],
      'company_afm'  =>   $customerData['company_afm'],
      'comapny_address' => $customerData['comapny_address'],
      'mobile' => $customerData['mobile'],
      'phone' => $customerData['phone'],
    ];
    $wpdb->update($clientsTableName, $updatedData, ['company_id' => $customerData['company_id']]);
  }
}
