<?php

// import necessary files and start session
include "config/Database.php";
include "controller/UserController.php";
include "controller/StudentController.php";
session_start();

// Initialize database and controllers
$database = new Database();
$db = $database->connect();

$UserController = new UserController($db);
$StudentController = new StudentController($db);

// Handle form submissions and routing based on request method and parameters
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check for post parameters to determine which action to take
    if (isset($_POST["auth-logout"])) {
        $UserController->logout();
    } elseif (isset($_POST["auth-login"])) {
        $UserController->login($_POST['email'], $_POST['password']);
    } elseif (isset($_POST["auth-register"])) {
        $UserController->register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    } elseif (isset($_POST["add-student"])) {
        /* 
            here we check if the user is logged in before allowing them to add a student, 
            this is an extra check to prevent not logged in users from adding students.
        */
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
            $StudentController->create($_POST['name'], $_POST['email']);
        } else {
            header("Location: index.php");
        }
    } elseif (isset($_POST["delete-student"])) {
        // same check as above to prevent not logged in users from deleting students
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
            $StudentController->delete($_POST['id']);
        } else {
            header("Location: index.php");
        }
    }
} else {
    // check if user is logged in before showing the dashboard
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        $StudentController->index();
    } else {
        $UserController->index();
    }
}
?>