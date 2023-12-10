<?php
namespace Ent;
class RiskCategory {

    public static  function create_risk_category_table() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $clientsTableName = $wpdb->prefix . 'risk_category';
        $sql  = 'CREATE TABLE '.$clientsTableName.'
            (
                category_id     integer NOT NULL AUTO_INCREMENT, 
                category_name   varchar(255),
                report          boolean, 
                invoice         boolean, 
                PRIMARY KEY (category_id)
            ) '.$charsetCollate;
        require_once(ABSPATH .'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

}