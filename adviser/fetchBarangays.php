<?php
// Include database connection
include("../config.php");

// Get the selected municipality value
$selectedMunicipality = mysqli_real_escape_string($conn, $_GET['municipality']);

// Fetch barangays based on the selected municipality
$barangaySQL = "SELECT * FROM table_barangay WHERE municipality_id = '$selectedMunicipality' ORDER BY barangay_name ASC";
$barangayResult = $conn->query($barangaySQL);

// Return the result as JSON
echo json_encode($barangayResult->fetch_all(MYSQLI_ASSOC));

// Close database connection
$conn->close();
