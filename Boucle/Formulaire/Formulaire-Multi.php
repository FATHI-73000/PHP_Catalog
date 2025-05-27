<?php


foreach ($products as $product) {
    echo "<div class='product'>";
    echo "<h3>" . htmlspecialchars($product["name"]) . "</h3>";
    echo "<p>Prix : " . number_format($product["price"] / 100, 2, ',', ' ') . " €</p>";
    echo "<p>Poids : " . $product["weight"] . " g</p>";
    echo "<p>Remise : " . ($product["discount"] !== null ? $product["discount"] . "%" : "Aucune") . "</p>";
    echo "<img src='" . htmlspecialchars($product["picture_url"]) . "' alt='" . htmlspecialchars($product["name"]) . "'>";

    // Formulaire de commande
    echo "<form method='post' action='cart.php'>";
    echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($product["name"]) . "'>";
    echo "<label>Quantité :
            <input type='number' name='quantity' value='1' min='1'>
          </label><br><br>";
    echo "<button type='submit'>Commander</button>";
    echo "</form>";

    echo "</div>";
}



$products = [

    $iphone = [
        "name" => "iphone",
        "price" => 450,
        "weight" => 200,
        "discount" => 10,
        "picture_url" => "https://cdn-apple.com/iphone-12.jpg",

    ],

    $ipad = [
        "name" => "ipad",
        "price" => 450,
        "weight" => 400,
        "discount" => null,         // pas de remise
        "picture_url" => "https://cdn-apple.com/ipad.jpg"
    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Catalogue des produits </title>
    <style>
        .product {
            border: 1px solid #baa;
            padding: 20px;
            margin: 15 0;
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
    <h1> Catalogue des produits </h1>
    <?php
        // Parcourir le tableau $products pour afficher chaque produit
        foreach ($products as $product) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($product["name"]) . "</h3>";
            echo "<p>Prix : " . number_format($product["price"] / 100, 2, ',', ' ') . " €</p>";
            echo "<p>Poids : " . $product["weight"] . " g</p>";
            echo "<p>Remise : " . ($product["discount"] !== null ? $product["discount"] . "%" : "Aucune") . "</p>";
            echo "<img src='" . htmlspecialchars($product["picture_url"]) . "' alt='" . htmlspecialchars($product["name"]) . "'>";
            echo "</div>";
            
        }

       
        ?>

        </body>

</html>


</body>

</html>