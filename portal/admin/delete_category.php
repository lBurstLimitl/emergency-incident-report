<?php
// Include the database connection
include 'includes/connect.php';

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    // Get the category ID from the URL
    $category_id = $_GET['id'];

    try {
        // Prepare the SQL query to delete the category
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $db->prepare($sql);

        // Bind the ID parameter
        $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            echo 'Category deleted successfully.';
        } else {
            echo 'Error: Failed to delete the category.';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: No category ID specified.";
}
?>
