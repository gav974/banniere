<?php


if(!defined('WP_UNINSTALL_PLUGIN')) exit;

if(!function_exists('bandeauUnInstall')){

/**
 * Supprimme les données dans la base de données
 */
function bandeauUnInstall(){
    global $wpdb;
    $table_site = $wpdb->prefix.'bandeau';

    $sql="DROP TABLE {$table_site}";
    $wpdb->query($sql);
    
}
}

bandeauUnInstall();