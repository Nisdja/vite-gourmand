<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Horaire.php";

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

$horaireModel = new Horaire($pdo);

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [

        "jour" => $_POST["jour"],
        "ouverture" => $_POST["ouverture"],
        "fermeture" => $_POST["fermeture"]

    ];

    if ($horaireModel->create($data)) {

        header("Location: horaires.php");
        exit();

    }

    $erreur = "Impossible d'ajouter l'horaire.";
}

include "../app/views/employee/create_horaire.php";