<?php
if (!defined('ABSPATH')) exit;


if (!function_exists('addStyle')) {

    /**
     * Déclare le css et le js sur le front de wordpress
     */
    function addStyle()
    {

        if (is_front_page()) {
            wp_register_style('bandeau_style', plugin_dir_url('__FILE__') . 'bandeau/include/css/bandeau-style.css');
            // Chargement du fichier CSS
            wp_enqueue_style('bandeau_style');

            if (!wp_script_is('jquery', 'done')) {
                // Si jQuery n'est pas chargé, ajouter le CDN de jQuery
                wp_deregister_script('jquery');
                wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true);
            }

            //wp_enqueue_script('bandeau_ajax_script', plugin_dir_url('__FILE__').'bandeau/include/js/bandeau-ajax.js', array(), '1.0.0', true);
            // Enregistrement du fichier JavaScript
            wp_register_script('bandeau_script', plugin_dir_url('__FILE__') . 'bandeau/include/js/bandeau-script.js', array(), '1.0.0', true);
            wp_enqueue_script('bandeau_script');

            wp_localize_script('bandeau_script', 'banniereAjax', ['ajaxurl' => admin_url('admin-ajax.php')]);
        }
    }
}

if (!function_exists('addStyleAdmin')) {
    /**
     * declare le css et le js dans la page d'administration 
     */
    function addStyleAdmin()
    {
       
        wp_register_style('bandeau_style_admin', plugin_dir_url('__FILE__') . 'bandeau/include/css/admin-style-bandeau.css');
        // Chargement du fichier CSS
        wp_enqueue_style('bandeau_style_admin');

        // Enregistrement du fichier JavaScript
        wp_register_script('bandeau_script_admin', plugin_dir_url(__FILE__) . 'bandeau/include/js/admin-bandeau-script.js', array(), '1.0.0', true);
        wp_enqueue_script('bandeau_script_admin');
        
    }
}
