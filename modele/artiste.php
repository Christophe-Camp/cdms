<?php

class artiste extends _model {

    protected $table = "artiste";
    protected $champs = ["id", "nom_de_scene", "presentation_groupe", "description_musique", "type_musique", "description_offre", "region", "prix"];

    // Liste tous les artistes, avec possibilité de filtrer, trier et ordonner les résultats.
    function list($filtreChamp = null, $filtreValeur = null, $tri = "id", $ordre = "ASC") {
        $sql = "SELECT * FROM {$this->table}";
        $params = [];

        // Ajoute un filtre si défini
        if ($filtreChamp && $filtreValeur !== null) {
            $sql .= " WHERE $filtreChamp = ?";
            $params[] = $filtreValeur;
        }

        // Tri les résultats
        $sql .= " ORDER BY $tri $ordre";

        // Exécute la requête
        $stmt = self::$pdo->prepare($sql); // utilise le PDO static hérité
        $stmt->execute($params);

        // Construit les objets artiste à partir des résultats
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste = [];

        foreach ($rows as $row) {
            $artiste = new self();
            $artiste->loadFromTab($row);
            $artiste->id = $row['id'];
            $liste[] = $artiste;
        }

        return $liste;
    }

    // Charge un artiste par identifiant utilisateur
    function loadByUtilisateur($id_utilisateur) {
        return $this->loadFromField("id", $id_utilisateur);
    }
    
    // Recherche des artistes selon plusieurs critères facultatifs (type, région, nom de scène)
    function recherche($type = "", $region = "", $nom = "") {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];

        if (!empty($type)) {
            $sql .= " AND type_musique LIKE ?";
            $params[] = "%$type%";
        }

        if (!empty($region)) {
            $sql .= " AND region LIKE ?";
            $params[] = "%$region%";
        }

        if (!empty($nom)) {
            $sql .= " AND nom_de_scene LIKE ?";
            $params[] = "%$nom%";
        }

        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste = [];

        foreach ($rows as $row) {
            $artiste = new self();
            $artiste->loadFromTab($row);
            $artiste->id = $row['id'];
            $liste[] = $artiste;
        }

        return $liste;
    }
}