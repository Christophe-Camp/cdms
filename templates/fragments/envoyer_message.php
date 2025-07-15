<?php
    // Template de fragment: formulaire pour envoyer un message
?>
<div class="card mt-4">
    <div class="card-body">
        <form id="form-message" onsubmit="envoyerMessage(event)">
            <input type="hidden" id="id_destinataire" value="<?= $contact->id() ?>">

            <div class="mb-3">
                <label for="contenu_message" class="form-label">Votre message</label>
                <input type="text" class="form-control" id="contenu_message" name="contenu_message" required>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>