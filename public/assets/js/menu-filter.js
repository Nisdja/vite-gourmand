const theme = document.getElementById("theme");
const regime = document.getElementById("regime");
const prixMax = document.getElementById("prixMax");

const container = document.getElementById("menus-container");

async function chargerMenus() {

    const url =
        `/vite-gourmand/public/filter_menu.php?theme=${encodeURIComponent(theme.value)}&regime=${encodeURIComponent(regime.value)}&prixMax=${encodeURIComponent(prixMax.value)}`;

    try {

        const response = await fetch(url);

        const menus = await response.json();

        container.innerHTML = "";

        if (menus.length === 0) {

            container.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Aucun menu trouvé.
                    </div>
                </div>
            `;

            return;

        }

        menus.forEach(menu => {

            container.innerHTML += `

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card shadow h-100">

                        <div class="card-body d-flex flex-column">

                            <h4 class="card-title">
                                ${menu.titre}
                            </h4>

                            <p class="card-text">
                                ${menu.description}
                            </p>

                            <hr>

                            <p>
                                <strong>Thème :</strong>
                                ${menu.theme}
                            </p>

                            <p>
                                <strong>Régime :</strong>
                                ${menu.regime}
                            </p>

                            <p>
                                <strong>Minimum :</strong>
                                ${menu.nb_personnes_min} personnes
                            </p>

                            <p class="fs-4 text-success fw-bold">
                                ${Number(menu.prix).toFixed(2)} €
                            </p>

                            <div class="mt-auto">

                                <a
                                    href="/vite-gourmand/public/show_menu.php?id=${menu.id}"
                                    class="btn btn-primary w-100">

                                    Voir le menu

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            `;

        });

    } catch (error) {

        console.error(error);

        container.innerHTML = `
            <div class="col-12">
                <div class="alert alert-danger text-center">
                    Une erreur est survenue lors du chargement des menus.
                </div>
            </div>
        `;

    }

}

theme.addEventListener("change", chargerMenus);
regime.addEventListener("change", chargerMenus);
prixMax.addEventListener("input", chargerMenus);