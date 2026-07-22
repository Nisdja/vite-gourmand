<?php

include __DIR__ . "/../layouts/header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Détail de la commande

    </h1>

    <div class="card shadow">

        <div class="card-body">

            <h3>

                <?= htmlspecialchars($menu["titre"]) ?>

            </h3>

            <hr>

            <p>

                <strong>Client :</strong>

                <?= htmlspecialchars($commande["prenom_client"]) ?>

                <?= htmlspecialchars($commande["nom_client"]) ?>

            </p>

            <p>

                <strong>Email :</strong>

                <?= htmlspecialchars($commande["email_client"]) ?>

            </p>

            <p>

                <strong>Téléphone :</strong>

                <?= htmlspecialchars($commande["telephone_client"]) ?>

            </p>

            <hr>

            <p>

                <strong>Adresse :</strong>

                <?= htmlspecialchars($commande["adresse_livraison"]) ?>

            </p>

            <p>

                <strong>Ville :</strong>

                <?= htmlspecialchars($commande["ville"]) ?>

            </p>

            <p>

                <strong>Date :</strong>

                <?= htmlspecialchars($commande["date_prestation"]) ?>

            </p>

            <p>

                <strong>Heure :</strong>

                <?= htmlspecialchars($commande["heure_livraison"]) ?>

            </p>

            <p>

                <strong>Nombre de personnes :</strong>

                <?= $commande["nombre_personnes"] ?>

            </p>

            <hr>

            <table class="table">

                <tr>

                    <td>Prix menu</td>

                    <td class="text-end">

                        <?= number_format($commande["prix_menu"],2,","," ") ?> €

                    </td>

                </tr>

                <tr>

                    <td>Livraison</td>

                    <td class="text-end">

                        <?= number_format($commande["prix_livraison"],2,","," ") ?> €

                    </td>

                </tr>

                <tr>

                    <td>Remise</td>

                    <td class="text-end text-danger">

                        - <?= number_format($commande["remise"],2,","," ") ?> €

                    </td>

                </tr>

                <tr class="table-success">

                    <th>Total</th>

                    <th class="text-end">

                        <?= number_format($commande["prix_total"],2,","," ") ?> €

                    </th>

                </tr>

            </table>

            <p>

                <strong>Statut actuel :</strong>

                <span class="badge bg-primary">

                    <?= htmlspecialchars($commande["statut"]) ?>

                </span>

            </p>

            <hr>

            <h4 class="mt-4">

                Historique des statuts

            </h4>

            <?php if (!empty($historique)) : ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr>

                                <th>Date</th>

                                <th>Statut</th>

                                <th>Commentaire</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($historique as $ligne) : ?>

                                <tr>

                                    <td>

                                        <?= date("d/m/Y H:i", strtotime($ligne["created_at"])) ?>

                                    </td>

                                    <td>

                                        <span class="badge bg-success">

                                            <?= htmlspecialchars($ligne["statut"]) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?=
                                        !empty($ligne["commentaire"])
                                            ? nl2br(htmlspecialchars($ligne["commentaire"]))
                                            : "<em>Aucun commentaire</em>"
                                        ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else : ?>

                <div class="alert alert-info">

                    Aucun historique disponible.

                </div>

            <?php endif; ?>

            <a
                href="/vite-gourmand/user/dashboard.php"
                class="btn btn-secondary mt-3">

                Retour

            </a>

        </div>

    </div>

</div>

<?php

include __DIR__ . "/../layouts/footer.php";

?>