<?php
// lrs/vues/generer_rapport.php

require_once '../../exports/Exporter.php';
require_once '../../lrs/modeles/ClientModele.php';
require_once '../config/config.php'; // Inclure le fichier de configuration

// Créer une connexion PDO
$pdo = getPDOConnection();

// Passer la connexion PDO au modèle
$clientModele = new ClientModele($pdo);

// Définir l'attribut de tri, si nécessaire (par exemple, 'nom', 'adresse', etc.)
$tri = 'nom'; // Exemple de tri, vous pouvez le modifier ou le rendre dynamique

// Passer l'argument de tri à la méthode getAllClients
$clients = $clientModele->getAllClients($tri);

if (isset($_GET['format'])) {
    $format = $_GET['format'];

    if ($format == 'csv') {
        Exporter::exportToCSV($clients);
    } elseif ($format == 'pdf') {
        Exporter::exportToPDF($clients);
    } else {
        echo 'Format non supporté.';
    }
} else {
    echo 'Aucun format spécifié.';
}
?>