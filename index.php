<?php
/**
 * @package Slider Plugin
 * @version 1.0.0
 */
/*
Plugin Name: Slider Plugin
Description: The Basic Slider Plugin
Author: Naufal M
Version: 1.0.0
Author URI: https://github.com/nopalmm
*/

ob_start();

include 'db-activate/activation.php';
register_activation_hook( __FILE__, 'sliderCreateTable');

define('TEMP_DIR' , plugin_dir_path(__FILE__).'/templates/');

include 'menu/function-menu.php';

include 'function-db/function-sql.php';

?>