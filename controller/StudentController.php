<?php
include "model/Student.php";

class StudentController {
    private $studentModel;

    public function __construct($db) {
        $this->studentModel = new Student($db);
    }

    public function index() {
        if (!isset($_SESSION["is_logged_in"]) || !isset($_SESSION["username"])) {
            header("Location: index.php");
            exit;
        }
        
        $search = $_GET['search'] ?? null;
        if ($search) {
            $studentsResult = $this->studentModel->searchStudents($search);
        } else {
            $studentsResult = $this->studentModel->getAllStudents();
        }

        $students = [];
        if ($studentsResult) {
            while ($row = $studentsResult->fetch_assoc()) {
                $students[] = $row;
            }
        }
        include "view/Dashboard.php";
    }

    public function create($name, $email) {
        if (!isset($_SESSION["is_logged_in"]) || !isset($_SESSION["username"])) {
            header("Location: index.php");
            exit;
        }

        $this->studentModel->name = $name;
        $this->studentModel->email = $email;

        if ($this->studentModel->doesEmailExist()) {
            $_SESSION["error"] = "Email already exists. Please use a different email.";
            header("Location: index.php");
            exit;
        }

        if ($this->studentModel->create()) {
            $_SESSION["success"] = "Student added successfully.";
        } else {
            $_SESSION["error"] = "Failed to add student.";
        }

        header("Location: index.php");
        exit;
    }

    public function delete($id) {
        if (!isset($_SESSION["is_logged_in"]) || !isset($_SESSION["username"])) {
            header("Location: index.php");
            exit;
        }

        if ($this->studentModel->delete($id)) {
            $_SESSION["success"] = "Student deleted successfully.";
        } else {
            $_SESSION["error"] = "Failed to delete student.";
        }
        header("Location: index.php");
        exit;
    }
}
?>
