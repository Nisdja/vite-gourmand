<?php include __DIR__ . "/../layouts/employee_header.php"; ?>

<h1 class="mb-4">Modifier un plat</h1>

<?php if (!empty($erreur)) : ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($erreur) ?>
    </div>
<?php endif; ?>

<form method="POST">

    <div class="mb-3">

        <label class="form-label">Nom</label>

        <input
            type="text"
            name="nom"
            class="form-control"
            value="<?= htmlspecialchars($plat["nom"]) ?>"
            required>

    </div>

    <div class="mb-3">

        <label class="form-label">Description</label>

        <textarea
            name="description"
            class="form-control"
            rows="4"
            required><?= htmlspecialchars($plat["description"]) ?></textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">Type</label>

        <select
            name="type"
            class="form-select">

            <option
                value="Entrée"
                <?= $plat["type"] == "Entrée" ? "selected" : "" ?>>

                Entrée

            </option>

            <option
                value="Plat"
                <?= $plat["type"] == "Plat" ? "selected" : "" ?>>

                Plat

            </option>

            <option
                value="Dessert"
                <?= $plat["type"] == "Dessert" ? "selected" : "" ?>>

                Dessert

            </option>

        </select>

    </div>

    <button class="btn btn-success">

        Enregistrer

    </button>

    <a
        href="/vite-gourmand/employee/plats.php"
        class="btn btn-secondary">

        Retour

    </a>

</form>

<?php include __DIR__ . "/../layouts/employee_footer.php"; ?>