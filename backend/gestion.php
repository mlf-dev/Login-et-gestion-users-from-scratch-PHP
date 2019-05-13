<?php

// on vérifie que le user est bien passé par register.php avant de pouvoir accéder à confirmation.php
require '../kernel/session_check.php';
require '../kernel/functions.php';

require '../kernel/db_connect.php';
// var_dump($_SESSION);

require '../models/user.php';
$users = findAllUsers(); // on récupère tous les users dans la table
//var_dump($users);
//die();

?>

<!doctype html>
<html lang="fr" xmlns:class="http://www.w3.org/1999/xhtml">
<head>
<?php require 'templates/header.php' ?>
    <title>Gestionnaire des utilisateurs</title>
</head>
<body>
<!--Import navbar-->
<?php require 'templates/navbar.php' ?>
<main role="main" class="container-fluid">
    <div class="jumbotron">
        <div class="row">
            <div class="col-12">
                <h3 style="text-align: center">Bienvenue <span style="color: #89e2bb; font-weight: bold"><?php echo strtoupper($_SESSION['login']) ?></span></h3>
                <h1>Gestion des utilisateurs</h1>

                <?php echo getFlash() ?>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Administrateur</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
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
                                <td>
                                    <?php if (!$user['is_admin']) : ?>
                                    <a class="btn btn-outline-dark" href="../controllers/toggleAdmin.php?id=<?= $user['id'] ?>&admin=1">Donner droit admin</a>
                                    <?php else: ?>
                                    <a  class="btn btn-dark <?php if($_SESSION['id_admin'] == $user['id']) :?> disabled <?php endif ?>" href="../controllers/toggleAdmin.php?id=<?= $user['id'] ?>">Retirer droit admin</a>
                                    <?php endif; ?>
                                    <a class="btn btn-info" href="edit.php?id=<?= $user['id'] ?>">Modifier</a>
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')" class="btn btn-danger <?php if($_SESSION['id_admin'] == $user['id']) :?> disabled <?php endif ?>" href="../controllers/delete.php?id=<?= $user['id'] ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <a onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter?')" href="../controllers/logout.php">Se déconnecter</a>
    </div>
</main>
</body>
<?php require 'templates/footer.php' ?>
</html>
