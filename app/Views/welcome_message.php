<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    <style>
body {
    font-family: 'Arial', Helvetica, sans-serif;
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
    text-align: center;
    box-shadow: 0 0 25px rgba(255, 0, 0, 0.25);
    width: 360px;
    border: 1px solid #2a2a2a;
}

h1 {
    margin-bottom: 15px;
    font-size: 28px;
    color: #ff2e2e;
    text-transform: uppercase;
    letter-spacing: 1px;
}

p {
    margin-bottom: 30px;
    color: #cccccc;
    font-size: 15px;
}

.btn {
    display: block;
    padding: 14px;
    margin: 15px 0;
    background: #ff2e2e;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.25s;
    box-shadow: 0 5px 15px rgba(255, 46, 46, 0.4);
}

.btn:hover {
    background: #d40000;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #2d2d2d;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
}

.btn-secondary:hover {
    background: #3a3a3a;
}

    </style>
</head>
<body>

<div class="container">
    <h1>Bienvenue sur notre site</h1>
    <p>Veuillez vous connecter ou créer un compte pour continuer.</p>

    <a href="<?php echo base_url(); ?>/connexion" class="btn">Connexion</a>
    <a href="<?php echo base_url(); ?>/inscription" class="btn btn-secondary">Inscription</a>
</div>

</body>
</html>
