<?php
session_start();
require_once 'config.php'; // Create this file with database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check the appropriate table based on user type
        $table = ($userType === 'donor') ? 'donors' : 'volunteers';
        
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $userType;
            $_SESSION['email'] = $user['email'];
            
            // Redirect to appropriate dashboard
            header("Location: main.php");
            exit();
        } else {
            // Login failed
            header("Location: login.php?error=Invalid email or password");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: login.php?error=An error occurred. Please try again later.");
        exit();
    }
} 
