<?php
include 'includes/head.php';
$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM emergency WHERE id = :post_id");
$result->bindParam(':post_id', $id);
$result->execute();
$row = $result->fetch();

$address = $row['address']; // Fetch the address
$latitude = $row['latitude']; // Fetch the latitude
$longitude = $row['longitude']; // Fetch the longitude
?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <?php
                        // Count pending emergencies for the agency
                        $result = $db->prepare("SELECT count(*) as total FROM emergency WHERE agency_id = {$_SESSION['SESS_AGENCY_ID']} AND status = 'Pending' ");
                        $result->execute();
                        for ($i = 0; $row = $result->fetch(); $i++) {
                        ?>
                            <li class="active">
                                <a href="view-emergency.php"><i class="fa fa-file"></i> <span>View Emergency</span> <span class="badge badge-pill bg-primary float-right"><?php echo $row['total']; ?></span></a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="report_history.php"><i class="fa fa-file-text-o"></i> <span>Reports History</span></a>
                        </li>
                        <li>
                            <a href="profile.php"><i class="fa fa-user"></i> <span>Profile</span></a>
                        </li>
                        <li>
                            <a href="information.php"><i class="fa fa-plus"></i> <span>Project Information</span></a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Emergency Detail</h4>
                    </div>
                </div>
                <?php if (get("success")): ?>
                    <div>
                        <?= App::message("success", "Your request has been successfully submitted, help is on the way") ?>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php
                        $id = $_GET['id'];
                        $result = $db->prepare("SELECT * FROM emergency where id= :post_id");
                        $result->bindParam(':post_id', $id);
                        $result->execute();
                        for ($i = 0; $row = $result->fetch(); $i++) {
                        ?>
                            <form action="update_status.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Full-width address and map section -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="address" class="form-control" value="<?php echo htmlspecialchars($address); ?>" placeholder="Drag marker or type address" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="map" style="width: 100%; height: 500px; border: 1px solid #ccc;"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency ID</label>
                                            <input class="form-control" type="text" value="<?php echo $row['emergency_id']; ?>" readonly="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" type="text" value="<?php echo $row['name']; ?>" readonly="">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Case Severity</label>
                                            <input class="form-control" type="text" value="<?php echo $row['case_severity']; ?>" readonly="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Category</label>
                                            <input class="form-control" type="text" value="<?php echo $row['emergency_category']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input class="form-control" type="text" value="<?php echo $row['state']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" type="text" value="<?php echo $row['phone_number']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="text" value="<?php echo $row['email']; ?>" readonly="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="select" name="status">
                                                <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                                                <option value="Pending">Pending</option>
                                                <option value="Resolved">Resolved</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <p readonly><?php echo $row['description']; ?></p>
                                        </div>
                                    </div>
                                </div><br>

                               <div style="text-align:center; display: flex; justify-content: center; gap: 20px;">
                                    <div>
                                        <h3>Emergency Image</h3>
                                        <?php
                                        if (!empty($row['photo'])) {
                                            echo '<img src="../../uploads/' . $row['photo'] . '" width="500px" height="300px">';
                                        } else {
                                            echo '<img src="../../img/default.jpg" width="500px" height="300px">';
                                        }
                                        ?>
                                    </div>

                                    <div>
                                        <h3>Emergency Video</h3>
                                        <?php
                                        if (!empty($row['video'])) {
                                            echo '<video width="500px" height="300px" controls>
                                                    <source src="../../uploads/' . $row['video'] . '" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                  </video>';
                                        } else {
                                            echo '<img src="../../img/default.jpg" width="500px" height="300px">';
                                        }
                                        ?>
                                    </div>
                                </div>



                                <br>

                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn">Update Status</button>
                                </div>
                            </form>
                        <?php } ?>
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
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the latitude and longitude from PHP
            const latitude = <?php echo $latitude; ?>;
            const longitude = <?php echo $longitude; ?>;
            const addressInput = document.getElementById('address');
            const mapElement = document.getElementById('map');

            const map = L.map(mapElement).setView([latitude, longitude], 13); // Use latitude and longitude from PHP

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
            }).addTo(map);

            // Place a draggable marker at the emergency location
            const marker = L.marker([latitude, longitude], {
                draggable: true
            }).addTo(map);

            // Update the address input field when the marker is dragged
            marker.on("dragend", function() {
                const position = marker.getLatLng();
                const geocodeUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${position.lat}&lon=${position.lng}`;
                
                fetch(geocodeUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            addressInput.value = data.display_name;
                        } else {
                            addressInput.value = "Address not found";
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching address:", error);
                        addressInput.value = "Error retrieving address";
                    });
            });

            // Reverse geocode to update the address when the page loads
            const geocodeUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`;
            
            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        addressInput.value = data.display_name;
                    }
                })
                .catch(error => {
                    console.error("Error fetching address:", error);
                    addressInput.value = "Error retrieving address";
                });
        });
    </script>
</body>
</html>
