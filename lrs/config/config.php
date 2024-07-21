<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'toto');
define('DB_USER', 'root');
define('DB_PASS', '');

// Connexion à la base de données avec PDO
function getPDOConnection() {
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        exit;
    }
}
?>