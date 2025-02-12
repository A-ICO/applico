<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
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
        .form-group { 
            margin-bottom: 15px; 
            width: 300px;
            position: relative;}
            
        span{
            color: red;
            font-size: 0.8em;
            position: absolute;
            right: 0;
            top: 5px;}

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
            display: block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Utilisateur</h1>
    
    <?php if (!empty($errors)): ?>
        <?php foreach($errors as $error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <form method="POST" action="index.php?action=register" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="login">Utilisateur:</label>
            <input type="text" id="login" name="login" required>
            <span id="loginError" class="error-message">Veuillez entrer un nom d'utilisateur valide</span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span id="emailError" class="error-message">Veuillez entrer une adresse email valide.</span>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            <span id="passwordError" class="error-message">Veuillez entrer un mot de passe valide.</span>
        </div>
        <div class="form-group">
            <label for="fonction">Fonction:</label>
            <input type="text" id="fonction" name="fonction" required>
            <span id="fonctionError" class="error-message">Veuillez saisir une fonction.</span>
        </div>
        
        <div class="button-group">
            <button type="submit">S'inscrire</button>
            <button type="button" onclick="window.location.href='index.php?action=cancel'">Annuler</button>
        </div>
    </form>
    
    <a href="index.php?action=cancel">Retour à l'accueil</a>

    <script>
    function validateForm() {
        var login = document.getElementById('login').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var fonction = document.getElementById('fonction').value;

        var loginError = document.getElementById('loginError');
        var emailError = document.getElementById('emailError');
        var passwordError = document.getElementById('passwordError');
        var fonctionError = document.getElementById('fonctionError');

        var loginRegex = /^[A-Z][a-z]{2,29}$/;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@%*+\-_!])[A-Za-z\d$@%*+\-_!]{6,}$/;
        var fonctionRegex = /^[a-zA-ZÀ-ÿ\s]{3,30}$/;

        loginError.style.display = 'none';
        emailError.style.display = 'none';
        passwordError.style.display = 'none';
        fonctionError.style.display = 'none';

        var isValid = true;

        if (login.value.trim() === '') {
            loginError.textContent = 'Le login est obligatoire';
            loginError.style.display = 'block';
            isValid = false;
        } else if (!loginRegex.test(login.value)) {
            loginError.textContent = 'Doit commencer par une majuscule (3-30 caractères)';
            loginError.style.display = 'block';
            isValid = false;
        }

        // Email validation
        if (email.value.trim() === '') {
            emailError.textContent = 'L\'email est obligatoire';
            emailError.style.display = 'block';
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            emailError.textContent = 'Email invalide';
            emailError.style.display = 'block';
            isValid = false;
        }

        // Password validation
        if (password.value.trim() === '') {
            passwordError.textContent = 'Le mot de passe est obligatoire';
            passwordError.style.display = 'block';
            isValid = false;
        } else if (!passwordRegex.test(password.value)) {
            passwordError.textContent = 'Mot de passe invalide';
            passwordError.style.display = 'block';
            isValid = false;
        }

        // Fonction validation
        if (fonction.value.trim() === '') {
            fonctionError.textContent = 'La fonction est obligatoire';
            fonctionError.style.display = 'block';
            isValid = false;
        } else if (!fonctionRegex.test(fonction.value)) {
            fonctionError.textContent = 'Fonction invalide';
            fonctionError.style.display = 'block';
            isValid = false;
        }

        return isValid;
    }

    // Ajouter des écouteurs d'événements pour masquer les erreurs lors de la saisie
    ['login', 'email', 'password', 'fonction'].forEach(function(id) {
        var input = document.getElementById(id);
        var errorSpan = document.getElementById(id + 'Error');
        
        input.addEventListener('input', function() {
            errorSpan.style.display = 'none';
        });
    });
    </script>
</body>
</html>