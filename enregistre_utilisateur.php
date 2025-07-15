<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: Enregistre un nouvel utilisateur
// Paramètres: nom, email, mot de passe, type utilisateur

// Initialisations
include "library/init.php";

// Si l'utilisateur est connecté, on récupère le nombre de nouveaux messages 
$nbNouveaux = 0;
if (connexionActive()) {
    $user = utilisateurConnecte();
    $messageObj = new message();
    $nbNouveaux = $messageObj->nbNouveauxMessages($user->id());
}

// Vérifie que les champs essentiels sont bien fournis
if (
    empty($_POST['email']) || 
    empty($_POST['mot_de_passe']) || 
    empty($_POST['type_utilisateur'])
) {
    die("Champs obligatoires manquants.");
}

$email = trim($_POST["email"]);

// Vérifie si l'utilisateur existe déjà 
$utilisateurExiste = new utilisateur();
if ($utilisateurExiste->loadFromField("email", $email)) {
    // On enregistre un message d'erreur temporaire en session
    $_SESSION['erreur_inscription'] = "Cette adresse email est déjà utilisée.";
    $_SESSION['formulaire_donnees'] = $_POST;
    header("Location: formulaire_inscription.php");
    exit;
}

// Création de l'objet utilisateur avec les données fournies
$utilisateur = new utilisateur();
$utilisateur->set("email", $_POST["email"]);
$utilisateur->set("mot_de_passe", password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT));
$utilisateur->set("type_utilisateur", $_POST["type_utilisateur"]);

// Facultatif si ces colonnes existent :
if (!empty($_POST["prenom"])) {
    $utilisateur->set("prenom", $_POST["prenom"]);
}

// Enregistre l'utilisateur dans la BDD
$utilisateur->update(); 

// Récupère l'ID généré automatiquement pour l'utilisateur
$id_utilisateur = $utilisateur->id(); 

// Selon le type d'utilisateur, on remplit la bonne table (organisateur ou artiste)
$type = $_POST["type_utilisateur"];

if ($type === "artiste") {
    $artiste = new artiste();
    $artiste->set("id", $id_utilisateur);  // associe l'id de l'utilisateur a l'artiste si selectionné
    $artiste->set("nom_de_scene", $_POST["nom_de_scene"] ?? '');
    $artiste->set("presentation_groupe", $_POST["presentation_groupe"] ?? '');
    $artiste->set("description_musique", $_POST["description_musique"] ?? '');
    $artiste->set("type_musique", $_POST["type_musique"] ?? '');
    $artiste->set("description_offre", $_POST["description_offre"] ?? '');
    $artiste->set("region", $_POST["region_artiste"] ?? '');
    $prix = isset($_POST["prix"]) && is_numeric($_POST["prix"]) ? (int) $_POST["prix"] : 0;
    $artiste->set("prix", $prix);
    $artiste->update();

} elseif ($type === "organisateur") {
    $orga = new organisateur();
    $orga->set("id", $id_utilisateur); // associe l'id de l'utilisateur a l'organisateur si selectionné
    $orga->set("prenom", $_POST["prenom"] ?? '');
    $orga->set("region", $_POST["region_organisateur"] ?? '');
    $orga->set("description_lieu", $_POST["description_lieu"] ?? '');
    $orga->update();
}

// Si l'enregistrement a réussi, on connecte automatiquement l'utilisateur
if ($id_utilisateur) {
    connecter($utilisateur);
    header("Location: accueil.php");// Redirection vers la page d'accueil
    exit;
} else {
    die("Erreur lors de l'enregistrement de l'utilisateur.");
}