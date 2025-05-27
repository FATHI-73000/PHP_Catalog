<?php
$products = [ "iphone", "ipad", "iMac"];  
sort($products);  // Trie : [ "iMac", "ipad", "iphone" ] tenir compte  de la casse (les majuscules avant les minuscules). natcasesort() : trie de manière insensible à la casse,

for ($product = 0; $product<=3; $product++){

echo " Premier produit : ". $products[0]; // Affiche "iMac"
echo " dernier produit :". $products[2];  // Affiche "iphone"
}



<?php
function sayMyName($firstName, $lastName) {
    return "Bonjour, je m'appelle " . $firstName . " " . $lastName . "<br>";
}

// On affiche le résultat de la fonction avec echo
echo sayMyName('Alex', 'De Pem');

