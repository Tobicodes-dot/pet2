<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adoption_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, fullName, email, contactNumber, residenceType, timeSpent, otherPets, allergies, ageVerification, commitment, additionalInfo, fosterName, status FROM adoption_form ORDER BY id DESC");

$submissions = [];

while ($row = $result->fetch_assoc()) {
    $submissions[] = $row;
}

header('Content-Type: application/json');
echo json_encode($submissions);
?>
