<?php
include 'config.php'; // your DB connection



if (!isset($_POST['id'])) {
    echo "No ID provided";
    exit;
}

$id = $_POST['id'];

// Delete the record
$sql = "DELETE FROM adoption_form WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "FAILED: " . $conn->error;
}
?>
