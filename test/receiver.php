<?php
// Enable error reporting to help debug any issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$servername = "localhost"; // Your MySQL server
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "blood_emergency_db";  // The database name (adjust if needed)

try {
    // Create a connection to the database using PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted via POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data from POST request
        $name = $_POST['receiver-name'];
        $email = $_POST['receiver-email'];
        $phone_number = $_POST['receiver-phone'];
        $blood_group = $_POST['receiver-blood-group'];
        $address = $_POST['receiver-address'];
        $disease = isset($_POST['receiver-disease']) ? $_POST['receiver-disease'] : null;

        // Prepare the SQL query to insert the data into 'receivers' table
        $sql = "INSERT INTO receivers (name, email, phone_number, blood_group, address, disease) 
                VALUES (:name, :email, :phone_number, :blood_group, :address, :disease)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':disease', $disease);

        // Execute the query
        $stmt->execute();

        // Success message
        echo "Receiver registration successfully submitted!";
    }
} catch (PDOException $e) {
    // Handle error if connection or query fails
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
