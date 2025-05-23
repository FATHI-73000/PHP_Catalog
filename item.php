<?php


include_once  " item1.php";
// Définition des variables
$nom = "T-shirt élégant Blanc";
$prix = 49.00; // Prix en EUR
$image_url = "https://www.ateliertuffery.com/products/t-shirt-homme-100-coton-bio-ecru"; // URL de l'image de l'article// Formatage du prix
$prix_formate = number_format($prix, 2, ',', ' '); // Formatage du prix avec deux décimales
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .article-container {
            width: 300px;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            background-color: #F9F9F9
;
        }
        .article-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .article-container h1 {
            font-size: 1.5em;
            color: #333;
        }
        .article-container p {
            font-size: 1em;
            color: #555;
        }
        .article-container .price {
            color: #E74C3C
;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="article-container">
        <h1>Article: <?php echo $nom; ?></h1>
        <img src="<?php echo $image_url; ?>" alt="Image de l'article">
        <p>Prix: <span class="price"><?php echo $prix_formate; ?> EUR</span></p>
    </div>
</body>
<?php include_once item1.php; ?>
</html>