<?php
require_once "../app/config/database.php";
require_once "../app/services/MailService.php";

$erreurs = [];

$nom = "";
$prenom = "";
$telephone = "";
$adresse = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $telephone = trim($_POST["telephone"]);
    $adresse = trim($_POST["adresse"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Validation
    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "Adresse e-mail invalide.";
    }

    // Mdp sécurisé
    if (
        strlen($password) < 10 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W_]/', $password)
    ) {
        $erreurs[] = "Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
    }

    // Vérifies si l'email existe déjà
    if (empty($erreurs)) {

        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->fetch()) {
            $erreurs[] = "Cet email est déjà utilisé.";
        }
    }

    // si pas d'erreur
    if (empty($erreurs)) {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users
                (nom, prenom, telephone, adresse, email, password, role)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $nom,
            $prenom,
            $telephone,
            $adresse,
            $email,
            $passwordHash,
            "utilisateur"
        ]);

        // Envoi mail 
        $mail = new MailService();

        $mail->envoyerBienvenue([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email
        ]);

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">Créer un compte</h2>

                    <?php if (!empty($erreurs)) : ?>

                        <div class="alert alert-danger">

                            <?php foreach ($erreurs as $erreur) : ?>

                                <div><?= htmlspecialchars($erreur) ?></div>

                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input
                                type="text"
                                class="form-control"
                                name="nom"
                                value="<?= htmlspecialchars($nom) ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input
                                type="text"
                                class="form-control"
                                name="prenom"
                                value="<?= htmlspecialchars($prenom) ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input
                                type="tel"
                                class="form-control"
                                name="telephone"
                                value="<?= htmlspecialchars($telephone) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <input
                                type="text"
                                class="form-control"
                                name="adresse"
                                value="<?= htmlspecialchars($adresse) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="<?= htmlspecialchars($email) ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                required>

                            <small class="text-muted">
                                Minimum 10 caractères avec une majuscule, une minuscule, un chiffre et un caractère spécial.
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            S'inscrire
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>