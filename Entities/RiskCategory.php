<?php
namespace Ent;
class RiskCategory {

    public static  function create_risk_category_table() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $categoriesTable = $wpdb->prefix . 'risk_category';
        $sql  = 'CREATE TABLE '.$categoriesTable.'
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


    public static function create_risk_category($category) {
        global $wpdb;
        $categoriesTable = $wpdb->prefix . 'risk_category';
        $sql = "INSERT INTO $categoriesTable (category_name, report, invoice ) VALUES ('".$category['category_name']."', ".$category['report'].", ".$category['invoice'].") ";
        $wpdb->query($sql);
    }

    public static function get_risk_category_by_id($id) {
        global $wpdb;
        $categoriesTable = $wpdb->prefix . 'risk_category';
        $sql = "SELECT * FROM $categoriesTable where category_id = $id ";
        return $wpdb->get_results($sql);
    }

    public static function get_all_categories() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $categoriesTable = $wpdb->prefix . 'risk_category';
        $resultsQuery = "SELECT * FROM $categoriesTable";
        $results = $wpdb->get_results($resultsQuery);
        return $results;
    }

}