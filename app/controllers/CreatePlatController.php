<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Plat.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

if (
    $_SESSION["user"]["role"] !== "employe" &&
    $_SESSION["user"]["role"] !== "administrateur"
) {
    die("Accès interdit.");
}

$platModel = new Plat($pdo);

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [

        "nom" => trim($_POST["nom"]),
        "description" => trim($_POST["description"]),
        "type" => $_POST["type"]

    ];

    if ($platModel->create($data)) {

        header("Location: plats.php");
        exit();

    }

    $erreur = "Impossible d'ajouter le plat.";

}

include "../app/views/employee/create_plat.php";