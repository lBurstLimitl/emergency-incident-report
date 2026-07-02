<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Quick Emergency Report</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php if (get("success")): ?>
                            <div>
                                <?= App::message("success", "Your emergency has been reported successfully.") ?>
                            </div>
                        <?php endif; ?>
                        <form action="quick_emergency.php" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <label>Your Location</label>
                             <div id="map" style="height: 300px;"></div>
                             <input type="text" name="address" id="address" class="form-control" readonly>
                             <input type="hidden" name="latitude" id="latitude">
                             <input type="hidden" name="longitude" id="longitude">
                             </div>

                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <textarea name="description" class="form-control" placeholder="Describe the emergency..."></textarea>
                                    </div>

                               <div class="form-group row">
                                    <div class="col-6 text-center">
                                            <label for="photo-input" class="photo-label">
                                    <img style="width: 50% !important; height: 50% !important;" src="https://cdn-icons-png.flaticon.com/128/44/44413.png" alt="Capture Photo" class="photo-icon">
                                            </label>
                                        <input type="file" name="photo" id="photo-input" accept="image/*" capture="environment" class="form-control" style="display: none;">
                                                </div>

                                         <div class="col-6 text-center">
                                             <label for="video-input" class="video-label">
                                     <img style="width: 50% !important; height: 50% !important;" src="https://cdn-icons-png.flaticon.com/128/8408/8408020.png" alt="Capture Video" class="video-icon">
                                         </label>
                                        <input type="file" name="video" id="video-input" accept="video/*" capture="environment" class="form-control" style="display: none;">
                                                </div>
                                                    </div>




                                <div class="m-t-20 text-center">
                              <button type="submit" class="btn btn-primary submit-btn">Report Emergency</button>
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
    <script src="assets/js/app.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const defaultCoordinates = [10.3157, 123.8854]; // Default coordinates (Cebu City)
            const map = L.map('map').setView(defaultCoordinates, 13);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
            }).addTo(map);

            // Add draggable user marker
            const userMarker = L.marker(defaultCoordinates, {
                draggable: true,
                icon: L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/252/252025.png', // Blue marker icon
                    iconSize: [32, 32],
                }),
            }).addTo(map);

            // Update hidden fields
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const addressInput = document.getElementById('address');


            latitudeInput.value = defaultCoordinates[0];
            longitudeInput.value = defaultCoordinates[1];

            function updateAddress(lat, lng) {
                const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            addressInput.value = data.display_name;
                        } else {
                            addressInput.value = "Unable to fetch address. Please verify your location.";
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching address:", error);
                        addressInput.value = "Unable to fetch address. Please verify your location.";
                    });
            }


            function updateLatLng(lat, lng) {
                latitudeInput.value = lat;
                longitudeInput.value = lng;
            }

            userMarker.on("dragend", function() {
                const position = userMarker.getLatLng();
                updateLatLng(position.lat, position.lng);
                updateAddress(position.lat, position.lng);
            });

            map.on("click", function(event) {
                 const { lat, lng } = event.latlng;
                 userMarker.setLatLng([lat, lng]);
                updateLatLng(lat, lng);
                updateAddress(lat, lng);
             });

            // Use geolocation to center the map on user's location
           if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
            const userCoordinates = [position.coords.latitude, position.coords.longitude];
            map.setView(userCoordinates, 18);
            userMarker.setLatLng(userCoordinates);
            updateLatLng(position.coords.latitude, position.coords.longitude);
            updateAddress(position.coords.latitude, position.coords.longitude);
        },
        function () {
            alert("Geolocation failed. Please drag the marker to your location.");
        },
        {
            enableHighAccuracy: true, // Requests high accuracy
            timeout: 10000,          // Maximum time allowed to fetch location
            maximumAge: 0,           // Do not use cached position
        }
    );
}

        });
    </script>
</body>

</html>
