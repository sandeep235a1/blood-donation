<?php
// check_donors.php
$blood_group = $_GET['blood_group'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'blood_emergency_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to find matching donors
$sql = "SELECT * FROM donors WHERE blood_group = '$blood_group'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Donor Found: <br>";
        echo "Name: " . $row['name'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Location: " . $row['address'] . "<br><br>";
    }
} else {
    echo "No matching donors found.";
}

// Close the connection
$conn->close();
?>
