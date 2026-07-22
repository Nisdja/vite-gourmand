<?php

require_once "../app/helpers/session.php";
require_once "../app/config/database.php";
require_once "../app/models/Avis.php";
require_once __DIR__ . '/../vendor/autoload.php';

$avisModel = new Avis($pdo);
$avis = $avisModel->getAvisValides();

include "../app/views/layouts/header.php";

?>

<div class="hero shadow">

    <h1>Bienvenue chez Vite & Gourmand</h1>

    <p>
        Traiteur pour tous vos événements.
    </p>

    <a
        href="/vite-gourmand/public/menus.php"
        class="btn btn-primary btn-lg">

        Découvrir nos menus

    </a>

</div>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Vite & Gourmand
            </h2>

            <p class="text-center">

                <strong>Vite & Gourmand</strong> est une société spécialisée dans la restauration 
                et les services traiteur, aussi bien pour les particuliers 
                que pour les professionnels.
            </p>

            <p class="text-center">

                Nous proposons des menus variés, préparés à partir de produits frais et de qualité, 
                afin de répondre à tous types d’événements : mariages, anniversaires, séminaires, 
                repas d’entreprise ou réceptions privées. Notre priorité reste d’assurer un service rapide, 
                fiable et personnalisé,pour satisfaire pleinement chaque client.

            </p>

            <p class="text-center">

                Notre priorité est d'offrir un service rapide, fiable et
                personnalisé afin de satisfaire pleinement chacun de nos
                clients.

            </p>

        </div>

    </div>

</div>


<div class="container mt-5">

    <h2 class="text-center mb-4">

        Notre équipe

    </h2>

    <div class="row text-center">

        <div class="col-md-3 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h1>👨‍🍳</h1>

                    <h5>équipes de qualité</h5>

                    <p>
                        Une équipe passionnée qui prépare des plats de qualité
                        avec des produits frais.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h1>🚚</h1>

                    <h5>rapide</h5>

                    <p>
                        Des livraisons ponctuelles pour garantir la fraîcheur
                        et la qualité de nos prestations.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h1>📅</h1>

                    <h5>Organisation</h5>

                    <p>
                        Une bonne préparation de chaque événement pour
                        répondre aux attentes de nos clients.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h1>⭐</h1>

                    <h5>Satisfaction client</h5>

                    <p>
                        Nos équipes mettent tout en œuvre pour offrir un service
                        professionnel et une expérience de unique.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="container mt-5">

    <h2 class="text-center mb-4">

        Avis de nos clients

    </h2>

    <?php if (empty($avis)) : ?>

        <div class="alert alert-info">

            Aucun avis validé pour le moment.

        </div>

    <?php else : ?>

        <div class="row">

            <?php foreach ($avis as $a) : ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow h-100">

                        <div class="card-body">

                            <h5>

                                <?= htmlspecialchars($a["prenom"]) ?>
                                <?= htmlspecialchars($a["nom"]) ?>

                            </h5>

                            <p class="text-warning">

                                <?= str_repeat("⭐", (int)$a["note"]) ?>

                            </p>

                            <p>

                                <?= nl2br(htmlspecialchars($a["commentaire"])) ?>

                            </p>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<?php

include "../app/views/layouts/footer.php";

?>