<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/User.php";

/* Vérification de la connexion administrateur */

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "administrateur") {
    header("Location: ../public/login.php");
    exit();
}

$userModel = new User($pdo);

/* Récupération de l'utilisateur */

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($id <= 0) {
    header("Location: users.php");
    exit();
}

$user = $userModel->getById($id);

if (!$user) {
    header("Location: users.php");
    exit();
}

/* Empêche la désactivation de son propre compte */

if ($id === (int)$_SESSION["user"]["id"]) {

    header("Location: users.php?error=self");

    exit();
}

/* Désactivation du compte */

if ($user["actif"] == 1) {

    $userModel->deactivate($id);

    header("Location: users.php?success=deactivate");

    exit();
}

/* Réactivation du compte */

$userModel->reactivate($id);

header("Location: users.php?success=reactivate");
exit();