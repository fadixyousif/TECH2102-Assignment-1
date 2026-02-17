<?php
class Database{
    // Properties to hold database connection details such as host, database name, username, password, and the connection object itself
    private $host = "localhost";
    private $db_name = "student_management";
    private $username = "root";
    private $password = "";
    private $conn;

    /* 
        connect method to establish a connection to mySQL database using mysqli, 
        returning the connection object for use in other parts of the application,
    */
    public function connect(){
        $this -> conn = new mysqli(
                $this->host, 
                $this->username, 
                $this->password, 
                $this->db_name);

        return $this->conn;        
    }
}