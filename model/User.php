<?php
class User {

    // Database connection property to interact with the database and properties to hold user attributes such as username, email, and password
    private $conn;

    public $user; 

    public $email;

    public $password;


    // Constructor to initialize the database connection property
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to handle user login, verifying email and password against the database
    public function login() {
        // Query to select user record based on the provided email
        $query = "SELECT * FROM users WHERE email = '$this->email' LIMIT 1";
        $result = $this->conn->query($query);

        // Check if a user with the provided email exists in the database
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Verify the provided password against the hashed password stored in the database
            if ($user && $user['password'] && password_verify($this->password, $user['password'])) {
                return [
                    "status" => true,
                    'username' => $user['username']
                ];
            // Return an error message if the password is invalid
            } else {
                return [
                    "status" => false,
                    'error' => 'Invalid password'
                ];
            }
        // Return an error message if the email is not found in the database
        } else {
            return [
                "status" => false,
                'error' => 'Email not found'
            ];
        }
    }

    // Method to handle user registration, inserting a new user record into the database
    public function register() {
        // Query to insert a new user record into the database with the provided username, email, and hashed password
        $query = "INSERT INTO users (username, email, password) VALUES ('$this->user', '$this->email', '$this->password')";
        return $this->conn->query($query);
    }

    /* 
        isUserExists method to check if a user with the provided email or username already exists in the database, 
        preventing duplicate registrations by executing a SQL query to search for records with the specified email or username in the users table, 
        returning true if a matching record is found or false if no match is found
    */
    public function isUserExists() {
        $query = "SELECT * FROM users WHERE email = '$this->email' OR username = '$this->user' LIMIT 1";
        $result = $this->conn->query($query);
        return mysqli_num_rows($result) > 0;
    }
}
?>