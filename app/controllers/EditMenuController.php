<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

require_once "../app/models/Menu.php";
require_once "../app/models/Theme.php";
require_once "../app/models/Regime.php";

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
$themeModel = new Theme($pdo);
$regimeModel = new Regime($pdo);

$menu = $menuModel->getById((int)$_GET["id"]);

if (!$menu) {
    die("Menu inexistant.");
}

$themes = $themeModel->getAll();
$regimes = $regimeModel->getAll();

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [

        "titre" => trim($_POST["titre"]),
        "description" => trim($_POST["description"]),
        "theme_id" => $_POST["theme_id"],
        "regime_id" => $_POST["regime_id"],
        "nb_personnes_min" => $_POST["nb_personnes_min"],
        "prix" => $_POST["prix"],
        "conditions_menu" => trim($_POST["conditions_menu"]),
        "stock" => $_POST["stock"]

    ];

    if ($menuModel->update($menu["id"], $data)) {

        header("Location: menus.php");
        exit();

    }

    $erreur = "Impossible de modifier le menu.";
}

include "../app/views/employee/edit_menu.php";