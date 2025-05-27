<?php
session_start();

// --- 1. PANIER SIMULÉ (vous pouvez remplacer ceci par $_SESSION plus tard)
$cart = [
    [
        "name" => "iPhone",
        "price" => 45000, // en centimes
        "weight" => 200,  // grammes
        "quantity" => 2
    ],
    [
        "name" => "iPad",
        "price" => 60000,
        "weight" => 400,
        "quantity" => 1
    ]
];

// --- 2. TRANSPORTEURS DISPONIBLES
$carriers = [
    "rapide" => "Transport Rapide",
    "eco" => "Livraison Économique"
];

// --- 3. TRANSPORTEUR CHOISI (formulaire POST ou valeur par défaut)
$selectedCarrier = $_POST['carrier'] ?? 'rapide';

// --- 4. CALCUL TOTAL PANIER (poids et prix)
$totalWeight = 0;
$totalHT = 0;

foreach ($cart as $item) {
    $totalWeight += $item["weight"] * $item["quantity"];
    $totalHT += $item["price"] * $item["quantity"];
}

// --- 5. FONCTION DE CALCUL DES FRAIS DE PORT
function calculFraisDePort($poids, $montant, $transporteur) {
    if ($poids > 2000) {
        return 0; // Gratuit
    } elseif ($poids > 500) {
        return (int)($montant * 0.10); // 10%
    } else {
        return 500; // 5€
    }
}

// --- 6. CALCUL FRAIS DE PORT + TOTAL TTC
$fraisPort = calculFraisDePort($totalWeight, $totalHT, $selectedCarrier);
$totalTTC = $totalHT + $fraisPort;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .cart-item { margin-bottom: 10px; }
        .summary { margin-top: 20px; }
        label, select, button { font-size: 16px; margin-top: 10px; }
    </style>
</head>
<body>

<h1>🛒 Votre panier</h1>

<?php foreach ($cart as $item): ?>
    <div class="cart-item">
        <?= htmlspecialchars($item["name"]) ?> × <?= $item["quantity"] ?> — 
        <?= number_format($item["price"] / 100, 2, ',', ' ') ?> € pièce
    </div>
<?php endforeach; ?>

<!-- FORMULAIRE DE CHOIX DU TRANSPORTEUR -->
<form method="post" action="cart.php">
    <label for="carrier">Choisissez un transporteur :</label>
    <select name="carrier" id="carrier">
        <?php foreach ($carriers as $key => $label): ?>
            <option value="<?= $key ?>" <?= ($selectedCarrier === $key) ? 'selected' : '' ?>>
                <?= htmlspecialchars($label) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <button type="submit">Mettre à jour le panier</button>
</form>

<!-- RÉCAPITULATIF -->
<div class="summary">
    <p>📦 Poids total : <?= $totalWeight ?> g</p>
    <p>💰 Sous-total : <?= number_format($totalHT / 100, 2, ',', ' ') ?> €</p>
    <p>🚚 Transporteur : <?= htmlspecialchars($carriers[$selectedCarrier]) ?></p>
    <p>🚛 Frais de port : <?= number_format($fraisPort / 100, 2, ',', ' ') ?> €</p>
    <p><strong>💳 Total TTC : <?= number_format($totalTTC / 100, 2, ',', ' ') ?> €</strong></p>
</div>

</body>
</html>
