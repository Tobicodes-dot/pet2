<?php
$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "", "adoption_database");

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {

        // Redirect to admin dashboard
        header("Location: admin.html");
        exit();

    } else {
        echo "Invalid password!";
    }
} else {
    echo "No user found with this email!";
}
?>
