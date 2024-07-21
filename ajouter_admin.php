<?php
// ajouter_admin.php

require_once 'lrs\config\config.php'; // Chemin correct vers config.php

// Données de l'utilisateur (normalement, ces données proviennent d'un formulaire)
$nom = 'robinho';
$prenom = 'samb';
$email = 'robinho@gmail.com';
$mot_de_passe = 'robinho'; // Mot de passe en clair
$role = 'admin'; // Rôle d'admin

// Hash du mot de passe
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Connexion à la base de données
$pdo = getPDOConnection();

// Préparer la requête d'insertion
$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

// Exécuter la requête
$stmt->execute([$nom, $prenom, $email, $mot_de_passe_hash, $role]);

echo "Utilisateur admin ajouté avec succès.";
?>