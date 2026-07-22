<?php

require_once "../app/config/database.php";

$token = $_GET["token"] ?? "";

if (empty($token)) {
    die("Lien invalide.");
}

$stmt = $pdo->prepare("
    SELECT id, nom, prenom, email,
           reset_token,
           reset_token_expiration
    FROM users
    WHERE reset_token = ?
");

$stmt->execute([$token]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Lien invalide.");
}

if (strtotime($user["reset_token_expiration"]) < time()) {
    die("Ce lien de réinitialisation a expiré.");
}

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if (strlen($password) < 8) {

        $erreur = "Le mot de passe doit contenir au moins 8 caractères.";

    } elseif ($password !== $confirm) {

        $erreur = "Les deux mots de passe sont différents.";

    } else {

        $stmt = $pdo->prepare("
            UPDATE users
            SET password = ?,
                reset_token = NULL,
                reset_token_expiration = NULL
            WHERE id = ?
        ");

        $stmt->execute([
            password_hash($password, PASSWORD_DEFAULT),
            $user["id"]
        ]);

        header("Location: login.php?reset=success");
        exit();

    }

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Réinitialisation du mot de passe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-danger text-white">

                    <h3 class="mb-0">
                        Nouveau mot de passe
                    </h3>

                </div>

                <div class="card-body">

                    <?php if (!empty($erreur)) : ?>

                        <div class="alert alert-danger">

                            <?= htmlspecialchars($erreur) ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Nouveau mot de passe

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                                minlength="8">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Confirmer le mot de passe

                            </label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                required
                                minlength="8">

                        </div>

                        <button
                            class="btn btn-danger w-100">

                            Modifier mon mot de passe

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>