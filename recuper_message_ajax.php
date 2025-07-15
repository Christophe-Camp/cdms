<?php
// Controleur pour AJAX
// Rôle: affiche les messages d'une conversation
// Paramètres: id_conversation

// Initialisations
include "library/init.php";

// Vérifie que l'utilisateur est connecté
if (!connexionActive()) {
    exit("Non autorisé");
}

// Récupère l'ID de l'utilisateur connecté
$monId = utilisateurConnecte()->id();

// Récupère l'ID du contact
$contactId = intval($_GET["id"] ?? 0);

// Vérifie que l'ID du contact est valide (non nul)
if (!$contactId) {
    exit("Contact invalide.");
}

// Instanciation de la classe message
$messageObj = new message();

// Met à jour la base : récupère le dernier message échangé
$messageObj->dernierMessage($monId, $contactId);

// marquer les messages reçus du contact comme lus
$messageObj->marquerCommeLus($monId, $contactId);

// Charger les messages 
$messages = $messageObj->chargerConversation($monId, $contactId);

// Charger les infos du contact (affichage)
$contact = new utilisateur($contactId);

// Affichage les messages de la conversation
include "templates/fragments/detail_message.php";