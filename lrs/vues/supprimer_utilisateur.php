<?php
// lrs/vues/supprimer_utilisateur.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../lrs/controleurs/UtilisateurControleur.php';

$utilisateurControleur = new UtilisateurControleur();

if (!isset($_GET['id'])) {
    header('Location: accueil.php'); // Redirige si l'ID n'est pas spécifié
    exit;
}

$id = $_GET['id'];

// Supprimer l'utilisateur
$utilisateurControleur->supprimerUtilisateur($id);

// Rediriger vers la liste des utilisateurs après suppression
header('Location: accueil.php');
exit;
?>
