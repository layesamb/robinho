<?php
// lrs/modeles/UtilisateurModele.php
require_once '../config/config.php';

class UtilisateurModele {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDOConnection();
    }

    // Récupérer tous les utilisateurs
    public function getAllUtilisateurs() {
        $stmt = $this->pdo->query('SELECT * FROM utilisateurs');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par son ID
    public function getUtilisateurById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouvel utilisateur
    public function addUtilisateur($data) {
        $stmt = $this->pdo->prepare('INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$data['nom'], $data['prenom'], $data['email'], password_hash($data['mot_de_passe'], PASSWORD_DEFAULT), $data['role']]);
    }

    // Mettre à jour un utilisateur existant
    public function updateUtilisateur($id, $data) {
        $sql = 'UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?';
        $params = [$data['nom'], $data['prenom'], $data['email'], $data['role'], $id];
        
        // Ajout du mot de passe seulement si fourni
        if (isset($data['mot_de_passe'])) {
            $sql = 'UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, mot_de_passe = ?, role = ? WHERE id = ?';
            $params = [$data['nom'], $data['prenom'], $data['email'], $data['mot_de_passe'], $data['role'], $id];
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }


    public function deleteUtilisateur($id) {
        $query = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>