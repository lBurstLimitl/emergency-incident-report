<?php

include 'includes/connect.php';

// Retrieve the search parameters
$fromDate = $_POST['from_date'];
$toDate = $_POST['to_date'];
$agency = $_POST['agency'];
$status = $_POST['status'];

// Build the SQL query based on the search parameters
$query = "SELECT e.*, a.agency_name 
          FROM emergency e 
          INNER JOIN agency a ON e.agency_id = a.agency_id 
          WHERE 1=1";

if (!empty($fromDate)) {
    $query .= " AND e.dates >= '$fromDate'";
}

if (!empty($toDate)) {
    $query .= " AND e.dates <= '$toDate'";
}

if (!empty($agency)) {
    $query .= " AND a.agency_name = '$agency'";
}

if (!empty($status)) {
    $query .= " AND e.status = '$status'";
}

// Execute the query and fetch the results
$result = $db->prepare($query);
$result->execute();

$tableHtml = ''; // Table rows
$mapData = []; // Array for map data

for ($i = 1; $row = $result->fetch(); $i++) {
    $tableHtml .= '<tr>';
    $tableHtml .= '<td>' . $i . '</td>';
    $tableHtml .= '<td>' . $row['emergency_id'] . '</td>';
    $tableHtml .= '<td>' . $row['agency_name'] . '</td>';
    $tableHtml .= '<td>' . $row['emergency_category'] . '</td>';
    $tableHtml .= '<td>' . $row['address'] . '</td>';
    $tableHtml .= '<td>' . $row['case_severity'] . '</td>';
    $tableHtml .= '<td>';
    if ($row['status'] == "Pending") {
        $tableHtml .= '<p class="status-red">Pending</p>';
    } else {
        $tableHtml .= '<p class="status-green">Resolved</p>';
    }
    $tableHtml .= '</td>';
    $tableHtml .= '<td>' . $row['dates'] . '</td>';
    $tableHtml .= '<td class="text-right">';
    $tableHtml .= '<a class="btn btn-primary" href="make_action.php?id=' . $row['id'] . '"><i class="fa fa-eye m-r-5"></i> View Details</a>';
    $tableHtml .= '</td>';
    $tableHtml .= '</tr>';

    // Add data for the map
    $mapData[] = [
        'emergency_id' => $row['emergency_id'],
        'agency_name' => $row['agency_name'],
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude'],
        'address' => $row['address'],
        'status' => $row['status']
    ];
}

// Return both table HTML and map data as JSON
$response = [
    'tableHtml' => $tableHtml,
    'mapData' => $mapData
];

echo json_encode($response);
?>
