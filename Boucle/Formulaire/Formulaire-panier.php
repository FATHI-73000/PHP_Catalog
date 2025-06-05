<?php
// Initialisation des valeurs si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données
    $productName = $_POST['product_name'];
    $unitPrice = (float) $_POST['unit_price'];
    $quantity = (int) $_POST['quantity'];
    $transporteur = $_POST['transporteur'];

    // Création d’un tableau associatif représentant l'article
    $article = [
        'nom' => $productName,
        'prix' => $unitPrice,
        'quantite' => $quantity
    ];

    // Fonction pour calculer le total HT
    function calculerMontantPanier($prixUnitaire, $quantite) {
        return $prixUnitaire * $quantite;
    }

    // Fonction pour les frais de port
    function calculerFraisDePort($transporteur) {
        if ($transporteur === 'standard') return 5.00;
        if ($transporteur === 'express') return 10.00;
        return 0;
    }

    // Calculs
    $totalHT = calculerMontantPanier($article['prix'], $article['quantite']);
    $fraisPort = calculerFraisDePort($transporteur);
    $totalTTC = $totalHT + $fraisPort;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier PHP</title>
</head>
<body>
    <h1>Commander un produit</h1>

    <form method="post">
        <label>Nom du produit :
            <input type="text" name="product_name" required>
        </label><br><br>

        <label>Prix unitaire (€) :
            <input type="number" name="unit_price" step="0.01" required>
        </label><br><br>

        <label>Quantité :
            <input type="number" name="quantity" min="1" required>
        </label><br><br>

        <label>Transporteur :
            <select name="transporteur">
                <option value="standard">Standard (5 €)</option>
                <option value="express">Express (10 €)</option>
            </select>
        </label><br><br>

        <button type="submit">Valider</button>
    </form>

    <?php if (!empty($article)): ?>
        <hr>
        <h2>Récapitulatif</h2>
        <p><strong>Produit :</strong> <?= htmlspecialchars($article['nom']) ?></p>
        <p><strong>Quantité :</strong> <?= $article['quantite'] ?></p>
        <p><strong>Prix unitaire :</strong> <?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
        <p><strong>Total HT :</strong> <?= number_format($totalHT, 2, ',', ' ') ?> €</p>
        <p><strong>Frais de port :</strong> <?= number_format($fraisPort, 2, ',', ' ') ?> €</p>
        <p><strong>Total TTC :</strong> <?= number_format($totalTTC, 2, ',', ' ') ?> €</p>
    <?php endif; ?>
</body>
</html>
