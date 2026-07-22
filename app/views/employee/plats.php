<?php

include __DIR__ . "/../layouts/employee_header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Gestion des plats

    </h1>

    <div class="d-flex justify-content-between mb-3">

        <h4>Liste des plats</h4>

        <a
            href="/vite-gourmand/employee/create_plat.php"
            class="btn btn-success">

            + Ajouter un plat

        </a>

    </div>

    <?php if (empty($plats)) : ?>

        <div class="alert alert-warning">

            Aucun plat trouvé.

        </div>

    <?php else : ?>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($plats as $plat) : ?>

                    <tr>

                        <td><?= $plat["id"] ?></td>

                        <td><?= htmlspecialchars($plat["nom"]) ?></td>

                        <td><?= htmlspecialchars($plat["description"]) ?></td>

                        <td><?= htmlspecialchars($plat["type"]) ?></td>

                        <td>

                            <a
                                href="/vite-gourmand/employee/edit_plat.php?id=<?= $plat["id"] ?>"
                                class="btn btn-warning btn-sm">

                                Modifier

                            </a>

                       <a
                            href="/vite-gourmand/employee/delete_plat.php?id=<?= $plat["id"] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Voulez-vous vraiment supprimer ce plat ?');">

                            Supprimer

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