<?php
require_once __DIR__ . "/../../helpers/session.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vite & Gourmand</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/vite-gourmand/public/assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

    <div class="container">

        <a class="navbar-brand fw-bold" href="/vite-gourmand/public/index.php">
            🍽️ Vite & Gourmand
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/vite-gourmand/public/index.php">
                        Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/vite-gourmand/public/menus.php">
                        Menus
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/vite-gourmand/public/contact.php">
                        Contact
                    </a>
                </li>

                <?php if(isset($_SESSION["user"])): ?>

                    <?php if($_SESSION["user"]["role"] == "administrateur"): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/vite-gourmand/admin/dashboard.php">
                                Administration
                            </a>
                        </li>

                    <?php elseif($_SESSION["user"]["role"] == "employe"): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/vite-gourmand/employee/dashboard.php">
                                Employé
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/vite-gourmand/user/dashboard.php">
                                Mon espace
                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link text-warning" href="/vite-gourmand/public/logout.php">
                            Déconnexion
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/vite-gourmand/public/login.php">
                            Connexion
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/vite-gourmand/public/register.php">
                            Inscription
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>

<div class="container mt-4">