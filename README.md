# 🍽️ Vite & Gourmand

Application web de gestion d'un service traiteur réalisée dans le cadre de l'ECF Studi.

---

# Fonctionnalités

## Clients

- Connexion
- Modification du profil
- Consultation des menus
- Filtrage AJAX des menus
- Création d'une commande
- Calcul automatique du prix
- Livraison gratuite à Bordeaux
- Livraison hors Bordeaux (5 € + 0,59 €/km)
- Remise de 10 % à partir du minimum + 5 personnes
- Historique des commandes

---

## Employés

- Tableau de bord
- Consultation des commandes
- Modification du statut
- Historique des statuts

---

## Administrateurs

- Gestion des utilisateurs
- Création d'employés
- Activation / désactivation des comptes
- Gestion complète des menus
- Gestion complète des commandes

---

# Envoi d'e-mails

L'application utilise PHPMailer.

Les e-mails envoyés sont :

- Confirmation de commande
- Création d'un employé
- Réinitialisation du mot de passe
- Commande terminée

---

# Technologies utilisées

- PHP 8
- MySQL
- JavaScript
- AJAX
- Bootstrap 5
- Composer
- PHPMailer
- MongoDB (statistiques)

---

# Installation

## Cloner le projet

```bash
git clone ...
```

ou copier le projet dans :

```
C:\xampp\htdocs\vite-gourmand
```

---

## Installer les dépendances

```bash
composer install
```

---

## Importer la base

Importer :

```
vite_gourmand.sql
```

dans phpMyAdmin.

---

## Configurer la connexion MySQL

Modifier :

```
app/config/database.php
```

---

## Configurer les e-mails

Créer :

```
config/mail.php
```

avec :

```php
return [

    'host'=>'smtp.gmail.com',

    'port'=>587,

    'username'=>'votre@gmail.com',

    'password'=>'mot_de_passe_application',

    'from_email'=>'votre@gmail.com',

    'from_name'=>'Vite & Gourmand'

];
```

---

# Lancer le projet

```
http://localhost/vite-gourmand/public
```

---

# Comptes de test

Administrateur

```
admin@test.fr
********
```

Employé

```
employe@test.fr
********
```

Client

```
client@test.fr
********
```

---

# Auteur

Projet réalisé dans le cadre de l'ECF Studi.