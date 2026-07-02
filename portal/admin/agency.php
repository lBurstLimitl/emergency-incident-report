<?php
include('includes/connect.php');
?>

<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">All Agency</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right"> <!-- Adjusted column class for alignment -->
                        <!-- Dropdown Filter -->
                        <select class="form-control" id="category-filter">
                            <option value="">Select Category</option>
                            <?php
                            try {
                                $pdo = new PDO('mysql:host=localhost;dbname=db_ems', 'root', '');
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                // Query to fetch category names
                                $stmt = $pdo->query("SELECT id, category_name FROM categories");

                                // Fetch and populate categories
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['category_name']) . "</option>";
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4 col-3 text-right m-b-20">
                        <a href="add-agency.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Agencys</a>
                    </div>
                </div>
                <?php if (get("success")): ?>
                    <div>
                        <?= App::message("success", "Successfully deleted an Agency from database!") ?>
                    </div>
                <?php endif; ?>
                <div class="row doctor-grid ">
                    <?php if (!isset($_GET["page"])) {
                        $_GET["page"] = 1;
                    }
                    $tbl_name = "agency"; //your table name

                    $adjacents = 3; // How many adjacent pages should be shown on each side?

                    /*$query = "SELECT COUNT(*) as num FROM $tbl_name";
                              $total_pages = mysqli_fetch_array(mysqli_query($conn,$query));
                              $total_pages = $total_pages['num'];
                            */
                    $get_agency = ORM::for_table("$tbl_name")->find_array();
                    $total_pages = count($get_agency);
                    /* Setup vars for query. */
                    $targetpage = "agency.php";   //your file name  (the name of this file)
                    $limit = 10;                //how many items to show per page
                    $page = $_GET['page'];
                    if ($page)
                        $start = ($page - 1) * $limit;      //first item to display on this page

                    else
                        $start = 0;          //if no page var is given, set start to 0
                    /* Get data. */

                    $result = $db->prepare("SELECT * FROM agency  ORDER BY id DESC LIMIT $start, $limit");
                    $result->execute();

                    /* Setup page vars for display. */
                    if ($page == 0) $page = 1;          //if no page var is given, default to 1.
                    $prev = $page - 1;              //previous page is page - 1
                    $next = $page + 1;              //next page is page + 1
                    $lastpage = ceil($total_pages / $limit);    //lastpage is = total pages / items per page, rounded up.
                    $lpm1 = $lastpage - 1;            //last page minus 1
                    ?>


                    <?php

                    for ($i = 1; $row = $result->fetch(); $i++) {


                    ?> <br><br>
                        <div class="col-md-4 col-sm-4  col-lg-3">
                            <div class="profile-widget">
                                <div class="doctor-img">
                                    <a class="avatar" href="#"><img alt="" src="../../uploads/<?php echo $row['photo']; ?>"></a>
                                </div>

                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item" href="deleteagency.php?id=<?= $row['id'] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                                <h4 class="doctor-name text-ellipsis"><a href="profile.html"><?php echo $row['agency_name']; ?></a></h4>
                                <div class="doc-prof"><?php echo $row['email']; ?>, <?php echo $row['phone_number']; ?></div>
                                <div class="user-country">
                                    <i class="fa fa-map-marker"></i> <?php echo $row['state']; ?>, <?php echo $row['address']; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <span class="see-all-btn">Showing
                                <?php if ($lastpage == $next - 1): ?>
                                    <?= $total_pages ?>
                                <?php else: ?>
                                    <?= $page * $limit ?>
                                <?php endif; ?>
                                of <?= $total_pages ?>
                            </span>
                             <div class="form-group">
                                <label>Address (Select location on the map)</label>
                                <div id="map" style="height: 300px; width: 600px; margin: 0 auto;"></div>
                                <input type="text" name="address" id="address" class="form-control" readonly>
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                            </div>

                            <div class="btn-group">
                                <?php if ($page != 1): ?>
                                    <a class="btn btn-default" href="?page=<?= $prev ?>"><i class="fa fa-angle-left"></i></a>
                                <?php endif; ?>

                                <?php if ($lastpage == $next - 1): ?>

                                <?php else: ?>
                                    <a class="btn btn-default" href="?page=<?= $next ?>"><i class="fa fa-angle-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <?php include 'includes/message.php'; ?>
        </div>
        <div id="delete_doctor" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to delete this Doctor?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <a href="deleteagency.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#category-filter').on('change', function() {
                var categoryId = $(this).val(); // Get selected category ID

                $.ajax({
                    url: 'fetch_agencies.php', // PHP script to fetch filtered data
                    type: 'POST',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // Replace the agency grid with the new filtered results
                        $('.doctor-grid').html(response);
                    },
                    error: function() {
                        $('.doctor-grid').html('<p>Failed to fetch data. Please try again.</p>');
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const defaultCoordinates = [14.420939448496483, 121.04350248792906]; // Default coordinates (Cebu City)
            const map = L.map('map').setView(defaultCoordinates, 12);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            // Add user's draggable marker
            // const userMarker = L.marker(defaultCoordinates, {
            //     draggable: true,
            //     icon: L.icon({
            //         iconUrl: 'https://cdn-icons-png.flaticon.com/512/252/252025.png', // Blue marker icon
            //         iconSize: [32, 32],
            //     }),
            // }).addTo(map);

            // // Add radar-like range circle (e.g., 2000 meters)
            // const radarRange = 2000; // Radius in meters
            // const circle = L.circle(defaultCoordinates, {
            //     color: 'blue',
            //     fillColor: 'blue',
            //     fillOpacity: 0.08,
            //     radius: radarRange,
            // }).addTo(map);

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

            // // Update latitude, longitude, address, and radar range when the marker is dragged
            // userMarker.on("dragend", function() {
            //     const position = userMarker.getLatLng();
            //     latitudeInput.value = position.lat;
            //     longitudeInput.value = position.lng;
            //     updateAddress(position.lat, position.lng);

            //     // Update the radar circle position
            //     circle.setLatLng(position);
            // });

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

            // // Request user's current location
            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(
            //         function(position) {
            //             const userCoordinates = [position.coords.latitude, position.coords.longitude];
            //             map.setView(userCoordinates, 13); // Center the map on user's location
            //             userMarker.setLatLng(userCoordinates); // Move the marker to user's location
            //             circle.setLatLng(userCoordinates); // Update radar circle position

            //             // Update hidden fields and address
            //             latitudeInput.value = position.coords.latitude;
            //             longitudeInput.value = position.coords.longitude;
            //             updateAddress(position.coords.latitude, position.coords.longitude);
            //         },
            //         function(error) {
            //             console.error("Error getting location:", error.message);
            //             alert("Unable to retrieve your location. Please select your location on the map.");
            //         }, {
            //             enableHighAccuracy: true,
            //             timeout: 15000,
            //             maximumAge: 0,
            //         }
            //     );
            // } else {
            //     console.error("Geolocation is not supported by this browser.");
            //     alert("Geolocation is not supported by your browser. Please drag the marker to your location.");
            // }
        });
    </script>

</body>

</html>