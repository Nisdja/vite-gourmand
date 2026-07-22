<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../app/config/database.php";
require_once "../app/helpers/session.php";

require_once "../app/models/Menu.php";
require_once "../app/models/Commande.php";

require_once "../app/services/CalculPrixService.php";
require_once "../app/services/MailService.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["menu"])) {
    die("Menu introuvable.");
}

$menuModel = new Menu($pdo);
$commandeModel = new Commande($pdo);

$menu = $menuModel->getById((int) $_GET["menu"]);

if (!$menu) {
    die("Menu inexistant.");
}

$user = $_SESSION["user"];

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombrePersonnes = (int) $_POST["nombre_personnes"];
    $distanceKm = isset($_POST["distance_km"])
        ? (float) $_POST["distance_km"]
        : 0;

    if ($nombrePersonnes < $menu["nb_personnes_min"]) {

        $erreur = "Le minimum est de " . $menu["nb_personnes_min"] . " personnes.";

    } else {

        $calcul = CalculPrixService::calculer(

            (float) $menu["prix"],
            (int) $menu["nb_personnes_min"],
            $nombrePersonnes,
            trim($_POST["ville"]),
            $distanceKm

        );

        $commande = [

            "user_id" => $user["id"],
            "menu_id" => $menu["id"],

            "nom_client" => $user["nom"],
            "prenom_client" => $user["prenom"],
            "email_client" => $user["email"],
            "telephone_client" => $user["telephone"],

            "adresse_livraison" => trim($_POST["adresse"]),
            "ville" => trim($_POST["ville"]),
            "distance_km" => $distanceKm,

            "date_prestation" => $_POST["date_prestation"],
            "heure_livraison" => $_POST["heure_livraison"],

            "nombre_personnes" => $nombrePersonnes,

            "prix_menu" => $calcul["prix_menu"],
            "prix_livraison" => $calcul["prix_livraison"],
            "remise" => $calcul["remise"],
            "prix_total" => $calcul["prix_total"]

        ];

        if ($commandeModel->create($commande)) {

            $commandeId = $pdo->lastInsertId();

            /*
             * Historique du statut
             */
            $stmt = $pdo->prepare("
                INSERT INTO historique_statuts
                (commande_id, statut)
                VALUES (?, ?)
            ");

            $stmt->execute([
                $commandeId,
                "En attente"
            ]);

            /*
 * Envoi de l'e-mail de confirmation
 */
try {

    $mail = new MailService();

    $mail->envoyerConfirmationCommande([
        'prenom' => $commande['prenom_client'],
        'nom' => $commande['nom_client'],
        'email' => $commande['email_client'],
        'date_prestation' => $commande['date_prestation'],
        'ville' => $commande['ville'],
        'nombre_personnes' => $commande['nombre_personnes'],
        'prix_total' => number_format($commande['prix_total'], 2, ',', ' ')
    ]);

} catch (Exception $e) {

    error_log(
        "Erreur d'envoi du mail : " . $e->getMessage()
    );

}

            header("Location: ../user/dashboard.php?commande=ok");
            exit();
        }

        $erreur = "Erreur lors de l'enregistrement.";

    }
}

include "../app/views/commande/create.php";