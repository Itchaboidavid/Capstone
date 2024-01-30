<?php
// Include database connection
include("../config.php");

// Get the selected province value
$selectedProvince = mysqli_real_escape_string($conn, $_GET['province']);

// Fetch municipalities based on the selected province
$municipalitySQL = "SELECT * FROM table_municipality WHERE province_id = '$selectedProvince' ORDER BY municipality_name ASC";
$municipalityResult = $conn->query($municipalitySQL);

// Return the result as JSON
echo json_encode($municipalityResult->fetch_all(MYSQLI_ASSOC));

// Close database connection
$conn->close();
