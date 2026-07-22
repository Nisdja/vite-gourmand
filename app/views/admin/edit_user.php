<?php
$title = "Modifier un utilisateur";
require_once __DIR__ . "/../layouts/header.php";
?>

<div class="container py-4">

    <h1 class="mb-4">Modifier un utilisateur</h1>

    <form method="POST">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Nom</label>
                <input
                    type="text"
                    name="nom"
                    class="form-control"
                    value="<?= htmlspecialchars($user["nom"]) ?>"
                    required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Prénom</label>
                <input
                    type="text"
                    name="prenom"
                    class="form-control"
                    value="<?= htmlspecialchars($user["prenom"]) ?>"
                    required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= htmlspecialchars($user["email"]) ?>"
                    required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Téléphone</label>
                <input
                    type="text"
                    name="telephone"
                    class="form-control"
                    value="<?= htmlspecialchars($user["telephone"]) ?>">
            </div>

            <div class="col-md-6 mb-4">
                <label>Rôle</label>

                <select name="role" class="form-select">

                    <option value="utilisateur" <?= $user["role"] == "utilisateur" ? "selected" : "" ?>>
                        Utilisateur
                    </option>

                    <option value="employe" <?= $user["role"] == "employe" ? "selected" : "" ?>>
                        Employé
                    </option>

                    <option value="administrateur" <?= $user["role"] == "administrateur" ? "selected" : "" ?>>
                        Administrateur
                    </option>

                </select>

            </div>

        </div>

        <button class="btn btn-primary">
            Enregistrer
        </button>

        <a href="users.php" class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>