<?php
// Retrieve form data using $_POST
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$address = $_POST['address'];
$phoneNumber = $_POST['phoneNumber'];
$course = $_POST['course'];
$additionalComments = $_POST['additionalComments'];

// Connect to the MySQL database
$servername = "localhost:4306";
$username = "root"; 
$password = ""; 
$dbname = "event_management"; 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data
$sql = "INSERT INTO event_registrations (fullName, email, address, phoneNumber, course, additionalComments)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fullName, $email, $address, $phoneNumber, $course, $additionalComments);

// Execute the prepared statement
if ($stmt->execute()) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
