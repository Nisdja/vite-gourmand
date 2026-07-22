<?php

require_once __DIR__ . "/../../helpers/session.php";

include __DIR__ . "/../layouts/header.php";

?>

<div class="container">

    <h1 class="text-center mb-5">
        Nos Menus
    </h1>

    <?php if (empty($menus)) : ?>

        <div class="alert alert-warning text-center">
            Aucun menu disponible.
        </div>

    <?php else : ?>

        <div class="row">

            <?php foreach ($menus as $menu) : ?>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card shadow h-100">

                        <div class="card-body d-flex flex-column">

                            <h4 class="card-title">
                                <?= htmlspecialchars($menu["titre"]) ?>
                            </h4>

                            <p class="card-text">
                                <?= htmlspecialchars($menu["description"]) ?>
                            </p>

                            <hr>

                            <p>
                                <strong>Thème :</strong>
                                <?= htmlspecialchars($menu["theme"]) ?>
                            </p>

                            <p>
                                <strong>Régime :</strong>
                                <?= htmlspecialchars($menu["regime"]) ?>
                            </p>

                            <p>
                                <strong>Minimum :</strong>
                                <?= $menu["nb_personnes_min"] ?> personnes
                            </p>

                            <p class="fs-4 text-success fw-bold">
                                <?= number_format($menu["prix"], 2, ",", " ") ?> €
                            </p>

                            <div class="mt-auto">

                                <a
                                    href="/vite-gourmand/public/show_menu.php?id=<?= $menu["id"] ?>"
                                    class="btn btn-primary w-100">

                                    Voir le menu

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<?php

include __DIR__ . "/../layouts/footer.php";

?>