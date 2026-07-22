<?php

$success = isset($_GET["success"]);

include "../app/views/layouts/header.php";

?>

<div class="container mt-5">

    <h1>Contact</h1>

    <?php if ($success) : ?>

        <div class="alert alert-success">

            Votre message a bien été envoyé.

        </div>

    <?php endif; ?>

    <form action="../app/controllers/ContactController.php" method="POST">

        <div class="mb-3">

            <label>Titre</label>

            <input
                type="text"
                name="titre"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Message</label>

            <textarea
                name="message"
                class="form-control"
                rows="6"
                required></textarea>

        </div>

        <button class="btn btn-primary">

            Envoyer

        </button>

    </form>

</div>

<?php

include "../app/views/layouts/footer.php";

?>