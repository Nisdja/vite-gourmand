<?php

class Regime
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tous les régimes
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM regimes ORDER BY nom";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}