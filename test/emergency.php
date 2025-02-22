<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_emergency_db"; // Change to your actual database name

try {
    // Establish the database connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['emergency-name'];
        $location = $_POST['emergency-location'];
        $blood_group = $_POST['emergency-blood-group'];

        // Debugging: Check if form data is received correctly
        // echo "Name: $name<br>Location: $location<br>Blood Group: $blood_group<br>";

        // Prepare the SQL query to insert the data into the 'emergencies' table
        $sql = "INSERT INTO emergencies (name, location, blood_group) VALUES (:name, :location, :blood_group)";
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the query
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':blood_group', $blood_group);

        // Execute the query
        $stmt->execute();

        // Success message
        echo "Emergency registration successfully submitted!";
    }
} catch (PDOException $e) {
    // Handle error and display the error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
