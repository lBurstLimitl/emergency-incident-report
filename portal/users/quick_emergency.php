<?php
include 'includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['address'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'] ?? '';
    $photo_name = '';
    $video_name = '';

    // File upload handling for photo
    if (!empty($_FILES['photo']['name'])) {
        $photo_name = strtolower($_FILES['photo']['name']);
        $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
        $allowedPhotoExtensions = ['jpg', 'jpeg', 'png'];
        $photo_prefix = 'photo_' . md5(time() * rand(1, 9999));
        $photo_name = $photo_prefix . '.' . $photo_ext;
        $photo_path = '../../uploads/' . $photo_name;

        if (in_array($photo_ext, $allowedPhotoExtensions)) {
            if (!@move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
                header("location:report-emergency.php?failed=true&error=photo_upload");
                exit;
            }
        } else {
            header("location:report-emergency.php?failed=true&error=invalid_photo_type");
            exit;
        }
    }

    // File upload handling for video
    if (!empty($_FILES['video']['name'])) {
        $video_name = strtolower($_FILES['video']['name']);
        $video_ext = strtolower(pathinfo($video_name, PATHINFO_EXTENSION));
        $allowedVideoExtensions = ['mp4', 'mov', 'avi'];
        $video_prefix = 'video_' . md5(time() * rand(1, 9999));
        $video_name = $video_prefix . '.' . $video_ext;
        $video_path = '../../uploads/' . $video_name;

        if (in_array($video_ext, $allowedVideoExtensions)) {
            if (!@move_uploaded_file($_FILES['video']['tmp_name'], $video_path)) {
                header("location:report-emergency.php?failed=true&error=video_upload");
                exit;
            }
        } else {
            header("location:report-emergency.php?failed=true&error=invalid_video_type");
            exit;
        }
    }

    // Find the nearest agency
    $query = "SELECT agency_id, agency_name, 
                     (6371 * acos(cos(radians(:latitude)) * cos(radians(latitude)) * 
                     cos(radians(longitude) - radians(:longitude)) + 
                     sin(radians(:latitude)) * sin(radians(latitude)))) AS distance 
              FROM agency 
              ORDER BY distance ASC 
              LIMIT 1";

    $stmt = $db->prepare($query);
    $stmt->execute(['latitude' => $latitude, 'longitude' => $longitude]);
    $nearestAgency = $stmt->fetch();

    if ($nearestAgency) {
        $agencyId = $nearestAgency['agency_id'];

        // Save the emergency report
        $insertQuery = "INSERT INTO emergency (agency_id, address, latitude, longitude, description, status, case_severity, photo, video) 
                        VALUES (:agency_id, :address, :latitude, :longitude, :description, 'Pending', 'Critical', :photo, :video)";
        $stmt = $db->prepare($insertQuery);
        $stmt->execute([
            'agency_id' => $agencyId,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'description' => $description,
            'photo' => $photo_name,
            'video' => $video_name,
        ]);

        header('Location: quick_report_page.php?success=1');
        exit;
    } else {
        echo "No nearby agency found.";
    }
}
