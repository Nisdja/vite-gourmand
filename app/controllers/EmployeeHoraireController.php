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

$user = $_SESSION["user"];

$horaireModel = new Horaire($pdo);

$horaires = $horaireModel->getAll();

include "../app/views/employee/horaires.php";