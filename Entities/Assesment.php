<?php

namespace Ent;

class Assesment
{

  public static function create_assesment_table()
  {
    global $wpdb;
    $charsetCollate = $wpdb->get_charset_collate();
    $assessmentsTable = $wpdb->prefix . 'assesments';
    $sql = "CREATE TABLE $assessmentsTable (
            assesment_id    integer NOT NULL AUTO_INCREMENT,
            assesment_name  varchar(255) UNIQUE,
            assesment_number integer,
            assesment_fail_limit integer,
            assesment_description varchar(255),
            expiration date,
            risk_id integer NOT NULL , 
            PRIMARY KEY (assesment_id)
        ) $charsetCollate ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

  public static function insert_assessment($riskId, $assessmentBody)
  {
    global $wpdb;
    $assessmentTable = $wpdb->prefix . 'assesments';
    $sql = "INSERT INTO " . $assessmentTable . " (assesment_name, assesment_number,assesment_fail_limit, assesment_description, expiration, risk_id) VALUES ('" . $assessmentBody['assesment_name'] . "', " . $assessmentBody['assesment_number'] . ', ' . $assessmentBody['assesment_number'] . ", '" . $assessmentBody['assesment_description'] . "', '" . $assessmentBody['expiration'] . "', " . $riskId . ')';
    return $wpdb->query($sql);
  }
}
