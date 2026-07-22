<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

require_once "../app/models/Menu.php";

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
    die("Menu introuvable.");
}

$menuModel = new Menu($pdo);

$menu = $menuModel->getById((int)$_GET["id"]);

if (!$menu) {
    die("Menu inexistant.");
}

$menuModel->delete($menu["id"]);

header("Location: menus.php");
exit();