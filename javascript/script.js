document.addEventListener("DOMContentLoaded", function () {
    // Récupère la liste déroulante du type d'utilisateur
    const selectType = document.getElementById("type_utilisateur");

    // Si elle existe, on ajoute un écouteur sur le changement de valeur
    if (selectType) {
        selectType.addEventListener("change", afficherFormulaireComplementaire);
    }

    // Affiche directement le bon formulaire selon la valeur déjà sélectionnée
    afficherFormulaireComplementaire();
});

// Variables globales
let id_contact_en_cours = null;
let intervalMessages = null;

//-------------------------------------------------------------
// Affiche le détail de la conversation avec un contact donné 
//-------------------------------------------------------------
function demandeDetail(id) {
    id_contact_en_cours = id;

    // Marquer comme lus via AJAX
    fetch('marquer_lus_ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_contact=${encodeURIComponent(id)}`
    })
    .then(response => response.text())
    .then(result => {
        if (result === "OK") {
            // Supprimer le badge rouge si présent
            const contactItem = document.querySelector(`.list-group-item div[onclick="demandeDetail(${id})"]`);
            if (contactItem) {
                const badge = contactItem.querySelector(".badge.bg-danger");
                if (badge) {
                    badge.remove();
                }
            }
        }
    });

    // Rafraîchir les messages tout de suite
    rafraichirMessages(id);

    // Cache le message "choisissez un contact"
    const placeholder = document.getElementById("detail-placeholder");
    if (placeholder) placeholder.style.display = "none";

    // Affiche le formulaire de détail (en bas)
    const formDiv = document.getElementById("detail-form");
    if (formDiv) formDiv.style.display = "block";

    // Arrête le rafraîchissement précédent s’il existe
    if (intervalMessages !== null) {
        clearInterval(intervalMessages);
    }

    // Démarre le rafraîchissement auto toutes les 3 secondes
    intervalMessages = setInterval(() => {
        rafraichirMessages(id_contact_en_cours);
    }, 3000);
}

//-----------------------------------------------------
// Rafraîchit les messages de la conversation en cours
//-----------------------------------------------------
function rafraichirMessages(contactId, autoScroll = true) {
    if (!contactId) return;

    // Met à jour le champ caché pour l'envoi du message
    const champDest = document.getElementById("id_destinataire");
    if (champDest) champDest.value = contactId;

    // Récupère les messages du serveur et les insère dans le DOM
    fetch(`recuper_message_ajax.php?id=${contactId}`)
        .then(response => response.text())
        .then(html => {
           afficherMessage(html);
        })
        .catch(error => {
            console.error("Erreur lors du rafraîchissement :", error);
        });
}

//------------------------------------------------------------
// Affiche dans la zone de message le contenu HTML reçu
//------------------------------------------------------------
function afficherMessage(fragment) {
    // Rôle : remplace le contenu de la div #detail-messages avec le HTML donné
    // Paramètre : 
    //    fragment : le code HTML à afficher (représentant les messages)
    // Retour : néant

    const zoneMessages = document.getElementById("detail-messages");
    if (zoneMessages) {
        zoneMessages.innerHTML = fragment;
        // scroll automatique en bas
        zoneMessages.scrollTop = zoneMessages.scrollHeight;
    }
}

//-----------------------------------------------------------
// Envoie un message via AJAX
//-----------------------------------------------------------
function envoyerMessage(event) {
    event.preventDefault();

    const idDestinataire = document.getElementById("id_destinataire")?.value;
    const champContenu = document.getElementById("contenu_message");
    const contenu = champContenu?.value.trim();

    // Vérifie que les champs sont remplis
    if (!idDestinataire || !contenu) {
        alert("Veuillez entrer un message.");
        return;
    }

    // Prépare les données à envoyer
    const formData = new FormData();
    formData.append("id_destinataire", idDestinataire);
    formData.append("contenu_message", contenu);

    // Envoie du message en AJAX
    fetch("envoyer_message_ajax.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        if (text === "OK") {
            champContenu.value = "";

            // Recharge les messages
            rafraichirMessages(idDestinataire); 

            // Scrolle en bas de la liste des messages
            setTimeout(() => {
                const messagesContainer = document.getElementById("detail-messages");
                if (messagesContainer) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            }, 200);
        } else {
            alert("Erreur : " + text);
        }
    })
    .catch(error => {
        console.error("Erreur AJAX :", error);
        alert("Erreur lors de l'envoi du message.");
    });
}

//-----------------------------------------------------
// Affiche dynamiquement le formulaire complémentaire 
// selon le type d'utilisateur sélectionné
//-----------------------------------------------------
function afficherFormulaireComplementaire() {
    const select = document.getElementById("type_utilisateur");
    const type = select ? select.value : null;

    const formArtiste = document.getElementById("formulaire_artiste");
    const formOrga = document.getElementById("formulaire_organisateur");

    // Cache tous les formulaires d’abord
    if (formArtiste) formArtiste.style.display = "none";
    if (formOrga) formOrga.style.display = "none";

    // Affiche uniquement celui qui correspond au type choisi
    if (type === "artiste" && formArtiste) {
        formArtiste.style.display = "block";
    } else if (type === "organisateur" && formOrga) {
        formOrga.style.display = "block";
    }
}

//------------------------------------------------------------
// Affiche/masque les artistes supplémentaires dans une liste
//------------------------------------------------------------
function toggleArtistes() {
    // Bascule la visibilité des éléments supplémentaires
    document.querySelectorAll('.extra-artiste').forEach(el => el.classList.toggle('d-none'));

    // Modifie le texte du bouton
    const btn = document.activeElement;
    btn.textContent = btn.textContent === "Voir plus" ? "Voir moins" : "Voir plus";
}

//------------------------------------------------------------
// Affiche/masque les prestations supplémentaires dans une liste
//------------------------------------------------------------
function togglePrestations() {
    // Bascule la visibilité des éléments supplémentaires
    document.querySelectorAll('.extra-prestation').forEach(el => el.classList.toggle('d-none'));

    // Modifie le texte du bouton
    const btn = document.activeElement;
    btn.textContent = btn.textContent === "Voir plus" ? "Voir moins" : "Voir plus";
}