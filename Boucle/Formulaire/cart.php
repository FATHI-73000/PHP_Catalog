<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product = htmlspecialchars($_POST["product_name"]);
    $quantity = (int) $_POST["quantity"];

    echo "<h1>Commande reçue</h1>";
    echo "<p>Produit : $product</p>";
    echo "<p>Quantité : $quantity</p>";
}
?>
