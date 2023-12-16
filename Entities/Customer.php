<?php
namespace Ent;
class Customer {
    public static function create_customer_table() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $clientsTableName = $wpdb->prefix . 'customers';
        $sql = "CREATE TABLE $clientsTableName (
            company_id      integer NOT NULL AUTO_INCREMENT,
            company_name    varchar(255),
            company_email   varchar(255),
            company_afm     varchar(10),
            comapny_address varchar(255), 
            mobile varchar(255), 
            phone varchar(255), 
            PRIMARY KEY (company_id)
        ) $charsetCollate ";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }
}