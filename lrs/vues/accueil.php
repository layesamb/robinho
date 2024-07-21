<?php
// lrs/vues/accueil.php
require_once '../controleurs/ClientControleur.php';
require_once '../controleurs/UtilisateurControleur.php';

// Créez des instances des contrôleurs
$clientControleur = new ClientControleur();
$utilisateurControleur = new UtilisateurControleur();

// Déterminez l'attribut de tri par défaut ou récupérez-le depuis la requête GET
$sortByClients = isset($_GET['sort_by_clients']) ? $_GET['sort_by_clients'] : 'id';

// Obtenez la liste des clients triés
$clients = $clientControleur->afficherClients($sortByClients);

// Obtenez la liste des utilisateurs
$utilisateurs = $utilisateurControleur->afficherUtilisateurs();

// Gérer la suppression d'un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['supprimer_utilisateur']) && isset($_POST['id'])) {
        $utilisateurControleur->supprimerUtilisateur($_POST['id']);
        header('Location: accueil.php'); // Redirige vers la liste après suppression
        exit;
    }

    // Gérer la suppression d'un client (si nécessaire)
    if (isset($_POST['supprimer_client']) && isset($_POST['id'])) {
        $clientControleur->supprimerClient($_POST['id']);
        header('Location: accueil.php'); // Redirige vers la liste après suppression
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Administration</title>
    <link rel="stylesheet" href="lrs\public\css\sytle4.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Clients et Utilisateurs</h1>

        <!-- Tri des clients -->
        <form method="get" action="accueil.php" class="sort-form">
            <label for="sort_by_clients">Trier les clients par :</label>
            <select name="sort_by_clients" id="sort_by_clients">
                <option value="id" <?php if ($sortByClients == 'id') echo 'selected'; ?>>ID</option>
                <option value="nom" <?php if ($sortByClients == 'nom') echo 'selected'; ?>>Nom</option>
                <option value="email" <?php if ($sortByClients == 'email') echo 'selected'; ?>>Email</option>
                <!-- Ajoutez d'autres options de tri si nécessaire -->
            </select>
            <button type="submit" class="btn">Trier</button>
        </form>

        <!-- Tableau des clients -->
        <h2>Liste des Clients</h2>
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
                        <td><?php echo htmlspecialchars($client['sexe']); ?></td>
                        <td><?php echo htmlspecialchars($client['statut']); ?></td>
                        <td>
                            <a href="modifier_client.php?id=<?php echo $client['id']; ?>" class="btn">Modifier</a> |
                            <form method="post" action="accueil.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
                                <button type="submit" name="supprimer_client" class="btn">Supprimer</button>
                            </form> |
                            <a href="details_client.php?id=<?php echo $client['id']; ?>" class="btn">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tableau des utilisateurs -->
        <h2>Liste des Utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($utilisateur['id']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                        <td>
                            <a href="modifier_utilisateur.php?id=<?php echo $utilisateur['id']; ?>" class="btn">Modifier</a> |
                            <form method="post" action="accueil.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $utilisateur['id']; ?>">
                                <button type="submit" name="supprimer_utilisateur" class="btn">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Liens pour ajouter un client et un utilisateur -->
        <p><a href="ajouter_client.php" class="btn">Ajouter un client</a></p>
        <p><a href="ajouter_utilisateur.php" class="btn">Ajouter un utilisateur</a></p>

        <!-- Liens pour exportation et rapport -->
        <p>
            <a href="exporter_clients.php?format=csv" class="btn">Exporter les clients en CSV</a> |
            <a href="exporter_clients.php?format=pdf" class="btn">Exporter les clients en PDF</a> |
            <a href="generer_rapport.php" class="btn">Générer un rapport</a> |
            <a href="logout.php" class="btn">Déconnexion</a>
        </p>
    </div>
</body>
</html>
