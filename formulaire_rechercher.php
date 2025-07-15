<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: afficher le formulaire de recherche
// Paramètres: néant

// Initialisations
include "library/init.php";

// Initialisation d'un tableau vide pour les résultats de recherche
$resultats = [];

// afficher le nombre de nouveaux messages 
$nbNouveaux = 0;
if (connexionActive()) {
    $user = utilisateurConnecte();
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($user->id());
}

// Affichage du formulaire de recherche
include "templates/pages/rechercher.php";