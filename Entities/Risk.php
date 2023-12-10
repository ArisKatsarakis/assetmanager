<?php
namespace Ent;

class Risk {

    public static function create_risk_table() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $clientsTableName = $wpdb->prefix . 'risk';
        $sql = "CREATE TABLE $clientsTableName (
            risk_id     integer NOT NULL AUTO_INCREMENT, 
            risk_name   varchar(255),
            expiration_date date,
            risk_category_id integer, 
            PRIMARY KEY (risk_id)
        ) $charsetCollate ";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }
    
}