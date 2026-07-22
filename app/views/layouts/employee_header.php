<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header("Location: /vite-gourmand/public/login.php");
    exit();
}

$user = $_SESSION["user"];

?>

<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vite Gourmand - Employé</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container-fluid">

        <a class="navbar-brand"
           href="/vite-gourmand/employee/dashboard.php">

            🍽 Vite Gourmand

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse"
            id="menu">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/vite-gourmand/employee/dashboard.php">

                        📦 Commandes

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/vite-gourmand/employee/menus.php">

                        🍽 Menus

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/vite-gourmand/employee/plats.php">

                        🥗 Plats

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/vite-gourmand/employee/horaires.php">

                        🕒 Horaires

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/vite-gourmand/employee/avis.php">

                        ⭐ Avis

                    </a>

                </li>

            </ul>

            <span class="navbar-text me-3">

                Bonjour

                <strong>

                    <?= htmlspecialchars($user["prenom"]) ?>

                </strong>

            </span>

            <a
                href="/vite-gourmand/public/logout.php"
                class="btn btn-outline-light">

                Déconnexion

            </a>

        </div>

    </div>

</nav>

<div class="container mt-4">