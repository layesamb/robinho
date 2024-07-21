<?php
// login.php
session_start();
require_once 'lrs/config/config.php'; // Corriger le chemin si nécessaire

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailOrName = $_POST['email_or_name'];
    $password = $_POST['password'];

    $pdo = getPDOConnection();

    // Vérification par email ou nom
    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ? OR nom = ?');
    $stmt->execute([$emailOrName, $emailOrName]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user'] = $user;

        // Vérification du rôle de l'utilisateur
        if ($user['role'] === 'admin') {
            header('Location: lrs/vues/accueil.php'); // Redirection pour l'admin
        } else {
            header('Location: lrs/vues/listeclients.php'); // Redirection pour l'utilisateur
        }
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="lrs\public\css\style1.css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <form method="post" action="login.php">
            <label for="email_or_name">Email ou Nom :</label>
            <input type="text" id="email_or_name" name="email_or_name" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Connexion</button>
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <p class="register-link">Vous n'avez pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
    </div>
</body>
</html>
