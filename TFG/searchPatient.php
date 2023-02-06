<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET["id"];
$sql = "SELECT * FROM patients WHERE NHIS = $id";

$result = mysqli_query($conn, $sql);
$patients = [];
while ($row = mysqli_fetch_assoc($result)) {
    $patients[] = $row;
}

header('Content-Type: application/json');
echo json_encode($patients);

// Close the connection
mysqli_close($conn);


