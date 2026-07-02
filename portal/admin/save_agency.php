<?php
session_start();
include('includes/connect.php');

// Retrieve data from the form
$a = $_POST['agency_name'];
$b = $_POST['phone_number'];
$c = $_POST['email'];
$d = $_POST['personincharge'];
$e = $_POST['username'];
$f = $_POST['password'];
$g = $_POST['state'];
$h = $_POST['address'];
$i = $_POST['agency_id'];
$category_id = $_POST['station_category']; // Get selected category ID
$latitude = $_POST['latitude']; // Added latitude
$longitude = $_POST['longitude']; // Added longitude

// File upload logic
$file_name = strtolower($_FILES['photo']['name']);
$file_ext = substr($file_name, strrpos($file_name, '.'));
$prefix = 'agency' . md5(time() * rand(1, 9999));
$file_name_new = $prefix . $file_ext;
$path = '../../uploads/' . $file_name_new;

// Attempt to move the uploaded file
if (@move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
    // Prepare SQL query with latitude, longitude, and category_id
    $sql = "INSERT INTO agency 
                (agency_name, phone_number, email, personincharge, username, password, state, address, agency_id, categories_id, latitude, longitude, photo) 
            VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :category_id, :lat, :lng, :j)";
    $q = $db->prepare($sql);
    $q->execute(array(
        ':a' => $a,
        ':b' => $b,
        ':c' => $c,
        ':d' => $d,
        ':e' => $e,
        ':f' => $f,
        ':g' => $g,
        ':h' => $h,
        ':i' => $i,
        ':category_id' => $category_id,  // Bind category_id
        ':lat' => $latitude,  // Bind latitude
        ':lng' => $longitude, // Bind longitude
        ':j' => $file_name_new
    ));

    // Redirect based on the query result
    if ($q) {
        header("location:add-agency.php?success=true");
    } else {
        header("location:add-agency.php?failed=true");
    }
} else {
    // File upload failed
    header("location:add-agency.php?failed=upload");
}
?>
