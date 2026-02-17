<?php
include "model/User.php";

class UserController {
    // Property to hold the instance of the User model for database interactions related to user authentication and registration
    private $userModel;

    /*
        Constructor to initialize the User model with the provided database connection, 
        allowing the controller to perform operations such as user login, logout, and registration through the model's methods
    */
    public function __construct($db) {
        $this->userModel = new User($db);
    }

    /* 
        login method to handle user login, verifying email and password against the database, 
        setting session variables for logged-in users and handling error messages for failed login attempts, 
        with a redirect back to the login page after processing the login request
    */
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

    /* 
        logout method to handle user logout, clearing session variables and destroying the session, 
        with a redirect back to the login page after processing the logout request
    */
    public function logout() {
        $_SESSION = [];
        session_destroy();
        setcookie('PHPSESSID', '', time() - 3600, '/');
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    /* 
        register method to handle user registration, inserting a new user record into the database, 
        with checks to ensure that passwords match and that duplicate emails or usernames are not allowed, 
        setting session variables for newly registered users and handling error messages for failed registration attempts, 
        with a redirect back to the registration page after processing the registration request
    */
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

    /* 
        index method to display the authentication page, 
        checking if the user is already logged in and redirecting to the dashboard if they are, 
        or including the authentication view if they are not logged in
    */
    public function index() {
        include "view/Auth.php";
    }
}
?>