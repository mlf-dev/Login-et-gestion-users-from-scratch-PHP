<?php
// Fichier qui ne sera jamais affiché, et qui va s'occuper de faire des redirections

// Etape 1 : Connexion à la base de données
require '../kernel/db_connect.php';
require '../models/user.php'; // user doit être placé après db_connect car la variable $db initiée dans db_connect dont a besoin user doit être déclarée avant
// Etape 2 : Récupérer les données du formulaire
require '../kernel/functions.php';
$fields_required = ['login', 'password','email','nom','prenom']; // va nous permettre de vérifier la corrélation entre ce qui est reçu comme datas et ce qui est requis
$datas_form = extractDatasForm($_POST, $fields_required); // ici $datas sera égale au return de cette fonction
// var_dump($datas_form); // var_dump plutôt que print_r car print_r n'affiche quelque chose que lorsqu'il s'agit d'un tableau, contrairement à var_dump. On le commente car une fois les vérifications du fonctionnement du code réalisé, plus rien ne doit être affiché par ce fichier.
// on est obligé de faire cela pour afficher le return d'extractDatasForm car la variable $datas_clean qui se situe dans extractDatasForm n'est pas utilisable en dehors de la fonction. Il faut donc en créer une à l'endroit où l'on veut l'afficher et lui affecter les valeurs à afficher et c'est ce que l'on a fait ici.

// On créé une variable array $message dans laquelle on va insérer les messages d'erreurs
$messages = [];

// Etape 3 : Vérifier que tous les champs sont remplis

if (in_array(null, $datas_form)) {
    $messages[] = "Tous les champs sont obligatoires";
}

// Etape 4-1 : vérifier le format du mail
if (filter_var($datas_form['email'],FILTER_VALIDATE_EMAIL) == false){
    $messages[] = "Votre email est invalide.";
}

// Etape 4 : Vérifier que l'email est unique
$resultat_email = findOneUserBy('email',$datas_form['email']); // $resultat est égal au return de la fonction findOneUserBy
// echo count($resultat_email);
$nombre_de_mails = count($resultat_email);
if ($nombre_de_mails > 0){
    $messages[] = "Un utilisateur est déjà inscrit avec cet email. Peut-être avez-vous déjà un compte?";
}

// Etape 5 : Vérifier que login est unique
$resultat_login = findOneUserBy('login',$datas_form['login']);
// echo count($resultat_login);
$nombre_de_login = count($resultat_login);
if ($nombre_de_login > 0){
    $messages[] = "Ce login est déjà utilisé par quelqu'un d'autre.";
}

// Etape 6 : Vérifier que le mot de passe fait au moins 8 caractères
if (strlen($datas_form['password'])<= 8){
    $messages[] = "Votre mot de passe doit compter au moins 8 caractères.";
};

// Etape 7 : Si tout est ok alors on insert les datas dans la base de données et on redirige vers la page de confirmation d'inscription
if(count($messages) == 0){
    // Executer une requête SQL pour transférer les données saisies dans le form dans la base de données
    addUser($datas_form);

    session_start();
    $_SESSION['register'] = true;
    header('Location: ../confirmation.php');
    exit();
}

// Démarrage session pour stocker les messages d'erreur
session_start();
// Etape 8 : Gestion des erreurs : quand un / des problèmes se déclenchent, il faut afficher tous les messages d'erreurs en même temps sur la page d'inscription
$_SESSION['messages'] = $messages;
header('Location: ../index.php');