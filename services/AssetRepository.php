<?php
namespace Serv;
class AssetRepository {

    public static function  create_required_tables() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $clientsTableName = $wpdb->prefix . 'customers';
        $sql = "CREATE TABLE $clientsTableName (
            company_id      integer NOT NULL AUTO_INCREMENT,
            company_name    varchar(255),
            company_email   varchar(255),
            company_afm     varchar(10),
            comapny_address varchar(255), 
            PRIMARY KEY (company_id)
        ) $charsetCollate ";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
        
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


}