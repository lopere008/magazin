<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Plateforme Magasin</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #1a2744;
            --gold: #c8a84b;
            --white: #ffffff;
            --gray: #f4f4f0;
            --text: #222;
            --error: #c0392b;
            --success: #1a7a4a;
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
            width: 420px;
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
            padding: 28px 36px 0;
            text-align: center;
            border-bottom: 4px solid var(--gold);
        }

        .card-header h1 {
            font-family: 'Merriweather', serif;
            color: var(--white);
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
        }

        /* ── ONGLETS ── */
        .tabs {
            display: flex;
        }

        .tab-btn {
            flex: 1;
            padding: 10px 0;
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.5);
            font-family: 'Source Sans 3', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: color 0.2s, border-color 0.2s;
        }

        .tab-btn.active {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }

        /* ── CORPS ── */
        .card-body {
            padding: 32px 36px 36px;
        }

        .panel { display: none; }
        .panel.active { display: block; }

        /* ── CHAMPS ── */
        .field { margin-bottom: 20px; }

        .field label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 7px;
        }

        .field input {
            width: 100%;
            padding: 11px 13px;
            border: 1.5px solid var(--border);
            border-radius: 3px;
            font-size: 0.95rem;
            font-family: 'Source Sans 3', sans-serif;
            color: var(--text);
            background: #fafaf8;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .field input:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(26,39,68,0.1);
            background: var(--white);
        }

        .field input.error-input {
            border-color: var(--error);
            box-shadow: 0 0 0 3px rgba(192,57,43,0.1);
        }

        .field-hint {
            font-size: 0.77rem;
            color: #888;
            margin-top: 5px;
        }

        /* ── ALERTES ── */
        .alert {
            display: none;
            font-size: 0.87rem;
            padding: 10px 14px;
            border-radius: 2px;
            margin-bottom: 18px;
            font-weight: 600;
            border-left: 3px solid;
        }

        .alert.error   { background: #fdf0ef; border-color: var(--error);   color: var(--error);   }
        .alert.success { background: #eaf7f1; border-color: var(--success);  color: var(--success); }

        .attempts-badge {
            display: none;
            font-size: 0.77rem;
            color: var(--error);
            margin-top: 5px;
            font-weight: 600;
        }

        /* ── BOUTON ── */
        .btn {
            width: 100%;
            padding: 13px;
            background: var(--navy);
            color: var(--white);
            border: none;
            border-radius: 3px;
            font-size: 0.93rem;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 4px;
        }

        .btn:hover   { background: #253560; }
        .btn:active  { transform: scale(0.99); }
        .btn:disabled { background: #999; cursor: not-allowed; }

        /* ── LIEN ── */
        .switch-link {
            display: block;
            text-align: center;
            margin-top: 14px;
            background: none;
            border: none;
            color: var(--navy);
            font-size: 0.84rem;
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
            font-family: 'Source Sans 3', sans-serif;
        }

        /* ── ÉCRAN SUCCÈS ── */
        .success-screen {
            display: none;
            text-align: center;
            padding: 10px 0 6px;
        }

        .success-icon {
            font-size: 3rem;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .success-screen h2 {
            font-family: 'Merriweather', serif;
            color: var(--navy);
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .success-screen p {
            color: #555;
            font-size: 0.92rem;
            margin-bottom: 18px;
        }

        /* ── ANIMATION SHAKE ── */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%       { transform: translateX(-8px); }
            40%       { transform: translateX(8px); }
            60%       { transform: translateX(-5px); }
            80%       { transform: translateX(5px); }
        }
        .shake { animation: shake 0.4s ease; }
    </style>
</head>
<body>

<div class="card">

    <!-- EN-TÊTE -->
    <div class="card-header">
        <h1>Plateforme Magasin</h1>
        <div class="tabs">
            <button class="tab-btn active" id="tab-login"    onclick="switchTab('login')">Connexion</button>
            <button class="tab-btn"        id="tab-register" onclick="switchTab('register')">Inscription</button>
        </div>
    </div>

    <div class="card-body">

        <!-- ══════════════════════════════
             PANNEAU CONNEXION
        ══════════════════════════════ -->
        <div class="panel active" id="panel-login">

            <div class="alert error" id="login-alert"></div>

            <div class="field">
                <label for="l-login">Login</label>
                <input type="text" id="l-login" placeholder="Entrez votre login" autocomplete="username">
            </div>

            <div class="field">
                <label for="l-pass">Mot de passe</label>
                <input type="password" id="l-pass" placeholder="Entrez votre mot de passe" autocomplete="current-password">
                <span class="attempts-badge" id="l-attempts"></span>
            </div>

            <button class="btn" id="login-btn" onclick="doLogin()">Se connecter</button>
            <button class="switch-link" onclick="switchTab('register')">Pas encore de compte ? S'inscrire</button>

        </div>

        <!-- ══════════════════════════════
             PANNEAU INSCRIPTION
        ══════════════════════════════ -->
        <div class="panel" id="panel-register">

            <div class="alert error"   id="reg-alert"></div>
            <div class="alert success" id="reg-success"></div>

            <div class="field">
                <label for="r-login">Login</label>
                <input type="text" id="r-login" placeholder="Choisissez un login" autocomplete="username">
                <div class="field-hint">Entre 3 et 20 caractères, sans espace</div>
            </div>

            <div class="field">
                <label for="r-pass">Mot de passe</label>
                <input type="password" id="r-pass" placeholder="Choisissez un mot de passe" autocomplete="new-password">
                <div class="field-hint">Minimum 4 caractères</div>
            </div>

            <div class="field">
                <label for="r-pass2">Confirmer le mot de passe</label>
                <input type="password" id="r-pass2" placeholder="Répétez le mot de passe" autocomplete="new-password">
            </div>

            <button class="btn" id="reg-btn" onclick="doRegister()">Créer un compte</button>
            <button class="switch-link" onclick="switchTab('login')">Déjà inscrit ? Se connecter</button>

        </div>

        <!-- ══════════════════════════════
             ÉCRAN SUCCÈS
        ══════════════════════════════ -->
        <div class="success-screen" id="success-screen">
            <div class="success-icon">✓</div>
            <h2 id="success-title">Bienvenue !</h2>
            <p  id="success-msg">Redirection en cours...</p>
            <button class="switch-link" onclick="resetAll()">← Retour</button>
        </div>

    </div>
</div>

<script>
    /* ─────────────────────────────────────
       CONFIGURATION
    ───────────────────────────────────── */
    const MAX_ATTEMPTS = 3;
    let passwordAttempts = 0;

    /* ─────────────────────────────────────
       STOCKAGE DES COMPTES (localStorage)
       Les comptes sont sauvegardés dans le
       navigateur sous la clé "pm_users".
       Format : { "login": "motdepasse", ... }
    ───────────────────────────────────── */
    function getUsers() {
        try { return JSON.parse(localStorage.getItem('pm_users') || '{}'); }
        catch (e) { return {}; }
    }

    function saveUsers(users) {
        localStorage.setItem('pm_users', JSON.stringify(users));
    }

    /* ─────────────────────────────────────
       NAVIGATION ENTRE ONGLETS
    ───────────────────────────────────── */
    function switchTab(tab) {
        document.getElementById('panel-login').classList.toggle('active',    tab === 'login');
        document.getElementById('panel-register').classList.toggle('active', tab === 'register');
        document.getElementById('tab-login').classList.toggle('active',      tab === 'login');
        document.getElementById('tab-register').classList.toggle('active',   tab === 'register');
        clearAlerts();
    }

    /* ─────────────────────────────────────
       UTILITAIRES
    ───────────────────────────────────── */
    function clearAlerts() {
        ['login-alert', 'reg-alert', 'reg-success'].forEach(function(id) {
            var el = document.getElementById(id);
            el.style.display = 'none';
            el.textContent = '';
        });
        document.getElementById('l-attempts').style.display = 'none';
        ['l-login', 'l-pass', 'r-login', 'r-pass', 'r-pass2'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.classList.remove('error-input');
        });
    }

    function showAlert(id, message) {
        var el = document.getElementById(id);
        el.textContent = message;
        el.style.display = 'block';
    }

    function shake(inputId) {
        var el = document.getElementById(inputId);
        el.classList.remove('shake');
        void el.offsetWidth; // force le redémarrage de l'animation
        el.classList.add('shake');
    }

    /* ─────────────────────────────────────
       CONNEXION
    ───────────────────────────────────── */
    function doLogin() {
        clearAlerts();

        var login = document.getElementById('l-login').value.trim();
        var pass  = document.getElementById('l-pass').value;
        var btn   = document.getElementById('login-btn');

        // Champs vides
        if (!login || !pass) {
            showAlert('login-alert', 'Veuillez remplir tous les champs.');
            return;
        }

        var users = getUsers();

        // Login introuvable
        if (!users.hasOwnProperty(login)) {
            document.getElementById('l-login').classList.add('error-input');
            shake('l-login');
            document.getElementById('l-login').value = '';
            document.getElementById('l-pass').value  = '';
            showAlert('login-alert', 'Login introuvable. Vérifiez ou créez un compte.');
            document.getElementById('l-login').focus();
            return;
        }

        // Mot de passe incorrect
        if (users[login] !== pass) {
            passwordAttempts++;
            document.getElementById('l-pass').classList.add('error-input');
            shake('l-pass');
            document.getElementById('l-pass').value = '';

            var restants = MAX_ATTEMPTS - passwordAttempts;

            if (passwordAttempts >= MAX_ATTEMPTS) {
                showAlert('login-alert', 'Nombre de tentatives dépassé. Accès bloqué.');
                btn.disabled = true;
                document.getElementById('l-login').disabled = true;
                document.getElementById('l-pass').disabled  = true;
            } else {
                showAlert('login-alert', 'Mot de passe incorrect.');
                var badge = document.getElementById('l-attempts');
                badge.textContent   = 'Tentative ' + passwordAttempts + '/' + MAX_ATTEMPTS + ' — ' + restants + ' essai(s) restant(s)';
                badge.style.display = 'inline';
                document.getElementById('l-pass').focus();
            }
            return;
        }

        // Connexion réussie
        btn.textContent = 'Connexion...';
        btn.disabled    = true;
        setTimeout(function() {
            showSuccessScreen('login', login);
        }, 600);
    }

    /* ─────────────────────────────────────
       INSCRIPTION
    ───────────────────────────────────── */
    function doRegister() {
        clearAlerts();

        var login = document.getElementById('r-login').value.trim();
        var pass  = document.getElementById('r-pass').value;
        var pass2 = document.getElementById('r-pass2').value;
        var btn   = document.getElementById('reg-btn');

        // Champs vides
        if (!login || !pass || !pass2) {
            showAlert('reg-alert', 'Veuillez remplir tous les champs.');
            return;
        }

        // Validation du login
        if (login.length < 3 || login.length > 20 || /\s/.test(login)) {
            document.getElementById('r-login').classList.add('error-input');
            shake('r-login');
            showAlert('reg-alert', 'Le login doit faire entre 3 et 20 caractères, sans espace.');
            return;
        }

        // Validation du mot de passe
        if (pass.length < 4) {
            document.getElementById('r-pass').classList.add('error-input');
            shake('r-pass');
            showAlert('reg-alert', 'Le mot de passe doit faire au moins 4 caractères.');
            return;
        }

        // Confirmation du mot de passe
        if (pass !== pass2) {
            document.getElementById('r-pass2').classList.add('error-input');
            shake('r-pass2');
            showAlert('reg-alert', 'Les mots de passe ne correspondent pas.');
            return;
        }

        // Login déjà pris
        var users = getUsers();
        if (users.hasOwnProperty(login)) {
            document.getElementById('r-login').classList.add('error-input');
            shake('r-login');
            showAlert('reg-alert', 'Le login "' + login + '" est déjà utilisé. Choisissez-en un autre.');
            return;
        }

        // Enregistrement du compte
        users[login] = pass;
        saveUsers(users);

        btn.textContent = 'Compte créé !';
        btn.disabled    = true;
        setTimeout(function() {
            showSuccessScreen('register', login);
        }, 500);
    }

    /* ─────────────────────────────────────
       ÉCRAN DE SUCCÈS
    ───────────────────────────────────── */
    function showSuccessScreen(mode, login) {
        document.getElementById('panel-login').classList.remove('active');
        document.getElementById('panel-register').classList.remove('active');

        var screen = document.getElementById('success-screen');
        screen.style.display = 'block';

        if (mode === 'register') {
            document.getElementById('success-title').textContent = 'Bienvenue, ' + login + ' !';
            document.getElementById('success-msg').textContent   = 'Votre compte a été créé. Vous pouvez maintenant vous connecter.';
        } else {
            document.getElementById('success-title').textContent = 'Bon retour, ' + login + ' !';
            document.getElementById('success-msg').textContent   = 'Connexion réussie. Redirection vers l\'accueil...';
            setTimeout(function() {
                window.location.href = 'acceuil.php'; // <-- change ce chemin si besoin
            }, 1500);
        }
    }

    /* ─────────────────────────────────────
       RÉINITIALISATION (bouton "Retour")
    ───────────────────────────────────── */
    function resetAll() {
        passwordAttempts = 0;

        document.getElementById('success-screen').style.display = 'none';

        var loginBtn = document.getElementById('login-btn');
        loginBtn.textContent = 'Se connecter';
        loginBtn.disabled    = false;

        var regBtn = document.getElementById('reg-btn');
        regBtn.textContent = 'Créer un compte';
        regBtn.disabled    = false;

        ['l-login', 'l-pass', 'r-login', 'r-pass', 'r-pass2'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) { el.value = ''; el.disabled = false; }
        });

        switchTab('login');
    }

    /* ─────────────────────────────────────
       TOUCHE ENTRÉE
    ───────────────────────────────────── */
    ['l-login', 'l-pass'].forEach(function(id) {
        document.getElementById(id).addEventListener('keydown', function(e) {
            if (e.key === 'Enter') doLogin();
        });
    });

    ['r-login', 'r-pass', 'r-pass2'].forEach(function(id) {
        document.getElementById(id).addEventListener('keydown', function(e) {
            if (e.key === 'Enter') doRegister();
        });
    });
</script>

</body>
</html>