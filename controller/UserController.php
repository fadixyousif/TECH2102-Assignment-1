<?php
include "model/User.php";

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }
    public function login($email, $password) {
        $this->userModel->email = $email;
        $this->userModel->password = $password;

        $loginData = $this->userModel->login();
        if ($loginData['status']) {
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
        include "view/Auth.php";
    }
}
?>