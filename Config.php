<?php
try {
    //paramètres 
    $hote = "localhost";
    $utilisateur = "maxime";
    $motDePasse = "maxime"; 
    $nomDeLaBase = "projetDND"; // à changer

    $db = new PDO("mysql:host=$hote;dbname=$nomDeLaBase", $utilisateur, $motDePasse);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die();
}
?>