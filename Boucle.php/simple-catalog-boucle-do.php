<?php
$products = [ "iphone", "ipad", "iMac"];  
sort($products);  // Trie : [ "iMac", "ipad", "iphone" ] tenir compte  de la casse (les majuscules avant les minuscules). natcasesort() : trie de manière insensible à la casse,
$i = 0;
do{

if ($i == 0){

echo " Premier produit : ". $products[0]. "<br>";   // Affiche "iMac"

}

if($i == 2){

echo " dernier produit :". $products[2].  "<br>";   // Affiche "iphone"

}
$i++;
}

while ($i<3);
?>

