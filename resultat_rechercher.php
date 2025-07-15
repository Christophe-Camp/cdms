<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: affiche les résultats de la recherche
// Paramètres: artiste, r&gion, type musique 

// Initialisations
include "library/init.php";

// afficher le nombre de nouveaux messages 
$nbNouveaux = 0;
if (connexionActive()) {
    $user = utilisateurConnecte();
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($user->id());
}

// Récupération des paramètres
$type = $_GET['type_musique'] ?? '';
$region = $_GET['region'] ?? '';
$nom = $_GET['nom_artiste'] ?? '';

// Instanciation de la classe artiste
$artiste = new artiste();

// Appel à la méthode recherche()
$resultats = $artiste->recherche($type, $region, $nom); 

// affichage des résultats de la recherche
include "templates/pages/rechercher.php";