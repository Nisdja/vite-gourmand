<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/User.php";
require_once "../app/services/MailService.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "administrateur") {
    header("Location: ../public/login.php");
    exit();
}

$userModel = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $motDePasse = $_POST["password"];

    $data = [
        "nom"        => trim($_POST["nom"]),
        "prenom"     => trim($_POST["prenom"]),
        "email"      => trim($_POST["email"]),
        "telephone"  => trim($_POST["telephone"]),
        "password"   => password_hash($motDePasse, PASSWORD_DEFAULT),
        "role"       => $_POST["role"]
    ];

    if ($userModel->create($data)) {

        // Envoi d'un e-mail uniquement pour les employés
        if ($data["role"] === "employe") {

            try {

                $mail = new MailService();

                $mail->envoyerCreationEmploye(
                    [
                        "nom" => $data["nom"],
                        "prenom" => $data["prenom"],
                        "email" => $data["email"]
                    ],
                    $motDePasse
                );

            } catch (Exception $e) {

                error_log(
                    "Erreur lors de l'envoi de l'e-mail : " . $e->getMessage()
                );

            }

        }

        // Redirection selon le rôle
        if ($data["role"] === "employe") {
            header("Location: employes.php?success=1");
        } else {
            header("Location: users.php?success=1");
        }

        exit();

    } else {

        $erreur = "Erreur lors de la création de l'utilisateur.";

    }
}

require_once "../app/views/admin/create_user.php";