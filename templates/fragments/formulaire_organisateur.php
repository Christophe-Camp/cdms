<?php
    // Template de fragment: formulaire pour les organisateurs
?>
<div id="formulaire_organisateur" style="display: none;">
        <div class="mb-3">
          <label for="prenom_orga" class="form-label">Prénom de l'organisateur</label>
          <input type="text" name="prenom_orga" id="prenom_orga" class="form-control">
        </div>
        <div class="mb-3">
            <label for="region">Région</label>
                <select name="region_organisateur" id="region_organisateur" class="form-select">
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
          <label class="form-label">Description du lieu</label>
          <input type="text" name="description_lieu" class="form-control">
        </div>
      </div>