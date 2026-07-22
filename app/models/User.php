<?php

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tous les utilisateurs
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT *
            FROM users
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Utilisateurs
     */
    public function getUsers(): array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE role = 'utilisateur'
            ORDER BY nom, prenom
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Employés
     */
    public function getEmployes(): array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE role = 'employe'
            ORDER BY nom, prenom
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Nombre d'utilisateurs
     */
    public function countUsers(): int
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM users
            WHERE role='utilisateur'
        ");

        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    /**
     * Nombre d'employés
     */
    public function countEmployes(): int
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM users
            WHERE role='employe'
        ");

        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    /**
     * Recherche par ID
     */
    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Création d'un utilisateur
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO users
            (
                nom,
                prenom,
                email,
                telephone,
                password,
                role,
                actif
            )
            VALUES
            (
                :nom,
                :prenom,
                :email,
                :telephone,
                :password,
                :role,
                1
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            "nom" => $data["nom"],
            "prenom" => $data["prenom"],
            "email" => $data["email"],
            "telephone" => $data["telephone"],
            "password" => $data["password"],
            "role" => $data["role"]
        ]);
    }

    /**
     * Modification d'un utilisateur
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE users SET

                nom = :nom,
                prenom = :prenom,
                email = :email,
                telephone = :telephone,
                role = :role

            WHERE id = :id
        ";

        $data["id"] = $id;

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($data);
    }


        /**
     * Suppression définitive
     * (à utiliser uniquement si nécessaire)
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM users
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Désactiver un utilisateur
     */
    public function deactivate(int $id): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE users
            SET actif = 0
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Réactiver un utilisateur
     */
    public function reactivate(int $id): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE users
            SET actif = 1
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Inverser l'état actif/inactif
     */
    public function toggleActive(int $id): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE users
            SET actif = IF(actif = 1, 0, 1)
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Vérifie si un email existe déjà
     */
    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        if ($excludeId !== null) {

            $stmt = $this->pdo->prepare("
                SELECT COUNT(*)
                FROM users
                WHERE email = ?
                AND id != ?
            ");

            $stmt->execute([$email, $excludeId]);

        } else {

            $stmt = $this->pdo->prepare("
                SELECT COUNT(*)
                FROM users
                WHERE email = ?
            ");

            $stmt->execute([$email]);
        }

        return (int)$stmt->fetchColumn() > 0;
    }

    /**
     * Recherche par email
     */
    public function getByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE email = ?
            LIMIT 1
        ");

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Mise à jour du mot de passe
     */
    public function updatePassword(int $id, string $password): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE users
            SET password = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $password,
            $id
        ]);
    }
}