<?php
// Contrôleur (ne peut être utilisé que comme URL, appelé en AJAX)
// Rôle : Enregistre un nouveau message dans la base de données via une requête AJAX
// Paramètres POST attendus :
// - id_destinataire : ID de l'utilisateur à qui le message est adressé
// - contenu_message : contenu textuel du message

// Initialisations
include "library/init.php";

// Vérification que l'utilisateur est connecté
if (!connexionActive()) {
    exit("Non autorisé");
}

// Récupération de l'expéditeur (utilisateur connecté)
$expediteur = utilisateurConnecte();
$idExpediteur = $expediteur->id();
$typeExpediteur = $expediteur->get("type_utilisateur");

// Sécurisation et validation des données reçues
$idDestinataire = intval($_POST["id_destinataire"] ?? 0);
$contenu = trim($_POST["contenu_message"] ?? '');

if (!$idDestinataire || $contenu === '') {
    exit("Paramètres invalides.");
}

// création du message
$message = new message();
$message->set("contenu_message", $contenu);
$message->set("date_envoi", date("Y-m-d H:i:s"));
$message->set("archive", 0);

// Détection du rôle et attribution des bons champs
if ($typeExpediteur === "organisateur") {
    $message->set("organisateur", $idExpediteur);
    $message->set("artiste", $idDestinataire);
    $message->set("lu_artiste", 0);         // Non lu par l'artiste
    $message->set("lu_organisateur", 1);    // Lu par l'organisateur (expéditeur)
} else {
    $message->set("organisateur", $idDestinataire);
    $message->set("artiste", $idExpediteur);
    $message->set("lu_artiste", 1);         // Lu par l'artiste (expéditeur)
    $message->set("lu_organisateur", 0);    // Non lu par l'organisateur
}

// Enregistrement du message
if ($message->update()) {
    //  Récupérer le destinataire 
    $destinataire = new utilisateur();
    $destinataire->load($idDestinataire);

    //  Si l'utilisateur veut recevoir ses messages par email
    if ($destinataire->get('redirect_message')) {
        $email = $destinataire->get('email');
        $sujet = "Nouveau message reçu sur la plateforme";
        $corps = "Bonjour,\n\nVous avez reçu un nouveau message de la part d'un organisateur.\n\n";
        $corps .= "Contenu du message :\n\n" . $contenu . "\n\n";
        $corps .= "Connectez-vous pour répondre.\n\n---\nPlateforme Musicale";

        // Envoi de l'email (à adapter selon config serveur)
        mail($email, $sujet, $corps, "From: no-reply@cdms.com");
    }

    echo "OK";
} else {
    echo "Erreur à l'enregistrement";
}