<?php
$title = "Gestion des employés";
require_once __DIR__ . "/../layouts/header.php";
?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Gestion des employés</h1>

        <a href="create_user.php?role=employe" class="btn btn-success">
             Ajouter un employé
        </a>
    </div>

    <?php if (empty($employes)) : ?>

        <div class="alert alert-info">
            Aucun employé enregistré.
        </div>

    <?php else : ?>

        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($employes as $employe) : ?>

                    <tr>

                        <td><?= $employe["id"] ?></td>

                        <td><?= htmlspecialchars($employe["nom"]) ?></td>

                        <td><?= htmlspecialchars($employe["prenom"]) ?></td>

                        <td><?= htmlspecialchars($employe["email"]) ?></td>

                        <td><?= htmlspecialchars($employe["telephone"]) ?></td>

                        <td>

                            <a href="edit_user.php?id=<?= $employe["id"] ?>"
                               class="btn btn-warning btn-sm">
                                Modifier
                            </a>

                            <a href="delete_user.php?id=<?= $employe["id"] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cet employé ?')">
                                Supprimer
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-secondary mt-3">
        Retour au tableau de bord
    </a>

</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>