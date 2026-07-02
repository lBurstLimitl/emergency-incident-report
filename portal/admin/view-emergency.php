<?php
include ('includes/connect.php');
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
                        <h4 class="page-title">All Emergency Report</h4>
                    </div> 
                    
                </div> 
				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Date</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" name="from_date" id="from_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To Date</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" name="to_date" id="to_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agency</label>
                            <select class="form-control" name="agency" id="agency">
                                <option value="">All</option>
                                <?php
                                // Fetch the agencies from the database
                                $result = $db->query("SELECT * FROM agency");
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['agency_name'] . '">' . $row['agency_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&nbsp;</label>
                                <button class="btn btn-primary" id="search-btn"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>


					<div class="col-md-12">
                        <div class="table-responsive print-table">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Case ID</th>
                                        <th>Agency</th>
                                        <th>Issue</th>
                                        <th>Address</th>
                                        <th>Case Severity</th>
                                        <th>Status</th>
                                        <th>Date/Time</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $db->prepare("SELECT e.*, a.agency_name FROM emergency e INNER JOIN agency a ON e.agency_id = a.agency_id");
                                $result->execute();
                                for($i=1; $row = $result->fetch(); $i++){ 
                                ?> 
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['emergency_id']; ?></td>
                                        <td><?php echo $row['agency_name']; ?></td>
                                        <td><?php echo $row['emergency_category']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['case_severity']; ?></td>
                                        <td> 
                                            <?php
                                            if($row['status'] == "Pending"){
                                                echo "<p class='status-red'>Pending</p>";   
                                            } else {
                                                echo "<p class='status-green'>Resolved</p>";
                                            }     
                                            ?>   
                                        </td>
                                        <td><?php echo $row['dates']; ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-primary" href="make_action.php?id=<?php echo $row['id'];?>"><i class="fa fa-eye m-r-5"></i> View Details</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

						</div>
					</div>
                    <div class="col-md-12 non-printable">
                        <div class="form-group">
                            <button class="btn btn-primary" id="print-btn"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                     <div class="row">
                    <div class="col-md-12">
                     <div class="form-group text-center">
                                <label>Address (Select location on the map)</label>
                                <div id="map" style="height: 300px; width: 600px; margin: 0 auto;"></div>
                                <input type="text" name="address" id="address" class="form-control" readonly>
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                            </div>
                        </div>
                    </div>


                    <script>
                    $(document).ready(function () {
                        // ...existing code...

                        // Handle the print button click event
                        $('#print-btn').click(function () {
                            $('.non-printable').hide();
                            $('.print-table').addClass('printable');
                            window.print();
                            $('.non-printable').show();
                            $('.print-table').removeClass('printable');
                        });

                        // ...existing code...
                    });
                    </script>
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
    $(document).ready(function () {
        // Initialize the datepickers
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });

        // Handle the search button click event
        $('#search-btn').click(function () {
    var fromDate = $('#from_date').val();
    var toDate = $('#to_date').val();
    var agency = $('#agency').val();
    var status = $('#status').val();

    $.ajax({
        url: 'search_emergency.php',
        method: 'POST',
        dataType: 'json', // Expect JSON response
        data: {
            from_date: fromDate,
            to_date: toDate,
            agency: agency,
            status: status
        },
        success: function (response) {
            // Update the table with the search results
            $('#myTable tbody').html(response.tableHtml);

            // Update the map markers
            const mapData = response.mapData;
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            mapData.forEach(data => {
                const marker = L.marker([data.latitude, data.longitude]).addTo(map);
                marker.bindPopup(`
                    <b>${data.agency_name}</b><br>
                    Address: ${data.address}<br>
                    Status: ${data.status}
                `);
            });
        },
        error: function () {
            alert('Failed to fetch data. Please try again.');
        }
    });
});
        // Handle the print button click event
    $('#print-btn').click(function () {
        var printContents = $('.table-responsive').clone();
        
        // Remove action column and pagination
        printContents.find('.text-right').remove();
        printContents.find('.dataTables_paginate').remove();
        printContents.find('.dataTables_info').remove();

        // Remove "Show entries" label and select
        printContents.find('label').remove();
        printContents.find('.dataTables_length').remove();
        
        var originalContents = $('body').html();

        // Create a new window to print
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>@media print {.emergency-heading {font-weight: bold;}}</style>');
        printWindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.min.css">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="col-md-12">');
        printWindow.document.write('<h2 class="emergency-heading">Emergency Reports</h2>');
        printWindow.document.write('<div class="table-responsive">');
        printWindow.document.write(printContents.html());
        printWindow.document.write('</div></div></body></html>');
        printWindow.document.close();

        // Wait for the window to load and then print
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };

        // Restore the original contents
        $('body').html(originalContents);
    });
    
});

</script>

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
            const map = L.map('map').setView(defaultCoordinates, 14);

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
                            iconUrl: 'https://cdn-icons-png.flaticon.com/128/1632/1632646.png', // Red marker icon
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
            fetch('get_address_emergency.php')
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


<!-- patients23:19-->
</html>
