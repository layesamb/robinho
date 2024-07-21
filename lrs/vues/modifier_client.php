<?php
// lrs/vues/modifier_client.php
require_once '../../lrs/controleurs/ClientControleur.php';

$clientControleur = new ClientControleur();

if (!isset($_GET['id'])) {
    header('Location: listeclients.php'); // Redirige si l'ID n'est pas spécifié
    exit;
}

$id = $_GET['id'];
$client = $clientControleur->afficherClient($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'sexe' => $_POST['sexe'],
        'statut' => $_POST['statut']
    ];
    $clientControleur->modifierClient($id, $data);
    header('Location: listeclients.php'); // Redirige vers la liste des clients après modification
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Client</title>
</head>
<body>
    <h1>Modifier un Client</h1>
    <form method="post" action="modifier_client.php?id=<?php echo htmlspecialchars($id); ?>">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required><br>
        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($client['adresse']); ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required><br>
        <label for="sexe">Sexe:</label>
        <select id="sexe" name="sexe" required>
            <option value="m" <?php echo $client['sexe'] === 'm' ? 'selected' : ''; ?>>Masculin</option>
            <option value="f" <?php echo $client['sexe'] === 'f' ? 'selected' : ''; ?>>Féminin</option>
        </select><br>
        <label for="statut">Statut:</label>
        <select id="statut" name="statut" required>
            <option value="actif" <?php echo $client['statut'] === 'actif' ? 'selected' : ''; ?>>Actif</option>
            <option value="inactif" <?php echo $client['statut'] === 'inactif' ? 'selected' : ''; ?>>Inactif</option>
        </select><br>
        <button type="submit">Modifier</button>
    </form>
    <p><a href="listeclients.php">Retour à la liste des clients</a></p>
</body>
</html>