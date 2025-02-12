<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: rgb(36, 35, 35);
            color: whitesmoke;
            text-align: center;
        }
        h1 {
            color: rgb(233, 42, 172);
            font-size: 80px;
            
        }
        a {
            color: rgb(233, 42, 172);
            text-decoration: none;
            padding: 10px 20px;
            border: white 2px solid;
            margin-top: 20px;
            display: inline-block;
        }
        a:hover {
            background-color: rgb(232, 76, 183);
        }
    </style>
</head>
<body>
    <h1>Bienvenue</h1>
    <?php if(isset($_SESSION['user'])): ?>
        <p>Identifiant: <?php echo htmlspecialchars($_SESSION['user']['login']); ?></p>
        <p>Email: <?php echo htmlspecialchars($_SESSION['user']['email']); ?></p>
        <p>Fonction: <?php echo htmlspecialchars($_SESSION['user']['fonction']); ?></p>
        <a href="index.php?action=logout">Déconnexion</a>
    <?php else: ?>
        <p>Vous n'êtes pas connecté.</p>
        <a href="index.php?action=login">Se connecter</a>
    <?php endif; ?>
</body>
</html>