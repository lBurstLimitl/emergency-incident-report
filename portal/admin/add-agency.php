<?php 
include ('includes/connect.php');

// Assuming PDO connection is used
try {
    $conn = new PDO("mysql:host=localhost;dbname=db_ems", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch categories
    $query = "SELECT id, category_name FROM categories";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch results
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php include 'includes/head.php'; ?>
<style>
    .suggestion-box {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        z-index: 1000;
        width: 100%;
        top: 700px;
        left: 0;
    }

    .suggestion-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #f0f0f0;
    }

    .no-suggestions {
        padding: 8px 12px;
        color: #888;
    }
</style>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
       <?php include 'includes/sidebar.php'; ?>
    </div>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Agency</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <?php if (get("success")): ?>
                        <div>
                            <?= App::message("success", "Agency has been added successfully") ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="save_agency.php" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agency ID</label>
                                <input class="form-control" type="text" name="agency_id" value="<?php echo rand(1000, 9999); ?>" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Agency Name</label>
                                <input class="form-control" name="agency_name" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Station Category</label>
                                <select class="form-control" name="station_category" required>
                                    <option value="">Select a Category</option>
                                    <?php foreach ($categories as $row): ?>
                                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <?php echo htmlspecialchars($row['category_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Emergency Number</label>
                                <input class="form-control" name="phone_number" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" required>
                            </div>
                            <div class="form-group">
                                <label>Person in Charge</label>
                                <input class="form-control" name="personincharge" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" type="password" required>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <input class="form-control" name="state" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="profile-upload">
                                    <div class="upload-img">
                                        <img alt="" src="assets/img/user.jpg">
                                    </div>
                                    <div class="upload-input">
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Map</label>
                                <div id="map" style="width: 100%; height: 400px; border: 1px solid #ccc;"></div>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" id="address" placeholder="Start typing address...">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Add Agency</button>
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
</body>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addressInput = document.getElementById("address");
        const latitudeInput = document.getElementById("latitude");
        const longitudeInput = document.getElementById("longitude");
        const mapElement = document.getElementById("map");
        const suggestionBox = document.createElement("div");
        suggestionBox.className = "suggestion-box";
        addressInput.parentNode.appendChild(suggestionBox);

        let map, marker;

        function initializeMap(lat, lng) {
            map = L.map(mapElement).setView([lat, lng], 13);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            marker = L.marker([lat, lng], {
                draggable: true,
            }).addTo(map);

            updateAddressAndCoordinates(lat, lng);

            // Update coordinates and address on marker drag
            marker.on("dragend", function() {
                const position = marker.getLatLng();
                updateAddressAndCoordinates(position.lat, position.lng);
            });
        }

        function updateAddressAndCoordinates(lat, lng) {
            latitudeInput.value = lat;
            longitudeInput.value = lng;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.display_name) {
                        addressInput.value = data.display_name;
                    } else {
                        addressInput.value = "Address not found";
                    }
                })
                .catch((error) => console.error("Error reverse geocoding:", error));
        }

        // Fetch suggestions for the address input
        addressInput.addEventListener("input", function() {
            const query = addressInput.value;
            if (query.trim().length > 2) {
                fetch(`https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(query)}&addressdetails=1`)
                    .then((response) => response.json())
                    .then((data) => {
                        suggestionBox.innerHTML = ""; // Clear previous suggestions
                        if (data.length > 0) {
                            data.forEach((item) => {
                                const suggestionItem = document.createElement("div");
                                suggestionItem.className = "suggestion-item";
                                suggestionItem.textContent = item.display_name;
                                suggestionItem.addEventListener("click", function() {
                                    const lat = parseFloat(item.lat);
                                    const lon = parseFloat(item.lon);
                                    addressInput.value = item.display_name;
                                    suggestionBox.innerHTML = ""; // Clear suggestions
                                    map.setView([lat, lon], 13);
                                    marker.setLatLng([lat, lon]);
                                    updateAddressAndCoordinates(lat, lon);
                                });
                                suggestionBox.appendChild(suggestionItem);
                            });
                        } else {
                            suggestionBox.innerHTML = "<div class='no-suggestions'>No suggestions found</div>";
                        }
                    })
                    .catch((error) => console.error("Error fetching address suggestions:", error));
            } else {
                suggestionBox.innerHTML = ""; // Clear suggestions when input is too short
            }
        });

        // Close suggestions on outside click
        document.addEventListener("click", function(e) {
            if (!suggestionBox.contains(e.target) && e.target !== addressInput) {
                suggestionBox.innerHTML = "";
            }
        });

        // Use Geolocation API to get user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    initializeMap(userLat, userLng);
                },
                (error) => {
                    console.warn("Geolocation failed. Defaulting to Cebu.");
                    console.error("Error code:", error.code, "-", error.message);
                    initializeMap(10.3157, 123.8854); // Default to Cebu
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000, // 10 seconds timeout
                    maximumAge: 0, // No cached locations
                }
            );
        } else {
            console.warn("Geolocation not supported. Defaulting to Cebu.");
            initializeMap(10.3157, 123.8854); // Default to Cebu
        }
    });
</script>
<!-- add-doctor24:06-->

</html>