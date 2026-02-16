<?php
class User {
    private $conn;

    public $user; 

    public $email;

    public $password;


    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login() {
        $query = "SELECT * FROM users WHERE email = '$this->email' LIMIT 1";
        $result = $this->conn->query($query);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            
            if ($user && $user['password'] && password_verify($this->password, $user['password'])) {
                return [
                    "status" => true,
                    'username' => $user['username']
                ];
            } else {
                return [
                    "status" => false,
                    'error' => 'Invalid password'
                ];
            }
        } else {
            return [
                "status" => false,
                'error' => 'Email not found'
            ];
        }
    }

    public function register() {
        $query = "INSERT INTO users (username, email, password) VALUES ('$this->user', '$this->email', '$this->password')";
        return $this->conn->query($query);
    }

    public function isUserExists() {
        $query = "SELECT * FROM users WHERE email = '$this->email'";
        $result = $this->conn->query($query);
        return mysqli_num_rows($result) > 0;
    }
}
?>