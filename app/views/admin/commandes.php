<?php

$title = "Gestion des commandes";
require_once __DIR__ . "/../layouts/header.php";

$statutSelectionne = $_GET["statut"] ?? "";
$clientRecherche = $_GET["client"] ?? "";

?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">

            Gestion des commandes

        </h1>

    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-5">

                        <label class="form-label">

                            Rechercher un client

                        </label>

                        <input
                            type="text"
                            name="client"
                            class="form-control"
                            value="<?= htmlspecialchars($clientRecherche) ?>"
                            placeholder="Nom ou prénom"
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">

                            Statut

                        </label>

                        <select
                            name="statut"
                            class="form-select"
                        >

                            <option value="">Tous</option>

                            <?php

                            $statuts = [

                                "En attente",
                                "Accepté",
                                "En préparation",
                                "En cours de livraison",
                                "Livré",
                                "En attente du retour de matériel",
                                "Terminée",
                                "Annulée"

                            ];

                            foreach ($statuts as $statut) :

                            ?>

                                <option
                                    value="<?= $statut ?>"
                                    <?= $statutSelectionne === $statut ? "selected" : "" ?>
                                >

                                    <?= $statut ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-3 d-flex align-items-end">

                        <button
                            class="btn btn-primary w-100"
                        >

                            Filtrer

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <?php if (!empty($commandes)) : ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Client</th>

                                <th>Menu</th>

                                <th>Date</th>

                                <th>Personnes</th>

                                <th>Total</th>

                                <th>Statut</th>

                                <th width="260">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($commandes as $commande) : ?>

                                <tr>

                                    <td>

                                        #<?= $commande["id"] ?>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= htmlspecialchars($commande["prenom_client"]) ?>

                                            <?= htmlspecialchars($commande["nom_client"]) ?>

                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            <?= htmlspecialchars($commande["email_client"]) ?>

                                        </small>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($commande["titre"]) ?>

                                    </td>

                                    <td>

                                        <?= date("d/m/Y", strtotime($commande["date_prestation"])) ?>

                                        <br>

                                        <small>

                                            <?= substr($commande["heure_livraison"],0,5) ?>

                                        </small>

                                    </td>

                                    <td>

                                        <?= $commande["nombre_personnes"] ?>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= number_format($commande["prix_total"],2,","," ") ?> €

                                        </strong>

                                    </td>

                                    <td>

                                        <?php

                                        switch ($commande["statut"]) {

                                            case "En attente":
                                                $badge="secondary";
                                                break;

                                            case "Accepté":
                                                $badge="primary";
                                                break;

                                            case "En préparation":
                                                $badge="warning";
                                                break;

                                            case "En cours de livraison":
                                                $badge="info";
                                                break;

                                            case "Livré":
                                                $badge="success";
                                                break;

                                            case "En attente du retour de matériel":
                                                $badge="dark";
                                                break;

                                            case "Terminée":
                                                $badge="success";
                                                break;

                                            default:
                                                $badge="danger";
                                        }

                                        ?>

                                        <span class="badge bg-<?= $badge ?>">

                                            <?= $commande["statut"] ?>

                                        </span>

                                    </td>

                                    <td>
                                                                                <a
                                            href="detail_commande.php?id=<?= $commande["id"] ?>"
                                            class="btn btn-info btn-sm"
                                        >

                                            <i class="bi bi-eye"></i>

                                            Détail

                                        </a>

                                        <?php if ($commande["statut"] !== "Terminée" && $commande["statut"] !== "Annulée") : ?>

                                            <a
                                                href="edit_commande.php?id=<?= $commande["id"] ?>"
                                                class="btn btn-warning btn-sm"
                                            >

                                                <i class="bi bi-pencil-square"></i>

                                                Statut

                                            </a>

                                        <?php endif; ?>

                                        <?php if ($commande["statut"] !== "Annulée") : ?>

                                            <a
                                                href="cancel_commande.php?id=<?= $commande["id"] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Voulez-vous vraiment annuler cette commande ?');"
                                            >

                                                <i class="bi bi-x-circle"></i>

                                                Annuler

                                            </a>

                                        <?php else : ?>

                                            <button
                                                class="btn btn-secondary btn-sm"
                                                disabled
                                            >

                                                <i class="bi bi-slash-circle"></i>

                                                Annulée

                                            </button>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else : ?>

                <div class="alert alert-info text-center mb-0">

                    <h5 class="mb-2">

                        Aucune commande trouvée.

                    </h5>

                    <p class="mb-0">

                        Aucune commande ne correspond aux critères sélectionnés.

                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>