<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
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
        }
        .error { 
            color: red; 
            margin-bottom: 10px; 
            text-align: center;
        }
        .form-group { 
            margin-bottom: 15px; 
            width: 300px;
        }
        label { 
            display: block; 
            margin-bottom: 5px; 
        }
        input { 
            width: 100%; 
            padding: 8px; 
            margin-bottom: 10px; 
            box-sizing: border-box;
        }
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        button { 
            padding: 10px 20px; 
            background-color: rgb(233, 42, 172); 
            color: white; 
            border: white 2px solid; 
            cursor: pointer; 
        }
        button:hover { 
            background-color: rgb(232, 76, 183); 
        }
        h1 {
            color: rgb(233, 42, 172);
            text-align: center;
            font-size: 80px;
        }
        a {
            color: rgb(233, 42, 172);
            text-decoration: none;
            text-align: center;
        }
        .register-link {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h1>Connexion MVC</h1>
    
    <?php if (!empty($errors)): ?>
        <?php foreach($errors as $error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <form method="POST" action="index.php?action=login" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="login">Utilisateur:</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="button-group">
            <button type="submit">Valider</button>
            <button type="button" onclick="window.location.href='index.php?action=cancel'">Annuler</button>
        </div>
    </form>
    
    <div class="register-link">
        <a href="index.php?action=register">Créer un compte</a>
    </div>

    <script>
    function validateForm() {
        var login = document.getElementById('login').value;
        var email = document.getElementById('email').value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var loginRegex = /^[A-Z][a-z]{2,29}$/;
        
        if (!loginRegex.test(login)) {
            alert('Le nom d\'utilisateur doit commencer par une majuscule et contenir entre 3 et 30 caractères');
            return false;
        }
        
        if (!emailRegex.test(email)) {
            alert('Veuillez entrer une adresse email valide');
            return false;
        }
        return true;
    }
    </script>
</body>
</html>