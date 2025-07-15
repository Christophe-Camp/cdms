<?php

class message extends _model {

    protected $table ="message";
    protected $champs =["organisateur", "artiste", "contenu_message", "date_envoi", "lu_organisateur", "lu_artiste", "archive"];     // liste simple de champs, sauf l'id
    protected $liens = [ "utilisateur" => "utilisateur"];      // Tableau [nomCahmp => objetPointé,...]

    // Récupère la liste des contacts avec lesquels l'utilisateur a échangé des messages.
    // Chaque contact est marqué comme archivé (1) ou actif (0) selon les messages échangés.
    function listeContacts($monId) {
        $sql = "
            SELECT 
                CASE 
                    WHEN organisateur = :monId THEN artiste
                    ELSE organisateur
                END AS contact_id,
                MIN(archive) AS archive_conversation  -- si au moins un message non archivé, archive=0 sinon 1
            FROM message
            WHERE organisateur = :monId OR artiste = :monId
            GROUP BY contact_id
        ";

        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([':monId' => $monId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $liste = [];
        foreach ($rows as $row) {
            $contact_id = $row['contact_id'];
            $archive_conversation = $row['archive_conversation']; // 0 ou 1
            
            $u = new utilisateur($contact_id);
            // Ajoute manuellement la propriété archive (ajoute un setter dans utilisateur si besoin)
            $u->set('archive', $archive_conversation);  
            
            $liste[$contact_id] = $u;
        }

        return $liste;
    }

    // Charge tous les messages échangés entre deux utilisateurs, triés par date croissante.
    function chargerConversation($id1, $id2) {
        $sql = "
            SELECT * FROM message
            WHERE (organisateur = ? AND artiste = ?)
            OR (organisateur = ? AND artiste = ?)
            ORDER BY date_envoi ASC
        ";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$id1, $id2, $id2, $id1]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste = [];

        foreach ($rows as $row) {
            $msg = new self();
            $msg->loadFromTab($row);
            $liste[] = $msg;
        }

        return $liste;
    }

    // Récupère le dernier message échangé entre deux utilisateurs.
    function dernierMessage($id1, $id2) {
        $sql = "
            SELECT * FROM message
            WHERE (organisateur = ? AND artiste = ?)
            OR (organisateur = ? AND artiste = ?)
            ORDER BY date_envoi DESC LIMIT 1
        ";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$id1, $id2, $id2, $id1]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $msg = new self();
            $msg->loadFromTab($row);
            return $msg;
        }
        return null;
    }

    // Compte le nombre total de nouveaux messages non lus pour l'utilisateur donné.
    function nbNouveauxMessages($id_utilisateur) {
        $user = new utilisateur($id_utilisateur);
        $type = $user->get("type_utilisateur");

        if ($type === "artiste") {
            $sql = "SELECT COUNT(*) AS nb FROM message WHERE artiste = :id AND lu_artiste = 0 AND archive = 0";
        } else {
            $sql = "SELECT COUNT(*) AS nb FROM message WHERE organisateur = :id AND lu_organisateur = 0 AND archive = 0";
        }

        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['id' => $id_utilisateur]);
        $row = $stmt->fetch();
        return $row ? intval($row["nb"]) : 0;
    }

    // Marque les messages d'un contact comme lus pour l'utilisateur connecté.
    function marquerCommeLus($monId, $contactId) {
        $type = utilisateurConnecte()->get("type_utilisateur");

        if ($type === "artiste") {
            $sql = "UPDATE message 
                    SET lu_artiste = 1 
                    WHERE organisateur = :contact 
                    AND artiste = :moi 
                    AND lu_artiste = 0";
        } else {
            $sql = "UPDATE message 
                    SET lu_organisateur = 1 
                    WHERE artiste = :contact 
                    AND organisateur = :moi 
                    AND lu_organisateur = 0";
        }

        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'contact' => $contactId,
            'moi' => $monId
        ]);
    }

    // Archive tous les messages entre deux utilisateurs.
    function archiveMessage($id1, $id2) {
        $sql = "UPDATE message
                SET archive = 1
                WHERE (
                    (organisateur = :id1 AND artiste = :id2)
                    OR 
                    (organisateur = :id2 AND artiste = :id1)
                )";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id1" => $id1,
            ":id2" => $id2,
        ]);
    }

    // Compte le nombre de nouveaux messages non lus provenant d’un contact spécifique.
    function nbNouveauxMessagesParContact($monId, $contactId) {
        $user = new utilisateur($monId);
        $type = $user->get("type_utilisateur");

        if ($type === "artiste") {
            // Messages envoyés par l’organisateur, non lus par l’artiste
            $sql = "SELECT COUNT(*) FROM message 
                    WHERE artiste = :moi 
                    AND organisateur = :contact 
                    AND lu_artiste = 0 
                    AND archive = 0";
        } else {
            // Messages envoyés par l’artiste, non lus par l’organisateur
            $sql = "SELECT COUNT(*) FROM message 
                    WHERE organisateur = :moi 
                    AND artiste = :contact 
                    AND lu_organisateur = 0 
                    AND archive = 0";
        }

        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ':moi' => $monId,
            ':contact' => $contactId,
        ]);
        return (int)$stmt->fetchColumn();
    }   
}