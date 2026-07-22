<?php

require_once "../app/config/database.php";
require_once "../app/models/Menu.php";

if (!isset($_GET["id"])) {

    die("Menu introuvable");

}

$model = new Menu($pdo);

$menu = $model->getById($_GET["id"]);

if (!$menu) {

    die("Menu inexistant");

}

$plats = $model->getPlats($_GET["id"]);

$images = $model->getImages($_GET["id"]);

include "../app/views/menu/show.php";