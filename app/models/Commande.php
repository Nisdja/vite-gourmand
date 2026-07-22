<?php

class Commande
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Créer une commande
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO commandes
        (
            user_id,
            menu_id,
            nom_client,
            prenom_client,
            email_client,
            telephone_client,
            adresse_livraison,
            ville,
            distance_km,
            date_prestation,
            heure_livraison,
            nombre_personnes,
            prix_menu,
            prix_livraison,
            remise,
            prix_total,
            statut
        )
        VALUES
        (
            :user_id,
            :menu_id,
            :nom_client,
            :prenom_client,
            :email_client,
            :telephone_client,
            :adresse_livraison,
            :ville,
            :distance_km,
            :date_prestation,
            :heure_livraison,
            :nombre_personnes,
            :prix_menu,
            :prix_livraison,
            :remise,
            :prix_total,
            'En attente'
        )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Toutes les commandes d'un utilisateur
     */
    public function getByUser(int $userId): array
    {
        $sql = "SELECT
                    commandes.*,
                    menus.titre
                FROM commandes
                INNER JOIN menus
                    ON menus.id = commandes.menu_id
                WHERE user_id = ?
                ORDER BY commandes.created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Toutes les commandes
     */
    public function getAll(): array
    {
        $sql = "SELECT
                    commandes.*,
                    menus.titre
                FROM commandes
                INNER JOIN menus
                    ON menus.id = commandes.menu_id
                ORDER BY commandes.created_at DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Une commande
     */
    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM commandes WHERE id=?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Modifier une commande
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE commandes SET

            adresse_livraison = :adresse_livraison,
            ville = :ville,
            distance_km = :distance_km,
            date_prestation = :date_prestation,
            heure_livraison = :heure_livraison,
            nombre_personnes = :nombre_personnes,

            prix_menu = :prix_menu,
            prix_livraison = :prix_livraison,
            remise = :remise,
            prix_total = :prix_total

            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $data["id"] = $id;

        return $stmt->execute($data);
    }

    /**
     * Modifier le statut
     */
    public function updateStatut(int $id, string $statut): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE commandes
             SET statut = ?
             WHERE id = ?"
        );

        return $stmt->execute([$statut, $id]);
    }

    /**
     * Supprimer une commande
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM commandes WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

    /**
     * Nombre de commandes par menu
     */
    public function countByMenu(): array
    {
        $sql = "SELECT
                    menus.titre,
                    COUNT(*) AS total
                FROM commandes
                INNER JOIN menus
                    ON menus.id = commandes.menu_id
                GROUP BY menus.id
                ORDER BY total DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Chiffre d'affaires
     */
    public function chiffreAffaires(
        ?int $menu = null,
        ?string $debut = null,
        ?string $fin = null
    ): array {

        $sql = "SELECT SUM(prix_total) AS ca
                FROM commandes
                WHERE 1";

        $params = [];

        if ($menu) {
            $sql .= " AND menu_id = ?";
            $params[] = $menu;
        }

        if ($debut) {
            $sql .= " AND date_prestation >= ?";
            $params[] = $debut;
        }

        if ($fin) {
            $sql .= " AND date_prestation <= ?";
            $params[] = $fin;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Filtrer les commandes
     */
    public function filter(?string $statut, ?string $client): array
    {
        $sql = "
            SELECT commandes.*, menus.titre
            FROM commandes
            INNER JOIN menus
                ON menus.id = commandes.menu_id
            WHERE 1
        ";

        $params = [];

        if (!empty($statut)) {
            $sql .= " AND commandes.statut = ?";
            $params[] = $statut;
        }

        if (!empty($client)) {
            $sql .= " AND (
                commandes.nom_client LIKE ?
                OR commandes.prenom_client LIKE ?
            )";

            $params[] = "%{$client}%";
            $params[] = "%{$client}%";
        }

        $sql .= " ORDER BY commandes.created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Historique d'une commande
     */
    public function getHistorique(int $commandeId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
             FROM historique_statuts
             WHERE commande_id = ?
             ORDER BY created_at ASC"
        );

        $stmt->execute([$commandeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}