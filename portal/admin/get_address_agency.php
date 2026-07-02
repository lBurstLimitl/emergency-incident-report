<?php

session_start();
include 'includes/connect.php';

// Query to fetch agency details
$sql = "SELECT agency_name, latitude, longitude, address FROM agency WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
$result = $conn->query($sql);

$agencies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Validate the data before adding it to the array
        if (is_numeric($row['latitude']) && is_numeric($row['longitude'])) {
            $agencies[] = $row;
        }
    }
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($agencies);

$conn->close();
