<?php
namespace Ent;
class Assesment {

    public static function create_assesment_table() {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $clientsTableName = $wpdb->prefix . 'assesments';
        $sql = "CREATE TABLE $clientsTableName (
            assesment_id    integer NOT NULL AUTO_INCREMENT,
            assesment_name  varchar(255) UNIQUE,
            assesment_number integer,
            assesment_fail_limit integer,
            asssment_description varchar(255),
            expiration          date,
            PRIMARY KEY (assesment_id)
        ) $charsetCollate ";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

}