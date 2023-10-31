<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$dbname = "railway";

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mobile_number = isset($_POST['mobile_number']) ? $_POST['mobile_number'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Sanitize and validate data (you should use more robust validation)
$first_name = mysqli_real_escape_string($conn, $first_name);
$last_name = mysqli_real_escape_string($conn, $last_name);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$mobile_number = mysqli_real_escape_string($conn, $mobile_number);
$message = mysqli_real_escape_string($conn, $message);

// Check for empty required fields
if (empty($first_name) || empty($last_name) || empty($email) || empty($mobile_number) || empty($message)) {
    die("Error: All fields are required.");
}

// Insert data into the database
$sql = "INSERT INTO orrs_contact (f_name, l_name, email, number, message)
        VALUES ('$first_name', '$last_name', '$email', '$mobile_number', '$message')";

if ($conn->query($sql) === true) {
    // Redirect to thanks.html
    header("Location: thanks.html");
    exit; // Make sure to exit after the header redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
