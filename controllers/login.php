<?php
session_start();
require '../models/user.php';

// 1 Connexion à la DB
require '../kernel/db_connect.php';

// 2 Récupérer les données du form
require '../kernel/functions.php';
$fields_required = ['login','password'];
$datas_form = extractDatasForm($_POST, $fields_required);

// Variable array qui va recueillir tous les messages d'erreurs
$messages = [];

// 3 Vérifier que tous les champs sont remplis
if (in_array(null, $datas_form)) {
    $messages[] = "Tous les champs sont obligatoires";

}

// 4 Lancer une requête SQL pour récupérer le user avec le login saisi
$user_in_db = findOneUserBy('login', $datas_form['login']);

// On s'assure que le login existe bien :
if (count ($user_in_db) != 1){
    $messages[] = "Votre login est incorrect";
}
// var_dump($resultat_login[0]['password']);

// 5 Comparer le mot de passe stocké dans la db au mot de passe saisi par le user
// 5-2 On vérifie que le mot de passe entré par le client correspond au mot de passe stocké dans la base de données

else if(password_verify($datas_form['password'], $user_in_db[0]['password'])){ // ici on compare le mot de passe tapé par le client avec le mot de passe stocké dans la base de données
    // 6 Si la comparaison est ok, alors si is_loggin == 1, alors :
    // 6-1 Si user est admin alors démarrage session, stockage dans la session d'une preuve d'identification
// 7 Redirection du user vers la page gestion.php qui affiche tous les users
    if($user_in_db[0]['is_admin'] == 1){ // on peut aussi mettre true, équivaut à 1
        $_SESSION['logged'] = true;
        header('Location: ../backend/gestion.php');
        exit();
    } else {
        $messages[] = "Vous n'avez pas les droits pour accéder à cette page";
    }
} else {
    $messages[] = 'Mot de passe invalide';
}


// Gestion des erreurs dans la variable $_SESSION['messages']
// On cumule les messages d'erreurs et on redirige le user sur le formulaire de login avec affichage de toutes les erreurs rencontrées
if (count($messages) != 0){
    $_SESSION['messages'] = $messages;
    header('Location: ../backend/index.php');
    exit();
}