<?php

include __DIR__ . "/../layouts/header.php";

?>

<div class="container">

    <h1 class="mb-4">

        Modifier la commande

    </h1>

    <?php if (!empty($erreur)) : ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($erreur) ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="card shadow mb-4">

            <div class="card-header bg-primary text-white">

                Informations du client

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Nom</label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user["nom"]) ?>"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Prénom</label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user["prenom"]) ?>"
                            readonly>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            class="form-control"
                            value="<?= htmlspecialchars($user["email"]) ?>"
                            readonly>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Téléphone</label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user["telephone"]) ?>"
                            readonly>

                    </div>

                </div>

            </div>

        </div>

        <div class="card shadow mb-4">

            <div class="card-header bg-success text-white">

                Informations de livraison

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">

                        Adresse de livraison

                    </label>

                    <textarea
                        class="form-control"
                        name="adresse"
                        rows="3"
                        required><?= htmlspecialchars($commande["adresse_livraison"]) ?></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Ville

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="ville"
                        name="ville"
                        value="<?= htmlspecialchars($commande["ville"]) ?>"
                        required>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">

                            Date de prestation

                        </label>

                        <input
                            
                            type="date"
                            class="form-control"
                            name="date_prestation"
                            value="<?= $commande["date_prestation"] ?>"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Heure de livraison

                        </label>

                        <input
                                type="time"
                                class="form-control"
                                name="heure_livraison"
                                value="<?= $commande["heure_livraison"] ?>"
                                required>

                    </div>

                </div>

            </div>

        </div>


        <div class="card shadow mb-4">

            <div class="card-header bg-warning">

                Menu sélectionné

            </div>

            <div class="card-body">

                <h3>

                    <?= htmlspecialchars($menu["titre"]) ?>

                </h3>

                <p>

                    <?= htmlspecialchars($menu["description"]) ?>

                </p>

                <div class="row">

                    <div class="col-md-6">

                        <strong>

                            Prix minimum :

                        </strong>

                        <?= number_format($menu["prix"],2,","," ") ?> €

                    </div>

                    <div class="col-md-6">

                        <strong>

                            Nombre minimum :

                        </strong>

                        <?= $menu["nb_personnes_min"] ?>

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
                        value="<?= $commande["nombre_personnes"] ?>"
                        required>

                </div>

            </div>

        </div>

        <!-- Récap -->

        <div class="card shadow mb-4">

            <div class="card-header bg-dark text-white">

                Récapitulatif

            </div>

            <div class="card-body">

                <table class="table">

                    <tr>

                        <td>

                            Prix du menu

                        </td>

                        <td class="text-end">

                            <span id="prixMenu">

                                <?= number_format($menu["prix"],2,".","") ?>

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

                            Remise

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

                            Total

                        </th>

                        <th class="text-end">

                            <span id="prixTotal">

                                <?= number_format($menu["prix"],2,".","") ?>

                            </span>

                            €

                        </th>

                    </tr>

                </table>

            </div>

        </div>

        <button
            class="btn btn-success btn-lg">

            Enregistrer les modifications

        </button>

        <a
            href="/vite-gourmand/public/show_menu.php?id=<?= $menu["id"] ?>"
            class="btn btn-secondary">

            Retour

        </a>

    </form>

</div>

<script>

const prixBase = <?= $menu["prix"] ?>;
const minimum = <?= $menu["nb_personnes_min"] ?>;

const inputPersonnes = document.getElementById("nombre_personnes");
const inputVille = document.getElementById("ville");

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

    if (nb >= minimum + 5) {
        reduction = menu * 0.10;
    }

    let livraison = 0;

    if (inputVille.value.trim().toLowerCase() !== "bordeaux") {
        livraison = 5;
    }

    let total = menu - reduction + livraison;

    prixMenu.innerHTML = menu.toFixed(2);
    remise.innerHTML = reduction.toFixed(2);
    prixLivraison.innerHTML = livraison.toFixed(2);
    prixTotal.innerHTML = total.toFixed(2);

}

inputPersonnes.addEventListener("input", calculerPrix);
inputVille.addEventListener("input", calculerPrix);

calculerPrix();

</script>

<?php

include __DIR__ . "/../layouts/footer.php";

?>