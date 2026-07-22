<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

require_once "../app/models/Commande.php";
require_once "../app/models/Menu.php";
require_once "../app/models/HistoriqueStatut.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    die("Commande introuvable.");
}

$user = $_SESSION["user"];

$commandeModel = new Commande($pdo);
$menuModel = new Menu($pdo);
$historiqueModel = new HistoriqueStatut($pdo);

$commande = $commandeModel->getById((int)$_GET["id"]);

if (!$commande) {
    die("Commande inexistante.");
}

/* Sécurité */

if (
    $_SESSION["user"]["role"] == "utilisateur"
    && $commande["user_id"] != $_SESSION["user"]["id"]
) {
    die("Accès refusé.");
}

$menu = $menuModel->getById($commande["menu_id"]);

$historique = $historiqueModel->getByCommande($commande["id"]);

include "../app/views/commande/show.php";