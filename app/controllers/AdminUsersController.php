<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/User.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

if ($_SESSION["user"]["role"] !== "administrateur") {
    die("Accès interdit.");
}

$userModel = new User($pdo);

$users = $userModel->getUsers();

require_once "../app/views/admin/users.php";