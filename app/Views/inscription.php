<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background: #151515;
            padding: 45px 40px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 0 25px rgba(255, 0, 0, 0.25);
            border: 1px solid #2a2a2a;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #ff2e2e;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        label {
            font-size: 14px;
            color: #cccccc;
        }

        input {
            width: 93%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            background: #1f1f1f;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
        }

        input:focus {
            outline: none;
            border-color: #ff2e2e;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: #ff2e2e;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.25s;
            box-shadow: 0 5px 15px rgba(255, 46, 46, 0.4);
            margin-top: 10px;
        }

        .btn:hover {
            background: #d40000;
            transform: translateY(-2px);
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #cccccc;
            text-decoration: none;
            font-size: 14px;
            margin: 0 8px;
        }

        .links a:hover {
            color: #ff2e2e;
        }

        .error {
            color: #ff4d4d;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Créer un compte</h2>

    <?php if(isset($validation)): ?>
        <div class="error">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('inscription/traiteInscription') ?>" method="post">

        <label>Nom</label>
        <input type="text" name="nom" required>

        <label>Prénom</label>
        <input type="text" name="prenom" required>

        <label>Identifiant</label>
        <input type="text" name="identifiant" required>

        <label>Mot de passe</label>
        <input type="password" name="mdp" required>

        <label>Code coach</label>
        <input type="password" name="code_coach">

        <button type="submit" class="btn">S'inscrire</button>
    </form>

    <div class="links">
        <a href="<?= site_url('connexion') ?>">Connexion</a>
        |
        <a href="<?= site_url('/') ?>">Retour accueil</a>
    </div>

</div>

</body>
</html>
