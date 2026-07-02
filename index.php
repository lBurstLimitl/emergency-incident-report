<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="homepage/images/favicon.png" type="">

    <title> Emergency Management System </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="homepage/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="homepage/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="homepage/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="homepage/css/responsive.css" rel="stylesheet" />

</head>

<style>
    /* Make sure the text and image are aligned properly on smaller screens */
    /* General Styling for Center Alignment */
        .detail-box, .img-box {
            display: flex;
            flex-direction: column; /* Stack content vertically */
            align-items: flex-start; /* Center horizontally */
            text-align: left; /* Center text alignment */
        }

        .detail-box h1 {
            font-size: 2.5rem; /* Adjust heading size */
            margin-bottom: 10px; /* Space below <h1> */
        }

        .detail-box p {
            font-size: 1.25rem; /* Adjust paragraph size */
            margin-top: 10px; /* Space above <p> */
        }

        .img-box img {
            max-width: 100%; /* Ensure the image is responsive */
            height: auto; /* Maintain aspect ratio */
            margin-top: 15px; /* Space above the image */
            margin-left: 65px;
        }

        /* Mobile-Specific Styling */
        @media (max-width: 767px) {
            .detail-box h1 {
                font-size: 1.5rem; /* Adjust heading size for smaller screens */
            }

            .detail-box p {
                font-size: 1rem; /* Adjust paragraph font size */
                margin-top: 10px; /* Space above <p> */
            }

            .img-box img {
                width: 80%; /* Adjust image size for mobile screens */
                max-width: 200px; /* Limit maximum size */
            }
        }
        
        /* Base Styles */
        .team_section .team_container .team-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .team_section .team_container .team-img-box img {
            width: 120px;
            max-width: 250px; /* Adjust based on your design */
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .team_section .team_container .team-detail-box h5 {
            font-size: 1.2rem;
            margin: 5px 0;
        }

        .team_section .team_container .team-detail-box p {
            font-size: 1rem;
            margin: 0;
        }

        /* Responsive Adjustments for Mobile */
        @media (max-width: 767px) {
            .team_section .team_container .team-box {
                padding: 15px;
            }

            .team_section .team_container .team-img-box img {
                max-width: 80%;
            }

            .team_section .team_container .team-detail-box h5,
            .team_section .team_container .team-detail-box p {
                font-size: 1rem;
                text-align: center;
            }
        }

        /* Emergency Button Styles */
            .emergency-button {
            position: fixed;
            top: 20px;  /* Space from the top */
            right: 20px; /* Space from the right edge */
            background-color: red; /* Red background color */
            color: white; /* White text */
            font-size: 18px; /* Font size */
            padding: 10px 20px; /* Padding for the button */
            border-radius: 5px; /* Rounded corners */
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none; /* Remove underline from the link */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); /* Shadow effect */
            z-index: 1000; /* Ensure it's above other content */
}

.emergency-button i {
    margin-right: 8px; /* Space between icon and text */
}

.emergency-button:hover {
    background-color: darkred; /* Darker shade on hover */
}


    </style>
<body>

    <div class="hero_area">
        <div class="hero_bg_box">
            <div class="bg_img_box">
                <img src="homepage/images/hero-bg.png" alt="">
            </div>
        </div>

                <!-- Emergency Button -->
        <a href="quickemergency.php" class="emergency-button" title="Report Emergency">
            <i class="fa fa-exclamation-circle"></i> Emergency
        </a>


        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.html">
                        <img src="images/logo.png" style="height: 80px; width: auto;">
                    </a>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 detail-box">
                                <h1>
                                    Heart <br>
                                    Rate
                                </h1>
                                <p>
                                    In an emergency, a racing heartbeat often signals panic or distress. It’s a physical reminder of the urgency to act quickly and stabilize the situation, as every second counts.
                                </p>
                            </div>
                            <div class="col-md-6 img-box">
                                <img src="homepage/images/heartrate.png" alt="Heart Rate">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 detail-box">
                                <h1>
                                    Emergency Vehicle <br>
                                    Lights
                                </h1>
                                <p>
                                    The flashing red and blue lights of a firetruck cutting through the night signify hope amidst chaos. They guide responders to the scene and alert others to clear the way for help.
                                </p>
                            </div>
                            <div class="col-md-6 img-box">
                                <img src="homepage/images/firefighter.png" alt="Emergency Vehicle Lights">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 detail-box">
                                <h1>
                                    Bandaid
                                </h1>
                                <p>
                                    A simple bandage might seem small, but in an emergency, it becomes a symbol of care and quick action, stopping bleeding and protecting wounds until further treatment can be provided.
                                </p>
                            </div>
                            <div class="col-md-6 img-box">
                                <img src="homepage/images/bandaid.png" alt="Bandaid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <li data-target="#customCarousel1" data-slide-to="1"></li>
                <li data-target="#customCarousel1" data-slide-to="2"></li>
            </ol>
        </div>
    </section>
    </div>


    <!-- service section -->
    <section class="service_section layout_padding">
    <div class="service_container">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Log <span>In</span>
                </h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="portal/admin/index.php">
                        <div class="box">
                            <div class="img-box">
                                <img src="homepage/images/w4.png" alt="" class="mx-auto d-block">
                            </div>
                            <div class="detail-box">
                                <h5>ADMIN</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="portal/agency/index.php">
                        <div class="box">
                            <div class="img-box">
                                <img src="homepage/images/station.png" alt="" class="mx-auto d-block">
                            </div>
                            <div class="detail-box">
                                <h5>AGENCY</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="portal/users/index.php">
                        <div class="box">
                            <div class="img-box">
                                <img src="homepage/images/user.png" alt="" class="mx-auto d-block">
                            </div>
                            <div class="detail-box">
                                <h5>USER</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- end service section -->


    <!-- about section -->

    <section class="about_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Emergency <span>Number</span>
                </h2>
            </div>
            <div class="row align-items-center">
                <!-- Image Section (Left) -->
                <div class="col-md-6">
                    <div class="img-box text-center">
                        <img src="homepage/images/ambulance.png" alt="Emergency" class="img-fluid">
                    </div>
                </div>
                <!-- Numbers Section (Right) -->
                <div class="col-md-6">
    <div class="container">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <div class="detail">
                    <h3>Brgy. Tunasan</h3>
                    <p>
                        <a href="tel:+639109681064">0910-968-1064</a> <br>
                        <a href="tel:+639276904148">0927-690-4148</a>
                    </p>
                    <h3>Brgy. Putatan</h3>
                    <p>
                        <a href="tel:+63986415260">8-641-52-60</a> <br>
                        <a href="tel:+63986600144">8-660-01-44</a>
                    </p>
                    <h3>Brgy. Poblacion</h3>
                    <p>
                        <a href="tel:+639089660626">8-966-06-26</a> <br>
                        <a href="tel:+639173149798">0917-314-9798</a> <br>
                        <a href="tel:+639979872687">0997-987-2687</a>
                    </p>
                </div>
            </div>
            <!-- Center Column -->
            <div class="col-md-4">
                <div class="detail">
                    <h3>Brgy. Bayanan</h3>
                    <p>
                        <a href="tel:+6394036459">8-403-6459</a> <br>
                        <a href="tel:+6394036480">8-403-6480</a> <br>
                        <a href="tel:+639255274826">0925-527-4826</a>
                    </p>
                    <h3>Brgy. Alabang</h3>
                    <p>
                        <a href="tel:+639473889040">0947-388-9040</a> <br>
                        <a href="tel:+639554539470">0955-453-9470</a>
                    </p>
                    <h3>Brgy. Cupang</h3>
                    <p>
                        <a href="tel:+63987432937">8-743-2937</a> <br>
                        <a href="tel:+63987432853">8-743-2853</a> <br>
                        <a href="tel:+63988503259">8-850-3259</a>
                    </p>
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-md-4">
                <div class="detail">
                    <h3>Brgy. Ayala Alabang</h3>
                    <p>
                        <a href="tel:+63988084053">8-808-4053</a> <br>
                        <a href="tel:+63988072472">8-807-2472</a> <br>
                        <a href="tel:+639541882730">0954-188-2730</a> <br>
                        <a href="tel:+639171112555">0917-111-2555</a>
                    </p>
                    <h3>Brgy. Buli</h3>
                    <p>
                        <a href="tel:+639952112601">0995-211-2601</a>
                    </p>
                    <h3>Brgy. Sucat</h3>
                    <p>
                        <a href="tel:+639498355484">0949-835-5484</a> <br>
                        <a href="tel:+639892782228">8-927-8228</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </section>


    <section class="client_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center psudo_white_primary mb_45">
                <h2>
                    Available <span>Agency</span>
                </h2>
            </div>
            <div class="carousel-wrap">
                <div class="owl-carousel client_owl-carousel">
                    <?php
                    // include 'connect.php'
                    $result = $db->prepare("SELECT * FROM agency ORDER BY id DESC ");
                    $result->execute();
                    for ($i = 0; $row = $result->fetch(); $i++) {
                    ?>
                        <div class="item">
                            <div class="box">
                                <div class="img-box">
                                    <img src="uploads/<?php echo $row['photo']; ?>" alt="" class="box-img">
                                </div>
                                <div class="detail-box">
                                    <div class="client_id">
                                        <div class="client_info">
                                            <h6>
                                                <?php echo $row['agency_name']; ?>
                                            </h6>
                                            <p>
                                                <?php echo $row['state']; ?>
                                            </p>
                                        </div>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    </div>
                                    <p>
                                        <strong>Phone:</strong> <?php echo $row['phone_number']; ?> <br>
                                        <strong>Email:</strong> <?php echo $row['email']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </section>

    <!-- team section -->
    <section class="team_section layout_padding">
    <div class="container-fluid">
        <div class="heading_container heading_center">
            <h2>
                Our <span>Team</span>
            </h2>
        </div>
        <div class="team_container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="team-box">
                        <div class="team-img-box">
                            <img src="homepage/images/team-1.jpg" class="team-img" alt="">
                        </div>
                        <div class="team-detail-box">
                            <h5>Allen Pascual</h5>
                            <p>Leader</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team-box">
                        <div class="team-img-box">
                            <img src="homepage/images/team-3.jpg" class="team-img" alt="">
                        </div>
                        <div class="team-detail-box">
                            <h5>Edralene De Guzman</h5>
                            <p>Member</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team-box">
                        <div class="team-img-box">
                            <img src="homepage/images/team-2.jpg" class="team-img" alt="">
                        </div>
                        <div class="team-detail-box">
                            <h5>Alliah Mher L. Domindiano</h5>
                            <p>Member</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- end team section -->


    <!-- footer section -->
    <section class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved
                <a href="#"></a>
            </p>
        </div>
    </section>
    <!-- footer section -->

    <!-- jQery -->
    <script type="text/javascript" src="homepage/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="homepage/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script type="text/javascript" src="homepage/js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->

</body>

</html>
