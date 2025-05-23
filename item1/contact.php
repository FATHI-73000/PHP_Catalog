<?php
$title = "Contact - MonSiteWeb";
$metaDescription = "Page de contact pour joindre notre équipe.";
include('header.php');
?>

<main>
    <h1>Contactez-nous</h1>
    <form>
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email"><br><br>
        <input type="submit" value="Envoyer">
    </form>
</main>

