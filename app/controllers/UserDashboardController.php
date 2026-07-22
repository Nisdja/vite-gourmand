<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Commande.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

$user = $_SESSION["user"];

$commandeModel = new Commande($pdo);

$commandes = $commandeModel->getByUser($user["id"]);

include "../app/views/user/dashboard.php";