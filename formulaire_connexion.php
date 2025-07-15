<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: prépare l'affichage du formulaire de connexion
// Paramètres: néant

// Initialisations
include "library/init.php";

// Vérifie si un utilisateur est déjà connecté
$utilisateur = utilisateurConnecte();

if ($utilisateur->get('id')) {
    // Il est connecté → on affiche directement la liste
    $artiste = new artiste();
    $liste_artistes = $artiste->list();

    include "templates/pages/liste_accueil.php";
    exit;
}

// Si, l'utilisateur n'est pas connecté : affichage du formulaire de connexion
include "templates/pages/connexion.php";