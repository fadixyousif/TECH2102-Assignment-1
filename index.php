<?php
include "controller/UserController.php";
session_start();

$UserController = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO : Handle login, logout, and registration logic based on the form data
} else {
    $UserController->index();
}
?>