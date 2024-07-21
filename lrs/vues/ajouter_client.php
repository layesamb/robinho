<?php
// lrs/vues/ajouter_client.php
require_once '../../lrs/controleurs/ClientControleur.php';

$clientControleur = new ClientControleur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'sexe' => $_POST['sexe'],
        'statut' => $_POST['statut']
    ];
    $clientControleur->ajouterClient($data);
    header('Location: listeclients.php'); // Redirige vers la liste des clients après ajout
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Client</title>
    <link rel="stylesheet" href="lrs\public\css\style5.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Client</h1>
        <form method="post" action="ajouter_client.php" class="form-container">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br>

            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="sexe">Sexe:</label>
            <select id="sexe" name="sexe" required>
                <option value="m">Masculin</option>
                <option value="f">Féminin</option>
            </select><br>

            <label for="statut">Statut:</label>
            <select id="statut" name="statut" required>
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
            </select><br>

            <button type="submit" class="btn">Ajouter</button>
        </form>
        <p><a href="listeclients.php" class="btn">Retour à la liste des clients</a></p>
    </div>
</body>
</html>
