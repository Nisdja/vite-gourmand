<?php

class Menu
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "
            SELECT
                menus.*,
                themes.nom AS theme,
                regimes.nom AS regime
            FROM menus
            LEFT JOIN themes ON menus.theme_id = themes.id
            LEFT JOIN regimes ON menus.regime_id = regimes.id
            ORDER BY menus.titre
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "
            SELECT
                menus.*,
                themes.nom AS theme,
                regimes.nom AS regime
            FROM menus
            LEFT JOIN themes ON menus.theme_id = themes.id
            LEFT JOIN regimes ON menus.regime_id = regimes.id
            WHERE menus.id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPlats($menuId)
    {
        $sql = "
            SELECT *
            FROM plats
            INNER JOIN menu_plat
                ON plats.id = menu_plat.plat_id
            WHERE menu_plat.menu_id = ?
            ORDER BY type
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$menuId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImages($menuId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM images_menu WHERE menu_id = ?"
        );

        $stmt->execute([$menuId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
     * Ajouter un menu
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO menus
        (
            titre,
            description,
            theme_id,
            regime_id,
            nb_personnes_min,
            prix,
            conditions_menu,
            stock
        )
        VALUES
        (
            :titre,
            :description,
            :theme_id,
            :regime_id,
            :nb_personnes_min,
            :prix,
            :conditions_menu,
            :stock
        )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }



        /**
     * Modifier un menu
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE menus SET

            titre = :titre,
            description = :description,
            theme_id = :theme_id,
            regime_id = :regime_id,
            nb_personnes_min = :nb_personnes_min,
            prix = :prix,
            conditions_menu = :conditions_menu,
            stock = :stock

            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $data["id"] = $id;

        return $stmt->execute($data);
    }

        /**
     * Supprimer un menu
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM menus WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }


    public function filter(
    ?string $theme = null,
    ?string $regime = null,
    ?float $prixMax = null
)
{
    $sql = "
        SELECT
            menus.*,
            themes.nom AS theme,
            regimes.nom AS regime
        FROM menus
        LEFT JOIN themes
            ON menus.theme_id = themes.id
        LEFT JOIN regimes
            ON menus.regime_id = regimes.id
        WHERE 1=1
    ";

    $params = [];

    if (!empty($theme)) {
        $sql .= " AND themes.nom = ?";
        $params[] = $theme;
    }

    if (!empty($regime)) {
        $sql .= " AND regimes.nom = ?";
        $params[] = $regime;
    }

    if (!empty($prixMax)) {
        $sql .= " AND menus.prix <= ?";
        $params[] = $prixMax;
    }

    $sql .= " ORDER BY menus.titre";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}