<?php
// Liste des produits autorisés (prix en euros)
$products = [
    "iphone" => [
        "price" => 450,
        "weight" => 200
    ],
    "ipad" => [
        "price" => 450,
        "weight" => 400
    ]
];

// Fonction pour formater l'affichage en euros
function euro($amount) {
    return number_format($amount, 2, ',', ' ') . " €";
}

// Initialisation des variables
$erreur = "";
$resultats = null;

// Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['product_name'], $_POST['quantity'])) {
        $erreur = "Erreur : données manquantes.";
    } else {
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];

        if (!array_key_exists($product_name, $products)) {
            $erreur = "Erreur : produit invalide.";
        } elseif (!filter_var($quantity, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
            $erreur = "Erreur : la quantité doit être un entier positif.";
        } else {
            $unit_price = $products[$product_name]['price'];
            $total_ht = $unit_price * $quantity;
            $tva = $total_ht * 0.20;
            $total_ttc = $total_ht + $tva;

            $resultats = [
                "produit" => $product_name,
                "quantite" => $quantity,
                "prix" => $unit_price,
                "ht" => $total_ht,
                "tva" => $tva,
                "ttc" => $total_ttc
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande produit</title>
</head>
<body>
    <h1>Formulaire de commande</h1>
    <?php if ($erreur): ?>
        <p style="color:red"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Produit :
            <select name="product_name" required>
                <?php foreach ($products as $key => $data): ?>
                    <option value="<?= $key ?>" <?= (isset($product_name) && $product_name === $key) ? 'selected' : '' ?>>
                        <?= ucfirst($key) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Quantité :
            <input type="number" name="quantity" min="1" required value="<?= isset($quantity) ? (int)$quantity : '' ?>">
        </label><br><br>

        <button type="submit">Commander</button>
    </form>

    <?php if ($resultats): ?>
        <h2>Récapitulatif de la commande</h2>
        <p><strong>Produit :</strong> <?= htmlspecialchars($resultats['produit']) ?></p>
        <p><strong>Quantité :</strong> <?= (int)$resultats['quantite'] ?></p>
        <p><strong>Prix unitaire :</strong> <?= euro($resultats['prix']) ?></p>
        <p><strong>Total HT :</strong> <?= euro($resultats['ht']) ?></p>
        <p><strong>TVA (20%) :</strong> <?= euro($resultats['tva']) ?></p>
        <p><strong>Total TTC :</strong> <?= euro($resultats['ttc']) ?></p>
    <?php endif; ?>
</body>
</html>
