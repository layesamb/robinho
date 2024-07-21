<?php
// lrs/vues/ajouter_utilisateur.php
require_once '../../lrs/controleurs/UtilisateurControleur.php';

$utilisateurControleur = new UtilisateurControleur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mot_de_passe' => password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),
        'role' => $_POST['role']
    ];
    $utilisateurControleur->ajouterUtilisateur($data);
    header('Location: accueil.php'); // Redirige vers la liste des utilisateurs après ajout
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="lrs\public\css\style6.css"> <!-- Assurez-vous que le chemin est correct -->
</head>
<body>
    <div class="container">
        <h1>Ajouter un Utilisateur</h1>
        <form method="post" action="ajouter_utilisateur.php" class="form-container">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br>
            
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="mot_de_passe">Mot de Passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
            
            <label for="role">Rôle:</label>
            <select id="role" name="role" required>
                <option value="utilisateur">Utilisateur</option>
                <option value="admin">Admin</option>
            </select><br>
            
            <button type="submit" class="btn">Ajouter</button>
        </form>
        <p><a href="accueil.php" class="btn">Retour à l'accueil</a></p>
    </div>
</body>
</html>
