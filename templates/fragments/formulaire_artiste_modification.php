<?php
    // Template de fragment: formulaire modification pour les artistes 
?>
<?php if (!isset($artiste)) return; ?>
<div id="formulaire_artiste" style="display: none;">
    <div class="mb-3">
        <label for="nom_de_scene" class="form-label">Nom de scène</label>
        <input type="text" name="nom_de_scene" id="nom_de_scene" class="form-control"
               value="<?= isset($artiste) ? htmlspecialchars($artiste->get('nom_de_scene')) : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Présentation du groupe</label>
        <input type="text" name="presentation_groupe" class="form-control"
               value="<?= isset($artiste) ? htmlspecialchars($artiste->get('presentation_groupe')) : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Description musique</label>
        <input type="text" name="description_musique" class="form-control"
               value="<?= isset($artiste) ? htmlspecialchars($artiste->get('description_musique')) : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Style musical</label>
        <input type="text" name="type_musique" class="form-control"
               value="<?= isset($artiste) ? htmlspecialchars($artiste->get('type_musique')) : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Description de l'offre</label>
        <input type="text" name="description_offre" class="form-control"
               value="<?= isset($artiste) ? htmlspecialchars($artiste->get('description_offre')) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="region_artiste">Région</label>
        <?php $region = $artiste->get('region') ?? ''; ?>
        <select name="region_artiste" id="region_artiste" class="form-select">
            <option value="">-- Choisir une région --</option>
            <option value="Auvergne-Rhône-Alpes" <?= $region === "Auvergne-Rhône-Alpes" ? 'selected' : '' ?>>Auvergne-Rhône-Alpes</option>
            <option value="Bourgogne-Franche-Comté" <?= $region === "Bourgogne-Franche-Comté" ? 'selected' : '' ?>>Bourgogne-Franche-Comté</option>
            <option value="Bretagne" <?= $region === "Bretagne" ? 'selected' : '' ?>>Bretagne</option>
            <option value="Centre-Val de Loire" <?= $region === "Centre-Val de Loire" ? 'selected' : '' ?>>Centre-Val de Loire</option>
            <option value="Corse" <?= $region === "Corse" ? 'selected' : '' ?>>Corse</option>
            <option value="Grand Est" <?= $region === "Grand Est" ? 'selected' : '' ?>>Grand Est</option>
            <option value="Hauts-de-France" <?= $region === "Hauts-de-France" ? 'selected' : '' ?>>Hauts-de-France</option>
            <option value="Île-de-France" <?= $region === "Île-de-France" ? 'selected' : '' ?>>Île-de-France</option>
            <option value="Normandie" <?= $region === "Normandie" ? 'selected' : '' ?>>Normandie</option>
            <option value="Nouvelle-Aquitaine" <?= $region === "Nouvelle-Aquitaine" ? 'selected' : '' ?>>Nouvelle-Aquitaine</option>
            <option value="Occitanie" <?= $region === "Occitanie" ? 'selected' : '' ?>>Occitanie</option>
            <option value="Pays de la Loire" <?= $region === "Pays de la Loire" ? 'selected' : '' ?>>Pays de la Loire</option>
            <option value="Provence-Alpes-Côte d'Azur" <?= $region === "Provence-Alpes-Côte d'Azur" ? 'selected' : '' ?>>Provence-Alpes-Côte d'Azur</option>
            <option value="Guadeloupe" <?= $region === "Guadeloupe" ? 'selected' : '' ?>>Guadeloupe</option>
            <option value="Martinique" <?= $region === "Martinique" ? 'selected' : '' ?>>Martinique</option>
            <option value="Guyane" <?= $region === "Guyane" ? 'selected' : '' ?>>Guyane</option>
            <option value="La Réunion" <?= $region === "La Réunion" ? 'selected' : '' ?>>La Réunion</option>
            <option value="Mayotte" <?= $region === "Mayotte" ? 'selected' : '' ?>>Mayotte</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Prix</label>
        <input type="number" name="prix" class="form-control"
               value="<?= isset($artiste) ? htmlspecialchars($artiste->get('prix')) : '' ?>">
    </div>
</div>