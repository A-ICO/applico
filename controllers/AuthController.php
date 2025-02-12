<?php
class AuthController {
    private $user;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function validateLogin($login, $email, $password) {
        $errors = [];
        
        // Validation du login
        if(empty($login)) {
            $errors[] = "Le nom d'utilisateur est obligatoire";
        } elseif(!preg_match('/^[A-Z][a-z]{2,29}$/', $login)) {
            $errors[] = "veuillez entrer un nom d'utilisateur valide.";
        }

        // Validation de l'email
        if(empty($email)) {
            $errors[] = "L'email est obligatoire";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Veuillez entrer une adresse email valide.";
        }
        
        // Validation du mot de passe
        if(empty($password)) {
            $errors[] = "Veuillez entrer un mot de passe valide.";
        }
        
        return $errors;
    }
    // controllers/AuthController.php
public function cancel() {
    // Si l'utilisateur était en train de s'enregistrer ou de se connecter,
    // on le redirige vers la page de login
    header("Location: index.php?action=login");
    exit;
}

public function logout() {
    session_destroy();
    header("Location: index.php?action=login");
    exit;
}

    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = $this->validateLogin(
                $_POST['login'] ?? '', 
                $_POST['email'] ?? '', 
                $_POST['password'] ?? ''
            );
            
            if(empty($errors)) {
                $user = $this->user->authenticate($_POST['email'], $_POST['password'], $_POST['login']);
                if($user) {
                    session_start();
                    $_SESSION['user'] = [
                        'id' => $user['id_user'],
                        'email' => $user['email_user'],
                        'login' => $user['login_user'],
                        'fonction' => $user['fonction']
                    ];
                    header("Location: index.php?action=home");
                    exit;
                } else {
                    $errors[] = "Identifiants incorrects";
                }
            }
            
            include 'views/login.php';
        } else {
            include 'views/login.php';
        }
    }
}
