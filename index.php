<?php
include "config/Database.php";
include "controller/UserController.php";
include "controller/StudentController.php";
session_start();

$database = new Database();
$db = $database->connect();

$UserController = new UserController($db);
$StudentController = new StudentController($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["auth-logout"])) {
        $UserController->logout();
    } elseif (isset($_POST["auth-login"])) {
        $UserController->login($_POST['email'], $_POST['password']);
    } elseif (isset($_POST["auth-register"])) {
        $UserController->register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    } elseif (isset($_POST["add-student"])) {
        if ($_SESSION['is_logged_in'] ?? false && isset($_SESSION['username'])) {
            $StudentController->create($_POST['name'], $_POST['email']);
        } else {
            header("Location: index.php");
        }
    } elseif (isset($_POST["delete-student"])) {
        if ($_SESSION['is_logged_in'] ?? false && isset($_SESSION['username'])) {
            $StudentController->delete($_POST['id']);
        } else {
            header("Location: index.php");
        }
    }
} else {
    if ($_SESSION['is_logged_in'] ?? false && isset($_SESSION['username'])) {
        $StudentController->index();
    } else {
        $UserController->index();
    }
}
?>