<?php
include 'includes/head.php';
$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM emergency WHERE id = :post_id");
$result->bindParam(':post_id', $id);
$result->execute();
$row = $result->fetch();

$address = $row['address']; // Fetch the address

?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Emergency Detail</h4>
                    </div>
                </div>
                <?php if (get("success")): ?>
                    <div>
                        <?= App::message("success", "Your request has been successfully submitted help is on the way") ?>
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
                            <form action="" method="post" enctype="multipart/form-data">

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
                                <br>
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
                                            <input class="form-control" type="text" value="<?php echo $row['status']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <p readonly><?php echo $row['description']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align:center;">
                                    <h3>Emergency Image</h3>
                                    <?php
                                    if (!empty($row['photo'])) {
                                        echo '<img src="../../uploads/' . $row['photo'] . '" width="100%" height="300px">';
                                    } else {
                                        echo '<img src="../../img/default.jpg" width="100%" height="300px">';
                                    }
                                    ?>
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
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const addressInput = document.getElementById('address');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const mapElement = document.getElementById('map');

            const map = L.map(mapElement).setView([10.3157, 123.8854], 13); // Default Cebu coordinates

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            const marker = L.marker([10.3157, 123.8854], {
                draggable: true
            }).addTo(map);

            // Function to locate an address on the map
            function locateAddress(address) {
                const geocodeUrl = `https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(address)}`;
                fetch(geocodeUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data[0]) {
                            const {
                                lat,
                                lon
                            } = data[0];
                            const coordinates = [parseFloat(lat), parseFloat(lon)];

                            // Update the map and marker
                            map.setView(coordinates, 13);
                            marker.setLatLng(coordinates);

                            // Update hidden input fields
                            latitudeInput.value = lat;
                            longitudeInput.value = lon;
                        } else {
                            console.error("Unable to locate address.");
                            alert("Address not found on the map.");
                        }
                    })
                    .catch(error => {
                        console.error("Error locating address:", error);
                    });
            }

            // If an address is present, locate it
            if (addressInput.value) {
                locateAddress(addressInput.value);
            }

            // Update coordinates when marker is dragged
            marker.on("dragend", function() {
                const position = marker.getLatLng();
                latitudeInput.value = position.lat;
                longitudeInput.value = position.lng;

                // Reverse geocode to update the address field
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
        });
    </script>
</body>


<!-- add-appointment24:07-->

</html>