<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/User.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "administrateur") {
    header("Location: ../public/login.php");
    exit();
}

$userModel = new User($pdo);

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$user = $userModel->getById($id);

if (!$user) {
    die("Utilisateur introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [
        "nom" => trim($_POST["nom"]),
        "prenom" => trim($_POST["prenom"]),
        "email" => trim($_POST["email"]),
        "telephone" => trim($_POST["telephone"]),
        "role" => $_POST["role"]
    ];

    $userModel->update($id, $data);

    header("Location: users.php");
    exit();
}

require_once "../app/views/admin/edit_user.php";