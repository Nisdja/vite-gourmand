<?php

class Horaire
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tous les horaires
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM horaires ORDER BY jour";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Un horaire
     */
    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM horaires WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ajouter
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO horaires
        (
            jour,
            ouverture,
            fermeture
        )
        VALUES
        (
            :jour,
            :ouverture,
            :fermeture
        )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Modifier
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE horaires SET

            jour = :jour,
            ouverture = :ouverture,
            fermeture = :fermeture

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
            "DELETE FROM horaires WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }
}