<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

require_once "../app/models/User.php";
require_once "../app/models/Commande.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

if ($_SESSION["user"]["role"] !== "administrateur") {
    die("Accès interdit.");
}

$userModel = new User($pdo);
$commandeModel = new Commande($pdo);

/*
|--------------------------------------------------------------------------
| Statistiques
|--------------------------------------------------------------------------
*/

$nbUtilisateurs = $userModel->countUsers();

$nbEmployes = $userModel->countEmployes();

$nbCommandes = count($commandeModel->getAll());

$resultatCA = $commandeModel->chiffreAffaires();

$ca = (float)($resultatCA["ca"] ?? 0);

$menus = $commandeModel->countByMenu();

require_once "../app/views/admin/dashboard.php";