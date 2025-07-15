<?php

class organisateur extends _model {

    protected $table = "organisateur";
    protected $champs = ["id","prenom", "region", "description_lieu"];

    // Charge un organisateur à partir de son identifiant utilisateur
    function loadByUtilisateur($id_utilisateur) {
        return $this->loadFromField("id", $id_utilisateur);
    }
}