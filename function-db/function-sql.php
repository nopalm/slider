<?php

function allData($name_db, $andWhere="") { 
    
    global $wpdb;

    $table_name = $wpdb->prefix.$name_db;
    $sql = "SELECT * FROM " . $table_name . " WHERE 1 ".$andWhere;
    $query = $wpdb->get_results($sql);

    return $query;
    
}


function store($name_db, $data=array()) {

    global $wpdb;

    $table_name = $wpdb->prefix.$name_db;
    $wpdb->insert($table_name,$data);
    $id_insert = $wpdb->insert_id;

    return $id_insert;

}


function edit($name_db, $andWhere) {

    global $wpdb;

    $table_name = $wpdb->prefix.$name_db;
    $sql = "SELECT * FROM " . $table_name . " WHERE id ".$andWhere;
    $row = $wpdb->get_row($sql);

    return $row;

}


function update($name_db,$data=array(), $where=array()) {

    global $wpdb;

    $table_name = $wpdb->prefix.$name_db;
    $update = $wpdb->update($table_name, $data, $where);

    return $update;

}


function delete($name_db, $where=array()) {

    global $wpdb;

    $table_name = $wpdb->prefix.$name_db;
    $delete = $wpdb->delete($table_name,$where);

    return $delete;

}
?>