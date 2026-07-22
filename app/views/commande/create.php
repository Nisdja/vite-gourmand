<?php

include __DIR__ . "/../layouts/header.php";

?>

<div class="container py-4">

    <h1 class="mb-4">
        Commander un menu
    </h1>

    <?php if (!empty($erreur)) : ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($erreur) ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <!-- Informations du client -->

        <div class="card shadow mb-4">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    Informations du client
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nom
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user["nom"]) ?>"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Prénom
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user["prenom"]) ?>"
                            readonly>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Adresse e-mail
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            value="<?= htmlspecialchars($user["email"]) ?>"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Téléphone
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user["telephone"]) ?>"
                            readonly>

                    </div>

                </div>

            </div>

        </div>


        <!-- Livraison -->

        <div class="card shadow mb-4">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">
                    Informations de livraison
                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">

                        Adresse de livraison

                    </label>

                    <textarea
                        name="adresse"
                        class="form-control"
                        rows="3"
                        required><?= htmlspecialchars($user["adresse"] ?? "") ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Ville
                        </label>

                        <input
                            type="text"
                            id="ville"
                            name="ville"
                            class="form-control"
                            value="Bordeaux"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Distance (km)
                        </label>

                        <input
                            type="number"
                            id="distance_km"
                            name="distance_km"
                            class="form-control"
                            min="0"
                            step="0.1"
                            value="0"
                            required>

                        <small class="text-muted">
                            0 km si la livraison est à Bordeaux.
                        </small>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Date de prestation

                        </label>

                        <input
                            type="date"
                            name="date_prestation"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Heure de livraison

                        </label>

                        <input
                            type="time"
                            name="heure_livraison"
                            class="form-control"
                            required>

                    </div>

                </div>

            </div>

        </div>


        <!-- Menu sélectionné -->

        <div class="card shadow mb-4">

            <div class="card-header bg-warning">

                <h5 class="mb-0">
                    Menu sélectionné
                </h5>

            </div>

            <div class="card-body">

                <h3 class="mb-3">

                    <?= htmlspecialchars($menu["titre"]) ?>

                </h3>

                <p>

                    <?= nl2br(htmlspecialchars($menu["description"])) ?>

                </p>

                <div class="row mb-3">

                    <div class="col-md-6">

                        <strong>Prix du menu minimum :</strong><br>

                        <?= number_format($menu["prix"], 2, ",", " ") ?> €

                    </div>

                    <div class="col-md-6">

                        <strong>Nombre minimum :</strong><br>

                        <?= $menu["nb_personnes_min"] ?> personnes

                    </div>

                </div>

                <hr>

                <div class="mb-3">

                    <label class="form-label">

                        Nombre de personnes

                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="nombre_personnes"
                        name="nombre_personnes"
                        min="<?= $menu["nb_personnes_min"] ?>"
                        value="<?= $menu["nb_personnes_min"] ?>"
                        required>

                    <small class="text-muted">

                        Minimum <?= $menu["nb_personnes_min"] ?> personnes.

                    </small>

                </div>

            </div>

        </div>

        <!-- Récap -->

        <div class="card shadow mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">
                    Récapitulatif de votre commande
                </h5>

            </div>

            <div class="card-body">

                <table class="table table-bordered align-middle">

                    <tbody>

                        <tr>

                            <td width="70%">

                                Prix du menu

                            </td>

                            <td class="text-end">

                                <span id="prixMenu">

                                    <?= number_format($menu["prix"], 2, ".", "") ?>

                                </span>

                                €

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Livraison

                            </td>

                            <td class="text-end">

                                <span id="prixLivraison">

                                    0.00

                                </span>

                                €

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Remise (10 %)

                            </td>

                            <td class="text-end text-danger">

                                -

                                <span id="remise">

                                    0.00

                                </span>

                                €

                            </td>

                        </tr>

                        <tr class="table-success">

                            <th>

                                Total à payer

                            </th>

                            <th class="text-end">

                                <span id="prixTotal">

                                    <?= number_format($menu["prix"], 2, ".", "") ?>

                                </span>

                                €

                            </th>

                        </tr>

                    </tbody>

                </table>

                <div class="alert alert-info mb-0">

                    <strong>Information :</strong><br>

                    • Livraison gratuite à Bordeaux.<br>

                    • Hors Bordeaux : forfait de 5 € + 0,59 €/km.<br>

                    • Une remise de 10 % est appliquée dès que le nombre de personnes est supérieur ou égal au minimum + 5.

                </div>

            </div>

        </div>

        <div class="d-flex justify-content-between mb-5">

            <a
                href="/vite-gourmand/public/show_menu.php?id=<?= $menu["id"] ?>"
                class="btn btn-secondary">

                ← Retour

            </a>

            <button
                type="submit"
                class="btn btn-success btn-lg">

                Valider la commande

            </button>

        </div>

            </form>

</div>

<script>

const prixBase = <?= (float)$menu["prix"] ?>;
const minimum = <?= (int)$menu["nb_personnes_min"] ?>;

const inputPersonnes = document.getElementById("nombre_personnes");
const inputVille = document.getElementById("ville");
const inputDistance = document.getElementById("distance_km");

const prixMenu = document.getElementById("prixMenu");
const prixLivraison = document.getElementById("prixLivraison");
const remise = document.getElementById("remise");
const prixTotal = document.getElementById("prixTotal");

function calculerPrix() {

    let nb = parseInt(inputPersonnes.value);

    if (isNaN(nb) || nb < minimum) {
        nb = minimum;
        inputPersonnes.value = minimum;
    }

    let prixParPersonne = prixBase / minimum;
    let menu = prixParPersonne * nb;

    let reduction = 0;

    if (nb >= (minimum + 5)) {
        reduction = menu * 0.10;
    }

    let livraison = 0;

    const ville = inputVille.value.trim().toLowerCase();

    if (ville !== "bordeaux") {

        let distance = parseFloat(inputDistance.value);

        if (isNaN(distance) || distance < 0) {
            distance = 0;
        }

        livraison = 5 + (distance * 0.59);

    } else {

        inputDistance.value = 0;

    }

    let total = menu - reduction + livraison;

    prixMenu.textContent = menu.toFixed(2);
    remise.textContent = reduction.toFixed(2);
    prixLivraison.textContent = livraison.toFixed(2);
    prixTotal.textContent = total.toFixed(2);
}

inputPersonnes.addEventListener("input", calculerPrix);
inputVille.addEventListener("input", calculerPrix);
inputDistance.addEventListener("input", calculerPrix);

calculerPrix();

</script>

<?php

include __DIR__ . "/../layouts/footer.php";

?>