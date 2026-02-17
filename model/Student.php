<?php 
class Student {
    // Properties to hold database connection and student attributes
    private $conn;
    public $id;
    public $name;
    public $email;

    // Constructor to initialize the database connection property
    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* 
        getAllStudents method to retrieve all student records from the database, 
        executing a SQL query to select all records from the students table and returning the result set for further processing
    */
    public function getAllStudents() {
        $query = "SELECT * FROM students";
        return $this->conn->query($query);
    }

    /* 
        searchStudents method to search for student records based on a keyword, 
        allowing users to find specific students by name or email, returning a result set of matching records
    */
    public function searchStudents($keyword) {
        $query = "SELECT * FROM students WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%'";
        return $this->conn->query($query);
    }

    /*
        create method to add a new student record to the database, taking the student's name and email as input, 
        and inserting a new record into the students table, returning true if the operation is successful or false if it fails
    */
    public function create() {
        $query = "INSERT INTO students (name, email) VALUES ('$this->name', '$this->email')";
        return $this->conn->query($query);
    }

    /* 
        delete method to remove a student record from the database based on the student's ID, 
        executing a SQL query to delete the record with the specified ID from the students table, 
        returning true if the operation is successful or false if it fails
    */
    public function delete($id) {
        $query = "DELETE FROM students WHERE id = $id";
        return $this->conn->query($query);
    }

    
    /* 
        doesEmailExist method to check if a student with the provided email already exists in the database, 
        preventing duplicate entries by executing a SQL query to search for records with the specified email in the students table, 
        returning true if a matching record is found or false if no match is found
    */
    public function doesEmailExist() {
        $query = "SELECT * FROM students WHERE email = '$this->email' LIMIT 1";
        $result = $this->conn->query($query);
        return mysqli_num_rows($result) > 0;
    }
}
?>