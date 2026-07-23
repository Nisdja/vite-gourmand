<?php

require_once "../app/config/database.php";
require_once "../app/models/Menu.php";
require_once "../app/models/Theme.php";
require_once "../app/models/Regime.php";

$model = new Menu($pdo);

$themeModel = new Theme($pdo);
$regimeModel = new Regime($pdo);

$menus = $model->getAll();

$themes = $themeModel->getAll();
$regimes = $regimeModel->getAll();

include "../app/views/menu/index.php";