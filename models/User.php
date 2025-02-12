<?php
class User {
    private $conn;
    private $table = "utilisateurs";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($email, $login, $password, $fonction) {
        $query = "INSERT INTO " . $this->table . " 
                SET email_user=:email, 
                    login_user=:login, 
                    pwd_user=:password, 
                    fonction=:fonction";

        try {
            $stmt = $this->conn->prepare($query);
            
            // Nettoyage des données
            $email = htmlspecialchars(strip_tags($email));
            $login = htmlspecialchars(strip_tags($login));
            $fonction = htmlspecialchars(strip_tags($fonction));
            
            // Hash du mot de passe
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            
            // Liaison des paramètres
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":fonction", $fonction);

            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    public function emailExists($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE email_user = :email";
        $stmt = $this->conn->prepare($query);
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function authenticate($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email_user = :email";
        $stmt = $this->conn->prepare($query);
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['pwd_user'])) {
                return $row;
            }
        }
        return false;
    }
}