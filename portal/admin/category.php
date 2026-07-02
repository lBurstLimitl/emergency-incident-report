<?php
// Include the database connection
include 'includes/connect.php';
$successMessage = ''; // Variable to store success or failure message
$errorMessage = '';   // Variable to store error message

try {
    // Check if form is submitted to add a category
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';

        // Check if category already exists
        $checkQuery = "SELECT COUNT(*) FROM categories WHERE category_name = :name";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindParam(':name', $name);
        $checkStmt->execute();

        // If the category already exists
        if ($checkStmt->fetchColumn() > 0) {
            $errorMessage = 'Category already exists.';
        } else {
            // Insert data into categories table if not exists
            $sql = "INSERT INTO categories (category_name, description, created_at) VALUES (:name, :description, NOW())";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);

            if ($stmt->execute()) {
                $successMessage = 'Category added successfully.';
                // Redirect to the same page to avoid resubmission on page reload
                header("Location: " . $_SERVER['PHP_SELF']);
                exit; // Ensure that the script stops executing after the redirect
            } else {
                $errorMessage = 'Failed to add category.';
            }
        }
    }

    // Check if form is submitted to delete a category
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_category'])) {
        $categoryId = $_POST['category_id'];

        // Delete the category from the database
        $deleteQuery = "DELETE FROM categories WHERE id = :id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $categoryId);

        if ($deleteStmt->execute()) {
            $successMessage = 'Category deleted successfully.';
            // Redirect to the same page to reflect changes
            header("Location: " . $_SERVER['PHP_SELF']);
            exit; // Stop executing after the redirect
        } else {
            $errorMessage = 'Failed to delete category.';
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php include 'includes/head.php'; ?>
<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>  
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Station Categories</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <!-- Form to add new category -->
                        <form method="post" action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea cols="30" rows="4" name="description" class="form-control" required></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="add_category">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display success or failure message -->
            <?php if ($successMessage): ?>
                <div class="alert alert-info text-center">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>

            <!-- Display error message -->
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">All Station Categories</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch categories data
                                    $result = $db->prepare("SELECT * FROM categories");
                                    $result->execute();
                                    $i = 1;
                                    while ($row = $result->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td class="text-right">
                                                <!-- Delete Category Button -->
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Delete Modal -->
                                                        <form method="post" action="#">
                                                            <input type="hidden" name="category_id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" class="dropdown-item" name="delete_category">
                                                                <i class="fa fa-trash-o m-r-5"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/message.php'; ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
