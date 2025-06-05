<?php
// database.php

// Connexion PDO à la base my_boutique
function getPDO() {
    static $pdo = null;
    if ($pdo === null) {
        $host = 'localhost';
        $dbname = 'my_boutique';
        $user = 'FATHI';
        $password = '12373000mF';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    return $pdo;
}

// 1. Récupérer tous les produits disponibles (quantity > 0)
function getAllAvailableProducts() {
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM products WHERE quantity > 0");
    return $stmt->fetchAll();
}

// 2. Récupérer tous les clients
function getAllCustomers() {
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM customers");
    return $stmt->fetchAll();
}

// 3. Récupérer toutes les commandes avec infos client (jointure)
function getAllOrdersWithCustomer() {
    $pdo = getPDO();
    $sql = "SELECT o.id, o.number, o.date, o.total_amount, c.first_name, c.last_name 
            FROM orders o
            JOIN customers c ON o.customer_id = c.id
            ORDER BY o.date DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// 4. Récupérer les produits commandés (jointure sur order_product, orders et products)
function getOrderProducts() {
    $pdo = getPDO();
    $sql = "SELECT op.id, o.number AS order_number, p.name AS product_name, op.quantity
            FROM order_product op
            JOIN orders o ON op.order_id = o.id
            JOIN products p ON op.product_id = p.id
            ORDER BY o.number";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// 5. Insérer un nouveau client
function insertCustomer(string $first_name, string $last_name) {
    $pdo = getPDO();
    $sql = "INSERT INTO customers (first_name, last_name) VALUES (:first_name, :last_name)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name]);
}

// 6. Modifier le prix d’un produit
function updateProductPrice(int $product_id, float $new_price) {
    $pdo = getPDO();
    $sql = "UPDATE products SET price = :price WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['price' => $new_price, 'id' => $product_id]);
}

// Bonus : supprimer un client par ID
function deleteCustomerById(int $customer_id) {
    $pdo = getPDO();
    $sql = "DELETE FROM customers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $customer_id]);
}
