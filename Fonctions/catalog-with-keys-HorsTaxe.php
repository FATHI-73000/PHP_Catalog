<?php

function priceExcludingVat($priceInCents , $vatRate = 20) {
    // Calcul du prix hors TVA
    $priceExcludingVat = $priceInCents / (1 + ($vatRate / 100)); 
    return number_format($priceExcludingVat/100, 2, ',', ' ') . '€'; // Formatage du prix avec deux décimales
}

// Définition des produits
$iphone = [
    "name" => "iphone",
    "price" => 45000,  // Prix en centimes
    "weight" => 200,   // Poids en grammes
    "discount" => 10,  // Remise en pourcentage
    "picture_url" => "https://cdn-apple.com/iphone-12.jpg",
];

$ipad = [
    "name" => "ipad",
    "price" => 55000,  // Prix en centimes
    "weight" => 300,   // Poids en grammes
    "discount" => null, // Pas de remise
    "picture_url" => "https://cdn-apple.com/ipad.jpg"
];

$imac = [
    "name" => "iMac",
    "price" => 120000, // Prix en centimes
    "weight" => 5000,  // Poids en grammes
    "discount" => 15,  // Remise en pourcentage
    "picture_url" => "https://cdn-apple.com/imac.jpg"
];

// Tableau des produits
$products = [$iphone, $ipad, $imac];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des produits</title>
    <style>
        .product {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px 0;
            max-width: 400px;
        }

        .product img {
            width: 150px;
        }
    </style>
</head>
<body>
    <h1>Catalogue des produits</h1>

    <?php foreach ($products as $product): ?>
        <div class="product">
            <!-- Affichage du nom du produit -->
            <h3><?php echo htmlspecialchars($product["name"]); ?></h3>

            <!-- Affichage du prix formaté hors TVA -->
            <p>Prix hors TVA : <?php echo priceExcludingVat($product["price"]); ?></p>

            <!-- Affichage du poids -->
            <p>Poids : <?php echo $product["weight"]; ?> g</p>

            <!-- Affichage de la remise -->
            <p>Remise : <?php echo ($product["discount"] !== null ? $product["discount"] . "%" : "Aucune"); ?></p>

            <!-- Affichage de l'image du produit -->
            <img src="<?php echo htmlspecialchars($product["picture_url"]); ?>" alt="<?php echo htmlspecialchars($product["name"]); ?>">
        </div>
    <?php endforeach; ?>

</body>
</html>