<?php
ob_start();

header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set("display_errors", 0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adoption_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit;
}

// Remove 'address' from required fields
$required_fields = ['fullName', 'email', 'contactNumber', 'residenceType', 'timeSpent', 'otherPets', 'allergies', 'ageVerification', 'commitment'];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || $_POST[$field] === '') {
        echo json_encode(["success" => false, "message" => "Missing field: $field"]);
        exit;
    }
}

// Sanitize input
$fullname = $conn->real_escape_string($_POST['fullName']);
$email = $conn->real_escape_string($_POST['email']);
$contactNumber = $conn->real_escape_string($_POST['contactNumber']);
$residenceType = $conn->real_escape_string($_POST['residenceType']);
$timeSpent = $conn->real_escape_string($_POST['timeSpent']);
$otherPets = $conn->real_escape_string($_POST['otherPets']);
$allergies = $conn->real_escape_string($_POST['allergies']);
$ageVerification = $conn->real_escape_string($_POST['ageVerification']);
$commitment = $conn->real_escape_string($_POST['commitment']);
$additionalInfo = isset($_POST['additionalInfo']) ? $conn->real_escape_string($_POST['additionalInfo']) : '';
$fosterName = isset($_POST['fosterName']) ? $conn->real_escape_string($_POST['fosterName']) : '';

// Insert into DB
$sql = "INSERT INTO adoption_form (fullName, email, contactNumber, residenceType, timeSpent, otherPets,
        allergies, ageVerification, commitment, additionalInfo, fosterName)
        VALUES ('$fullname', '$email', '$contactNumber', '$residenceType', '$timeSpent', '$otherPets',
        '$allergies', '$ageVerification', '$commitment', '$additionalInfo', '$fosterName')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Application submitted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
}

$conn->close();
ob_end_flush();
?>
