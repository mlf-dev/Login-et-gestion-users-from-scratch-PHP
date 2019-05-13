<?php
// sécuriser l'accès au fichier
require '../kernel/session_check.php';
require '../kernel/db_connect.php';
require '../models/user.php';
require '../kernel/functions.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (empty($id)){
    header('Location: gestion.php');
    exit();
}
$user = findOneUserBy('id',$id);

?>

<!doctype html>
<html lang="fr" xmlns:class="http://www.w3.org/1999/xhtml">

<head>
<!--Import du header-->
<?php require 'templates/header.php'; ?>
    <title>Modifier informations</title>
</head>
<!--Import de la navbar-->
<?php require 'templates/navbar.php'; ?>
<body>
    <main role="main" class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-8 offset-2">

                    <h3>Mofidier les informations de l'utilisateur <?= $user[0]['login'] ?>: </h3>

                    <?php echo getFlash() ?>

                    <form action="../controllers/update.php?id=<?= $user[0]['id'] ?>" method="POST">
                        <div class="form-group">
                            <label for="login">Identifiant</label>
                            <input type="text" class="form-control" name="login" id="login" value="<?= $user[0]['login'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= $user[0]['email'] ?>">
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        -->
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" value="<?= $user[0]['nom'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $user[0]['prenom'] ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
<!--Import du footer -->
<?php require 'templates/footer.php'; ?>
</body>
</html>