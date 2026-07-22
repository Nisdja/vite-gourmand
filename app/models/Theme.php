<?php

class Theme
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tous les thèmes
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM themes ORDER BY nom";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}