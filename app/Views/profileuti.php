<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir un utilisateur</title>

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
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            color: #ff2e2e;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 24px;
        }

        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 25px;
            background: #1f1f1f;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
        }

        select:focus {
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
            margin-bottom: 15px;
        }

        .btn:hover {
            background: #d40000;
            transform: translateY(-2px);
        }

        .links {
            margin-top: 10px;
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
    </style>
</head>
<body>

<div class="container">

    <h1>Choisissez un utilisateur</h1>

    <form action="<?= base_url('/planning') ?>" method="get">

        <select name="user_id" required>
            <?php foreach ($utilisateurs as $user): ?>
                <option value="<?= $user->id ?>">
                    <?= esc($user->nom) ?> <?= esc($user->prenom) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn">Voir le planning</button>
    </form>
    
    
    <div class="links">
        <a href="<?= base_url('/connexion') ?>">Connexion</a>
        |
        <a href="<?= base_url('/inscription') ?>">Inscription</a>
    </div>

</div>

</body>
</html>
