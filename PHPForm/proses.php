<?php 
// user_repository.php
class UserRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }

        return null;
    }
}

// authentication.php
class Authentication {
    public function login($user) {
        session_start();
        $_SESSION['username'] = $user['username'];
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}

// login.php
include('../dml/koneksi.php');
include('user_repository.php');
include('authentication.php');

$userRepository = new UserRepository($conn);
$auth = new Authentication();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    
    $user = $userRepository->authenticate($email, $password);

    if ($user) {
        $auth->login($user);
        header('Location: ../tugas14/dashboard.php');
    } else {
        $_SESSION['login_error'] = 'Email atau password salah';
        header('Location: login.php');
    }
}

$conn->close();
?>