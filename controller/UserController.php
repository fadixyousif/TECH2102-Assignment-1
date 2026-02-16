<?php
include "model/User.php";
include "config/database.php";

class UserController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->userModel = new User($db);
    }
    public function login($username, $password) {
        $this->userModel->user = $username;
        $this->userModel->password = $password;

        $loginData = $this->userModel->login();
        if ($loginData['status']) {
            session_start();
            $_SESSION['is_logged_in'] = true;
            $_SESSION['username'] = $loginData['username'];
        } else {
            // Placeholder error handling for login failure (not yet implemented)
            //$_SESSION['error'] = $loginData['error'];
        }
    }

    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        setcookie('PHPSESSID', '', time() - 3600, '/');
        header('Location: index.php');
        exit;
    }

    public function register($username, $email, $password, $confirm_password) {
        $this->userModel->user = $username;
        $this->userModel->email = $email;
        
        if ($password !== $confirm_password) {
            // Placeholder error handling for password mismatch (not yet implemented)
        }

        if(!$this->userModel->isUserExists()) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $this->userModel->password = $passwordHash;
            if ($this->userModel->register()) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['username'] = $username;
            } else {
                // Placeholder error handling for registration failure (not yet implemented)
            } 
        } else {
            // Placeholder error handling for existing user (not yet implemented)
        }
        
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    public function index() {
        // Implement logic to display the authentication page
        include "view/Auth.php";
    }
}
?>