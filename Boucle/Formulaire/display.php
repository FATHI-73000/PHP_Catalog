<?php
require_once 'database.php';

// Appels aux fonctions
$products = getAllAvailableProducts();
$customers = getAllCustomers();
$orders = getAllOrdersWithCustomer();
$order_products = getOrderProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Affichage BDD my_boutique</title>
<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: #2c3e50; }
    table { border-collapse: collapse; width: 100%; max-width: 900px; margin-bottom: 40px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f4f4f4; }
</style>
</head>
<body>

<h1>Données de la base my_boutique</h1>

<h2>Produits disponibles</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Nom</th><th>Description</th><th>Prix (€)</th><th>Quantité</th></tr>
    </thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['description']) ?></td>
            <td><?= number_format($p['price'], 2, ',', ' ') ?></td>
            <td><?= $p['quantity'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Clients</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Prénom</th><th>Nom</th></tr>
    </thead>
    <tbody>
    <?php foreach ($customers as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['first_name']) ?></td>
            <td><?= htmlspecialchars($c['last_name']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Commandes avec clients</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Numéro</th><th>Date</th><th>Total (€)</th><th>Client</th></tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $o): ?>
        <tr>
            <td><?= $o['id'] ?></td>
            <td><?= $o['number'] ?></td>
            <td><?= $o['date'] ?></td>
            <td><?= number_format($o['total_amount'], 2, ',', ' ') ?></td>
            <td><?= htmlspecialchars($o['first_name']) ?> <?= htmlspecialchars($o['last_name']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Produits commandés (détails)</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Numéro commande</th><th>Produit</th><th>Quantité</th></tr>
    </thead>
    <tbody>
    <?php foreach ($order_products as $op): ?>
        <tr>
            <td><?= $op['id'] ?></td>
            <td><?= $op['order_number'] ?></td>
            <td><?= htmlspecialchars($op['product_name']) ?></td>
            <td><?= $op['quantity'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
