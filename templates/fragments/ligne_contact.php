<?php
// Template de fragment: ligne de contact

$nbNonLus = $nbNonLusParContact[$utilisateur->id()] ?? 0;
?>
<div class="list-group-item">
    <div class="d-flex justify-content-between align-items-center">

        <!-- Partie cliquable (nom + message) -->
        <div class="flex-grow-1" style="cursor: pointer; min-width: 0;" onclick="demandeDetail(<?= $utilisateur->id() ?>)">
            <div class="fw-bold text-truncate d-flex align-items-center">
                <?= htmlentities($utilisateur->get("prenom")) ?>
                <?php if ($nbNonLus > 0): ?>
                    <span class="badge bg-danger ms-2"><?= $nbNonLus ?></span>
                <?php endif; ?>
            </div>
            <div class="text-truncate text-secondary small">
                <?= $dernier ? htmlentities($dernier->get("contenu_message")) : '<em>Aucun message</em>' ?>
            </div>
        </div>

        <!-- Bouton archiver -->
        <form method="POST" action="archiver_conversation.php"
              class="ms-2" onsubmit="event.stopPropagation(); return confirm('Archiver cette conversation ?');">
            <input type="hidden" name="id_utilisateur" value="<?= $utilisateur->id() ?>">
            <button type="submit" class="btn btn-sm btn-outline-secondary" title="Archiver">
                <i class="bi bi-archive"></i>
            </button>
        </form>
    </div>
</div>