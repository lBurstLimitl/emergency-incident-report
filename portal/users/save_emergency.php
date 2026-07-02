<?php
session_start();
include('includes/connect.php');

// Validate required fields
if (empty($_POST['address'])) {
    header("location:report-emergency.php?failed=true&error=address_missing");
    exit;
}

// Collect data from POST
$a = $_POST['emergency_id'];
$b = $_POST['agency_id'];
$c = $_POST['case_severity'];
$d = $_POST['emergency_category'];
$e = $_POST['phone_number'];
$f = $_POST['address']; // Ensure this is populated
$g = $_POST['latitude'];
$h = $_POST['longitude'];
$i = $_POST['name'];
$j = $_POST['state'];
$k = $_POST['status'];
$l = $_POST['victim_id'];
$m = $_POST['dates'];
$n = $_POST['email'];
$o = $_POST['description'];

$file_name_new = '';

// File upload handling
if (!empty($_FILES['photo']['name'])) {
    $file_name = strtolower($_FILES['photo']['name']);
    $file_ext = substr($file_name, strrpos($file_name, '.'));
    
    $allowed = ['.jpg', '.jpeg', '.png', '.gif'];
    if(!in_array($file_ext, $allowed)) {
        header("location:report-emergency.php?failed=true&error=invalid_file_type");
        exit;
    }

    $prefix = 'emergency' . md5(time() * rand(1, 9999));
    $file_name_new = $prefix . $file_ext;
    $path = '../../uploads/' . $file_name_new;

    if (!@move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
        header("location:report-emergency.php?failed=true&error=file_upload");
        exit;
    }
}

// Insert into the database
try {
    $sql = "INSERT INTO emergency (emergency_id, agency_id, case_severity, emergency_category, phone_number, address, latitude, longitude, name, state, status, victim_id, dates, email, description, photo)
            VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p)";
    $q = $db->prepare($sql);
    $q->bindParam(':a', $a);
    $q->bindParam(':b', $b);
    $q->bindParam(':c', $c);
    $q->bindParam(':d', $d);
    $q->bindParam(':e', $e);
    $q->bindParam(':f', $f);
    $q->bindParam(':g', $g);
    $q->bindParam(':h', $h);
    $q->bindParam(':i', $i);
    $q->bindParam(':j', $j);
    $q->bindParam(':k', $k);
    $q->bindParam(':l', $l);
    $q->bindParam(':m', $m);
    $q->bindParam(':n', $n);
    $q->bindParam(':o', $o);
    $q->bindParam(':p', $file_name_new);

    $q->execute();
    header("location:report-emergency.php?success=true");
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    header("location:report-emergency.php?failed=true&error=db_error");
}
