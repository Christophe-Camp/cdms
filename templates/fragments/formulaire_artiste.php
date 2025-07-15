<?php
    // Template de fragment: formulaire pour les artistes
?>
<div id="formulaire_artiste" style="display: none;">
        <div class="mb-3">
          <label for="nom_de_scene" class="form-label">Nom de scène</label>
          <input type="text" name="nom_de_scene" id="nom_de_scene" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Présentation du groupe</label>
          <input type="text" name="presentation_groupe" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Description musique</label>
          <input type="text" name="description_musique" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Style musical</label>
          <input type="text" name="type_musique" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Description de l'offre</label>
          <input type="text" name="description_offre" class="form-control">
        </div>
        <div class="mb-3">
            <label for="region">Région</label>
                <select name="region_artiste" id="region_artiste" class="form-select">
                    <option value="">-- Choisir une région --</option>
                    <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
                    <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
                    <option value="Bretagne">Bretagne</option>
                    <option value="Centre-Val de Loire">Centre-Val de Loire</option>
                    <option value="Corse">Corse</option>
                    <option value="Grand Est">Grand Est</option>
                    <option value="Hauts-de-France">Hauts-de-France</option>
                    <option value="Île-de-France">Île-de-France</option>
                    <option value="Normandie">Normandie</option>
                    <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                    <option value="Occitanie">Occitanie</option>
                    <option value="Pays de la Loire">Pays de la Loire</option>
                    <option value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Guyane">Guyane</option>
                    <option value="La Réunion">La Réunion</option>
                    <option value="Mayotte">Mayotte</option>
                </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Prix</label>
          <input type="number" name="prix" class="form-control">
        </div>
      </div>