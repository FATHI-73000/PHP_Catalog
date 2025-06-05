<?php
require_once 'database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $products = $_POST['products'] ?? [];
    $quantities = $_POST['quantities'] ?? [];

    if (empty($firstName) || empty($lastName) || empty($products)) {
        die("<p style='color:red;'>Tous les champs sont obligatoires et au moins un produit doit être sélectionné.</p>");
    }

    $pdo = getPDO();
    $pdo->beginTransaction();

    try {
        // 1. Insertion du client
        insertCustomer($firstName, $lastName);
        $customerId = $pdo->lastInsertId();

        // 2. Calcul du total
        $total = 0;
        $selectedProducts = [];

        foreach ($products as $productId => $_) {
            $qty = (int)$quantities[$productId];
            if ($qty <= 0) continue;

            $stmt = $pdo->prepare("SELECT name, price FROM products WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch();

            if ($product) {
                $subtotal = $product['price'] * $qty;
                $total += $subtotal;
                $selectedProducts[] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $qty,
                    'subtotal' => $subtotal,
                    'id' => $productId
                ];
            }
        }

        // 3. Insertion de la commande
        $orderNumber = uniqid('CMD');
        $orderDate = date('Y-m-d');
        $stmt = $pdo->prepare("
            INSERT INTO orders (number, date, total_amount, customer_id)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$orderNumber, $orderDate, $total, $customerId]);
        $orderId = $pdo->lastInsertId();

        // 4. Insertion dans order_product + mise à jour du stock
        foreach ($selectedProducts as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_product (order_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$orderId, $item['id'], $item['quantity']]);

            $stmt = $pdo->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
            $stmt->execute([$item['quantity'], $item['id']]);
        }

        $pdo->commit();

        // 5. Affichage de la confirmation
        echo "<h2>Commande réussie !</h2>";
        echo "<p><strong>Numéro de commande :</strong> $orderNumber</p>";
        echo "<p><strong>Client :</strong> $firstName $lastName</p>";
        echo "<p><strong>Date :</strong> $orderDate</p>";
        echo "<h3>Détails de la commande :</h3>";
        echo "<ul>";
        foreach ($selectedProducts as $item) {
            echo "<li>" . htmlspecialchars($item['name']) . " — {$item['quantity']} × {$item['price']} € = <strong>{$item['subtotal']} €</strong></li>";
        }
        echo "</ul>";
        echo "<p><strong>Total :</strong> $total €</p>";
        echo '<p><a href="catalogue.php">← Retour au catalogue</a></p>';

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<p style='color:red;'>Erreur lors de la commande : " . $e->getMessage() . "</p>";
    }

} else {
    echo "<p style='color:red;'>Accès interdit. Veuillez soumettre le formulaire.</p>";
}
