<?php include __DIR__ . "/../layouts/employee_header.php"; ?>

<div class="container mt-4">

    <h1>Ajouter un plat</h1>

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
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea
                name="description"
                class="form-control"
                rows="4"
                required></textarea>
        </div>

        <div class="mb-3">

            <label class="form-label">

                Type

            </label>

            <select
                name="type"
                class="form-select">

                <option>Entrée</option>
                <option>Plat</option>
                <option>Dessert</option>

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

</div>

<?php include __DIR__ . "/../layouts/employee_footer.php"; ?>