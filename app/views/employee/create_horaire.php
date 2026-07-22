<?php include __DIR__ . "/../layouts/employee_header.php"; ?>

<h1>Ajouter un horaire</h1>

<?php if (!empty($erreur)) : ?>
<div class="alert alert-danger">
    <?= htmlspecialchars($erreur) ?>
</div>
<?php endif; ?>

<form method="POST">

<div class="mb-3">

<label>Jour</label>

<select
name="jour"
class="form-select">

<option>Lundi</option>
<option>Mardi</option>
<option>Mercredi</option>
<option>Jeudi</option>
<option>Vendredi</option>
<option>Samedi</option>
<option>Dimanche</option>

</select>

</div>

<div class="mb-3">

<label>Ouverture</label>

<input
type="time"
name="ouverture"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Fermeture</label>

<input
type="time"
name="fermeture"
class="form-control"
required>

</div>

<button class="btn btn-success">

Enregistrer

</button>

<a
href="/vite-gourmand/employee/horaires.php"
class="btn btn-secondary">

Retour

</a>

</form>

<?php include __DIR__ . "/../layouts/employee_footer.php"; ?>