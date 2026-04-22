<?php
$page_title = 'Rooms — Kunjdham Vrindavan | Rooms & Accommodation';
include 'includes/header.php';
?>

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/banner.png);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Rooms</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rooms</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Booking Start -->
         <?php
       include 'includes/bookingBar.php';
?>
        <!-- Booking End -->

        <!-- Rooms Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Rooms & Suites</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/room-1.jpg" alt="Room 1">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Deluxe Room</h5>
                                    <p class="mb-0">$120/Night</p>
                                </div>
                                <p>Comfortable and spacious rooms with modern amenities and pure-veg meals available on request.</p>
                                <a class="btn btn-primary mt-2" href="booking.php">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="room-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/room-2.jpg" alt="Room 2">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Family Suite</h5>
                                    <p class="mb-0">$180/Night</p>
                                </div>
                                <p>Large suite suitable for family stays, near major temples and tour facilitation.</p>
                                <a class="btn btn-primary mt-2" href="booking.php">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="room-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/room-3.jpg" alt="Room 3">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Single Room</h5>
                                    <p class="mb-0">$80/Night</p>
                                </div>
                                <p>Cozy single rooms for solo travelers and pilgrims looking for budget accommodation.</p>
                                <a class="btn btn-primary mt-2" href="booking.php">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rooms End -->

<?php include 'includes/footer.php'; ?>
