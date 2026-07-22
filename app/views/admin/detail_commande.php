<?php

$title = "Détail de la commande";
require_once __DIR__ . "/../layouts/header.php";

?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>

            Commande #<?= $commande["id"] ?>

        </h1>

        <a href="commandes.php" class="btn btn-secondary">

            Retour

        </a>

    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h4 class="mb-0">

                        Informations client

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <strong>Nom</strong>

                            <p class="mb-0">

                                <?= htmlspecialchars($commande["prenom_client"]) ?>

                                <?= htmlspecialchars($commande["nom_client"]) ?>

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Email</strong>

                            <p class="mb-0">

                                <?= htmlspecialchars($commande["email_client"]) ?>

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Téléphone</strong>

                            <p class="mb-0">

                                <?= htmlspecialchars($commande["telephone_client"]) ?>

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Ville</strong>

                            <p class="mb-0">

                                <?= htmlspecialchars($commande["ville"]) ?>

                            </p>

                        </div>

                        <div class="col-12">

                            <strong>Adresse de livraison</strong>

                            <p class="mb-0">

                                <?= nl2br(htmlspecialchars($commande["adresse_livraison"])) ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card shadow">

                <div class="card-header">

                    <h4 class="mb-0">

                        Détails de la prestation

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <strong>Menu</strong>

                            <p>

                                <?= htmlspecialchars($commande["titre"] ?? "") ?>

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Nombre de personnes</strong>

                            <p>

                                <?= $commande["nombre_personnes"] ?>

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Date</strong>

                            <p>

                                <?= date("d/m/Y", strtotime($commande["date_prestation"])) ?>

                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Heure</strong>

                            <p>

                                <?= substr($commande["heure_livraison"],0,5) ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h4 class="mb-0">

                        Facturation

                    </h4>

                </div>

                <div class="card-body">

                    <table class="table">

                        <tr>

                            <th>Prix menu</th>

                            <td class="text-end">

                                <?= number_format($commande["prix_menu"],2,","," ") ?> €

                            </td>

                        </tr>

                        <tr>

                            <th>Livraison</th>

                            <td class="text-end">

                                <?= number_format($commande["prix_livraison"],2,","," ") ?> €

                            </td>

                        </tr>

                        <tr>

                            <th>Remise</th>

                            <td class="text-end text-success">

                                - <?= number_format($commande["remise"],2,","," ") ?> €

                            </td>

                        </tr>

                        <tr class="table-dark">

                            <th>Total</th>

                            <th class="text-end">

                                <?= number_format($commande["prix_total"],2,","," ") ?> €

                            </th>

                        </tr>

                    </table>

                </div>

            </div>

                        <div class="card shadow mb-4">

                <div class="card-header">

                    <h4 class="mb-0">

                        Statut de la commande

                    </h4>

                </div>

                <div class="card-body text-center">

                    <?php

                    switch ($commande["statut"]) {

                        case "En attente":
                            $badge = "secondary";
                            break;

                        case "Accepté":
                            $badge = "primary";
                            break;

                        case "En préparation":
                            $badge = "warning";
                            break;

                        case "En cours de livraison":
                            $badge = "info";
                            break;

                        case "Livré":
                            $badge = "success";
                            break;

                        case "En attente du retour de matériel":
                            $badge = "dark";
                            break;

                        case "Terminée":
                            $badge = "success";
                            break;

                        default:
                            $badge = "danger";
                            break;

                    }

                    ?>

                    <span class="badge bg-<?= $badge ?> fs-6">

                        <?= htmlspecialchars($commande["statut"]) ?>

                    </span>

                </div>

            </div>

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h4 class="mb-0">

                        Historique des statuts

                    </h4>

                </div>

                <div class="card-body">

                    <?php if (!empty($historique)) : ?>

                        <ul class="list-group">

                            <?php foreach ($historique as $ligne) : ?>

                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    <span>

                                        <?= htmlspecialchars($ligne["statut"]) ?>

                                    </span>

                                    <small class="text-muted">

                                        <?= date("d/m/Y H:i", strtotime($ligne["created_at"])) ?>

                                    </small>

                                </li>

                            <?php endforeach; ?>

                        </ul>

                    <?php else : ?>

                        <div class="alert alert-info mb-0">

                            Aucun historique disponible.

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <?php if ($commande["statut"] !== "Terminée" && $commande["statut"] !== "Annulée") : ?>

                <div class="card shadow">

                    <div class="card-header">

                        <h4 class="mb-0">

                            Faire évoluer la commande

                        </h4>

                    </div>

                    <div class="card-body">

                        <form method="POST" action="update_statut.php">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $commande["id"] ?>"
                            >

                            <div class="mb-3">

                                <label class="form-label">

                                    Nouveau statut

                                </label>

                                <select
                                    name="statut"
                                    class="form-select"
                                    required
                                >

                                    <option value="En attente" <?= $commande["statut"] == "En attente" ? "selected" : "" ?>>

                                        En attente

                                    </option>

                                    <option value="Accepté" <?= $commande["statut"] == "Accepté" ? "selected" : "" ?>>

                                        Accepté

                                    </option>

                                    <option value="En préparation" <?= $commande["statut"] == "En préparation" ? "selected" : "" ?>>

                                        En préparation

                                    </option>

                                    <option value="En cours de livraison" <?= $commande["statut"] == "En cours de livraison" ? "selected" : "" ?>>

                                        En cours de livraison

                                    </option>

                                    <option value="Livré" <?= $commande["statut"] == "Livré" ? "selected" : "" ?>>

                                        Livré

                                    </option>

                                    <option value="En attente du retour de matériel" <?= $commande["statut"] == "En attente du retour de matériel" ? "selected" : "" ?>>

                                        En attente du retour de matériel

                                    </option>

                                    <option value="Terminée" <?= $commande["statut"] == "Terminée" ? "selected" : "" ?>>

                                        Terminée

                                    </option>

                                    <option value="Annulée">

                                        Annulée

                                    </option>

                                </select>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-success w-100"
                            >

                                Enregistrer le statut

                            </button>

                        </form>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>