<?php
// Controleur (ne peut être utilisé que comme URL)
// Rôle: mettre fin a la session 
// Paramètres: neant

// Initialisations
include "library/init.php";

// Déconnecter l'utilisateur
deconnecter();

// affichage de la page d'accueil
include "templates/pages/connexion.php";