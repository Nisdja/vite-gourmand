<?php

require_once __DIR__ . "/../../helpers/session.php";

include __DIR__ . "/../layouts/header.php";

?>

<div class="container">

    <div class="row">

        <div class="col-lg-8">

            <h1 class="mb-4">
                <?= htmlspecialchars($menu["titre"]) ?>
            </h1>

            
            <?php if (!empty($images)) : ?>

                <div class="row mb-4">

                    <?php foreach ($images as $image) : ?>

                        <div class="col-md-6 mb-3">

                            <img
                                src="/vite-gourmand/public/assets/images/menus/<?= htmlspecialchars($image["image"]) ?>"
                                class="img-fluid rounded shadow"
                                alt="<?= htmlspecialchars($menu["titre"]) ?>">

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else : ?>

                <div class="alert alert-secondary">
                    Aucune image disponible.
                </div>

            <?php endif; ?>

            
            <div class="card shadow mb-4">

                <div class="card-body">

                    <h3>Description</h3>

                    <p>
                        <?= nl2br(htmlspecialchars($menu["description"])) ?>
                    </p>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <p>
                                <strong>Thème :</strong><br>
                                <?= htmlspecialchars($menu["theme"]) ?>
                            </p>

                        </div>

                        <div class="col-md-6">

                            <p>
                                <strong>Régime :</strong><br>
                                <?= htmlspecialchars($menu["regime"]) ?>
                            </p>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <p>
                                <strong>Nombre minimum :</strong><br>
                                <?= $menu["nb_personnes_min"] ?> personnes
                            </p>

                        </div>

                        <div class="col-md-6">

                            <p>
                                <strong>Stock disponible :</strong><br>
                                <?= $menu["stock"] ?>
                            </p>

                        </div>

                    </div>

                    <h3 class="text-success">

                        <?= number_format($menu["prix"],2,","," ") ?>

                        €

                    </h3>

                </div>

            </div>

            
            <div class="card shadow mb-4">

                <div class="card-body">

                    <h3>Composition du menu</h3>

                    <?php if (!empty($plats)) : ?>

                        <ul class="list-group">

                            <?php foreach ($plats as $plat) : ?>

                                <li class="list-group-item">

                                    <strong>
                                        <?= ucfirst($plat["type"]) ?>
                                    </strong>

                                    :

                                    <?= htmlspecialchars($plat["nom"]) ?>

                                </li>

                            <?php endforeach; ?>

                        </ul>

                    <?php else : ?>

                        <div class="alert alert-warning">
                            Aucun plat disponible.
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        
        <div class="col-lg-4">

            <div class="card border-warning shadow mb-3">

                <div class="card-header bg-warning">

                    <strong>
                        Conditions du menu
                    </strong>

                </div>

                <div class="card-body">

                    <?= nl2br(htmlspecialchars($menu["conditions_menu"])) ?>

                </div>

            </div>

            

            <?php if (isset($_SESSION["user"])) : ?>

                <div class="d-grid mb-2">

                    <a
                        href="/vite-gourmand/public/commande.php?menu=<?= $menu["id"] ?>"
                        class="btn btn-success btn-lg">

                        Commander

                    </a>

                </div>

            <?php else : ?>

                <div class="alert alert-info">

                    Vous devez être connecté pour commander.

                </div>

                <div class="d-grid mb-2">

                    <a
                        href="/vite-gourmand/public/login.php"
                        class="btn btn-primary">

                        Se connecter

                    </a>

                </div>

                <div class="d-grid mb-2">

                    <a
                        href="/vite-gourmand/public/register.php"
                        class="btn btn-outline-primary">

                        Créer un compte

                    </a>

                </div>

            <?php endif; ?>

            <div class="d-grid">

                <a
                    href="/vite-gourmand/public/menus.php"
                    class="btn btn-secondary">

                    Retour aux menus

                </a>

            </div>

        </div>

    </div>

</div>

<?php

include __DIR__ . "/../layouts/footer.php";

?>