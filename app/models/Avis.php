<?php

class Avis
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "SELECT a.*, u.nom, u.prenom
                FROM avis a
                JOIN users u ON a.user_id = u.id
                ORDER BY a.created_at DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO avis
                (
                    commande_id,
                    user_id,
                    note,
                    commentaire,
                    valide
                )
                VALUES
                (
                    :commande_id,
                    :user_id,
                    :note,
                    :commentaire,
                    0
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }

    public function valider($id)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE avis SET valide = 1 WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

    public function supprimer($id)
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM avis WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

    public function getAvisValides()
    {
        $sql = "SELECT a.*, u.nom, u.prenom
                FROM avis a
                JOIN users u ON a.user_id = u.id
                WHERE a.valide = 1
                ORDER BY a.created_at DESC";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}