<?php

$success = isset($_GET["success"]);

include "../app/views/layouts/header.php";

?>

<div class="container mt-5">

<h2>Mot de passe oublié</h2>

<?php if($success): ?>

<div class="alert alert-success">

Si cette adresse existe, un lien de réinitialisation a été envoyé.

</div>

<?php endif; ?>

<form action="../app/controllers/ForgotPasswordController.php" method="POST">

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<button class="btn btn-primary">

Envoyer

</button>

</form>

</div>

<?php include "../app/views/layouts/footer.php"; ?>