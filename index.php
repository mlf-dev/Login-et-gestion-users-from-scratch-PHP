<?php
require 'kernel/functions.php';
// Récupération ou démarrage session
session_start();
// var_dump($_SESSION);

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/navbar-top.css" rel="stylesheet">
</head>
<body>
<!--Import navbar-->
<?php require 'backend/templates/navbar.php';?>

<main role="main" class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-8 offset-2">
                <?php echo getFlash() ?>
                <h4>Inscription : </h4>
                <form action="controllers/register.php" method="POST">
                    <div class="form-group">
                        <label for="login">Identifiant</label>
                        <input type="text" class="form-control" name="login" id="login">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="prenom">
                    </div>

                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>