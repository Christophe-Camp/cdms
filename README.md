## 🎶 Concert dans mon salon
Concert dans mon salon est une plateforme web qui facilite l'organisation de concerts privés en mettant en relation des artistes avec des organisateurs particuliers ou professionnels.
L’objectif est de diffuser la musique vivante dans des lieux intimes, comme les salons, jardins ou locaux d’entreprise, en dehors des circuits traditionnels.


##  Objectif
Cette plateforme vise à :
Valoriser les artistes locaux en leur offrant plus de visibilité.
Permettre aux particuliers ou entreprises d’organiser des concerts chez eux facilement.
Centraliser les échanges grâce à un système de messagerie intégré.


##  Fonctionnalités principales
👤 Utilisateurs
Création de comptes pour artistes et organisateurs.
Les profils artistes sont publics, ceux des organisateurs sont confidentiels (accessibles uniquement aux artistes qu'ils contactent).

📋 Artistes
Présentation libre : nom de scène, style de musique, présentation du groupe, offre de prestation, régions couvertes, prix.
Visualisation publique de toutes les fiches artistes.

🔍 Recherche
Recherche d’artistes par type de musique et région.

💬 Messagerie
Envoi de messages via une messagerie interne.
Mise à jour automatique des nouveaux messages.
Notifications dynamiques : compteur de messages non lus dans l’entête + changement d’onglet si nouveaux messages.
Archivage des conversations.

⚙️ Gestion du profil
Modification du profil.
Possibilité d’ajouter une adresse mail pour recevoir les messages par email.


##  Technologies utilisées

Backend	PHP
Frontend	HTML5, CSS3, Bootstrap 5
Dynamique	JavaScript
Base de données	MySQL
UI Icons	Bootstrap Icons


##  Structure du projet

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


##  Fonctionnalités techniques détaillées

 Chargement dynamique des listes d'artistes ("Voir plus")
 Affichage conditionnel des boutons selon le rôle de l'utilisateur
 Messagerie AJAX : envoi et réception sans rechargement
 Système de notification automatique dans l'entête + favicon/onglet
 Sécurité : gestion de sessions, distinction entre rôles utilisateur


##  Cahier des charges (résumé)

Le projet a été développé pour une start-up visant à favoriser les concerts privés.
Le site est une première version web, une application mobile est prévue en second temps.
Artistes : création de profil public avec description libre
Organisateurs : création de profil privé visible uniquement aux artistes contactés
Recherche d’artistes par ville/type
Messagerie intégrée, notifications en direct, archivage des conversations
Notifications par mail (optionnel)
Notifications dynamiques dans l’interface utilisateur


## ✅ État d'avancement

 Création d'un compte artiste/organisateur
 Liste et recherche d’artistes
 Envoi de messages via messagerie
 Notification de messages non lus
 Archivage des conversations
 Interface responsive avec Bootstrap


##  Propositions d’évolutions

Application mobile (iOS/Android)
Évaluation et avis sur les artistes
Système de réservation/calendrier
Upload de morceaux ou extraits musicaux
Revoir l'écran d'accueil qui n'est pas très intuitif

Déploiement Le site est disponible en ligne ici : https://cdms-chca.play.mywebecom.ovh/accueil.php


git https://github.com/Christophe-Camp/cdms
Auteurs 👤 Christophe-Camp