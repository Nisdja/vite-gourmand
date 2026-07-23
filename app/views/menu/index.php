<?php

require_once __DIR__ . "/../../helpers/session.php";

include __DIR__ . "/../layouts/header.php";

?>

<div class="container">

    <h1 class="text-center mb-5">
        Nos Menus
    </h1>

    <div class="row mb-4">

        <div class="col-md-4 mb-3">

            <label for="theme" class="form-label">
                Thème
            </label>

            <select
                id="theme"
                class="form-select">

                <option value="">
                    Tous les thèmes
                </option>

                <?php foreach ($themes as $theme) : ?>

                    <option
                        value="<?= htmlspecialchars($theme["nom"]) ?>">

                        <?= htmlspecialchars($theme["nom"]) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="col-md-4 mb-3">

            <label for="regime" class="form-label">
                Régime
            </label>

            <select
                id="regime"
                class="form-select">

                <option value="">
                    Tous les régimes
                </option>

                <?php foreach ($regimes as $regime) : ?>

                    <option
                        value="<?= htmlspecialchars($regime["nom"]) ?>">

                        <?= htmlspecialchars($regime["nom"]) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="col-md-4 mb-3">

            <label for="prixMax" class="form-label">
                Prix maximum
            </label>

            <input
                type="number"
                class="form-control"
                id="prixMax"
                placeholder="Ex : 25">

        </div>

    </div>

    <div
        id="menus-container"
        class="row">

        <?php if (empty($menus)) : ?>

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    Aucun menu disponible.

                </div>

            </div>

        <?php else : ?>

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

                                <?= $menu["nb_personnes_min"] ?>

                                personnes

                            </p>

                            <p class="fs-4 text-success fw-bold">

                                <?= number_format($menu["prix"], 2, ",", " ") ?>

                                €

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

        <?php endif; ?>

    </div>

</div>

<script src="/vite-gourmand/public/assets/js/menu-filter.js"></script>

<?php

include __DIR__ . "/../layouts/footer.php";

?>