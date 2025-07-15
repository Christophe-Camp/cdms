<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: enregistre les modification du profil utilisateur 
// Paramètres: tous les champs du formulaire 

// Initialisations
include "library/init.php";

// Vérifie que l'utilisateur est connecté
$utilisateur = utilisateurConnecte();
if (!$utilisateur || !$utilisateur->get("id")) {
    die("Utilisateur non connecté");
}

// gestion de l'upload de la photo
$dossier = "uploads/";
if (!file_exists($dossier)) {
    mkdir($dossier, 0777, true); // Crée le dossier s'il n'existe pas
}

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $tmpName     = $_FILES['photo']['tmp_name'];
    $nomOriginal = basename($_FILES['photo']['name']);
    $ext         = strtolower(pathinfo($nomOriginal, PATHINFO_EXTENSION));
    $autorise    = ['jpg','jpeg','png','gif'];

    if (in_array($ext, $autorise)) {
        $nouveauNom = uniqid('photo_') . '.' . $ext;
        $dest       = $dossier . $nouveauNom;

        if (move_uploaded_file($tmpName, $dest)) {
            // Supprime l’ancienne photo si elle existe
            $ancienne = $utilisateur->get('photo');
            if ($ancienne && file_exists($dossier.$ancienne)) {
                unlink($dossier.$ancienne);
            }
            // Enregistre le nouveau nom en BDD
            $utilisateur->set('photo', $nouveauNom);
        }
    }
}


// MAJ utilisateur
$utilisateur->set("email", $_POST["email"]);
$utilisateur->set("redirect_message", isset($_POST["redirect_message"]) ? 1 : 0);
$utilisateur->set("prenom", $_POST["prenom"]);
$utilisateur->set("type_utilisateur", $_POST["type_utilisateur"]);

// Mise à jour du mot de passe s’il est renseigné
if (!empty($_POST["mot_de_passe"])) {
    $mot_de_passe_hash = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
    $utilisateur->set("mot_de_passe", $mot_de_passe_hash);
}

// Enregistre les changements de l'utilisateur en base
$utilisateur->update();

// MAJ selon le type utilisateur
$type = $_POST["type_utilisateur"];
$id = $utilisateur->id();

if ($type === "artiste") {
    $artiste = new artiste();
    $artiste->loadByUtilisateur($id); // Charge les données existantes

    // Mise à jour des champs spécifiques à l'artiste
    $artiste->set("nom_de_scene", $_POST["nom_de_scene"] ?? '');
    $artiste->set("presentation_groupe", $_POST["presentation_groupe"] ?? '');
    $artiste->set("description_musique", $_POST["description_musique"] ?? '');
    $artiste->set("type_musique", $_POST["type_musique"] ?? '');
    $artiste->set("description_offre", $_POST["description_offre"] ?? '');
    $artiste->set("region", $_POST["region_artiste"] ?? '');
    $artiste->set("prix", $_POST["prix"] ?? 0);
    $artiste->update();

} elseif ($type === "organisateur") {
    $orga = new organisateur();
    $orga->loadByUtilisateur($id);// Charge les données existantes

    // Mise à jour des champs spécifiques à l'organisateur
    $orga->set("prenom", $_POST["prenom"] ?? '');
    $orga->set("region", $_POST["region_organisateur"] ?? '');
    $orga->set("description_lieu", $_POST["description_lieu"] ?? '');
    $orga->update();
}

// Redirection vers la page d'accueil
header("Location: accueil.php");
exit;