<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: archiver une conversation dans la messagerie 
// Paramètres: 

// Initialisations
include "library/init.php";

// Récupération de l'ID de l'utilisateur connecté
$monId = utilisateurConnecte()->id();

// Sécurisation et récupération de l'ID du contact depuis le POST
$idContact = intval($_POST["id_utilisateur"] ?? 0);

// Instanciation de la classe de gestion des messages
$messageObj = new Message();


// Vérifie que les deux IDs sont valides avant d'archiver
if ($monId && $idContact) {
    // Archive la conversation entre l'utilisateur connecté et le contact
    $messageObj->archiveMessage($monId, $idContact); 
}

// Redirection vers la messagerie
header("Location: messagerie.php");
exit;