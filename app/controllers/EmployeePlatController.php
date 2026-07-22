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

$user = $_SESSION["user"];

$platModel = new Plat($pdo);

$plats = $platModel->getAll();

include "../app/views/employee/plats.php";