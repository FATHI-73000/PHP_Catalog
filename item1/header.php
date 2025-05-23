<!-- header.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre description spécifique ici">
    <title><?php echo $title; ?></title>
    <!-- Lien vers votre CSS (bootstrap si nécessaire) -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <header>
        <nav>
            <ul>
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/item1/about.php">À propos</a></li>
                <li><a href="/item1/contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>