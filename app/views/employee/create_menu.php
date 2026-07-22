<?php

include __DIR__ . "/../layouts/employee_header.php";

?>

<div class="container mt-5">

    <h1 class="mb-4">

        Ajouter un menu

    </h1>

    <?php if (!empty($erreur)) : ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($erreur) ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="card shadow">

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">

                        Titre

                    </label>

                    <input
                        type="text"
                        name="titre"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">

                            Thème

                        </label>

                        <select
                            name="theme_id"
                            class="form-select"
                            required>

                            <?php foreach ($themes as $theme) : ?>

                                <option
                                    value="<?= $theme["id"] ?>">

                                    <?= htmlspecialchars($theme["nom"]) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Régime

                        </label>

                        <select
                            name="regime_id"
                            class="form-select"
                            required>

                            <?php foreach ($regimes as $regime) : ?>

                                <option
                                    value="<?= $regime["id"] ?>">

                                    <?= htmlspecialchars($regime["nom"]) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

                <br>

                <div class="row">

                    <div class="col-md-4">

                        <label class="form-label">

                            Minimum de personnes

                        </label>

                        <input
                            type="number"
                            name="nb_personnes_min"
                            class="form-control"
                            min="1"
                            required>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">

                            Prix (€)

                        </label>

                        <input
                            type="number"
                            name="prix"
                            class="form-control"
                            step="0.01"
                            required>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">

                            Stock

                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            min="0"
                            required>

                    </div>

                </div>

                <br>

                <div class="mb-3">

                    <label class="form-label">

                        Conditions du menu

                    </label>

                    <textarea
                        name="conditions_menu"
                        class="form-control"
                        rows="3"></textarea>

                </div>

                <button
                    class="btn btn-success">

                    Enregistrer

                </button>

                <a
                    href="/vite-gourmand/employee/menus.php"
                    class="btn btn-secondary">

                    Retour

                </a>

            </div>

        </div>

    </form>

</div>

<?php

include __DIR__ . "/../layouts/employee_footer.php";