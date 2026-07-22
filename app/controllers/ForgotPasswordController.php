<?php

require_once "../app/config/database.php";
require_once "../app/services/MailService.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../public/forgot_password.php");
    exit();
}

$email = trim($_POST["email"]);

$stmt = $pdo->prepare("
    SELECT id, nom, prenom, email
    FROM users
    WHERE email = ?
");

$stmt->execute([$email]);

$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if ($utilisateur) {

    // Génération d'un token
    $token = bin2hex(random_bytes(32));

    // Date d'expiration (1 heure)
    $expiration = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Enregistrement en base
    $stmt = $pdo->prepare("
        UPDATE users
        SET reset_token = ?, reset_token_expiration = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $token,
        $expiration,
        $utilisateur["id"]
    ]);

    // Lien de réinitialisation
    $lien = "http://localhost/vite-gourmand/public/reset_password.php?token=" . $token;

    try {

        $mail = new MailService();

        $mail->envoyerReinitialisationMotDePasse(
            $utilisateur,
            $lien
        );

    } catch (Exception $e) {

        error_log(
            "Erreur envoi mail : " . $e->getMessage()
        );

    }

}

header("Location: ../public/forgot_password.php?success=1");
exit();