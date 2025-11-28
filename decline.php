<?php
include 'config.php'; // your DB connection

if (!isset($_POST['id'])) {
    echo "No ID provided";
    exit;
}

$id = $_POST['id'];

// Update status to 'declined'
$sql = "UPDATE adoption_form SET status='declined' WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "FAILED: " . $conn->error;
}
?>
