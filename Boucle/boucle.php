<?php
$produits = [
    ["nom" => "T-shirt", "prix" => 15.99],
    ["nom" => "Jeans", "prix" => 39.99],
    ["nom" => "Casquette", "prix" => 12.50],
    ["nom" => "Sweat", "prix" => 29.99]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue</title>
    <link rel="stylesheet" href="boucle.css">
</head>
<body>
    <h1>Catalogue de produits</h1>
    <ul>
        <?php foreach ($produits as $produit): ?>
            <li>
                <strong><?= htmlspecialchars($produit["nom"]) ?></strong> - 
                <?= number_format($produit["prix"], 2) ?> €
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
