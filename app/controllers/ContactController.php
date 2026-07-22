<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../public/contact.php");
    exit();
}

$titre = trim($_POST["titre"]);
$email = trim($_POST["email"]);
$message = trim($_POST["message"]);

/*
 * Ici tu pourras plus tard utiliser PHPMailer.
 * Pour le rendu, on valide simplement le formulaire.
 */

header("Location: ../public/contact.php?success=1");
exit();