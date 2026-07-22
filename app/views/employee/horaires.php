<?php

include __DIR__ . "/../layouts/employee_header.php";

?>

<h1 class="mb-4">

    Gestion des horaires

</h1>

<div class="d-flex justify-content-between mb-3">

    <h4>Liste des horaires</h4>

    <a
        href="/vite-gourmand/employee/create_horaire.php"
        class="btn btn-success">

        + Ajouter un horaire

    </a>

</div>

<?php if (empty($horaires)) : ?>

    <div class="alert alert-warning">

        Aucun horaire enregistré.

    </div>

<?php else : ?>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>

            <th>Jour</th>
            <th>Ouverture</th>
            <th>Fermeture</th>
            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($horaires as $horaire) : ?>

        <tr>

            <td>

                <?= htmlspecialchars($horaire["jour"]) ?>

            </td>

            <td>

                <?= htmlspecialchars($horaire["ouverture"]) ?>

            </td>

            <td>

                <?= htmlspecialchars($horaire["fermeture"]) ?>

            </td>

            <td>

                <a
                    href="#"
                    class="btn btn-warning btn-sm">

                    Modifier

                </a>

                <a
                    href="#"
                    class="btn btn-danger btn-sm">

                    Supprimer

                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </tbody>

</table>

<?php endif; ?>

<?php

include __DIR__ . "/../layouts/employee_footer.php";