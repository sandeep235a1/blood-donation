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

        // Prepare the SQL query to get user data from the 'login' table
        $sql = "SELECT * FROM login WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username_input);
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password entered by the user with the hashed password stored in the database
            if (password_verify($password_input, $user['password'])) {
                // Success: user is authenticated
                echo "Login successful! Welcome, " . htmlspecialchars($user['username']) . ".";
                // Redirect to a protected page or dashboard (optional)
                // header('Location: dashboard.php');
            } else {
                // Error: Password does not match
                echo "Invalid username or password!";
            }
        } else {
            // Error: No user found with the given username
            echo "Invalid username or password!";
        }
    }
} catch (PDOException $e) {
    // Handle error if connection or query fails
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
