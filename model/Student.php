<?php 
class Student {
    private $conn;
    public $id;
    public $name;
    public $email;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllStudents() {
        $query = "SELECT * FROM students";
        return $this->conn->query($query);
    }

    public function searchStudents($keyword) {
        $query = "SELECT * FROM students WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%'";
        return $this->conn->query($query);
    }

    public function create() {
        $query = "INSERT INTO students (name, email) VALUES ('$this->name', '$this->email')";
        return $this->conn->query($query);
    }

    public function delete($id) {
        $query = "DELETE FROM students WHERE id = $id";
        return $this->conn->query($query);
    }

    public function doesEmailExist() {
        $query = "SELECT * FROM students WHERE email = '$this->email' LIMIT 1";
        $result = $this->conn->query($query);
        return mysqli_num_rows($result) > 0;
    }
}
?>