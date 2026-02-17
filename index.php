<?php
include "controller/UserController.php";
session_start();

$UserController = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["auth-logout"])) {
        $UserController->logout();
    } elseif (isset($_POST["auth-login"])) {
        $UserController->login($_POST['email'], $_POST['password']);
    } elseif (isset($_POST["auth-register"])) {
        $UserController->register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    } else if (isset($_POST['auth-logout'])) {
        $UserController->logout();
    }
} else {
    if ($_SESSION['is_logged_in'] ?? false && isset($_SESSION['username'])) {
        include "view/Dashboard.php";
    } else {
        include "view/Auth.php";
    }
}
?>