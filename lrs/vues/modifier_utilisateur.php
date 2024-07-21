<?php
// lrs/vues/modifier_utilisateur.php
require_once '../../lrs/controleurs/UtilisateurControleur.php';

$utilisateurControleur = new UtilisateurControleur();

if (!isset($_GET['id'])) {
    header('Location: accueil.php'); // Redirige si l'ID n'est pas spécifié
    exit;
}

$id = $_GET['id'];
$utilisateur = $utilisateurControleur->afficherUtilisateur($id);

if (!$utilisateur) {
    die("Utilisateur non trouvé.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'role' => $_POST['role']
    ];

    // Mise à jour du mot de passe seulement si un nouveau mot de passe est fourni
    if (!empty($_POST['mot_de_passe'])) {
        $data['mot_de_passe'] = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    }

    $utilisateurControleur->modifierUtilisateur($id, $data);
    header('Location: accueil.php'); // Redirige vers la liste des utilisateurs après modification
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Utilisateur</title>
</head>
<body>
    <h1>Modifier un Utilisateur</h1>
    <form method="post" action="modifier_utilisateur.php?id=<?php echo htmlspecialchars($id); ?>">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>" required><br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur['prenom']); ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>" required><br>
        <label for="mot_de_passe">Mot de Passe (laisser vide pour ne pas changer):</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe"><br>
        <label for="role">Rôle:</label>
        <select id="role" name="role" required>
            <option value="utilisateur" <?php echo $utilisateur['role'] === 'utilisateur' ? 'selected' : ''; ?>>Utilisateur</option>
            <option value="admin" <?php echo $utilisateur['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select><br>
        <button type="submit">Modifier</button>
    </form>
    <p><a href="accueil.php">Retour à l'accueil</a></p>
</body>
</html>
