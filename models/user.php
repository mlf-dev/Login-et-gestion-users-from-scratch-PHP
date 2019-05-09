<?php

function findOneUserBy($critere_de_recherche, $value) {

    // on récupère la variable $db qui est la base de donnée, et qui vient du fichier db_connect
    global $db;

    // SQL
    // $sql = "SELECT * FROM users WHERE $critere_de_recherche = '$value'";
    $sql = "SELECT * FROM users WHERE $critere_de_recherche = :value"; // * veut dire : récupérer toutes les colonnes
    // on prépare la requête SQL
    $stmt = $db->prepare($sql); // on prépare la requête et on la stocke dans une variable statement (état)
    $stmt->bindparam(':value', $value, PDO::PARAM_STR); // on lie la valeur donnée par le client avec
    // PARAM_STR permet de vérifier si l'email donné par le client est bien une chaîne de caractère, fait également la vérification des quotes et l'échappement systématique de ce genre de caractère pour éviter l'injection de requête SQL dans la base de données (ex : '' OR 1=1);

    $stmt->execute();// après la préparation on exécute la requête SQL
    $stmt->setFetchMode(PDO::FETCH_ASSOC); // le mode de récupératoin (setFetchMode) est un tableau associatif (FETCH_ASSOC)
    $resultat = $stmt->fetchAll(); // on récupère tous les résultats dans la table (toutes les lignes et non toutes les colonnes, puisque c'est * dans la requête qui se charge déjà de récupérer les colonnes)

    //echo "<pre>";
    //var_dump($resultat); // le résultat est un booléen, true ou false en fonction de si la requête fonctionne ou non
    //echo "</pre>";
    return $resultat;

}

function addUser(array $datas) {
    global $db;
    $sql = "INSERT INTO users (login,email,password,nom,prenom,is_admin, created_at) VALUES(:login,:email,:password,:nom,:prenom,:is_admin,:created_at)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":login", $datas['login'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datas['email'], PDO::PARAM_STR);
    $stmt->bindParam(":password", password_hash($datas['password'], PASSWORD_ARGON2ID), PDO::PARAM_STR);
    $stmt->bindParam(":nom", $datas['nom'], PDO::PARAM_STR);
    $stmt->bindParam(":prenom", $datas['prenom'], PDO::PARAM_STR);
    $stmt->bindValue(":is_admin", 0, PDO::PARAM_BOOL);
    $stmt->bindParam(":created_at", date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->execute();
};

function findAllUsers() {
    global $db;
    $sql = "SELECT * FROM users";

    $stmt = $db->prepare($sql);
    $stmt-> execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultat = $stmt->fetchAll();
    return $resultat;
};