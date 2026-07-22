<?php

$title = "Gestion des utilisateurs";
require_once __DIR__ . "/../layouts/header.php";

?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">

            Gestion des utilisateurs

        </h1>

        <a href="create_user.php" class="btn btn-success">

            <i class="bi bi-plus-circle"></i>

            Ajouter un utilisateur

        </a>

        

    </div>

    <?php if (isset($_GET["success"])) : ?>

        <div class="alert alert-success">

            <?php

            switch ($_GET["success"]) {

                case "create":
                    echo "Utilisateur ajouté avec succès.";
                    break;

                case "update":
                    echo "Utilisateur modifié avec succès.";
                    break;

                case "deactivate":
                    echo "Utilisateur désactivé avec succès.";
                    break;

                case "reactivate":
                    echo "Utilisateur réactivé avec succès.";
                    break;
            }

            ?>

        </div>

    <?php endif; ?>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "self") : ?>

        <div class="alert alert-danger">

            Vous ne pouvez pas désactiver votre propre compte.

        </div>

    <?php endif; ?>

    <div class="card shadow-sm">

        <div class="card-body">

            <?php if (!empty($users)) : ?>

                <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Nom</th>

                                <th>Prénom</th>

                                <th>Email</th>

                                <th>Téléphone</th>

                                <th>Rôle</th>

                                <th>Statut</th>

                                <th width="260">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($users as $user) : ?>

                                <tr>

                                    <td>

                                        <?= $user["id"] ?>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($user["nom"]) ?>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($user["prenom"]) ?>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($user["email"]) ?>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($user["telephone"]) ?>

                                    </td>

                                    <td>

                                        <?php if ($user["role"] === "administrateur") : ?>

                                            <span class="badge bg-danger">

                                                Administrateur

                                            </span>

                                        <?php elseif ($user["role"] === "employe") : ?>

                                            <span class="badge bg-warning text-dark">

                                                Employé

                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-primary">

                                                Utilisateur

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if ($user["actif"]) : ?>

                                            <span class="badge bg-success">

                                                Actif

                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-secondary">

                                                Inactif

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a
                                            href="edit_user.php?id=<?= $user["id"] ?>"
                                            class="btn btn-warning btn-sm"
                                        >

                                            <i class="bi bi-pencil"></i>

                                            Modifier

                                        </a>                                       
                                        
                                        <?php if ($user["id"] != $_SESSION["user"]["id"]) : ?>

                                            <?php if ($user["actif"]) : ?>

                                                <a
                                                    href="delete_user.php?id=<?= $user["id"] ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Voulez-vous vraiment désactiver cet utilisateur ?');"
                                                >

                                                    <i class="bi bi-person-x"></i>

                                                    Désactiver

                                                </a>

                                            <?php else : ?>

                                                <a
                                                    href="delete_user.php?id=<?= $user["id"] ?>"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm('Voulez-vous réactiver cet utilisateur ?');"
                                                >

                                                    <i class="bi bi-person-check"></i>

                                                    Réactiver

                                                </a>

                                            <?php endif; ?>

                                        <?php else : ?>

                                            <button
                                                class="btn btn-secondary btn-sm"
                                                disabled
                                            >

                                                <i class="bi bi-person-fill-check"></i>

                                                Compte connecté

                                            </button>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else : ?>

                <div class="alert alert-info mb-0">

                    Aucun utilisateur trouvé.

                </div>

            <?php endif; ?>

        </div>

    </div>

    <a href="dashboard.php" class="btn btn-secondary mt-3">
        Retour au tableau de bord
    </a>

</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>