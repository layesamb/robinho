<?php
// lrs/vues/details_client.php
require_once '../../lrs/controleurs/ClientControleur.php';

$clientControleur = new ClientControleur();

if (!isset($_GET['id'])) {
    header('Location: listeclients.php'); // Redirige si l'ID n'est pas spécifié
    exit;
}

$id = $_GET['id'];
$client = $clientControleur->afficherClient($id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Client</title>
    <link rel="stylesheet" href="lrs\public\css\style7.css"> <!-- Assurez-vous que le chemin est correct -->
</head>
<body>
    <div class="container">
        <h1>Détails du Client</h1>
        <div class="client-details">
            <p><strong>ID:</strong> <?php echo htmlspecialchars($client['id']); ?></p>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($client['nom']); ?></p>
            <p><strong>Adresse:</strong> <?php echo htmlspecialchars($client['adresse']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
            <p><strong>Sexe:</strong> <?php echo htmlspecialchars($client['sexe'] === 'm' ? 'Masculin' : 'Féminin'); ?></p>
            <p><strong>Statut:</strong> <?php echo htmlspecialchars($client['statut'] === 'actif' ? 'Actif' : 'Inactif'); ?></p>
        </div>
        <p><a href="modifier_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" class="btn">Modifier</a></p>
        <p><a href="listeclients.php" class="btn">Retour à la liste des clients</a></p>
    </div>
</body>
</html>