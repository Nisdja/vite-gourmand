<?php

require_once "../app/config/database.php";
require_once "../app/models/Menu.php";

$model = new Menu($pdo);

$menus = $model->getAll();

include "../app/views/menu/index.php";