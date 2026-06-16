# Magazikn — Plateforme de Gestion de Magasin

Plateforme web de gestion de stock et de ventes, développée en PHP/MySQL.

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

---

## Démo en ligne

> Déployé sur InfinityFree : `http://magazin001infinityfree.great-site.net/authent.php`

