<?php

include __DIR__ . "/../layouts/employee_header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Gestion des menus

    </h1>

    <div class="d-flex justify-content-between mb-3">

        <h4>Liste des menus</h4>

        <a
            href="/vite-gourmand/employee/create_menu.php"
            class="btn btn-success">

            + Ajouter un menu

        </a>

    </div>

    <?php if (empty($menus)) : ?>

        <div class="alert alert-warning">

            Aucun menu.

        </div>

    <?php else : ?>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Titre</th>
                    <th>Thème</th>
                    <th>Régime</th>
                    <th>Minimum</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($menus as $menu) : ?>

                    <tr>

                        <td><?= $menu["id"] ?></td>

                        <td><?= htmlspecialchars($menu["titre"]) ?></td>

                        <td><?= htmlspecialchars($menu["theme"]) ?></td>

                        <td><?= htmlspecialchars($menu["regime"]) ?></td>

                        <td><?= $menu["nb_personnes_min"] ?></td>

                        <td><?= number_format($menu["prix"], 2, ",", " ") ?> €</td>

                        <td><?= $menu["stock"] ?></td>

                        <td>

                            <a
                                href="/vite-gourmand/employee/edit_menu.php?id=<?= $menu["id"] ?>"
                                class="btn btn-warning btn-sm">

                                Modifier

                            </a>

                        <a
                            href="/vite-gourmand/employee/delete_menu.php?id=<?= $menu["id"] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Voulez-vous vraiment supprimer ce menu ?');">

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