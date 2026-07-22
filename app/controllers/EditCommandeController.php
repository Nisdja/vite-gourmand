<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

require_once "../app/models/Commande.php";
require_once "../app/models/Menu.php";
require_once "../app/services/CalculPrixService.php";

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

$commande = $commandeModel->getById((int)$_GET["id"]);

if (!$commande) {
    die("Commande inexistante.");
}

/* Vérification propriétaire  */

if ($commande["user_id"] != $user["id"]) {
    die("Accès refusé.");
}

/* Modification uniquement si En attente */

if ($commande["statut"] != "En attente") {
    die("Cette commande ne peut plus être modifiée.");
}

$menu = $menuModel->getById($commande["menu_id"]);

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombrePersonnes = (int)$_POST["nombre_personnes"];

    if ($nombrePersonnes < $menu["nb_personnes_min"]) {

        $erreur = "Le minimum est de ".$menu["nb_personnes_min"]." personnes.";

    } else {

        $calcul = CalculPrixService::calculer(

            $menu["prix"],
            $menu["nb_personnes_min"],
            $nombrePersonnes,
            $_POST["ville"]

        );

        $data = [

            "adresse_livraison" => trim($_POST["adresse"]),
            "ville" => trim($_POST["ville"]),

            "date_prestation" => $_POST["date_prestation"],
            "heure_livraison" => $_POST["heure_livraison"],

            "nombre_personnes" => $nombrePersonnes,

            "prix_menu" => $calcul["prix_menu"],
            "prix_livraison" => $calcul["prix_livraison"],
            "remise" => $calcul["remise"],
            "prix_total" => $calcul["prix_total"]

        ];

        if ($commandeModel->update($commande["id"], $data)) {

            header("Location: ../user/dashboard.php?update=ok");
            exit();

        }

        $erreur = "Impossible de modifier la commande.";

    }

}

include "../app/views/commande/edit.php";