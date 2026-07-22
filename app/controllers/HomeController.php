<?php

require_once "../app/config/database.php";
require_once "../app/models/Menu.php";
require_once "../app/models/Avis.php";

$menuModel = new Menu($pdo);
$avisModel = new Avis($pdo);

$menus = $menuModel->getAll();
$avis = $avisModel->getAvisValides();

include "../app/views/home.php";