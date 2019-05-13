<?php
require '../kernel/session_check.php';
require '../kernel/db_connect.php';
require '../models/user.php';
require '../kernel/functions.php';

// récupération de l'id
$id = isset($_GET['id']) ? $_GET['id'] :null;

$fields_required = ['login','email','nom','prenom']; // champs qui doivent être remplis
$datas_form = extractDatasForm($_POST, $fields_required); // on nettoie les datas avant de les envoyer dans la base de données

$messages = [];


if (in_array(null, $datas_form)) {
    $messages[] = "Tous les champs sont obligatoires";
}

if (filter_var($datas_form['email'],FILTER_VALIDATE_EMAIL) == false){ // on vérifie le format de l'email
    $messages[] = "Votre email est invalide.";
}

$resultat_email = findOneUserBy('email',$datas_form['email']); // on vérifie que l'email n'est pas déjà utilisé


$resultat_login = findOneUserBy('login',$datas_form['login']); // on vérifie que le login est unique
$nombre_de_login = count($resultat_login);
if ($nombre_de_login > 0){
    $messages[] = "Ce login est déjà utilisé par quelqu'un d'autre.";
}

if(count($messages) == 0){
    // Executer une requête SQL pour transférer les données saisies dans le form dans la base de données
    session_start();
    updateUser($id,$datas_form);
    $_SESSION['messages'] = ['Les modifications ont bien été prises en compte'];
    $_SESSION['color'] = 'primary';
    header('Location: ../backend/gestion.php');
    exit();
}

// Démarrage session pour stocker les messages d'erreur
session_start();
// Etape 8 : Gestion des erreurs : quand un / des problèmes se déclenchent, il faut afficher tous les messages d'erreurs en même temps sur la page d'inscription
$_SESSION['messages'] = $messages;
$_SESSION['color'] = 'danger';
header('Location: ../backend/edit.php?id='.$id);
exit();
