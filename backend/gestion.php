<?php

session_start();

// on vérifie que le user est bien passé par register.php avant de pouvoir accéder à confirmation.php
if (isset($_SESSION['logged']) == false){
    $_SESSION['messages'] = ["Il y a une erreur quelque part."];
    header('Location: index.php');
    exit();
}

require '../kernel/db_connect.php';

require '../models/user.php';
$users = findAllUsers(); // on récupère tous les users dans la table
//var_dump($users);
//die();

?>

<!doctype html>
<html lang="fr" xmlns:class="http://www.w3.org/1999/xhtml">
<head>
<?php require 'templates/header.php' ?>
    <title>Gestionnaire de utilisateurs</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">Top navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<main role="main" class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-10">

                <h1>Gestion des utilisateurs</h1>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Administrateur</th>
                        <th>Date d'inscription</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) :?>
                            <tr>
                                <td><?= $user['login'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= strtoupper($user['nom']) ?></td>
                                <td><?= ucfirst($user['login']) ?></td>
                                <td>
                                    <?php if($user['is_admin'] == true) :?>
                                    <span class="badge badge-primary">Admin</span>
                                    <?php else :?>
                                    <span class="badge badge-dark">User</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php $date_creation = date_create($user['created_at']) ?>
                                    <?= date_format($date_creation, 'd/m/Y H:i') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
<?php require 'templates/footer.php' ?>
</html>
