<?php
//chargement du fichier de configuration
require_once '../config/config.php';
// Connexion à la base de données avec PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=toto', 'root', ''); // Remplacez par vos informations de connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec de la connexion à la base de données : ' . $e->getMessage();
    exit;
}

// Inclusion des fichiers du modèle MVC
require_once 'modeles/ClientModele.php';
require_once 'modeles/UtilisateurModele.php';
require_once 'controleurs/ClientControleur.php';
require_once 'controleurs/UtilisateurControleur.php';

// Initialisation des contrôleurs
$clientControleur = new ClientControleur();
$utilisateurControleur = new UtilisateurControleur();

// Détermination de l'action à exécuter en fonction des paramètres URL
$action = $_GET['action'] ?? 'accueil'; // Action par défaut

switch ($action) {
    case 'liste_clients':
        $clients = $clientControleur->afficherClients();
        require 'vues/listeclients.php';
        break;
    case 'ajouter_client':
        require 'vues/ajouter_client.php';
        break;
    case 'modifier_client':
        require 'vues/modifier_client.php';
        break;
    case 'details_client':
        require 'vues/details_client.php';
        break;
    case 'liste_utilisateurs':
        $utilisateurs = $utilisateurControleur->afficherUtilisateurs();
        require 'vues/accueil.php';
        break;
    case 'ajouter_utilisateur':
        require 'vues/ajouter_utilisateur.php';
        break;
    case 'modifier_utilisateur':
        require 'vues/modifier_utilisateur.php';
        break;
    case 'supprimer_utilisateur':
        require 'vues/supprimer_utilisateur.php';
    case 'generer_rapport':
        require 'vues/generer_rapport.php';
        break;
    case 'exporter_clients':
        require 'vues/exporter_clients.php';
        break;
    default:
        require 'vues/accueil.php';
        break;
}
?>