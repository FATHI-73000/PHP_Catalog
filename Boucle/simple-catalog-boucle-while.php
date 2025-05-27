<?php
$products = [ "iphone", "ipad", "iMac"];  
sort($products);  // Trie : [ "iMac", "ipad", "iphone" ] tenir compte  de la casse (les majuscules avant les minuscules). natcasesort() : trie de manière insensible à la casse,
$i = 0;
while($i<1){
echo " Premier produit : ". $products[0]. "<br>";   // Affiche "iMac"
echo " dernier produit :". $products[2];  // Affiche "iphone"
$i++;
}
?>