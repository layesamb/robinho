<?php
// lrs/vues/exporter_clients.php

require_once '../config/config.php'; // Inclure le fichier de configuration
require_once '../modeles/ClientModele.php'; // Inclure le modèle des clients

// Créer une connexion PDO
$pdo = getPDOConnection();

// Passer la connexion PDO au modèle
$clientModele = new ClientModele($pdo);

// Récupérer tous les clients
$clients = $clientModele->getAllClients();

// Déterminer le format de l'export
$format = isset($_GET['format']) ? $_GET['format'] : 'csv';

if ($format == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="clients.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Nom', 'Adresse', 'Email', 'Sexe', 'Statut']); // Entêtes

    foreach ($clients as $client) {
        fputcsv($output, $client);
    }

    fclose($output);
    exit;
} elseif ($format == 'pdf') {
    // Code pour exporter au format PDF
    // Inclure le fichier TCPDF et générer le PDF ici
} else {
    echo 'Format non supporté.';
}
?>
