<?php
// librairie: fonction de gestion de la session utililsateur

    // Connecter un utilisateur: connecter
    // savoir si un utilisateur est connecté: connexionActive
    // Recupére l'utilisateur connecté: utilisateurConnecte
    // Deconnecter un utilisateur connecté: deconnecter
    // Vérifier les codes de connexion: verifierIdentifiants
    

    function connecter($utilisateur) {
        $_SESSION['utilisateur'] = [
            'id' => $utilisateur->get('id'),
            'activ' => true,
            'last_activity' => time()
        ];
    }

    function connexionActive($timeout = 3600) {
        if (!isset($_SESSION['utilisateur']) || !$_SESSION['utilisateur']['activ']) return false;
        if (time() - $_SESSION['utilisateur']['last_activity'] > $timeout) {
            deconnecter();
            return false;
        }
        // Mettre à jour le temps de la dernière activité
        $_SESSION['utilisateur']['last_activity'] = time();
        return true;
    }

    function utilisateurConnecte() {
        if (connexionActive()){
            return new utilisateur($_SESSION['utilisateur']['id']);
        }
        return new utilisateur();
    }

    function deconnecter() {
        unset($_SESSION['utilisateur']);
    }

    function verifierIdentifiants($email, $mot_de_passe) {
        $utilisateur = new utilisateur();
        if (!$utilisateur->loadByEmail($email)) {
            return false;
        }

        if ($mot_de_passe === $utilisateur->get("mot_de_passe")) {
        return $utilisateur;
        }

        return false;
    } 