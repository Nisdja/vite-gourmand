<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Commande.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

if ($_SESSION["user"]["role"] !== "employe" && $_SESSION["user"]["role"] !== "administrateur") {
    die("Accès interdit.");
}

$user = $_SESSION["user"];

$commandeModel = new Commande($pdo);

$statut = $_GET["statut"] ?? "";
$client = trim($_GET["client"] ?? "");

if ($statut || $client) {

    $commandes = $commandeModel->filter(
        $statut,
        $client
    );

} else {

    $commandes = $commandeModel->getAll();

}

include "../app/views/employee/dashboard.php";