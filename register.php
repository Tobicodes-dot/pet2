<?php
$fullname = $_POST['fullName'];
$email = $_POST['email'];
$contact = $_POST['contactNumber'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$conn = new mysqli("localhost", "root", "", "adoption_database");

$sql = "INSERT INTO users (fullName, email, password, contactNumber)
        VALUES ('$fullname', '$email', '$password', '$contact')";

if ($conn->query($sql)) {
    // Redirect to login page
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>

