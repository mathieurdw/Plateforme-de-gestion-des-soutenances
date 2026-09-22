# 🎓 Application de Gestion des Soutenances et Prise de Rendez-Vous

Une application web dynamique développée en **PHP** suivant l'architecture **MVC (Modèle-Vue-Contrôleur)**. Ce projet vise à automatiser et simplifier la planification des soutenances académiques entre étudiants et examinateurs.

---

## 📌 Table des Matières

- [Fonctionnalités](#-fonctionnalités)
- [Architecture du Projet](#-architecture-du-projet)
- [Technologies Utilisées](#-technologies-utilisées)
- [Base de Données](#-base-de-données)
- [Installation et Configuration](#-installation-et-configuration)
- [Auteurs](#-auteurs)

---

## ✨ Fonctionnalités

### 👥 Gestion des Rôles et Utilisateurs
- **Étudiants** : Inscription, consultation des créneaux disponibles et réservation de rendez-vous pour leurs projets.
- **Examinateurs / Enseignants** : Ajout et gestion des créneaux horaires de disponibilité.
- **Administrateurs** : Vue d'ensemble sur l'ensemble des projets, créneaux et rendez-vous.

### 📅 Plannings et Rendez-Vous
- Attribution dynamique de créneaux aux projets.
- Module dédié aux innovations pour évaluer ou consulter facilement les plannings.

---

## 📁 Architecture du Projet

Le projet suit une structure Modèle-Vue-Contrôleur (MVC) claire :

```text
├── app/
│   ├── controllers/      # Contrôleurs (Projet, Creneau, Personne, RendezVous, etc.)
│   ├── models/           # Modèles de données & ORM de base (Model.php, etc.)
│   ├── router/           # Routage de l'application (router1.php)
│   └── views/            # Vues HTML/PHP (Projets, Créneaux, Connexion, etc.)
├── outil/
│   ├── Connexion.php     # Singleton de connexion PDO à la base de données
│   └── projetdb.sql      # Script d'initialisation SQL
├── public/               # Fichiers statiques (CSS, JS, Bootstrap)
└── index.php             # Point d'entrée principal
