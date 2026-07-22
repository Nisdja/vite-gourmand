<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../helpers/session.php";
require_once __DIR__ . "/../models/Avis.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../../public/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../user/dashboard.php");
    exit();
}

if (
    !isset($_POST["commande_id"]) ||
    !isset($_POST["note"]) ||
    !isset($_POST["commentaire"])
) {
    header("Location: ../../user/dashboard.php");
    exit();
}

$commande_id = (int) $_POST["commande_id"];
$user_id = (int) $_SESSION["user"]["id"];
$note = (int) $_POST["note"];
$commentaire = trim($_POST["commentaire"]);

$data = [
    "commande_id" => $commande_id,
    "user_id" => $user_id,
    "note" => $note,
    "commentaire" => $commentaire
];

$avisModel = new Avis($pdo);

try {

    $avisModel->create($data);

    header("Location: ../../user/dashboard.php?avis=ok");
    exit();

} catch (PDOException $e) {

    die("Erreur : " . $e->getMessage());

}