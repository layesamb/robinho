<?php
// lrs/controleurs/ClientControleur.php
require_once '../config/config.php';
require_once '../modeles/ClientModele.php';

class ClientControleur {
    private $clientModele;

    public function __construct() {
        $pdo = getPDOConnection(); // Obtenez la connexion PDO
        $this->clientModele = new ClientModele($pdo); // Passez l'objet PDO au modèle
    }

    // Méthodes pour gérer les clients
    public function afficherClients($sortBy = 'id') {
        return $this->clientModele->getAllClients($sortBy);
    }

    public function afficherClient($id) {
        return $this->clientModele->getClientById($id);
    }

    public function ajouterClient($data) {
        $this->clientModele->addClient($data);
    }

    public function modifierClient($id, $data) {
        $this->clientModele->updateClient($id, $data);
    }

    public function supprimerClient($id) {
        $this->clientModele->deleteClient($id);
    }
}

?>