<?php

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (empty($id)) {
    header ('Location: ../index.php');
    exit();
}

print_r($_GET);

// Se connecter à la db
require '../kernel/db_connect.php';
// Récupérer le model user pour mettre à jour le user dans la table > is_admin = 1
require '../models/user.php';

setAdmin($_GET['id']);

// Stocker un message de confirmation dans la session
session_start();
$_SESSION['messages'] = "L'utilisateur est maintenant administrateur";
// Redirection vers la page gestion.php avec affichage du message
header('Location: ../backend/gestion.php');
