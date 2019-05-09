<?php
$dsn = "mysql:host=localhost;dbname=td_php_db"; // On définit la base de données sur laquelle on travaille et son emplacement
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']; // PDO:: permet d'accéder aux méthodes de PDO et aux attributs; toutes les connexions à la db seront en utf8

try { // essaye de se connecter à la db
    $db = new PDO($dsn, "root", "root", $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // permet de collecter toutes les erreurs qui se déclencheront (syntaxe ou autre, mais sans rapport avec la connexion)
}catch (PDOException $e){ // si un exception (erreur) est levée, on l'appelle $e et
    echo "Problème de connexion à la DB".$e->getMessage(); // on affiche le message avec getMessage() qui affiche le message d'erreur
}

// var_dump($db); Permet de vérifier si ce code fonctionne