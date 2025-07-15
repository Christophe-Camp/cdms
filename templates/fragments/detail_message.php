<?php
    // Template de fragment: affiche le detail d'un message 
?>

<?php if (!empty($messages)): ?>
    <div class="list-group mb-4">
        <?php foreach ($messages as $msg): ?>
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <small class="text-muted"><?= htmlentities($msg->get("date_envoi")) ?></small>
                </div>
                <p class="mb-0"><?= nl2br(htmlentities($msg->get("contenu_message"))) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">Aucun message trouvé.</div>
<?php endif; ?>