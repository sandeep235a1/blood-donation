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
        $name = $_POST['donor-name'];
        $email = $_POST['donor-email'];
        $phone_number = $_POST['donor-phone'];
        $blood_group = $_POST['donor-blood-group'];
        $address = $_POST['donor-address'];

        // Prepare the SQL query to insert the donor data into the 'donors' table
        $sql = "INSERT INTO donors (name, email, phone_number, blood_group, address) 
                VALUES (:name, :email, :phone_number, :blood_group, :address)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':address', $address);

        // Execute the query
        $stmt->execute();

        // Success message
        echo "Donor registration successful!";
    }
} catch (PDOException $e) {
    // Handle error if connection or query fails
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>

