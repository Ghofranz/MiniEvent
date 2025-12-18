# 🎫 MiniEvent

---

## 📋 Description

**MiniEvent** est une application web complète de gestion d'événements développée en PHP natif suivant l'architecture MVC. Elle permet aux administrateurs de créer et gérer des événements, tandis que les visiteurs peuvent consulter les événements disponibles et effectuer des réservations en ligne.

---

## ✨ Fonctionnalités

### 👥 Côté Visiteur
- 🔍 **Consultation des événements** - Liste complète 
- 📄 **Détails complets** - Informations détaillées sur chaque événement
- 🎟️ **Réservation en ligne** - Formulaire de réservation simple et intuitif
- 📊 **Disponibilité en temps réel** - Affichage du nombre de places restantes
- 🚫 **Protection anti-doublon** - Une seule réservation par email par événement

### 🔐 Côté Administrateur
- 📊 **Tableau de bord** - Vue d'ensemble avec statistiques (événements, réservations, etc.)
- ➕ **Gestion des événements** - Création, modification, suppression
- 🖼️ **Upload d'images** - Support des images pour chaque événement
- 📋 **Gestion des réservations** - Consultation par événement
- 📤 **Export CSV** - Exportation des listes de réservations
- 🖨️ **Impression** - Fonction d'impression intégrée

---

## 🛠️ Technologies

| Catégorie | Technologies |
|-----------|-------------|
| **Backend** | PHP 8.0+, PDO |
| **Base de données** | MySQL 5.7+ / MariaDB |
| **Gestion BDD** | phpMyAdmin |
| **Serveur local** | XAMPP / WAMP / MAMP |
| **Frontend** | HTML5, CSS3, JavaScript (Vanilla) |

---
## 📁 Architecture

```
MiniEvent/
├── 📂 app/
│   ├── 📂 controllers/
│   │   ├── AdminController.php      # Gestion admin (dashboard, CRUD events)
│   │   ├── EventController.php      # Affichage des événements
│   │   └── ReservationController.php # Gestion des réservations
│   │
│   ├── 📂 models/
│   │   ├── Admin.php                # Modèle administrateur
│   │   ├── Event.php                # Modèle événement
│   │   └── Reservation.php          # Modèle réservation
│   │
│   └── 📂 views/
│       ├── 📂 admin/
│       │   ├── dashboard.php        # Tableau de bord
│       │   ├── form_event.php       # Formulaire création/édition
│       │   ├── login.php            # Page de connexion
│       │   └── reservations.php     # Liste des réservations
│       │
│       ├── 📂 events/
│       │   ├── details.php          # Détails d'un événement
│       │   └── list.php             # Liste des événements
│       │
│       └── 📂 partials/
│           ├── header.php           # En-tête commun
│           └── footer.php           # Pied de page commun
│
├── 📂 config/
│   ├── database.php                 # Configuration BDD (myPhpAdmin-xampp)
│   └── routes.php                   # Routage de l'application
│
├── 📂 public/
│   ├── 📂 css/
│   │   └── style.css               # Styles principaux
│   ├── 📂 js/
│   │   └── script.js               # Scripts JavaScript                
│   └── index.php                    # Point d'entrée
│
└── README.md
```

---

📸 Captures d'écran
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/07fa61ae-f9d7-46ad-a68b-f635d03972c3" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/f739f30d-698a-45d2-901e-1df8ca9d7f6a" />
 <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/04fb72c3-7fdf-4d28-a343-813140e9d473" />
 <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/31db2977-080f-4bdc-8ec2-b798cf833b74" />
 <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/779aea5d-92fa-4b24-887b-5187dfd6eda7" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/45c3bb84-9c28-40c1-8a37-78ae72bcc14b" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/104cb959-8789-4413-8503-28f5643b5800" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/378e2323-f718-4c09-a5ac-b724a29e1fad" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/fb83e647-00bb-433f-bd8e-c3538bbc0fcd" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/4149f7d4-915f-4a45-9aed-eb143816070e" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/80f7b1dc-3322-4c32-99d6-a7913bba3e53" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/c39559d0-6f60-4b4c-9ddd-5a9eeeb3f756" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/991bbf16-9894-4216-819c-ba6f068b6252" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/e9385481-1ead-46b6-b813-ce4252861257" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/780e12f2-696d-417c-8d84-c0e41b931b79" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/da914dc1-c8be-4f95-95ab-e6120bc40f4b" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/4680fdc5-e72c-4b0c-b7e0-445b34bb8ec1" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/efd3b233-7054-4239-8b19-1ffbb2c2d4bf" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/e1686c50-6cb1-4f8f-a648-52e707ed683d" />
---

## 🚀 Installation

### Prérequis

- **XAMPP** / **WAMP** / **MAMP** (inclut PHP, MySQL et phpMyAdmin)
- PHP 8.0 ou supérieur
- MySQL 5.7+ ou MariaDB

### Étapes d'installation

#### 1. Installer XAMPP

Télécharger et installer XAMPP depuis [apachefriends.org](https://www.apachefriends.org/)

#### 2. Cloner/Copier le projet

Copier le dossier du projet dans le répertoire `htdocs` de XAMPP :
```
C:\xampp\htdocs\minievent\
```

#### 3. Démarrer les services

Ouvrir le **XAMPP Control Panel** et démarrer :
- ✅ **Apache**
- ✅ **MySQL**

#### 4. Créer la base de données avec phpMyAdmin
<img width="1232" height="379" alt="image" src="https://github.com/user-attachments/assets/06ebd1fb-47d1-4291-b820-da44bfa16948" />

1. Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`

2. Cliquer sur **"Nouvelle base de données"**

3. Nom de la base : `minievent`

4. Interclassement : `utf8mb4_unicode_ci`

5. Cliquer sur **"Créer"**

#### 5. Importer les tables

Dans phpMyAdmin, sélectionner la base `minievent`, puis aller dans l'onglet **SQL** et exécuter :

```sql
-- Table des administrateurs
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des événements
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    event_date DATE,
    event_time TIME,
    location VARCHAR(255),
    seats INT DEFAULT 25,
    image VARCHAR(255) DEFAULT 'default.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des réservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    UNIQUE KEY unique_reservation (event_id, email)
);

-- Créer un admin par défaut (mot de passe: admin123)
INSERT INTO admin (username, password_hash) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
```

<img width="1388" height="471" alt="image" src="https://github.com/user-attachments/assets/97efdedd-a50b-45aa-94e1-19d7f040c760" />
<img width="1159" height="495" alt="image" src="https://github.com/user-attachments/assets/945488a0-ba4f-40a1-adae-7dc016597781" />


#### 6. Configurer la connexion

Modifier le fichier `config/database.php` selon votre configuration :

```php
private $host = "127.0.0.1";
private $port = "3306";        // Port MySQL (3306 par défaut, 3307 si conflit)
private $db_name = "minievent";
private $username = "root";
private $password = "";        // Vide par défaut sur XAMPP
```

#### 7. Lancer l'application

**Option A - Via XAMPP (Apache) :**
```
http://localhost/minievent/public/
```

**Option B - Via PHP built-in server :**
```bash
cd C:\xampp\htdocs\minievent\public
php -S localhost:8000
```
Puis accéder à `http://localhost:8000`

#### 8. Connexion admin

- **URL** : `http://localhost:8000/admin/login`
- **Utilisateur** : `admin`
- **Mot de passe** : `admin123`

---
 ✨Equipe de travaille:

 -Ghofran Zouaghi 
 -Eya hedhili
