<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Commande.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    die("Commande introuvable.");
}

$commandeModel = new Commande($pdo);

$commande = $commandeModel->getById((int)$_GET["id"]);

if (!$commande) {
    die("Commande inexistante.");
}

/*
|--------------------------------------------------------------------------
| Sécurité
|--------------------------------------------------------------------------
*/

if ($commande["user_id"] != $_SESSION["user"]["id"]) {
    die("Accès refusé.");
}

/*
|--------------------------------------------------------------------------
| Annulation uniquement si En attente
|--------------------------------------------------------------------------
*/

if ($commande["statut"] != "En attente") {
    die("Cette commande ne peut plus être annulée.");
}

/*
|--------------------------------------------------------------------------
| Suppression
|--------------------------------------------------------------------------
*/

$commandeModel->delete($commande["id"]);

header("Location: ../user/dashboard.php?cancel=ok");
exit();