<?php
// Database Configuration
$host = 'localhost';     // Database host (usually localhost)
$dbname = 'charitex1';    // Your database name
$username = 'root';  // Database username
$password = '';  // Database password

// Create database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Database Table Creation (if not already exists)
$createDonorTable = "
CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$createVolunteerTable = "
CREATE TABLE IF NOT EXISTS volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(100),
    availability VARCHAR(50),
    support_education BOOLEAN DEFAULT FALSE,
    support_orphans BOOLEAN DEFAULT FALSE,
    support_elders BOOLEAN DEFAULT FALSE,
    skills TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$pdo->exec($createDonorTable);
$pdo->exec($createVolunteerTable);

// Process Signup Form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    
    // Hash password securely
    $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        if ($role === 'donor') {
            $stmt = $pdo->prepare("INSERT INTO donors (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword]);
        } elseif ($role === 'volunteer') {
            $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
            $availability = filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_STRING);
            
            // Handle checkbox values
            $supportEducation = isset($_POST['supportEducation']) ? 1 : 0;
            $supportOrphans = isset($_POST['supportOrphans']) ? 1 : 0;
            $supportElders = isset($_POST['supportElders']) ? 1 : 0;
            $skills = filter_input(INPUT_POST, 'skills', FILTER_SANITIZE_STRING);

            $stmt = $pdo->prepare("
                INSERT INTO volunteers 
                (name, email, password, location, availability, 
                support_education, support_orphans, support_elders, skills) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $name, $email, $hashedPassword, $location, $availability,
                $supportEducation, $supportOrphans, $supportElders, $skills
            ]);
        }

        // Redirect after successful registration
        header("Location: success-page.html");
        exit();

    } catch(PDOException $e) {
        // Handle potential duplicate email or other database errors
        if ($e->getCode() == '23000') {  // Duplicate entry error
            $errorMessage = "Email already registered. Please use a different email.";
        } else {
            $errorMessage = "Registration failed. Please try again.";
        }
        // You might want to redirect back to signup with error message
    }
}
?>