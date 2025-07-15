<?php

class utilisateur extends _model  {

    protected $table = "utilisateur";
    protected $champs = ["email", "mot_de_passe", "prenom", "type_utilisateur", "redirect_message", "photo"];

    // Charge un utilisateur à partir de son adresse email
    function loadByEmail($email) {

        $sql = "SELECT * FROM `{$this->table}` WHERE email = :email LIMIT 1";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ligne) {
            $this->valeurs = [];
            $this->id = null;
            return false;
        }

        $this->loadFromTab($ligne);
        $this->id = $ligne["id"];
        return true;
    }

    // Vérifie que l'identifiant et le mot de passe sont valides
    function verifierLogin($email, $mot_de_passe) {
        if (!$this->loadByEmail($email)) {
            return false;
        }
        // pour verifier un mot de passe hashés
        if (password_verify($mot_de_passe, $this->get("mot_de_passe"))) {
            return true;
        }
        return false;
    }  
    
    // Définit une valeur manuellement pour un champ de l'utilisateur
    // pour faire la liste des conversation archivé
    function set($champ, $valeur) {
        $this->valeurs[$champ] = $valeur;
    }
}