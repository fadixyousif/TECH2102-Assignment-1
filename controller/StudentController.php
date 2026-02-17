<?php
include "model/Student.php";

class StudentController {
    public function index() {
        if (!isset($_SESSION["is_logged_in"]) && !isset($_SESSION["username"])) {
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }
        include "view/Dashboard.php";
    }
}
?>
