<?php
/*
  Plugin Name: Bandeau
  Description: Ajoute un bandeau sur votre page d'acceuil, exclusif a antalia.re et ju-et romeo 
  Version: 1.0.0
  Author: Eclapier Johanny
  Author URI: https://www.upstart.re
 License: GPLv2 

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2023 ECLAPIER johanny (email : contact@upstart.re) 

*/

if (!defined('ABSPATH')) exit;

if (!defined('BA_BANNIERE_PATH')) {
  define('BA_BANNIERE_PATH', plugin_dir_path(__FILE__));
}


require_once BA_BANNIERE_PATH . 'function/methodStyle.php';
require_once BA_BANNIERE_PATH . 'function/methodTemplate.php';
require_once BA_BANNIERE_PATH . 'modeles/dbBanieres.php';
require_once BA_BANNIERE_PATH . 'function/changeMessage.php';


if (!function_exists('init')) {
  function init()
  {
    addStyle();
    add_action('wp_enqueue_scripts', 'addStyle');

    afficheBandeau();
    add_action('wp_body_open', 'afficheBandeau');

   

    declareMenu();
    add_action('admin_menu', 'declareMenu');

    addStyleAdmin();
    add_action('load-', 'addStyleAdmin');

    add_action('wp_ajax_nopriv_dataSending', 'dataSending');
  }
}

/**
 * gere la création de la table en base de données
 */
if (!function_exists('ba_install')) {
  function ba_Install()
  {
    //créer la table
    createTableBanniere();
  }
}

/**
 * Affiche la page d'administration pour les mofifications du message 
 */
if (!function_exists('ba_admin_page')) {
  function ba_admin_page()
  {
    $status = null;
    //verifie si une variable a ete teste
    if (isset($_POST['ba_mes_messages'])) {
      if (substr_count($_POST['ba_mes_messages'], ",") <= 2) {

        $envoie = $_POST['ba_mes_messages'];
        $data = convert($envoie);
        update($data);

        $status = ["green","Données enregistrées"];
      }else {
        $status = ["red","Vous ne pouvez écrire que trois messages"];
      }
    }

    // recupere la valeur en base de donnée
    $dataresult = queryDataAdmin();

    $string_message = revertConvert($dataresult);

    affichePageAdmin($string_message, $status);
  }
}


/**
 * declarer le menu dans la page admin 
 */
if (!function_exists('declareMenu')) {
  function declareMenu()
  {
    if (function_exists('add_menu_page')) {

      add_menu_page(
        'banniere',
        'Banniere',
        'administrator',
        __FILE__,
        'ba_admin_page',
        ' ',
        03
      );
    }
  }
}
/**
 * provoque une requete ajax pour recuperer les données sur le front 
 */
if (!function_exists('dataSending')) {
  function dataSending()
  {

    $dataSending = queryDataAdmin();

    $reformate = $dataSending[0]['data'];

    $unserialize_data = unserialize($reformate);

    $deserialized_data = array_map('stripslashes', $unserialize_data);

    wp_send_json($deserialized_data, null, null);
  }
}

//active l'enregistrement des tables
register_activation_hook(__FILE__, 'ba_Install');


init();
