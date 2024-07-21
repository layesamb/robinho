<?php
// lrs/vues/logout.php

// Démarrer la session
session_start();

// Détruire toutes les données de la session
$_SESSION = array();

// Détruire la session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Enfin, détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: /project/index.php');
exit;
?>
