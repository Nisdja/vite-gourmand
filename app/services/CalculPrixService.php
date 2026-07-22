<?php

class CalculPrixService
{
    /**
     * Calcule le prix d'une commande.
     *
     * Règles métier :
     * - Respect du nombre minimum de personnes
     * - Prix proportionnel au nombre de personnes
     * - Remise de 10 % à partir du minimum + 5 personnes
     * - Livraison gratuite à Bordeaux
     * - Hors Bordeaux :
     *      5 € + 0,59 €/km
     */
    public static function calculer(
        float $prixBase,
        int $minimumPersonnes,
        int $nombrePersonnes,
        string $ville,
        float $distanceKm = 0
    ): array {

        // Respect du minimum
        if ($nombrePersonnes < $minimumPersonnes) {
            $nombrePersonnes = $minimumPersonnes;
        }

        // Prix par personne
        $prixParPersonne = $prixBase / $minimumPersonnes;

        // Prix du menu
        $prixMenu = $prixParPersonne * $nombrePersonnes;

        // Remise
        $remise = 0;

        if ($nombrePersonnes >= ($minimumPersonnes + 5)) {
            $remise = $prixMenu * 0.10;
        }

        // Livraison
        $prixLivraison = 0;

        if (mb_strtolower(trim($ville)) !== "bordeaux") {

            $distanceKm = max(0, $distanceKm);

            $prixLivraison = 5 + ($distanceKm * 0.59);
        }

        // Total
        $prixTotal = $prixMenu - $remise + $prixLivraison;

        return [

            "prix_menu" => round($prixMenu, 2),

            "prix_livraison" => round($prixLivraison, 2),

            "remise" => round($remise, 2),

            "prix_total" => round($prixTotal, 2)

        ];
    }
}