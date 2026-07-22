<?php

include __DIR__ . "/../layouts/header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Espace Utilisateur

    </h1>

    <div class="alert alert-success">

        Bienvenue

        <strong>

            <?= htmlspecialchars($user["prenom"]) ?>

            <?= htmlspecialchars($user["nom"]) ?>

        </strong>

    </div>

    <h3 class="mb-4">

        Mes commandes

    </h3>

    <?php if (empty($commandes)) : ?>

        <div class="alert alert-warning">

            Vous n'avez encore effectué aucune commande.

        </div>

    <?php else : ?>

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Menu</th>

                    <th>Date</th>

                    <th>Personnes</th>

                    <th>Prix</th>

                    <th>Statut</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($commandes as $commande) : ?>

                    <tr>

                        <td><?= $commande["id"] ?></td>

                        <td><?= htmlspecialchars($commande["titre"]) ?></td>

                        <td><?= htmlspecialchars($commande["date_prestation"]) ?></td>

                        <td><?= $commande["nombre_personnes"] ?></td>

                        <td><?= number_format($commande["prix_total"], 2, ",", " ") ?> €</td>

                        <td>

                            <span class="badge bg-primary">

                                <?= htmlspecialchars($commande["statut"]) ?>

                            </span>

                        </td>

                        <td>

                            <a
                                href="/vite-gourmand/public/show_commande.php?id=<?= $commande["id"] ?>"
                                class="btn btn-primary btn-sm">

                                Voir

                            </a>

                            <?php if ($commande["statut"] == "En attente") : ?>

                                <a
                                    href="/vite-gourmand/public/edit_commande.php?id=<?= $commande["id"] ?>"
                                    class="btn btn-warning btn-sm">

                                    Modifier

                                </a>

                                <a
                                    href="/vite-gourmand/public/cancel_commande.php?id=<?= $commande["id"] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Voulez-vous vraiment annuler cette commande ?');">

                                    Annuler

                                </a>

                            <?php endif; ?>

                            <?php if ($commande["statut"] == "Terminée") : ?>

                                <a
                                    href="/vite-gourmand/user/avis.php?commande_id=<?= $commande["id"] ?>"
                                    class="btn btn-success btn-sm">

                                    Laisser un avis

                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

<?php

include __DIR__ . "/../layouts/footer.php";

?>