<?php

// récupérer la session
session_start();
// destruction de la session
session_destroy();
// redirection vers la page login
header('Location: ../backend/index.php');
exit();
