<?php

if (!defined('ABSPATH')) exit;


if (!function_exists('createTableBanniere')) {
    /**
     * creer la base de donnée
     */
    function createTableBanniere()
    {
        global $wpdb; // Variable pour accéder à la base de données de WordPress

        $table_name = $wpdb->prefix . 'banniere'; // Remplacez 'nom_de_votre_table' par le nom souhaité pour votre table

        $charset_collate = $wpdb->get_charset_collate();



        // Définition de la requête SQL pour créer la table
        $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            data longtext NOT NULL ,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        /*insertion de données par defaut */
        $value_data = 'a:3:{i:0;s:10:"element 1";i:1;s:25:"element 2";i:2;s:4:"element 3";}';
        $wpdb->insert(
            $table_name,
            [
                'data' => $value_data
            ]
        );
    }
}

if (!function_exists('update')) {

    /**
     * mets a jour les données de la base de donnée
     */
    function update($data)
    {
        global $wpdb;
        $id = 1;


        $table_name = $wpdb->prefix . 'banniere'; // Remplacez 'nom_de_votre_table' par le nom de votre table

        $wpdb->update(
            $table_name,
            [
                'data' => $data
            ],
            [
                'Id' => $id
            ],
            [
                '%s'
            ]

        );
    }
}

if (!function_exists('queryDataAdmin')) {
/**
 * recupere les données present dans la table 
 */
    function queryDataAdmin()
    {
        global $wpdb;
        $id = 1;
        $table_name = $wpdb->prefix . 'banniere';

        $sql = "SELECT data FROM {$table_name} WHERE {$table_name}.id= {$id}";
        $result = $wpdb->get_results($sql, ARRAY_A);

        return $result;
    }
}
