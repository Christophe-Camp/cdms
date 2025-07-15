<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: Prépare l'affichage de la liste des artites et de leur prestation
// Paramètres: néant

// Initialisations
include "library/init.php";

// Initialisation des variables de contexte
$nbNouveaux = 0;
$estConnecte = connexionActive();
$utilisateur = utilisateurConnecte();
$estOrganisateur = false;

// Si l'utilisateur est connecté, on récupère ses informations
if ($estConnecte && $utilisateur) {
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($utilisateur->id());

    // Détermine si l'utilisateur est un organisateur
    $estOrganisateur = $utilisateur->get("type_utilisateur") === "organisateur";
}

// Récupération de la liste des artistes (toujours affichée)
$artiste = new artiste();
$liste_artistes = $artiste->list();

// Affichage de la page d'accueil avec le bon header dans le template
include "templates/pages/liste_accueil.php";