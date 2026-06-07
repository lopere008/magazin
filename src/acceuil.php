<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Plateforme Magasin</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #1a2744;
            --gold: #c8a84b;
            --gold-light: #e8c87a;
            --white: #ffffff;
            --gray: #f4f4f0;
            --text: #222;
            --border: #d0cfc8;
        }

        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: var(--gray);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(0,0,0,0.03) 40px, rgba(0,0,0,0.03) 41px),
                repeating-linear-gradient(90deg, transparent, transparent 40px, rgba(0,0,0,0.03) 40px, rgba(0,0,0,0.03) 41px);
        }

        .card {
            background: var(--white);
            width: 480px;
            border-radius: 4px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.12);
            overflow: hidden;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── HEADER ── */
        .card-header {
            background: var(--navy);
            padding: 28px 36px 24px;
            text-align: center;
            border-bottom: 4px solid var(--gold);
        }

        .logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 24px;
            margin-bottom: 16px;
        }

        .logos img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            border-radius: 50%;
            background: var(--white);
            padding: 4px;
        }

        .card-header h1 {
            font-family: 'Merriweather', serif;
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .card-header p {
            color: var(--gold-light);
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        /* ── BODY ── */
        .card-body {
            padding: 32px 36px 36px;
        }

        .menu-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .menu-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .menu-list li a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border: 1.5px solid var(--border);
            border-radius: 3px;
            text-decoration: none;
            color: var(--navy);
            font-size: 0.97rem;
            font-weight: 600;
            background: #fafaf8;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }

        .menu-list li a:hover {
            background: var(--navy);
            border-color: var(--navy);
            color: var(--white);
        }

        .menu-list li a:hover .icon {
            color: var(--gold);
        }

        .icon {
            font-size: 1.1rem;
            color: var(--gold);
            transition: color 0.2s;
            width: 20px;
            text-align: center;
        }

        /* ── FOOTER ── */
        .card-footer {
            background: var(--navy);
            padding: 10px;
            text-align: center;
            border-top: 4px solid var(--gold);
        }

        .card-footer span {
            color: var(--gold-light);
            font-size: 0.72rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="card">

    <div class="card-header">
        <div class="logos">
            <img src="logo.png"  alt="Logo UAC">
            <img src="logo2.png" alt="Logo ENEAM">
        </div>
        <h1>Plateforme Magasin</h1>
        <p>Bienvenue dans notre plateforme</p>
    </div>

    <div class="card-body">
        <div class="menu-label">Menu principal</div>
        <ul class="menu-list">
            <li>
                <a href="article.php">
                    <span class="icon">📦</span>
                    Articles
                </a>
            </li>
            <li>
                <a href="voirvente.php">
                    <span class="icon">📋</span>
                    Ventes
                </a>
            </li>
            <li>
                <a href="enregistrervente.php">
                    <span class="icon">🛒</span>
                    Effectuer une vente
                </a>
            </li>
            <li>
                <a href="listclient.php">
                    <span class="icon">👥</span>
                    Liste clients
                </a>
            </li>
        </ul>
    </div>

    <div class="card-footer">
        <span>ENEAM &mdash; Université d'Abomey-Calavi</span>
    </div>

</div>

</body>
</html>