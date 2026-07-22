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

$menuModel = new Menu($pdo);
$themeModel = new Theme($pdo);
$regimeModel = new Regime($pdo);

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

    if ($menuModel->create($data)) {

        header("Location: menus.php");
        exit();

    }

    $erreur = "Impossible d'ajouter le menu.";

}

include "../app/views/employee/create_menu.php";