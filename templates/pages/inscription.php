<?php
// Template de page: formulaire d'inscription
// Paramètres: email,mot de passe, type utilisateur 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" media="screen" href="css/styles.css" type="text/css">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <? include "templates/fragments/header_no_connecter.php";?>
    
    <div class="container mt-5">
        <h1 class="mb-4">S'inscrire</h1>

        <!-- Message d'erreur s'il l'email existe -->
        <?php if (!empty($_SESSION['erreur_inscription'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['erreur_inscription']) ?>
            </div>
            <?php unset($_SESSION['erreur_inscription']); ?>
        <?php endif; ?>

        <form method="post" action="enregistre_utilisateur.php" class="card p-4 shadow">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="type_utilisateur" class="form-label">Type d'utilisateur</label>
                <select name="type_utilisateur" id="type_utilisateur" class="form-select" required onchange="afficherFormulaireComplementaire()">
                <option value="">-- Choisir --</option>
                <option value="artiste">Artiste</option>
                <option value="organisateur">Organisateur</option>
                </select>
            </div>

            <!-- Formulaire artiste -->
            <?php include "templates/fragments/formulaire_artiste.php";?>
            
            <!-- Formulaire organisateur -->
            <?php include "templates/fragments/formulaire_organisateur.php";?>

                <div class="d-grid">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js" type="text/javascript" ></script>
</body>
</html>