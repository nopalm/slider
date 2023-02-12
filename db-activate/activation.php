<?php

function sliderCreateTable() {

  global $wpdb;

  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'slider';

  $sql = "CREATE TABLE `$table_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head_slider` varchar(255) DEFAULT NULL,
  `desc_slider` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY(id)
  ) $charset_collate;
  ";

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
  }

}

?>