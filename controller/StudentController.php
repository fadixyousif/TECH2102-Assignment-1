<?php
include "model/Student.php";

class StudentController {
    // Property to hold the instance of the Student model for database interactions related to student data management
    private $studentModel;

    /*
        Constructor to initialize the Student model with the provided database connection, 
        allowing the controller to perform operations such as retrieving, creating, and deleting student records through the model's methods
    */
    public function __construct($db) {
        $this->studentModel = new Student($db);
    }

    /* 
        create method to add a new student record to the database, taking the student's name and email as input, 
        and inserting a new record into the students table, returning true if the operation is successful or false if it fails, 
        with additional checks to ensure that only logged-in users can add students and that duplicate emails are not allowed
    */
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

    /* 
        delete method to remove a student record from the database based on the student's ID, 
        executing a SQL query to delete the record with the specified ID from the students table, 
        returning true if the operation is successful or false if it fails, 
        with an additional check to ensure that only logged-in users can delete students
    */
    public function delete($id) {
        if (!isset($_SESSION["is_logged_in"]) && !isset($_SESSION["username"])) {
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

    
    /*
        index method to display the dashboard with a list of students, 
        checking if the user is logged in before allowing access to the dashboard, 
        and retrieving student records from the database to be displayed in the view
    */
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
}
?>
