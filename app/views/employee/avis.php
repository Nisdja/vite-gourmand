<?php require_once __DIR__ . '/../layouts/employee_header.php'; ?>

<div class="container mt-4">

    <h1>Gestion des avis</h1>

    <?php if (empty($avis)) : ?>

        <div class="alert alert-info">
            Aucun avis disponible.
        </div>

    <?php else : ?>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Client</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($avis as $a) : ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($a["prenom"] . " " . $a["nom"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($a["note"]) ?>/5
                    </td>

                    <td>
                        <?= nl2br(htmlspecialchars($a["commentaire"])) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($a["created_at"]) ?>
                    </td>

                    <td>

                        <?php if ($a["valide"]) : ?>

                            <span class="badge bg-success">
                                Validé
                            </span>

                        <?php else : ?>

                            <span class="badge bg-warning text-dark">
                                En attente
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <?php if (!$a["valide"]) : ?>

                            <a href="/vite-gourmand/employee/valider_avis.php?id=<?= $a["id"] ?>"
                               class="btn btn-success btn-sm">
                                Valider
                            </a>

                            <a href="/vite-gourmand/employee/refuser_avis.php?id=<?= $a["id"] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cet avis ?');">
                                Refuser
                            </a>

                        <?php else : ?>

                            —

                        <?php endif; ?>

                    </td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../layouts/employee_footer.php'; ?>