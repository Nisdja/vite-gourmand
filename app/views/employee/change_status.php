<?php

include __DIR__ . "/../layouts/employee_header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Modifier le statut d'une commande

    </h1>

    <?php if (!empty($erreur)) : ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($erreur) ?>

        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <h4>

                Commande n°<?= $commande["id"] ?>

            </h4>

            <p>

                <strong>Client :</strong>

                <?= htmlspecialchars($commande["prenom_client"]) ?>

                <?= htmlspecialchars($commande["nom_client"]) ?>

            </p>

            <p>

                <strong>Statut actuel :</strong>

                <span class="badge bg-primary">

                    <?= htmlspecialchars($commande["statut"]) ?>

                </span>

            </p>

            <hr>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">

                        Nouveau statut

                    </label>

                    <select
                        name="statut"
                        class="form-select"
                        required>

                        <?php foreach ($statuts as $statut) : ?>

                            <option
                                value="<?= $statut ?>"
                                <?= $statut == $commande["statut"] ? "selected" : "" ?>>

                                <?= $statut ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Commentaire

                    </label>

                    <textarea
                        name="commentaire"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <button
                    class="btn btn-success">

                    Enregistrer

                </button>

                <a
                    href="/vite-gourmand/employee/dashboard.php"
                    class="btn btn-secondary">

                    Retour

                </a>

            </form>

        </div>

    </div>

</div>

<?php

include __DIR__ . "/../layouts/employee_footer.php";