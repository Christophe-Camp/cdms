<?php
// Template de page: formulaire pour modifier son profil
// Paramètres: id du profil connecter $_SESSION

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" media="screen" href="css/styles.css" type="text/css">
    <title>Modification de Profil</title>
</head>
<body>
    <?php include "templates/fragments/header_connecter.php"; ?>

    <div class="container my-5">
        <h1 class="mb-4">Mon Profil</h1>
        
        <form method="post" action="enregistre_modification.php" enctype="multipart/form-data" class="card p-4 shadow">

            <div class="mb-3">
                <label for="photo" class="form-label">Photo de profil</label><br>
                <?php if ($utilisateur->get('photo')) : ?>
                    <img src="uploads/<?= htmlspecialchars($utilisateur->get('photo')) ?>"
                        alt="Photo actuelle"
                        style="max-width:120px;border-radius:8px;margin-bottom:6px">
                <?php endif; ?>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($utilisateur->get('email')) ?>">
            </div>

            <div>
                <input type="checkbox" class="form-check-input" id="redirect_message" name="redirect_message" <?= $utilisateur->get('redirect_message') ? 'checked' : '' ?>>
                <label class="form-check-label" for="redirect_message">Recevoir mes messages par email</label>
            </div>

            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control">
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($utilisateur->get('prenom')) ?>">
            </div>

            <div class="mb-3">
                <label for="type_utilisateur" class="form-label">Type d'utilisateur</label>
                <select name="type_utilisateur" id="type_utilisateur" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="artiste" <?= $type_utilisateur === 'artiste' ? 'selected' : '' ?>>Artiste</option>
                    <option value="organisateur" <?= $type_utilisateur === 'organisateur' ? 'selected' : '' ?>>Organisateur</option>
                </select>
            </div>

            <!-- Les deux formulaires sont toujours inclus -->
            

            <?php if ($type_utilisateur === 'artiste' && isset($artiste)) : ?>
    <?php include "templates/fragments/formulaire_artiste_modification.php"; ?>
<?php endif; ?>

<?php if ($type_utilisateur === 'organisateur' && isset($organisateur)) : ?>
    <?php include "templates/fragments/formulaire_organisateur_modification.php"; ?>
<?php endif; ?>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- JS placé à la toute fin -->
    <script src="javascript/script.js" type="text/javascript"></script>
</body>
</html>