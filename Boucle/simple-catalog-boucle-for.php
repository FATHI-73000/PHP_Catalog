
<?php
$products = ["iphone", "ipad", "iMac"];
sort($products); // Trie le tableau par ordre alphabétique (sensible à la casse)

for ($i = 0; $i < count($products); $i++) {
    if ($i == 0) {
        echo "Premier produit : " . $products[$i] . "<br>";
    }

    if ($i == 2){
        echo "Dernier produit : " . $products[$i] . "<br>";
    }
}
?>