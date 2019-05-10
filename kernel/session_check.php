<?php

// Récupérer la session
session_start();
// Vérifier la preuve d'identification et d'autorisation
if (isset($_SESSION['logged']) == false){
    $_SESSION['messages'] = ["Accès interdit"];
    header('Location: ../backend/index.php');
    exit();
}