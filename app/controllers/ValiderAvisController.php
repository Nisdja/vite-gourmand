<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Avis.php";

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

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: ../employee/avis.php");
    exit();
}

$avisModel = new Avis($pdo);
$avisModel->valider((int) $_GET["id"]);

header("Location: ../employee/avis.php");
exit();