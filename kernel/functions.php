<?php

// On obtient ce commentaire avec /** et entrer
/**
 * Extraires les données d'un formulaire
 * @param array $datas_a_nettoyer
 * @param array $fields_required
 * @return array $datas_clean
 */
function extractDatasForm(array $datas_a_nettoyer, array $fields_required) { // ici on veut un array en entrée et un array en sortie

    /*
    print_r($datas_a_nettoyer);
    print_r($fields_required);
    die();
    */

    $data_clean = [];
    // print_r($datas_a_nettoyer);

    // 1> Mettre les clés du tableau $datas_a_nettoyer
    /*
        $tableau_des_cles_de_datasanettoyer_a_comparer = [];
        foreach($datas_a_nettoyer as $html_name => $values){
            array_push($tableau_des_cles_de_datasanettoyer_a_comparer, $html_name);
        }
    */

    $diff = array_diff(array_keys($datas_a_nettoyer), $fields_required);

    // 2> Comparer deux tableaux avec array_diff() qui renvoie un troisième tableau
    if (count($diff)>0) {
        return false;
    }

    // 3> Si dans ce tableau il y a une valeur, alors il y a une erreur quelque part
    foreach($datas_a_nettoyer as $html_name => $value) {
        if (!empty($value)) {
            $data_clean[$html_name] = trim($value); // on retire les espaces avant et après
        } else {
            $data_clean[$html_name] = null;
        }
    }

    return $data_clean;
}

/**
 * Récupère les messages d'erreur dans index.php puis les supprime
 */
function getFlash(){
    // Démarrage récupération de sessions :
    // session_start();
    $html = null;
    if (isset($_SESSION['messages'])) {
        $html = '<div class="alert alert-danger">';

        foreach ($_SESSION['messages'] as $message){
            $html .= '<strong>';
            $html .= $message;
            $html .= '</strong><br/>';
        }

        $html .= '</div>';

        unset($_SESSION['messages']); // supprime les messages de la session
    }

    return $html;
}


function setFlash(){

}

