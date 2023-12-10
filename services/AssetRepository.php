<?php
namespace Serv;
use Ent\RiskCategory;
use Ent\Risk;
use Ent\Assesment;
use Ent\Customer;
class AssetRepository {
    
    public static function  create_required_tables() {
        Customer::create_customer_table();
        RiskCategory::create_risk_category_table();
        Risk::create_risk_table();
        Assesment::create_assesment_table();
    }


    public static function delete_required_tables() {
        global $wpdb;
        $clientsTableName = $wpdb->prefix . 'customers';
		$wpdb->query("
			DROP TABLE IF EXISTS $clientsTableName
		");
    }


    public static function create_new_customer( $customerJson ) {
        global $wpdb;
        $clientsTableName = $wpdb->prefix . 'customers';
        $result = $wpdb->query(
            "
            INSERT INTO `wp_customers`( `company_name`, `company_email`, `company_afm`, `comapny_address`) VALUES ('".$customerJson['companyName']."','".$customerJson['companyEmail']."','".$customerJson['companyAfm']."','".$customerJson['companyAddress']."')
            "
        );

    }

    public static function deleteCustomerById($customerId)  {
        global $wpdb; 
        $clientsTableName = $wpdb->prefix. 'customers';
        $wpdb->delete($clientsTableName, [
            'company_id' => $customerId
        ]);
    }

    public static function updateCustomer($customerData) {
        global $wpdb;
        $clientsTableName = $wpdb->prefix . 'customers';
        $updatedData = [
            'company_name' => $customerData['company_name']
        ];
        $wpdb->update($clientsTableName, $updatedData, ['company_id'=> $customerData['company_id']]);
    }


}