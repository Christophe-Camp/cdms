<?php
    // Template de fragment: menu quand on est connecté
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="accueil.php">
            <i class="bi bi-music-note-beamed"></i> Concert dans mon salon
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                 <li class="nav-item">
                    <a class="nav-link" href="retour_liste.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="formulaire_rechercher.php">Rechercher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="messagerie.php">
                        Messagerie
                        <?php if ($nbNouveaux > 0): ?>
                            <span class="badge bg-danger"><?= $nbNouveaux ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="formulaire_modification_profil.php">Modifier Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>