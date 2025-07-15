<?php
// Template de page: afficher la liste des messages
// Paramètres: 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="css/styles.css" type="text/css">
</head>
<body>
    <div class="container my-5">
        <div id="listeMessage">
            <?php include "templates/fragments/detail_message.php"; ?>
        </div>

        <div id="message">
            <?php include "templates/fragments/envoyer_message.php"; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js" type="text/javascript"></script>
</body>
</html>