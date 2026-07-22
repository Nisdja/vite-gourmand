<?php

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ? AND actif = 1";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user"] = $user;

        switch ($user["role"]) {

            case "administrateur":
                header("Location: ../admin/dashboard.php");
                break;

            case "employe":
                header("Location: ../employee/dashboard.php");
                break;

            default:
                header("Location: ../user/dashboard.php");
                break;
        }

        exit();
    }

    $erreur = "Email ou mot de passe incorrect.";
}

?>

<!doctype html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Connexion</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">

                        Connexion

                    </h2>

                    <?php if ($erreur): ?>

                        <div class="alert alert-danger">

                            <?= $erreur ?>

                        </div>

                    <?php endif; ?>

                    <form method="post">

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Mot de passe</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            class="btn btn-primary w-100">

                            Se connecter

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <a href="forgot_password.php">

                            Mot de passe oublié ?

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>