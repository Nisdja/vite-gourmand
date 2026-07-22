    <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class MailService
{
    private PHPMailer $mail;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/mail.php';
        
        $this->mail = new PHPMailer(true);

        try {

            $this->mail->isSMTP();

            $this->mail->Host = $config['host'];

            $this->mail->SMTPAuth = true;

            $this->mail->Username = $config['username'];

            $this->mail->Password = $config['password'];

            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $this->mail->Port = $config['port'];

            $this->mail->CharSet = 'UTF-8';

            $this->mail->setFrom(
                $config['from_email'],
                $config['from_name']
            );

            $this->mail->isHTML(true);

        } catch (Exception $e) {
    die(
        "Erreur PHPMailer :<br>" .
        $e->getMessage() .
        "<br><br>Détail :<br>" .
        $this->mail->ErrorInfo
    );
}
    }
    
    /**
     * Envoi générique d'un e-mail
     */
    public function envoyer(
        string $destinataire,
        string $nom,
        string $sujet,
        string $contenu
    ): bool {

        try {

            $this->mail->clearAddresses();

            $this->mail->addAddress(
                $destinataire,
                $nom
            );

            $this->mail->Subject = $sujet;

            $this->mail->Body = $contenu;

            $this->mail->AltBody = strip_tags($contenu);

            return $this->mail->send();

        } catch (Exception $e) {

            error_log(
                "Erreur Mail : " . $this->mail->ErrorInfo
            );

            return false;

        }

    }
         /**
     * Envoie un e-mail de bienvenue après l'inscription.
     */
    public function envoyerBienvenue(array $utilisateur): bool
    {
        $contenu = "
            <h2>Bienvenue chez Vite & Gourmand !</h2>

            <p>Bonjour <strong>{$utilisateur['prenom']} {$utilisateur['nom']}</strong>,</p>

            <p>Votre compte a bien été créé.</p>

            <p>Vous pouvez dès maintenant vous connecter et passer vos commandes.</p>

            <br>

            <p>À bientôt,</p>

            <p><strong>L'équipe Vite & Gourmand</strong></p>
        ";

        return $this->envoyer(
            $utilisateur['email'],
            $utilisateur['prenom'] . ' ' . $utilisateur['nom'],
            'Bienvenue chez Vite & Gourmand',
            $contenu
        );
    }

    /**
     * Confirmation d'une commande.
     */
    public function envoyerConfirmationCommande(array $commande): bool
    {
        $contenu = "
            <h2>Confirmation de votre commande</h2>

            <p>Bonjour <strong>{$commande['prenom']} {$commande['nom']}</strong>,</p>

            <p>Nous avons bien reçu votre commande.</p>

            <ul>
                <li><strong>Date :</strong> {$commande['date_prestation']}</li>
                <li><strong>Ville :</strong> {$commande['ville']}</li>
                <li><strong>Nombre de personnes :</strong> {$commande['nombre_personnes']}</li>
                <li><strong>Total :</strong> {$commande['prix_total']} €</li>
            </ul>

            <p>Notre équipe reviendra vers vous rapidement.</p>

            <br>

            <p>Merci de votre confiance.</p>

            <p><strong>Vite & Gourmand</strong></p>
        ";

        return $this->envoyer(
            $commande['email'],
            $commande['prenom'] . ' ' . $commande['nom'],
            'Confirmation de votre commande',
            $contenu
        );
    }

    /**
     * Création d'un compte employé.
     */
    public function envoyerCreationEmploye(array $employe, string $motDePasse): bool
    {
        $contenu = "
            <h2>Bienvenue dans l'équipe Vite & Gourmand</h2>

            <p>Bonjour {$employe['prenom']} {$employe['nom']},</p>

            <p>Votre compte employé a été créé.</p>

            <p><strong>Email :</strong> {$employe['email']}</p>

            <p><strong>Mot de passe :</strong> {$motDePasse}</p>

            <p>Nous vous conseillons de modifier votre mot de passe dès votre première connexion.</p>

            <br>

            <p>L'équipe Vite & Gourmand</p>
        ";

        return $this->envoyer(
            $employe['email'],
            $employe['prenom'] . ' ' . $employe['nom'],
            'Création de votre compte employé',
            $contenu
        );
    }

        /**
     * Informe le client que sa commande est terminée.
     */
    public function envoyerCommandeTerminee(array $commande): bool
    {
        $contenu = "
            <h2>Votre commande est terminée</h2>

            <p>Bonjour <strong>{$commande['prenom']} {$commande['nom']}</strong>,</p>

            <p>Nous vous informons que votre prestation est désormais terminée.</p>

            <p>Merci de votre confiance et à bientôt chez <strong>Vite & Gourmand</strong>.</p>
        ";

        return $this->envoyer(
            $commande['email'],
            $commande['prenom'] . ' ' . $commande['nom'],
            'Votre commande est terminée',
            $contenu
        );
    }

    /**
     * Informe le client du retour du matériel.
     */
    public function envoyerRetourMateriel(array $commande): bool
    {
        $contenu = "
            <h2>Retour du matériel</h2>

            <p>Bonjour <strong>{$commande['prenom']} {$commande['nom']}</strong>,</p>

            <p>Nous confirmons que le matériel mis à votre disposition a bien été récupéré.</p>

            <p>Nous vous remercions pour votre confiance.</p>

            <p>L'équipe Vite & Gourmand.</p>
        ";

        return $this->envoyer(
            $commande['email'],
            $commande['prenom'] . ' ' . $commande['nom'],
            'Retour du matériel',
            $contenu
        );
    }

    /**
     * Envoie un e-mail de réinitialisation du mot de passe.
     */
    public function envoyerReinitialisationMotDePasse(
        array $utilisateur,
        string $lien
    ): bool {

        $contenu = "
            <h2>Réinitialisation de votre mot de passe</h2>

            <p>Bonjour {$utilisateur['prenom']},</p>

            <p>Vous avez demandé la réinitialisation de votre mot de passe.</p>

            <p>
                <a href='$lien'
                   style='background:#c0392b;
                          color:#fff;
                          padding:12px 18px;
                          text-decoration:none;
                          border-radius:5px;'>
                    Réinitialiser mon mot de passe
                </a>
            </p>

            <p>Si vous n'êtes pas à l'origine de cette demande, ignorez simplement cet e-mail.</p>
        ";

        return $this->envoyer(
            $utilisateur['email'],
            $utilisateur['prenom'] . ' ' . $utilisateur['nom'],
            'Réinitialisation du mot de passe',
            $contenu
        );
    }

}