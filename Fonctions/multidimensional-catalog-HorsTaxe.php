<?php

// Vérifier si la fonction existe déjà avant de la déclarer
if (!function_exists('priceExcludingVat')) {
    function priceExcludingVat($priceInCents, $vatRate = 20) {
        // Calcul du prix hors TVA
        $priceExcludingVat = $priceInCents / (1 + ($vatRate / 100)); 
        return number_format($priceExcludingVat / 100, 2, ',', ' ') . '€'; // Formatage du prix avec deux décimales
    }
}

// Définition des produits
$products = [
    $iphone = [
        "name" => "iphone",
        "price" => 45000, // Prix en centimes
        "weight" => 200,  // Poids en grammes
        "discount" => 10, // Remise en pourcentage
        "picture_url" => "https://cdn-apple.com/iphone-12.jpg",
    ],
    $ipad = [
        "name" => "ipad",
        "price" => 55000, // Prix en centimes
        "weight" => 400,  // Poids en grammes
        "discount" => null, // Pas de remise
        "picture_url" => "https://cdn-apple.com/ipad.jpg"
    ],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des produits</title>
    <style>
        .product {
            border: 1px solid #baa;
            padding: 20px;
            margin: 15px 0;
            max-width: 350px;
            display: inline-block;
            vertical-align: top;
        }

        .product img {
            width: 200px;
        }
    </style>
</head>

<body>
    <h1>Catalogue des produits</h1>
    <?php
    // Parcourir le tableau $products pour afficher chaque produit
    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<h3>" . htmlspecialchars($product["name"]) . "</h3>";
        $priceExcludingVat = priceExcludingVat($product["price"], 20); // Appel de la fonction pour obtenir le prix hors TVA
        echo "<p>Prix hors TVA : " . $priceExcludingVat . "</p>";
        echo "<p>Poids : " . $product["weight"] . " g</p>";
        echo "<p>Remise : " . ($product["discount"] !== null ? $product["discount"] . "%" : "Aucune") . "</p>";
        echo "<img src='" . htmlspecialchars($product["picture_url"]) . "' alt='" . htmlspecialchars($product["name"]) . "'>";
        echo "</div>";
    }
    ?>

</body>

</html>
