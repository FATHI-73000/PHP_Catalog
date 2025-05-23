<?php


// Définir les variables par défaut
$title = "MonSiteWeb";
$metaDescription = "Bienvenue sur le site de MonSiteWeb";

// Vérifier la page demandée dans l'URL (ex: ?page=about)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Définir les titres et descriptions en fonction de la page demandée
if ($page === 'home') {
    $title = "Accueil - MonSiteWeb";
    $metaDescription = "Page d'accueil de MonSiteWeb. Découvrez nos services et notre entreprise.";
} elseif ($page === 'about') {
    $title = "À propos - MonSiteWeb";
    $metaDescription = "Page décrivant l'entreprise et son histoire.";
} elseif ($page === 'services') {
    $title = "Nos services - MonSiteWeb";
    $metaDescription = "Découvrez les services proposés par MonSiteWeb, votre partenaire en développement web.";
} elseif ($page === 'contact') {
    $title = "Contact - MonSiteWeb";
    $metaDescription = "Contactez MonSiteWeb pour toute question ou demande de devis.";
}

// Inclusions du header
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="T.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php?page=home">MonSiteWeb</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=home">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">À propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="item.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <?php
        // Affichage du contenu en fonction de la page demandée
        if ($page === 'home') {
            echo '<h1>Bienvenue sur MonSiteWeb</h1>';
            echo '<p>Découvrez nos services, notre histoire, et contactez-nous pour plus d\'informations.</p>';
        } elseif ($page === 'about') {
            echo '<h1>À propos</h1>';
            echo '<p>Notre entreprise a été fondée en 2020 et se spécialise dans le développement web.</p>';
        } elseif ($page === 'services') {
            echo '<h1>Nos Services</h1>';
            echo '<ul>
                    <li>Développement de sites web</li>
                    <li>Création de boutiques en ligne</li>
                    <li>Maintenance et mise à jour de sites web</li>
                  </ul>';
        } elseif ($page === 'contact') {
            echo '<h1>Contactez-nous</h1>';
            echo '<form action="submit_form.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                  </form>';
        } else {
            echo '<h1>Page non trouvée</h1>';
            echo '<p>Désolé, la page que vous cherchez n\'existe pas.</p>';
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <p>&copy; 2026 MonSiteWeb - Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>