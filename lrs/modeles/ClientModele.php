<?php
// lrs/modeles/ClientModele.php
require_once '../config/config.php'; // Assurez-vous que config.php est inclus

class ClientModele {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthodes pour gérer les clients
    public function getAllClients($trie = null) {
        $query = 'SELECT * FROM clients';

        if ($trie) {
            $query .= ' ORDER BY ' . $trie;
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientById($id) {
        $query = "SELECT * FROM clients WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addClient($data) {
        $query = "INSERT INTO clients (nom, adresse, email, sexe, statut) VALUES (:nom, :adresse, :email, :sexe, :statut)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($data);
    }

    public function updateClient($id, $data) {
        $query = "UPDATE clients SET nom = :nom, adresse = :adresse, email = :email, sexe = :sexe, statut = :statut WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function deleteClient($id) {
        $query = "DELETE FROM clients WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}