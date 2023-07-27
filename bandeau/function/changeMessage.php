<?php

if (!defined('ABSPATH')) exit;


if (!function_exists('convert')) {
    /**
     * convert un chaine dans un tableau en base de données
     */
    function convert($envoie)
    {


        $tableau = explode(",", $envoie);

        $tableau = array_map('trim', $tableau);

        $serialized_data = serialize($tableau);

        return ($serialized_data);
    }
}

if (!function_exists('revertConvert')) {
    /**
     * converti un tableau en base de donnée en chaine de caracteres 
     */
    function revertConvert($dataresult)
    {

        $reformate = $dataresult[0]['data'];

        $unserialize_data = unserialize($reformate);

        $deserialized_data = array_map('stripslashes', $unserialize_data);

        $string_data = implode(",", $deserialized_data);

        return $string_data;
    }
}
