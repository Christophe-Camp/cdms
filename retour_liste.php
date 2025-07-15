<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: retourner à la liste des artistes
// Paramètres: 

// Initialisations
include "library/init.php";

// afficher le nombre de nouveaux messages 
$nbNouveaux = 0;
if (connexionActive()) {
    $user = utilisateurConnecte();
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($user->id());
}

// Récupération de l'utilisateur connecté
$utilisateur = utilisateurConnecte();

// Détermination du type d'utilisateur (utile dans les vues)
if (!isset($estOrganisateur)) {
    $estOrganisateur = $utilisateur && $utilisateur->get("type_utilisateur") === "organisateur";
}

// Si aucun utilisateur connecté, redirection vers la page d'accueil
if (!$utilisateur->get("id")) {
    header("Location: accueil.php");
    exit;
}

// Récupération de la liste complète des artistes
$artiste = new artiste();
$liste_artistes = $artiste->list();

// Affichage de la page d'accueil avec la liste des artistes
include "templates/pages/liste_accueil.php";