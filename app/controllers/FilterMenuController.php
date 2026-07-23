<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Menu.php";

header("Content-Type: application/json");

$model = new Menu($pdo);

$theme = !empty($_GET["theme"]) ? trim($_GET["theme"]) : null;
$regime = !empty($_GET["regime"]) ? trim($_GET["regime"]) : null;
$prixMax = !empty($_GET["prixMax"]) ? (float) $_GET["prixMax"] : null;

$menus = $model->filter(
    $theme,
    $regime,
    $prixMax
);

echo json_encode($menus);