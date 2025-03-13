<?php
require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function login($username, $email) {
        $query = "SELECT * FROM users WHERE username = :username AND email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}
?>
