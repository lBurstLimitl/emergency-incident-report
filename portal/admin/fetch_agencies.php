<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_ems', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
        $categoryId = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);

        if (!$categoryId) {
            echo '<p>Invalid category selected.</p>';
            exit;
        }

        // Fetch agencies based on the selected category
        $stmt = $pdo->prepare("SELECT * FROM agency WHERE categories_id = :category_id");
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    } else {
        // Fetch all agencies when no category is selected
        $stmt = $pdo->prepare("SELECT * FROM agency");
    }

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-4 col-sm-4 col-lg-3">';
            echo '<div class="profile-widget">';
            echo '<div class="doctor-img">';
            echo '<a class="avatar" href="#"><img alt="" src="../../uploads/' . htmlspecialchars($row['photo']) . '"></a>';
            echo '</div>';
            echo '<h4 class="doctor-name text-ellipsis"><a href="profile.html">' . htmlspecialchars($row['agency_name']) . '</a></h4>';
            echo '<div class="doc-prof">' . htmlspecialchars($row['email']) . ', ' . htmlspecialchars($row['phone_number']) . '</div>';
            echo '<div class="user-country"><i class="fa fa-map-marker"></i> ' . htmlspecialchars($row['state']) . ', ' . htmlspecialchars($row['address']) . '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No agencies found.</p>';
    }
} catch (PDOException $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
