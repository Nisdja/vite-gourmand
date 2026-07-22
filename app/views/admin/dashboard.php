<?php
$title = "Tableau de bord administrateur";
require_once __DIR__ . "/../layouts/header.php";
?>

<div class="container py-4">

    <h1 class="mb-4">
        Tableau de bord administrateur
    </h1>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Utilisateurs</h6>
                    <h2><?= $nbUtilisateurs ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Employés</h6>
                    <h2><?= $nbEmployes ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Commandes</h6>
                    <h2><?= $nbCommandes ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Chiffre d'affaires</h6>
                    <h2><?= number_format($ca, 2, ",", " ") ?> €</h2>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-5">

    <div class="row">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    Menus les plus commandés
                </div>

                <div class="card-body">

                    <?php if (!empty($menus)) : ?>

                        <canvas id="menuChart" height="180"></canvas>

                        <hr>

                        <table class="table table-striped">

                            <thead>

                                <tr>
                                    <th>Menu</th>
                                    <th>Commandes</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($menus as $menu) : ?>

                                    <tr>

                                        <td><?= htmlspecialchars($menu["titre"]) ?></td>

                                        <td><?= $menu["total"] ?></td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    <?php else : ?>

                        <div class="alert alert-info">

                            Aucun menu n'a encore été commandé.

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    Gestion
                </div>

                <div class="list-group list-group-flush">

                    <a href="users.php" class="list-group-item list-group-item-action">
                        Gérer les utilisateurs
                    </a>

                    <a href="employes.php" class="list-group-item list-group-item-action">
                        Gérer les employés
                    </a>

                    <a href="../employee/menus.php" class="list-group-item list-group-item-action">
                        Menus
                    </a>

                    <a href="../employee/plats.php" class="list-group-item list-group-item-action">
                        Plats
                    </a>

                    <a href="../employee/horaires.php" class="list-group-item list-group-item-action">
                        Horaires
                    </a>

                    <a href="../employee/avis.php" class="list-group-item list-group-item-action">
                        Avis clients
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php if (!empty($menus)) : ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = [
<?php foreach ($menus as $menu) : ?>
"<?= addslashes($menu["titre"]) ?>",
<?php endforeach; ?>
];

const data = [
<?php foreach ($menus as $menu) : ?>
<?= (int)$menu["total"] ?>,
<?php endforeach; ?>
];

new Chart(document.getElementById("menuChart"), {

    type: "bar",

    data: {

        labels: labels,

        datasets: [{

            label: "Nombre de commandes",

            data: data,

            backgroundColor: [
                "#0d6efd",
                "#198754",
                "#ffc107",
                "#dc3545",
                "#6f42c1",
                "#20c997",
                "#fd7e14",
                "#6610f2"
            ]

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0

                }

            }

        }

    }

});

</script>

<?php endif; ?>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>