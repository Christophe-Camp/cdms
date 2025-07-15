<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: prépare la liste des contacts et des messages
// Paramètres: contact (dans l'URL)

// Initialisations
include "library/init.php";

// Vérifie si l'utilisateur est connecté
if (!connexionActive()) {
    header("Location: formulaire_connexion.php");
    exit;
}

// Récupération des informations de l'utilisateur connecté
$utilisateurConnecte = utilisateurConnecte();
$monId = $utilisateurConnecte->id();
$monType = $utilisateurConnecte->get("type_utilisateur");

// Récupère l'ID du contact à charger si présent dans l'URL
$id_contact = isset($_GET["contact"]) ? intval($_GET["contact"]) : null;

// Instancie la classe message
$messageObj = new message();

// Si un contact est spécifié, on sécurise l'accès
if ($id_contact !== null) {
    // Chargement de l'utilisateur cible
    $utilisateurCible = new utilisateur($id_contact);
    
    // Vérifie que l'utilisateur existe
    if (!$utilisateurCible->get("id")) {
        die("Utilisateur cible introuvable.");
    }

    // Vérifie que les types d'utilisateur sont différents (artiste <-> organisateur)
    $typeContact = $utilisateurCible->get("type_utilisateur");
    if ($typeContact === $monType) {
        die("Vous ne pouvez pas contacter un utilisateur du même type.");
    }

    // Marquer les messages comme lus pour cette conversation
    $messageObj->marquerCommeLus($monId, $id_contact);
}

// Récupérer les utilisateurs avec qui on a échangé des messages
$tous_les_contacts = $messageObj->listeContacts($monId);

$liste_utilisateur = []; // Actifs
$utilisateurs_archives = []; // Archivés

// Parcours de tous les contacts pour savoir sur qu'elle liste on le met 
foreach ($tous_les_contacts as $id => $utilisateur) {
    if (!empty($utilisateur->get("archive"))) {
        $utilisateurs_archives[$id] = $utilisateur;
    } else {
        $liste_utilisateur[$id] = $utilisateur;
    }
}

// Si le contact n’a jamais eu de messages, on l’ajoute (dans le cas où la sécurité plus haut a validé)
if ($id_contact && !array_key_exists($id_contact, $liste_utilisateur)) {
    $liste_utilisateur[$id_contact] = $utilisateurCible;
}

// Nombre total de nouveaux messages (mis à jour après marquage)
$nbNouveaux = $messageObj->nbNouveauxMessages($monId);

// Préparer un tableau avec le nombre de messages non lus par contact (mis à jour)
$nbNonLusParContact = [];
foreach ($liste_utilisateur as $id => $utilisateur) {
    $nbNonLusParContact[$id] = $messageObj->nbNouveauxMessagesParContact($monId, $id);
}

// Affiche la messagerie avec la liste des utilisateurs
include "templates/pages/liste_utilisateur.php";