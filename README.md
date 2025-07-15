# 🎶 Concert dans mon salon

**Concert dans mon salon** est une application web qui permet aux organisateurs d'événements de découvrir des artistes locaux, consulter leurs prestations, et les contacter directement via une messagerie intégrée.

## 🛠️ Technologies utilisées

- PHP (backend)
- HTML5, CSS3, Bootstrap 5 (frontend)
- JavaScript
- MySQL 
- [Bootstrap Icons](https://icons.getbootstrap.com/) pour l'interface

## 📁 Structure du projet

/
├── css/
│ └── styles.css
├── document/
│ ├── mcd.jpg
│ └── schema d'ergonomie.jpg
├── javascript/
│ └── script.js
├── library/
│ ├── bdd.php
│ ├── init.php
│ └── session.php
├── modele/
│ ├── _model.php
│ ├── artiste.php
│ ├── message.php
│ ├── organisateur.php
│ └── utilisateur.php
├── templates/
│ ├── fragments/
│ │ ├── detail_message.php
│ │ ├── envoyer_message.php
│ │ ├── formulaire_artiste_modification.php
│ │ ├── formulaire_artiste.php
│ │ ├── formulaire_organisateur_modification.php
│ │ ├── formulaire_organisateur.php
│ │ ├── header_connecter.php
│ │ ├── header_no_connecter.php
│ │ ├── ligne_contact.php
│ │ └── liste_region.php
│ ├── pages/
│ │ ├── connexion.php
│ │ ├── inscription.php
│ │ ├── liste_accueil.php
│ │ ├── liste_message.php
│ │ ├── liste_utilisateur.php
│ │ ├── modifier_profil.php
│ │ └── rechercher.php
├── uploads/
├── accueil.php
├── archiver_conversation.php
├── deconnexion.php
├── enregistre_modification.php
├── enregistre_utilisateur.php
├── envoyer_message_ajax.php
├── formulaire_connexion.php
├── formulaire_inscription.php
├── formulaire_modification_profil.php
├── formulaire_rechercher.php
├── marquer_lus_ajax.php
├── messagerie.php
├── README.md
├── recupe_message_ajax.php
├── resultat_rechercher.php
├── retour_liste.php
└── validation_connexion.php


## ✨ Fonctionnalités

- 🔍 Affichage de la liste des **artistes** (nom de scène, type de musique, description, etc.)
- 💼 Affichage de la **prestation proposée** (région, prix, offre détaillée)
- 🧩 Affichage conditionnel d’un bouton **Contacter l’artiste** si l’utilisateur est connecté comme organisateur
- 🔄 Fonction "Voir plus" pour charger dynamiquement plus d’artistes ou de prestations
- 📬 Intégration d’un système de **messagerie interne** via `messagerie.php`
