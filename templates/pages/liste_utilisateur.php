<?php
// Template de page: afficher la liste des contacts et des messages
// Paramètres: utilisateur, dernier message

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" media="screen" href="css/styles.css" type="text/css">
    <title>Messagerie</title>
</head>
<body>
    <? include "templates/fragments/header_connecter.php";?>
    <?php if (isset($_GET["contact"])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            demandeDetail(<?= intval($_GET["contact"]) ?>);
        });
    </script>
<?php endif; ?>

    <div class="container-fluid my-4" style="height: 100vh;">
        <div class="row h-100">
            <!-- Liste des contacts -->
            <div class="col-md-4 border-end" id="liste">
                <h3 class="mb-4">Liste des contacts</h3>
                <div class="list-group">
                    <?php foreach($liste_utilisateur as $id => $utilisateur): ?>
                        <?php $dernier = $messageObj->dernierMessage($monId, $id); ?>
                        <?php include "templates/fragments/ligne_contact.php"; ?>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($utilisateurs_archives)): ?>
                    <h4 class="mb-3 text-muted">Messages archivés</h4>
                    <div class="list-group">
                        <?php foreach($utilisateurs_archives as $id => $utilisateur): ?>
                        <?php $dernier = $messageObj->dernierMessage($monId, $id); ?>
                        <?php include "templates/fragments/ligne_contact.php"; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Détail des messages -->
            <div class="col-md-8 d-flex flex-column" id="detail">
                <!-- Zone de conversation affichée dynamiquement -->
                <h3 class="mb-4">Conversation</h3>
                <div id="detail-messages" class="overflow-auto mb-3 p-3" style="max-height: 400px;">
                    <!-- Les messages seront injectés ici -->
                </div>
                <div id="detail-form">
                    <!-- Le formulaire de réponse reste ici, jamais remplacé -->
                    <form id="form-message" onsubmit="envoyerMessage(event)">
                        <input type="hidden" id="id_destinataire" value="...">
                        <div class="mb-3">
                            <label for="contenu_message" class="form-label">Votre message</label>
                            <input type="text" class="form-control" id="contenu_message" name="contenu_message" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>

                <div class="text-muted text-center py-5" id="detail-placeholder">
                    <i class="bi bi-chat-dots fs-1"></i>
                    <p class="mt-3">Sélectionnez un contact pour voir la conversation</p>
                </div>
            </div>
        </div>
    </div>
    <script src="javascript/script.js" type="text/javascript" ></script>
</body>
</html>