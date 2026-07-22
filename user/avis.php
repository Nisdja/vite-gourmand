<?php

require_once "../app/helpers/session.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../public/login.php");
    exit();
}

$commande_id = isset($_GET["commande_id"]) ? (int)$_GET["commande_id"] : 0;

if ($commande_id <= 0) {
    header("Location: ../public/user/dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laisser un avis</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">Laisser un avis</h3>

                </div>

                <div class="card-body">

                    <form action="../app/controllers/CreateAvisController.php" method="POST">

                        <input
                            type="hidden"
                            name="commande_id"
                            value="<?= $commande_id ?>">

                        <div class="mb-3">

                            <label class="form-label">

                                Note

                            </label>

                            <select
                                name="note"
                                class="form-select"
                                required>

                                <option value="">-- Choisir une note --</option>

                                <option value="1">⭐ 1</option>
                                <option value="2">⭐⭐ 2</option>
                                <option value="3">⭐⭐⭐ 3</option>
                                <option value="4">⭐⭐⭐⭐ 4</option>
                                <option value="5">⭐⭐⭐⭐⭐ 5</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Commentaire

                            </label>

                            <textarea
                                name="commentaire"
                                class="form-control"
                                rows="5"
                                maxlength="1000"
                                required></textarea>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a
                                href="../public/user/dashboard.php"
                                class="btn btn-secondary">

                                Retour

                            </a>

                            <button
                                type="submit"
                                class="btn btn-success">

                                Envoyer l'avis

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>