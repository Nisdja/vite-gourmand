# Vite & Gourmand

Application web de gestion d'un service traiteur développée dans le cadre de l'ECF Développeur Web et Web Mobile de Studi.

---

# Fonctionnalités

## Clients

- Création d'un compte
- Connexion / Déconnexion
- Modification du profil
- Consultation des menus
- Filtrage dynamique des menus (AJAX)
- Création d'une commande
- Calcul automatique du prix
- Livraison gratuite à Bordeaux
- Livraison hors Bordeaux (5 € + 0,59 €/km)
- Remise de 10 % à partir de 5 personnes
- Historique des commandes
- Dépôt d'avis après une commande

---

## Employés

- Tableau de bord
- Consultation des commandes
- Modification du statut des commandes
- Historique des changements de statut
- Gestion du matériel

---

## Administrateurs

- Gestion des utilisateurs
- Création de comptes employés
- Activation / désactivation des comptes
- Gestion complète des menus
- Gestion complète des commandes
- Validation des avis clients

---

# Notifications par e-mail

L'application utilise **PHPMailer** pour envoyer automatiquement :

- E-mail de bienvenue
- Confirmation de commande
- Création d'un compte employé
- Réinitialisation du mot de passe
- Notification de commande terminée
- Notification de retour du matériel

---

# Technologies utilisées

- PHP 8
- MySQL
- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- AJAX
- Composer
- PHPMailer
- MongoDB (statistiques)

---

# Installation

## 1. Cloner le projet

```bash
git clone https://github.com/Nisdja/vite-gourmand.git
```

ou copier le dossier dans :

```text
C:\xampp\htdocs\vite-gourmand
```

---

## 2. Installer les dépendances

```bash
composer install
```

---

## 3. Importer la base de données

Importer le fichier :

```text
vite_gourmand.sql
```

dans phpMyAdmin.

---

## 4. Configurer la base de données

Modifier le fichier :

```text
app/config/database.php
```

avec vos informations de connexion MySQL.


# Lancement du projet

En local :

```text
http://localhost/vite-gourmand/public/
```

En ligne :

```text
https://vitegourmand.ifree.page/vite-gourmand/public/
```

---

# Comptes de démonstration

## Administrateur

```
Email : admin@vitegourmand.fr
Mot de passe : Admin@12345
```

## Employé

```
Email : djamel@test
Mot de passe : Djamel0101
```

## Client

```
Email : djamelchebani@gmail.com
Mot de passe : Djamel0101*
```

---

# Gestion de projet

- GitHub : https://github.com/Nisdja/vite-gourmand
- Trello : https://trello.com/b/0fK3i4hW/vite-gourmand

---

# Auteur

**CHEBANI Djanis**

Projet réalisé dans le cadre de l'ECF Développeur Web et Web Mobile - Studi. 