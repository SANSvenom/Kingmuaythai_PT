<?php
// config/db.php
$host = 'localhost';
$dbname = 'kingmuaythai_db';
$usernameDb = 'root';
$password = ''; // Add your password if you have one

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname", 
        $usernameDb, 
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    // Make $pdo available globally
    global $pdo;
    
    // Test connection
    $pdo->query("SELECT 1");
    
    return $pdo;
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}