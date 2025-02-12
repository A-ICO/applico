<?php
class UserController {
    private $user;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function validateRegistration($data) {
        $errors = [];
        
        // Validation de l'email
        if(empty($data['email'])) {
            $errors[] = "L'email est obligatoire";
        } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format d'email invalide";
        } elseif($this->user->emailExists($data['email'])) {
            $errors[] = "Cet email est déjà utilisé";
        }
        
        // Validation du login (commence par une majuscule)
        if(empty($data['login'])) {
            $errors[] = "Le login est obligatoire";
        } elseif(!preg_match('/^[A-Z][a-z]{2,29}$/', $data['login'])) {
            $errors[] = "Le login doit commencer par une majuscule (3-30 caractères)";
        }
        
        // Validation du mot de passe
        if(empty($data['password'])) {
            $errors[] = "Le mot de passe est obligatoire";
        } elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@%*+\-_!])[A-Za-z\d$@%*+\-_!]{6,}$/', $data['password'])) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial";
        }
        
        // Validation de la fonction
        if(empty($data['fonction'])) {
            $errors[] = "La fonction est obligatoire";
        } elseif(!preg_match('/^[a-zA-ZÀ-ÿ\s]{3,30}$/', $data['fonction'])) {
            $errors[] = "La fonction doit contenir entre 3 et 30 caractères";
        }
        
        return $errors;
    }

    public function register() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = $this->validateRegistration($_POST);
            
            if(empty($errors)) {
                if($this->user->create(
                    $_POST['email'],
                    $_POST['login'],
                    $_POST['password'],
                    $_POST['fonction']
                )) {
                    header("Location: index.php?action=login&success=1");
                    exit;
                } else {
                    $errors[] = "Une erreur est survenue";
                }
            }
            
            include 'views/register.php';
        } else {
            include 'views/register.php';
        }
    }
}