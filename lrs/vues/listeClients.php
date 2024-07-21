<?php
// lrs/vues/listeclients.php
require_once '../../lrs/controleurs/ClientControleur.php';

// Créez une instance du contrôleur des clients
$clientControleur = new ClientControleur();

// Déterminez l'attribut de tri par défaut ou récupérez-le depuis la requête GET
$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';

// Obtenez la liste des clients triés
$clients = $clientControleur->afficherClients($sortBy);

// Si un utilisateur veut supprimer un client
if (isset($_POST['supprimer_client'])) {
    $id = $_POST['id'];
    $clientControleur->supprimerClient($id);
    header('Location: listeclients.php'); // Recharger la page après suppression
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="/lrs/vues/style.css"> <!-- Assurez-vous que le chemin est correct -->
</head>
<body>
    <div class="container">
        <h1>Liste des Clients</h1>

        <!-- Tri des clients -->
        <form method="get" action="listeclients.php" class="sort-form">
            <label for="sort_by">Trier par :</label>
            <select name="sort_by" id="sort_by">
                <option value="id" <?php if ($sortBy == 'id') echo 'selected'; ?>>ID</option>
                <option value="nom" <?php if ($sortBy == 'nom') echo 'selected'; ?>>Nom</option>
                <option value="email" <?php if ($sortBy == 'email') echo 'selected'; ?>>Email</option>
                <!-- Ajoutez d'autres options de tri si nécessaire -->
            </select>
            <button type="submit">Trier</button>
        </form>

        <!-- Tableau des clients -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Sexe</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['id']); ?></td>
                        <td><?php echo htmlspecialchars($client['nom']); ?></td>
                        <td><?php echo htmlspecialchars($client['adresse']); ?></td>
                        <td><?php echo htmlspecialchars($client['email']); ?></td>
                        <td><?php echo htmlspecialchars($client['sexe'] === 'm' ? 'Masculin' : 'Féminin'); ?></td>
                        <td><?php echo htmlspecialchars($client['statut'] === 'actif' ? 'Actif' : 'Inactif'); ?></td>
                        <td>
                            <a href="modifier_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" class="btn">Modifier</a> |
                            <form method="post" action="listeclients.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">
                                <button type="submit" name="supprimer_client" class="btn">Supprimer</button>
                            </form> |
                            <a href="details_client.php?id=<?php echo htmlspecialchars($client['id']); ?>" class="btn">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Liens pour ajouter un client -->
        <p><a href="ajouter_client.php" class="btn">Ajouter un client</a></p>

        <!-- Liens pour exportation et rapport -->
        <p>
            <a href="exporter_clients.php?format=csv" class="btn">Exporter en CSV</a> |
            <a href="exporter_clients.php?format=pdf" class="btn">Exporter en PDF</a> |
            <a href="generer_rapport.php" class="btn">Générer un rapport</a> |
            <a href="logout.php" class="btn">Déconnexion</a>
        </p>
    </div>
</body>
</html>