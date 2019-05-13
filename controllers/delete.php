<?php
require '../kernel/session_check.php';
require '../kernel/db_connect.php';
require '../models/user.php';
require '../kernel/functions.php';

// récupération de l'id
$id = isset($_GET['id']) ? $_GET['id'] :null;

// on supprime le user
deleteUser($id);

$messages[] = "L'utilisateur a été supprimé";
$_SESSION ['messages'] = $messages;

header('Location: ../backend/gestion.php');