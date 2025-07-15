<?php
include "library/init.php";

if (!connexionActive()) {
    exit("Non autorisé.");
}

$utilisateurConnecte = utilisateurConnecte();
$monId = $utilisateurConnecte->id();

$id_contact = isset($_POST['id_contact']) ? intval($_POST['id_contact']) : null;

if (!$id_contact) {
    exit("ID manquant");
}

$messageObj = new message();
$messageObj->marquerCommeLus($monId, $id_contact);

echo "OK";