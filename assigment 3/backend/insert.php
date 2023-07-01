<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// Handle the uploaded file
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["healthReport"]["name"]);
move_uploaded_file($_FILES["healthReport"]["tmp_name"], $targetFile);

// Insert user details into the database
$sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', $age, $weight, '$email', '$targetFile')";

if ($conn->query($sql) === TRUE) {
    echo "User details and health report uploaded successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
