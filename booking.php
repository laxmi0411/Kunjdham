<?php
$page_title = 'Book Rooms — Kunjdham Vrindavan | Rooms & Darshan Facility';
include 'includes/header.php';
$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);
?>

<?php if (!empty($_SESSION['errors'])): ?>
    <div class="container mt-3">
        <?php foreach ($_SESSION['errors'] as $err): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($err); ?></div>
        <?php endforeach; unset($_SESSION['errors']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); ?></div>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

   <?php
       include 'includes/bookingBar.php';
?>

        <!-- Booking Start -->
      
            <div class="container py-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                    <h1 class="mb-5">Book A <span class="text-primary text-uppercase">Luxury Room</span></h1>
                </div>
                <div class="row g-5 py-5">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpeg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form id="bookingForm" method="post" action="process_booking.php" novalidate>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>">
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required pattern="\+?\d{10,15}" title="Enter digits only, optional leading +, 10-15 digits" maxlength="16" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>">
                                            <label for="phone">Phone</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" id="checkin" name="checkin" placeholder="Check In" data-target="#date3" data-toggle="datetimepicker" required value="<?php echo htmlspecialchars($old['checkin'] ?? ''); ?>" />
                                            <label for="checkin">Check In</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" id="checkout" name="checkout" placeholder="Check Out" data-target="#date4" data-toggle="datetimepicker" required value="<?php echo htmlspecialchars($old['checkout'] ?? ''); ?>" />
                                            <label for="checkout">Check Out</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="select1" name="adults">
                                                <option value="1" <?php echo (isset($old['adults']) && $old['adults']==1) ? 'selected' : ''; ?>>Adult 1</option>
                                                <option value="2" <?php echo (isset($old['adults']) && $old['adults']==2) ? 'selected' : ''; ?>>Adult 2</option>
                                                <option value="3" <?php echo (isset($old['adults']) && $old['adults']==3) ? 'selected' : ''; ?>>Adult 3</option>
                                            </select>
                                            <label for="select1">Select Adult</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="select2" name="children">
                                                <option value="0" <?php echo (isset($old['children']) && $old['children']==0) ? 'selected' : ''; ?>>None</option>
                                                <option value="1" <?php echo (isset($old['children']) && $old['children']==1) ? 'selected' : ''; ?>>Child 1</option>
                                                <option value="2" <?php echo (isset($old['children']) && $old['children']==2) ? 'selected' : ''; ?>>Child 2</option>
                                                <option value="3" <?php echo (isset($old['children']) && $old['children']==3) ? 'selected' : ''; ?>>Child 3</option>
                                            </select>
                                            <label for="select2">Select Child</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select class="form-select" id="select3" name="room" required>
                                                <option value="">Choose a room</option>
                                                <option value="junior" <?php echo (isset($old['room']) && $old['room']=='junior') ? 'selected' : ''; ?>>Junior Suite - ₹1111/Night</option>
                                                <option value="executive" <?php echo (isset($old['room']) && $old['room']=='executive') ? 'selected' : ''; ?>>Executive Suite - ₹2151/Night</option>
                                                <option value="deluxe" <?php echo (isset($old['room']) && $old['room']=='deluxe') ? 'selected' : ''; ?>>Super Deluxe - ₹2151/Night</option>
                                            </select>
                                            <label for="select3">Select A Room</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Special Request" id="message" name="message" style="height: 100px"><?php echo htmlspecialchars($old['message'] ?? ''); ?></textarea>
                                            <label for="message">Special Request</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
   
        <!-- Booking End -->

<?php include 'includes/footer.php'; ?>
