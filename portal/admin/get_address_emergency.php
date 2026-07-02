<?php

session_start();
include 'includes/connect.php';

// Retrieve search parameters from GET or POST request
$fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : null;
$toDate = isset($_GET['to_date']) ? $_GET['to_date'] : null;
$agency = isset($_GET['agency']) ? $_GET['agency'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

// Build the SQL query
$sql = "SELECT e.emergency_id, a.agency_name, e.latitude, e.longitude, e.address, e.status 
        FROM emergency e
        INNER JOIN agency a ON e.agency_id = a.agency_id
        WHERE e.latitude IS NOT NULL AND e.longitude IS NOT NULL";

if (!empty($fromDate)) {
    $sql .= " AND e.dates >= '$fromDate'";
}

if (!empty($toDate)) {
    $sql .= " AND e.dates <= '$toDate'";
}

if (!empty($agency)) {
    $sql .= " AND a.agency_name = '$agency'";
}

if (!empty($status)) {
    $sql .= " AND e.status = '$status'";
}

$result = $conn->query($sql);

$emergencies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Validate the data before adding it to the array
        if (is_numeric($row['latitude']) && is_numeric($row['longitude'])) {
            $emergencies[] = $row;
        }
    }
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($emergencies);

$conn->close();
