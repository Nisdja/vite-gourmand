<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../helpers/session.php";

require_once __DIR__ . "/../models/Commande.php";

if (
    !isset($_SESSION["user"]) ||
    $_SESSION["user"]["role"] !== "administrateur"
) {
    header("Location: ../public/login.php");
    exit();
}

$commandeModel = new Commande($pdo);

/*Liste des commandes*/

$statut = $_GET["statut"] ?? null;
$client = trim($_GET["client"] ?? "");

if ($statut === "") {
    $statut = null;
}

if ($client === "") {
    $client = null;
}

if ($statut || $client) {

    $commandes = $commandeModel->filter(
        $statut,
        $client
    );

} else {

    $commandes = $commandeModel->getAll();

}

/*Affichage du détail*/

$commande = null;
$historique = [];

if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $commande = $commandeModel->getById($id);

    if (!$commande) {

        die("Commande introuvable.");

    }

    $historique = $commandeModel->getHistorique($id);

}

/*Changement de statut*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = (int) $_POST["id"];

    $statut = trim($_POST["statut"]);

    $statutsAutorises = [

        "En attente",
        "Accepté",
        "En préparation",
        "En cours de livraison",
        "Livré",
        "En attente du retour de matériel",
        "Terminée",
        "Annulée"

    ];

    if (!in_array($statut, $statutsAutorises)) {

        die("Statut invalide.");

    }

    if (!$commandeModel->updateStatut($id, $statut)) {

        die("Impossible de modifier le statut.");

    }

    /*Historique*/

    $stmt = $pdo->prepare(
        "
        INSERT INTO historique_statuts
        (
            commande_id,
            statut
        )
        VALUES
        (
            ?,
            ?
        )
        "
    );

    $stmt->execute([
        $id,
        $statut
    ]);

    /*Si la commande est terminée*/

    if ($statut === "Terminée") {


    }

    /*Si la commande est annulée*/

    if ($statut === "Annulée") {

    }

    header("Location: detail_commande.php?id=" . $id . "&success=statut");

    exit();
}

/*Chargement des vues*/

if ($commande !== null) {

    require_once __DIR__ . "/../views/admin/detail_commande.php";

} else {

    require_once __DIR__ . "/../views/admin/commandes.php";

}