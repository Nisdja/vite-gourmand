<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";
require_once "../app/models/Commande.php";
require_once "../app/services/MailService.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

if (
    $_SESSION["user"]["role"] !== "employe" &&
    $_SESSION["user"]["role"] !== "administrateur"
) {
    die("Accès interdit.");
}

if (!isset($_GET["id"])) {
    die("Commande introuvable.");
}

$commandeModel = new Commande($pdo);

$commande = $commandeModel->getById((int) $_GET["id"]);

if (!$commande) {
    die("Commande inexistante.");
}

$statuts = [
    "En attente",
    "Acceptée",
    "En préparation",
    "En cours de livraison",
    "Livrée",
    "En attente du retour de matériel",
    "Terminée"
];

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nouveauStatut = $_POST["statut"];
    $commentaire = trim($_POST["commentaire"]);

    if (!in_array($nouveauStatut, $statuts)) {

        $erreur = "Statut invalide.";

    } else {

        // Mise à jour du statut
        $commandeModel->updateStatut(
            $commande["id"],
            $nouveauStatut
        );

        // Historique
        $stmt = $pdo->prepare("
            INSERT INTO historique_statuts
            (commande_id, statut, commentaire)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $commande["id"],
            $nouveauStatut,
            $commentaire
        ]);

        /*
         * Envoi d'un e-mail lorsque la commande est terminée
         */
        if ($nouveauStatut === "Terminée") {

            try {

                $mail = new MailService();

                $mail->envoyerCommandeTerminee([
                    "prenom" => $commande["prenom_client"],
                    "nom" => $commande["nom_client"],
                    "email" => $commande["email_client"]
                ]);

            } catch (Exception $e) {

                error_log(
                    "Erreur lors de l'envoi du mail : " . $e->getMessage()
                );

            }

        }

        header("Location: dashboard.php?status=ok");
        exit();
    }
}

include "../app/views/employee/change_status.php";