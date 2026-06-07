# Magazikn — Plateforme de Gestion de Magasin

Plateforme web de gestion de stock et de ventes, développée en PHP/MySQL dans le cadre d'un projet académique à l'ENEAM (Cotonou, Bénin).

---

## Fonctionnalités

- **Authentification** — Connexion / Inscription avec session PHP
- **Gestion des articles** — Ajout, consultation et suivi du stock
- **Gestion des clients** — Liste et suivi des clients
- **Enregistrement des ventes** — Saisie et historique des ventes
- **Tableau de bord** — Vue d'ensemble de l'activité du magasin

---

## Stack technique

| Côté | Technologie |
|------|-------------|
| Backend | PHP 8+ |
| Base de données | MySQL / MariaDB |
| Frontend | HTML5, CSS3, JavaScript (vanilla) |
| Hébergement (demo) | InfinityFree |

---

## Structure du projet

```
magazikn/
├── config/
│   └── db.php              # Configuration base de données (template)
├── public/
│   └── assets/             # Images et ressources statiques
├── src/
│   ├── authent.php         # Connexion / Inscription
│   ├── acceuil.php         # Tableau de bord
│   ├── article.php         # Liste des articles
│   ├── ajoutarticle.php    # Ajout d'article
│   ├── listclient.php      # Liste des clients
│   ├── enregistrervente.php # Enregistrement d'une vente
│   └── voirvente.php       # Historique des ventes
├── .gitignore
├── env.local.example
└── README.md
```

---

## Installation locale

**1. Cloner le repo**
```bash
git clone https://github.com/lopere008/magazikn.git
cd magazikn
```

**2. Configurer la base de données**
```bash
cp env.local.example .env.local
# Éditez .env.local avec vos credentials MySQL
```

**3. Créer les tables MySQL**

Exécutez le schéma suivant dans phpMyAdmin ou via CLI :

```sql
CREATE TABLE articles (
    id_article VARCHAR(20) PRIMARY KEY,
    designation VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    categorie VARCHAR(50)
);

CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    contact VARCHAR(50)
);

CREATE TABLE vente (
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    id_article VARCHAR(20),
    id_client INT,
    quantite INT NOT NULL,
    date_vente DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_article) REFERENCES articles(id_article),
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);
```

**4. Lancer avec PHP CLI**
```bash
php -S localhost:8000 -t src/
```

Ouvrez ensuite [http://localhost:8000/authent.php](http://localhost:8000/authent.php)

---

## Démo en ligne

> Déployé sur InfinityFree : `magazin001infinityfree.great-site.net`

