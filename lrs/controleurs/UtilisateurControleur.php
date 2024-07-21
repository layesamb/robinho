<?php
// lrs/controleurs/UtilisateurControleur.php
require_once '../config/config.php';
require_once '../modeles/UtilisateurModele.php';

class UtilisateurControleur {
    private $utilisateurModele;

    public function __construct() {
        $this->utilisateurModele = new UtilisateurModele();
    }

    // Afficher tous les utilisateurs
    public function afficherUtilisateurs() {
        return $this->utilisateurModele->getAllUtilisateurs();
    }

    // Afficher un utilisateur spécifique par ID
    public function afficherUtilisateur($id) {
        return $this->utilisateurModele->getUtilisateurById($id);
    }

    // Ajouter un nouvel utilisateur
    public function ajouterUtilisateur($data) {
        $this->utilisateurModele->addUtilisateur($data);
    }

    // Mettre à jour un utilisateur existant
    public function modifierUtilisateur($id, $data) {
        $this->utilisateurModele->updateUtilisateur($id, $data);
    }

    // Supprimer un utilisateur
    public function supprimerUtilisateur($id) {
        $this->utilisateurModele->deleteUtilisateur($id);
    }
}
?>
