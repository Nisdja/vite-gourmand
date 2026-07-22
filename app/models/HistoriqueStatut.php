<?php

class HistoriqueStatut
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ajouter une entrée dans l'historique
     */
    public function create(
        int $commandeId,
        string $statut,
        ?string $commentaire = null
    ): bool {

        $stmt = $this->pdo->prepare(
            "INSERT INTO historique_statuts
            (
                commande_id,
                statut,
                commentaire
            )
            VALUES
            (
                ?,
                ?,
                ?
            )"
        );

        return $stmt->execute([
            $commandeId,
            $statut,
            $commentaire
        ]);
    }

    /**
     * Historique d'une commande
     */
    public function getByCommande(int $commandeId): array
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