<?php

class Plat
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tous les plats
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM plats ORDER BY type, nom";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Un plat
     */
    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM plats WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ajouter
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO plats
        (
            nom,
            description,
            type
        )
        VALUES
        (
            :nom,
            :description,
            :type
        )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Modifier
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE plats SET

            nom = :nom,
            description = :description,
            type = :type

            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $data["id"] = $id;

        return $stmt->execute($data);
    }

    /**
     * Supprimer
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM plats WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }
}