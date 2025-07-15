<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: vérifie si les identifiants sont correcte si ok connexion réussi on affiche la liste des artiste si non on affiche le formulaire 
// Paramètres: $email, $mot_de_passe

// Initialisations
include "library/init.php";

// Récupération des données du formulaire
if (isset($_POST["email"])){
    $email = $_POST["email"];
}else{
    $email = "";
}

if (isset($_POST["mot_de_passe"])){
    $mot_de_passe = $_POST["mot_de_passe"];
}else {
    $mot_de_passe = "";
}

// Vérifie que les champs sont bien remplis
if (empty($email) || empty($mot_de_passe)) {
    echo "Champs manquants";
    include "templates/pages/connexion.php";
    exit;
}

// Instanciation de l'utilisateur
$utilisateur = new utilisateur();

// Vérification des identifiants via la méthode de la classe
if (!$utilisateur->verifierLogin($email, $mot_de_passe)) {
    echo "Erreur d'authentification";
    include "templates/pages/connexion.php";
    exit;
}

// Connexion de l'utilisateur (sauvegarde en session)
connecter($utilisateur);

// Déterminer si l'utilisateur est un organisateur (utile dans les vues)
if (!isset($estOrganisateur)) {
    $estOrganisateur = $utilisateur && $utilisateur->get("type_utilisateur") === "organisateur";
}

// Récupération de la liste des artistes pour affichage dans la page d'accueil
$artiste = new artiste();
$liste_artistes = $artiste->list();

// afficher le nombre de nouveaux messages 
$nbNouveaux = 0;
if (connexionActive()) {
    $user = utilisateurConnecte();
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($user->id());
}

// Afficher la page d'accueil avec la liste des artistes 
include "templates/pages/liste_accueil.php";