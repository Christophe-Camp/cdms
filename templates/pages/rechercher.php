<?php
// Template de page: formulaire de recherche
// Paramètres: type_musique, région, artiste

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" media="screen" href="css/styles.css" type="text/css">
    <title>Rechercher</title>
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

    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">🔍 Rechercher un artiste</h3>
                <form method="get" action="resultat_rechercher.php">
                    <div class="mb-3">
                        <label for="type_musique" class="form-label">🎶 Type de musique</label>
                        <input type="text" name="type_musique" class="form-control" id="type_musique" placeholder="ex : Jazz, Rock, Electro...">
                    </div>
                    <div class="mb-3">
                        <label for="region" class="form-label">📍 Région</label>
                        <?php include "templates/fragments/liste_region.php"; ?>
                    </div>
                    <div class="mb-3">
                        <label for="nom_artiste" class="form-label">🎤 Nom de l'artiste</label>
                        <input type="text" name="nom_artiste" class="form-control" id="nom_artiste" placeholder="Nom de scène">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($resultats)) : ?>
        <div class="container mt-5">
            <h3>Résultats</h3>
            <?php if (empty($resultats)) : ?>
                <div class="alert alert-warning">Aucun artiste trouvé.</div>
            <?php else : ?>
                <ul class="list-group">
                    <?php foreach ($resultats as $art) : ?>
                        <li class="list-group-item">
                            <strong>🎤 Artiste :</strong> <?= htmlspecialchars($art->get('nom_de_scene') ?? '') ?><br>
                            <strong>🎶 Type :</strong> <?= htmlspecialchars($art->get('type_musique') ?? '') ?><br>
                            <strong>📍 Région :</strong> <?= htmlspecialchars($art->get('region') ?? '') ?>

                            <?php
                                $utilisateur = utilisateurConnecte();
                                $estOrganisateur = $utilisateur && $utilisateur->get("type_utilisateur") === "organisateur";
                            ?>

                            <?php if ($estOrganisateur): ?>
                                <form method="GET" action="messagerie.php" class="mt-2">
                                    <input type="hidden" name="contact" value="<?= $art->id() ?>">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-chat-dots"></i> Contacter cet artiste
                                    </button>
                                </form>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>