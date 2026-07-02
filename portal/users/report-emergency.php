<?php include 'includes/head.php'; ?>


<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Report Emergency</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php if (get("success")): ?>
                            <div>
                                <?= App::message("success", "Your request has been successfully submitted help is on the way") ?>
                            </div>
                        <?php endif; ?>
                        <form action="save_emergency.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Address (Select location on the map)</label>
                                <div id="map" style="height: 300px;"></div>
                                <input type="text" name="address" id="address" class="form-control" readonly>
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency ID</label>
                                        <input class="form-control" type="text" name="emergency_id" value="<?php echo rand(1000, 9999); ?>" readonly="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agency Name</label>
                                        <select class="select" name="agency_id">
                                            <option selected disabled>Select</option> <!-- 'Select' option is now disabled -->
                                            <?php
                                            $result = $db->prepare("SELECT * FROM agency");
                                            $result->execute();
                                            while ($row = $result->fetch()) {
                                                echo '<option value="' . htmlspecialchars($row['agency_id']) . '">' . htmlspecialchars($row['agency_name']) . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Case Severity</label>
                                        <select class="select" name="case_severity">
                                            <option selected disabled>Select</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Critical">Critical</option>
                                            <option value="Danger">Danger</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Category</label>
                                        <select class="select" name="emergency_category">
                                            <option selected disabled>Select</option>
                                            <?php
                                            $result = $db->prepare("SELECT * FROM emergency_type ");
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                            ?>
                                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input class="form-control" name="state" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" name="phone_number" value="<?php echo $_SESSION['SESS_PHONE_NUMBER']; ?>" type="text" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>" readonly type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control" name="dates" value="<?php echo date('d-m-Y'); ?>" readonly type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input class="form-control" name="victim_id" value="<?php echo $_SESSION['SESS_USERS_ID']; ?>" readonly type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" value="<?php echo $_SESSION['SESS_EMAIL']; ?>" readonly type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload image of emergency</label>
                                        <div class="profile-upload">
                                            <div class="upload-img">
                                                <img alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="upload-input">
                                                <input type="file" name="photo" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea cols="30" rows="4" name="description" class="form-control"></textarea>
                            </div>


                            <div class="col-md-6" hidden>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input class="form-control" name="status" value="Pending" readonly type="text">
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Send Request</button>
                            </div>
                        </form>
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
            const defaultCoordinates = [10.3157, 123.8854]; // Default coordinates (Cebu City)
            const map = L.map('map').setView(defaultCoordinates, 13);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            // Add user's draggable marker
            const userMarker = L.marker(defaultCoordinates, {
                draggable: true,
                icon: L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/252/252025.png', // Blue marker icon
                    iconSize: [32, 32],
                }),
            }).addTo(map);

            // Add radar-like range circle (e.g., 2000 meters)
            const radarRange = 2000; // Radius in meters
            const circle = L.circle(defaultCoordinates, {
                color: 'blue',
                fillColor: 'blue',
                fillOpacity: 0.08,
                radius: radarRange,
            }).addTo(map);

            // Initialize hidden input fields
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const addressInput = document.querySelector('input[name="address"]');

            latitudeInput.value = defaultCoordinates[0];
            longitudeInput.value = defaultCoordinates[1];

            // Fetch and update the address
            function updateAddress(lat, lng) {
                const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.address) {
                            const address = [
                                data.address.road || '',
                                data.address.city || '',
                                data.address.state || '',
                                data.address.postcode || '',
                                data.address.country || ''
                            ].filter(Boolean).join(', ');
                            addressInput.value = address;
                        } else {
                            addressInput.value = "Unable to fetch address. Please verify your location.";
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching address:", error);
                        addressInput.value = "Unable to fetch address. Please verify your location.";
                    });
            }

            // Update latitude, longitude, address, and radar range when the marker is dragged
            userMarker.on("dragend", function() {
                const position = userMarker.getLatLng();
                latitudeInput.value = position.lat;
                longitudeInput.value = position.lng;
                updateAddress(position.lat, position.lng);

                // Update the radar circle position
                circle.setLatLng(position);
            });

            // Fetch agency data and add markers
            function addAgencyMarkers(agencies) {
                agencies.forEach(agency => {
                    const {
                        agency_name,
                        latitude,
                        longitude,
                        address
                    } = agency;
                    const marker = L.marker([latitude, longitude], {
                        icon: L.icon({
                            iconUrl: 'https://cdn-icons-png.flaticon.com/512/252/252031.png', // Red marker icon
                            iconSize: [32, 32],
                        }),
                    }).addTo(map);

                    // Add popup with agency details
                    marker.bindPopup(`
                <b>${agency_name}</b><br>
                Address: ${address || 'N/A'}
            `);
                });
            }

            // Fetch agencies from the PHP endpoint
            fetch('get_address_agency.php')
                .then(response => response.json())
                .then(data => {
                    addAgencyMarkers(data);
                })
                .catch(error => {
                    console.error("Error fetching agency data:", error);
                });

            // Request user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userCoordinates = [position.coords.latitude, position.coords.longitude];
                        map.setView(userCoordinates, 13); // Center the map on user's location
                        userMarker.setLatLng(userCoordinates); // Move the marker to user's location
                        circle.setLatLng(userCoordinates); // Update radar circle position

                        // Update hidden fields and address
                        latitudeInput.value = position.coords.latitude;
                        longitudeInput.value = position.coords.longitude;
                        updateAddress(position.coords.latitude, position.coords.longitude);
                    },
                    function(error) {
                        console.error("Error getting location:", error.message);
                        alert("Unable to retrieve your location. Please select your location on the map.");
                    }, {
                        enableHighAccuracy: true,
                        timeout: 15000,
                        maximumAge: 0,
                    }
                );
            } else {
                console.error("Geolocation is not supported by this browser.");
                alert("Geolocation is not supported by your browser. Please drag the marker to your location.");
            }
        });
    </script>
</body>


<!-- add-appointment24:07-->

</html>