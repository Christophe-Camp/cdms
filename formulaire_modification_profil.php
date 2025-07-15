<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: affiche le formulaire pour modifier le profil utilisateur
// Paramètres: email, mot de passe, nom, ..

// initialisations
include "library/init.php";

// Charger l'utilisateur connecté
$utilisateur = utilisateurConnecte();

// Si non connecté, rediriger vers la page de connexion
if (!$utilisateur->get('id')) {
    header("Location: formulaire_connexion.php");
    exit;
}

// Récupération du type d'utilisateur ("artiste" ou "organisateur")
$type_utilisateur = $utilisateur->get('type_utilisateur');

// Charger les données spécifiques selon son type d'utilisateur
$artiste = null;
$organisateur = null;
$id_utilisateur = $utilisateur->get("id"); 

if ($type_utilisateur === "artiste") {
    $artiste = new artiste();
    $artiste->loadByUtilisateur($id_utilisateur);
} elseif ($type_utilisateur === "organisateur") {
    $organisateur = new organisateur();
    $organisateur->loadByUtilisateur($id_utilisateur);
}

// afficher le nombre de nouveaux messages 
$nbNouveaux = 0;
if (connexionActive()) {
    $user = utilisateurConnecte();
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($user->id());
}

// affichage du formulaire de modification de profil
include "templates/pages/modifier_profil.php";