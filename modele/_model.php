<?php

class _model {

    // Connexion PDO partagée par toutes les instances (partager dans la meme classe ou les sous classes)
    protected static $pdo; 

    protected $table = "";
    protected $champs = [];
    protected $liens = [];

    protected $valeurs = [];
    protected $id;

    // Définit la connexion PDO utilisée par tous les modèles
    static function setPDO($pdo) {
        self::$pdo = $pdo;
    }

    // Constructeur : si un ID est fourni, charge automatiquement les données associées
    function __construct($id = null) {
        if ($id !== null) {
            $this->load($id);
        }
    }

    // Charge un enregistrement en base à partir de son ID
    function load($id) {
        $row = bddGetRecord("SELECT * FROM {$this->table} WHERE id = :id", [":id" => $id]);
        if ($row) {
            foreach ($row as $champ => $val) {
                $champ === "id" ? $this->id = $val : $this->valeurs[$champ] = $val;
            }
            return true;
        }
        return false;
    }

    // Charge un enregistrement à partir d’un champ spécifique (ex: email)
    function loadFromField($champ, $valeur) {
        $row = bddGetRecord("SELECT * FROM {$this->table} WHERE $champ = :val LIMIT 1", [":val" => $valeur]);
        if ($row) {
            foreach ($row as $key => $value) {
                if ($key === "id") {
                    $this->id = $value;
                } else {
                    $this->valeurs[$key] = $value;
                }
            }
            return true;
        }
        return false;
    }

    // Charge les champs d’un tableau associatif vers l’objet
    function loadFromTab($tab) {
        foreach ($this->champs as $champ) {
            if (isset($tab[$champ])) {
                $this->set($champ, $tab[$champ]);
            }
        }
        return true;
    }

    // Retourne une liste d’objets selon filtre/tri, similaire à une requête SQL générique
    function list($filtreChamp = null, $filtreValeur = null, $tri = "id", $ordre = "ASC") {
       $sql = "SELECT * FROM {$this->table}";
        $params = [];

        if ($filtreChamp && $filtreValeur !== null) {
            $sql .= " WHERE $filtreChamp = :filtre";
            $params[":filtre"] = $filtreValeur;
        }

        $sql .= " ORDER BY $tri $ordre";

        $rows = bddGetRecords($sql, $params);

        $liste = [];
        foreach ($rows as $row) {
            $obj = new static(); // ou get_called_class()
            $obj->id = $row['id'];
            foreach ($row as $champ => $val) {
                if ($champ !== 'id') {
                    $obj->valeurs[$champ] = $val;
                }
            }
            $liste[] = $obj;
        }
        return $liste;
    }

    // Assigne plusieurs champs en une seule fois
    function setFields(array $tab) {
        foreach ($tab as $champ => $val) {
            $this->set($champ, $val);
        }
    }

    // Récupère la valeur d’un champ (ou l’ID)
    function get($champ) {
        if ($champ === 'id') return $this->id;
        return isset($this->valeurs[$champ]) ? $this->valeurs[$champ] : null;
    }

    // Modifie la valeur d’un champ si celui-ci est défini dans le modèle
    function set($champ, $valeur) {
        if (in_array($champ, $this->champs)) {
            $this->valeurs[$champ] = $valeur;
        }
    }

    // Affiche la valeur d’un champ en HTML sécurisé 
    function html($champ) {
        if (in_array($champ, $this->liens)) return '';
        return nl2br(htmlentities($this->get($champ), ENT_QUOTES, 'UTF-8'));
    }

    // Supprime l’enregistrement de la base de données
    function delete() {
        return bddDelete($this->table, $this->id);
    }

    // Insère ou met à jour l’enregistrement en base de données
    function update() {
        if ($this->id) {
            return bddUpdate($this->table, $this->valeurs, $this->id);
        } else {
            $id = bddInsert($this->table, $this->valeurs);
            if ($id) {
                $this->id = $id;
                return true;
            }
            return false;
        }
    }

    // Retourne l’ID de l’objet
    function id() {
        return $this->id;
    }

    // Vérifie si l'objet est chargé (c’est-à-dire s’il a un ID)
    function is() {
        return isset($this->id);
    }
}