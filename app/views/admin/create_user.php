<?php

$title = "Ajouter un utilisateur";
require_once __DIR__ . "/../layouts/header.php";

$role = $_GET["role"] ?? "utilisateur";

?>

<div class="container py-4">

    <div class="row">

        <div class="col-lg-8 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    <h3 class="mb-0">

                        <?php if ($role === "employe") : ?>

                            Ajouter un employé

                        <?php else : ?>

                            Ajouter un utilisateur

                        <?php endif; ?>

                    </h3>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Nom

                                </label>

                                <input
                                    type="text"
                                    name="nom"
                                    class="form-control"
                                    required
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Prénom

                                </label>

                                <input
                                    type="text"
                                    name="prenom"
                                    class="form-control"
                                    required
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Adresse e-mail

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    required
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Téléphone

                                </label>

                                <input
                                    type="text"
                                    name="telephone"
                                    class="form-control"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Mot de passe

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    minlength="8"
                                    required
                                >

                                <div class="form-text">

                                    Minimum 8 caractères.

                                </div>

                            </div>

                            <?php if ($role === "employe") : ?>

                                <input
                                    type="hidden"
                                    name="role"
                                    value="employe"
                                >

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Rôle

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        value="Employé"
                                        disabled
                                    >

                                </div>

                            <?php else : ?>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Rôle

                                    </label>

                                    <select
                                        name="role"
                                        class="form-select"
                                        required
                                    >

                                        <option value="utilisateur">

                                            Utilisateur

                                        </option>

                                        <option value="employe">

                                            Employé

                                        </option>

                                    </select>

                                    <div class="form-text">

                                        La création d'un administrateur n'est pas autorisée depuis cette interface.

                                    </div>

                                </div>

                            <?php endif; ?>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">

                            <a
                                href="<?= $role === "employe" ? "employes.php" : "users.php" ?>"
                                class="btn btn-secondary"
                            >

                                Retour

                            </a>

                            <button
                                type="submit"
                                class="btn btn-success"
                            >

                                Enregistrer

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>