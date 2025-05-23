<?php
function discountedPrice($priceInCents, $discount) {
    $discountedPrice = $priceInCents - ($priceInCents * $discount / 100);
    return formatprice($discountedPrice);
}

function formatprice($priceInCents) {
    $priceInEuros = $priceInCents / 100;
    return number_format($priceInEuros, 2, ',', ' ') . ' €';
}

$iphone = [
    "name" => "iphone",
    "price" => 45000,
    "weight" => 200,
    "discount" => 10,
    "picture_url" => "https://cdn-apple.com/iphone-12.jpg"
];

$ipad = [
    "name" => "ipad",
    "price" => 55000,
    "weight" => 300,
    "discount" => null,
    "picture_url" => "https://cdn-apple.com/ipad.jpg"
];

$iMac = [
    "name" => "iMac",
    "price" => 120000,
    "weight" => 5000,
    "discount" => 15,
    "picture_url" => "https://cdn-apple.com/imac.jpg"
];

$products = [ $iphone, $ipad, $iMac ];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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
            <h3><?php echo htmlspecialchars($product["name"]); ?></h3>
            <p>
                Prix : 
                <?php 
                    if ($product["discount"] !== null) {
                        echo discountedPrice($product["price"], $product["discount"]);
                    } else {
                        echo formatprice($product["price"]);
                    }
                ?>
            </p>
            <p>Poids : <?php echo $product["weight"]; ?> g</p>
            <p>Remise : <?php echo ($product["discount"] !== null ? $product["discount"] . "%" : "Aucune"); ?></p>
            <img src="<?php echo htmlspecialchars($product["picture_url"]); ?>" alt="<?php echo htmlspecialchars($product["name"]); ?>">
        </div>
    <?php endforeach; ?>
</body>
</html>
