<?php
include 'config.php'; // your DB connection file

$id = $_POST['id'];

$sql = "UPDATE adoption_form SET status='approved' WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
echo "OK";
?>