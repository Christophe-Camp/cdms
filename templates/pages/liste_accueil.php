<?php
// Template de page: affiche la liste des artistes et de leurs prestations (non connecté)
// Paramètres: liste_artistes

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" media="screen" href="css/styles.css" type="text/css">
    <title>Concert dans mon salon</title>
</head>
<body>
    <?php
        $utilisateur = utilisateurConnecte();
        if ($utilisateur->get('id')) {
            include "templates/fragments/header_connecter.php";
        } else {
            include "templates/fragments/header_no_connecter.php";
        }
    ?>
    <h3 class="container my-4">Artistes</h3>
    <div class="container">
        <?php if (!empty($liste_artistes) && is_array($liste_artistes)) : ?>
            <?php foreach ($liste_artistes as $index => $artistes) : ?>
                <div class="row mb-3 <?= $index >= 4 ? 'd-none extra-artiste' : '' ?>">
                    <div class="card text-white bg-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Nom de l'artiste : <?= htmlspecialchars($artistes->get("nom_de_scene")) ?></h5>
                            <p class="card-text"><strong>Description musique :</strong> <?= htmlspecialchars($artistes->get("description_musique")) ?></p>
                            <p class="card-text"><strong>Type de musique :</strong> <?= htmlspecialchars($artistes->get("type_musique")) ?></p>
                            <?php if ($estOrganisateur): ?>
                                <form method="GET" action="messagerie.php">
                                    <input type="hidden" name="contact" value="<?= $artistes->id() ?>">
                                    <button type="submit" class="btn btn-light btn-sm">
                                        <i class="bi bi-chat-dots"></i> Contacter cet artiste
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (count($liste_artistes) > 4): ?>
                <div class="text-center my-3">
                    <button class="btn btn-outline-primary" onclick="toggleArtistes()">Voir plus</button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <h3 class="container my-4">Prestations</h3>
    <div class="container">
        <?php if (!empty($liste_artistes) && is_array($liste_artistes)) : ?>
            <?php foreach ($liste_artistes as $index => $artistes) : ?>
                <div class="row mb-3 <?= $index >= 4 ? 'd-none extra-prestation' : '' ?>">
                    <div class="card text-black shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Offre : <?= htmlspecialchars($artistes->get("description_offre")) ?></h5>
                            <p class="card-text"><strong>Région :</strong> <?= htmlspecialchars($artistes->get("region")) ?></p>
                            <p class="card-text"><strong>Prix :</strong> <?= htmlspecialchars($artistes->get("prix")) ?></p>
                            <?php if ($estOrganisateur): ?>
                                <form method="GET" action="messagerie.php">
                                    <input type="hidden" name="contact" value="<?= $artistes->id() ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-chat-dots"></i> Contacter cet artiste
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (count($liste_artistes) > 4): ?>
                <div class="text-center my-3">
                    <button class="btn btn-outline-secondary" onclick="togglePrestations()">Voir plus</button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script src="javascript/script.js" type="text/javascript" ></script>
</body>
</html>