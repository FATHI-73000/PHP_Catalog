<?php


// Sécuriser la fonction euro()
if (!function_exists('euro')) {
    function euro($cents) {
        return number_format($cents / 100, 2, ',', ' ') . ' €';
    }
}

// Fonction pour vider le panier
function emptyCart() {
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Le panier a été vidé.";
}

// Exemple de produits pour initialiser le panier si vide
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        'iphone' => ['price' => 45000, 'weight' => 200, 'quantity' => 1],
        'ipad'   => ['price' => 60000, 'weight' => 400, 'quantity' => 2]
    ];
}

// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Vider le panier si demandé
    if (isset($_POST['empty_cart'])) {
        emptyCart();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Mise à jour des quantités
    if (isset($_POST['update_cart']) && isset($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $product => $qty) {
            $qty = (int)$qty;
            if ($qty > 0) {
                $_SESSION['cart'][$product]['quantity'] = $qty;
            } else {
                unset($_SESSION['cart'][$product]);
            }
        }
        $_SESSION['message'] = "Panier mis à jour.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Récupérer le panier
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Formulaire panier</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin-top: 20px;}
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center;}
        th { background: #eee;}
        input[type=number] { width: 50px; }
        .message { color: green; margin-top: 10px;}
        form { margin-bottom: 15px; }
    </style>
</head>
<body>

<h1>Votre panier</h1>

<?php if (!empty($_SESSION['message'])): ?>
    <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (!empty($cart)): ?>

<!-- Formulaire mise à jour quantités -->
<form method="post" action="">
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            foreach ($cart as $product => $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($product) ?></td>
                <td><?= euro($item['price']) ?></td>
                <td>
                    <input type="number" name="quantities[<?= htmlspecialchars($product) ?>]" min="0" value="<?= $item['quantity'] ?>" />
                </td>
                <td><?= euro($subtotal) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total :</th>
                <th><?= euro($total) ?></th>
            </tr>
        </tfoot>
    </table>

    <button type="submit" name="update_cart">Mettre à jour le panier</button>
</form>

<!-- Formulaire vider le panier -->
<form method="post" action="" onsubmit="return confirm('Voulez-vous vraiment vider le panier ?')">
    <button type="submit" name="empty_cart" value="1">Vider le panier</button>
</form>

<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>

</body>
</html>
