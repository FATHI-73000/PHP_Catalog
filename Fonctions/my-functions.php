<?php

function formatprice($priceInCents){ //  Fonction pour formater le prix
    $priceInEuros= $priceInCents/100; // conversion en Euros
    return number_format($priceInEuros, 2, ',',  ' ') . '€' ; // formatage du prix avec deux décimales

}






function priceExcludingVat($priceInCents, $vatRate=20){ // Fonction pour calculer le prix hors TVA

    $priceExcludingVat = $priceInCents / (1 + ($vatRate / 100)); // calcul du prix hors TVA
    return formatprice($priceExcludingVat); // formatage du prix avec deux décimales

}



function discountedPrice($priceInCents, $discount){ // Fpnction pour calculer le prix avec remise
    $discountedPrice = $priceInCents - ($priceInCents * $discount / 100); // calcul du prix avec remise
    return formatprice($discountedPrice); // formatage du prix avec deux décimales
}



echo formatprice(1000); // Affiche 10,00€

echo priceExcludingVat(1000); 
?>

