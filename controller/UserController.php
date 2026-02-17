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
    public function login($email, $password) {
        $this->userModel->email = $email;
        $this->userModel->password = $password;

        $loginData = $this->userModel->login();
        if ($loginData['status']) {
            session_start();
            $_SESSION['is_logged_in'] = true;
            $_SESSION['username'] = $loginData['username'];
        } else {
            // Placeholder error handling for login failure (not yet implemented)
            $_SESSION['error'] = $loginData['error'];
        }

        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        setcookie('PHPSESSID', '', time() - 3600, '/');
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    public function register($username, $email, $password, $confirm_password) {
        $this->userModel->user = $username;
        $this->userModel->email = $email;
        
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";

            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }

        if(!$this->userModel->isUserExists()) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $this->userModel->password = $passwordHash;
            if ($this->userModel->register()) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Registration successful. You are now logged in.";
            } else {
                $_SESSION['error'] = "Registration failed. Please try again.";
            } 
        } else {
            $_SESSION['error'] = "Email or username already exists. Please use a different email or username.";
        }
        
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    public function index() {
        // check if user is logged in, if not redirect to login page an extra check for username to prevent session issues
        if (!isset($_SESSION["is_logged_in"]) && !isset($_SESSION["username"])) {
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }

        include "view/Auth.php";
    }
}
?>