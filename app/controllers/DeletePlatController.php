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

if (!isset($_GET["id"])) {
    die("Plat introuvable.");
}

$platModel = new Plat($pdo);

$plat = $platModel->getById((int) $_GET["id"]);

if (!$plat) {
    die("Plat inexistant.");
}

$platModel->delete($plat["id"]);

header("Location: plats.php");
exit();