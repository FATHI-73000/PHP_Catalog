<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product = htmlspecialchars($_POST["product_name"]);
    $quantity = (int) $_POST["quantity"];
    $unitPrice = (int) $_POST["unit_price"]; // en centimes

    $totalPrice = $unitPrice * $quantity;

    echo "<h1>Commande reçue</h1>";
    echo "<p>Produit : $product</p>";
    echo "<p>Quantité : $quantity</p>";
    echo "<p>Prix unitaire après remise : " . number_format($unitPrice / 100, 2, ',', ' ') . " €</p>";
    echo "<p><strong>Prix total : " . number_format($totalPrice / 100, 2, ',', ' ') . " €</strong></p>";
}
?>
