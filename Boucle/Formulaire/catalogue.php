<?php
require_once 'database.php';
$products = getAllAvailableProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue - Passer une commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f9f9f9;
        }

        h2, h3 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        .product-row {
            margin-bottom: 10px;
            padding: 8px;
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-row input[type="number"] {
            width: 60px;
            margin-left: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Passer une commande</h2>

<form action="commande.php" method="post">
    <label>
        Prénom :
        <input type="text" name="first_name" required>
    </label>

    <label>
        Nom :
        <input type="text" name="last_name" required>
    </label>

    <h3>Produits disponibles :</h3>

    <?php foreach ($products as $product): ?>
        <div class="product-row">
            <div>
                <!-- ✅ Ajout de value="1" pour transmettre le produit coché -->
                <input type="checkbox" id="prod_<?= $product['id'] ?>" name="products[<?= $product['id'] ?>]" value="1">
                <label for="prod_<?= $product['id'] ?>">
                    <?= htmlspecialchars($product['name']) ?> —
                    <?= number_format($product['price'], 2) ?> € (Stock : <?= $product['quantity'] ?>)
                </label>
            </div>
            <div>
                <label>
                    Quantité :
                    <input type="number" name="quantities[<?= $product['id'] ?>]" value="1" min="1">
                </label>
            </div>
        </div>
    <?php endforeach; ?>

    <br>
    <button type="submit">Commander</button>
</form>

</body>
</html>
