<?php

include __DIR__ . "/../layouts/employee_header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Espace Employé

    </h1>

    <div class="alert alert-info">

        Bienvenue

        <strong>

            <?= htmlspecialchars($user["prenom"]) ?>

            <?= htmlspecialchars($user["nom"]) ?>

        </strong>

    </div>

<form method="GET" class="row mb-4">

    <div class="col-md-4">

        <select
            name="statut"
            class="form-select">

            <option value="">
                Tous les statuts
            </option>

            <?php

            $listeStatuts = [

                "En attente",
                "Acceptée",
                "En préparation",
                "En cours de livraison",
                "Livrée",
                "En attente du retour de matériel",
                "Terminée"

            ];

            foreach($listeStatuts as $s):

            ?>

                <option
                    value="<?= $s ?>"
                    <?= ($statut==$s) ? "selected" : "" ?>>

                    <?= $s ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-4">

        <input
            type="text"
            name="client"
            class="form-control"
            placeholder="Nom ou prénom du client"
            value="<?= htmlspecialchars($client) ?>">

    </div>

    <div class="col-md-4">

        <button
            class="btn btn-primary">

            Filtrer

        </button>

        <a
            href="dashboard.php"
            class="btn btn-secondary">

            Réinitialiser

        </a>

    </div>

</form>

    <h3 class="mb-4">

        Toutes les commandes

    </h3>

    <?php if (empty($commandes)) : ?>

        <div class="alert alert-warning">

            Aucune commande.

        </div>

    <?php else : ?>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Client</th>

                    <th>Menu</th>

                    <th>Date</th>

                    <th>Personnes</th>

                    <th>Total</th>

                    <th>Statut</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($commandes as $commande) : ?>

                    <tr>

                        <td><?= $commande["id"] ?></td>

                        <td>

                            <?= htmlspecialchars($commande["prenom_client"]) ?>

                            <?= htmlspecialchars($commande["nom_client"]) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($commande["titre"]) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($commande["date_prestation"]) ?>

                        </td>

                        <td>

                            <?= $commande["nombre_personnes"] ?>

                        </td>

                        <td>

                            <?= number_format($commande["prix_total"], 2, ",", " ") ?> €

                        </td>

                        <td>

                            <span class="badge bg-primary">

                                <?= htmlspecialchars($commande["statut"]) ?>

                            </span>

                        </td>

                        <td>

                            <a
                                href="/vite-gourmand/public/show_commande.php?id=<?= $commande["id"] ?>"
                                class="btn btn-sm btn-primary">

                                Voir

                            </a>

                      <a
                            href="/vite-gourmand/employee/change_status.php?id=<?= $commande["id"] ?>"
                            class="btn btn-success btn-sm">

                            Statut

                        </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

<?php

include __DIR__ . "/../layouts/employee_footer.php";