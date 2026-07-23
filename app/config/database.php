<?php

if (
    $_SERVER["SERVER_NAME"] === "localhost" ||
    $_SERVER["SERVER_NAME"] === "127.0.0.1"
) {

    // Base locale (XAMPP)

    $host = "localhost";
    $dbname = "vite_gourmand";
    $user = "root";
    $password = "";

} else {

    // InfinityFree

    $host = "sql308.infinityfree.com";
    $dbname = "if0_42472749_vite_gourmand";
    $user = "if0_42472749";
    $password = "h97IWMeXXJYs4";

}

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Erreur de connexion à la base de données : " . $e->getMessage());

}