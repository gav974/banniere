<?php
if (!defined('ABSPATH')) exit;


if (!function_exists('afficheBandeau')) {
    /**
     * affiche le bandeau avec les élements html 
     */
    function afficheBandeau()
    {
        //test si on n'est sur la homepage
        if (is_front_page()) {

            ob_start();
            include plugin_dir_path(__FILE__) . '../template/content.php';

            $contenu = ob_get_clean();

            echo $contenu;
        }
    }
}
if (!function_exists('affichePageAdmin')) {
    /**
     * Affiche le modele de page cote
     */
    function affichePageAdmin($string_message, $status = null)
    {


        ob_start();

        include plugin_dir_path(__FILE__) . '../template/adminPage.php';

        $viewPage = ob_get_clean();

        echo $viewPage;
    }
}
