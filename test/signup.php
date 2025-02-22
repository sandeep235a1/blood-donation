<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$servername = "localhost";  // Your MySQL server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "blood_emergency_db";  // The database name (adjust if needed)

try {
    // Create a connection to the database using PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data from POST request
        $username_input = $_POST['username'];
        $password_input = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($password_input !== $confirm_password) {
            echo "Passwords do not match!";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password_input, PASSWORD_BCRYPT);

            // Prepare the SQL query to insert the user data into 'login' table
            $sql = "INSERT INTO login (username, password) VALUES (:username, :password)";
            
            // Prepare the statement
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username_input);
            $stmt->bindParam(':password', $hashed_password);

            // Execute the query
            $stmt->execute();

            // Success message
            echo "Sign up successful! You can now log in.";
        }
    }
} catch (PDOException $e) {
    // Handle error if connection or query fails
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
