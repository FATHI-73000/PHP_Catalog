<?php
if (!function_exists('discountedPrice')) {
    function discountedPrice($priceInCents, $discount) {
        if ($discount !== null && is_numeric($discount)) {
            return   $priceInCents - ($priceInCents * $discount / 100);
        }
        return $priceInCents;
    }
}

$products = [
    [
        "name" => "iphone",
        "price" => 45000,
        "weight" => 200,
        "discount" => 10,
        "picture_url" => "https://cdn-apple.com/iphone-12.jpg",
    ],
    [
        "name" => "ipad",
        "price" => 45000,
        "weight" => 400,
        "discount" => null,
        "picture_url" => "https://cdn-apple.com/ipad.jpg"
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        foreach ($products as $product) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($product["name"]) . "</h3>";

            
            echo "<p>Prix : " . discountedPrice($product["price"], $product["discount"]);

            echo "<p>Poids : " . htmlspecialchars($product["weight"]) . " g</p>";
            echo "<p>Remise : " . ($product["discount"] !== null ? $product["discount"] . "%" : "Aucune") . "</p>";
            echo "<img src='" . htmlspecialchars($product["picture_url"]) . "' alt='" . htmlspecialchars($product["name"]) . "'>";
            echo "</div>";
        }
    ?>
</body>
</html>
