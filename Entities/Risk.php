<?php

namespace Ent;

class Risk
{

  public static function create_risk_table()
  {
    global $wpdb;
    $charsetCollate = $wpdb->get_charset_collate();
    $riskTableName = $wpdb->prefix . 'risk';
    $sql = "CREATE TABLE $riskTableName (
            risk_id     integer NOT NULL AUTO_INCREMENT, 
            risk_name   varchar(255),
            expiration_date date,
            risk_category_id integer, 
            PRIMARY KEY (risk_id)
        ) $charsetCollate ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

  public static function create_risk($categoryId, $riskBody)
  {
    global $wpdb;
    $riskTableName = $wpdb->prefix . 'risk';
    $sql = "INSERT INTO $riskTableName (risk_name, expiration_date, risk_category_id ) VALUES ('" . $riskBody['risk_name'] . "', '" . $riskBody['expiration_date'] . "', " . $categoryId . ") ";
    $wpdb->query($sql);
  }

  public static function get_risk_by_category_id($categoryId)
  {
    global $wpdb;
    $riskTableName = $wpdb->prefix . 'risk';
    $sql = "SELECT * FROM $riskTableName where risk_category_id = $categoryId";
    return $wpdb->get_results($sql);
  }
}

