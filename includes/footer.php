<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer wow fadeIn px-3 px-md-5" data-wow-delay="0.1s">
    <div class="container-fluid pb-5 ">

        <div class="row g-5">
            <div class="col-md-6 col-lg-4">
                <div class=" rounded p-4">

                    <a href="index.php" class=" w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-row align-items-center">
                            <img src="img/logo.png" alt="Kunjdham Logo" class="img-fluid mb-1"
                                style="height: 80px; width: auto;">
                            <h1 class="m-0 text-primary text-uppercase fs-2">Kunjdham</h1>
                        </div>
                    </a>


                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Attala chungi, parikarma marg t.b, hospital
                    lane, Vrindavan, Uttar Pradesh 281121</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>8102634528 , 94108108610</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>booking@kunjdham.com</p>

            </div>
            <div class="col-lg-5 col-md-12">
                <div class="row gy-5 g-4">
                    <div class="col-md-6">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Company</h6>
                        <a class="btn btn-link" href="about.php">About Us</a>
                        <a class="btn btn-link" href="contact.php">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <!-- <a class="btn btn-link" href="">Support</a> -->
                    </div>
                    <div class="col-md-6">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Social Links</h6>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <!-- <a class="btn btn-link" href="">Food & Restaurant</a>
                            <a class="btn btn-link" href="">Spa & Fitness</a>
                            <a class="btn btn-link" href="">Sports & Gaming</a>
                            <a class="btn btn-link" href="">Event & Party</a>
                            <a class="btn btn-link" href="">GYM & Yoga</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="copyright">

            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Kunjdham</a>, All Right Reserved.
                </div>
                <!-- <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div> -->
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

// Collect any flash alerts to fire via SweetAlert2
$swal_type = '';
$swal_title = '';
$swal_message = '';

if (!empty($_SESSION['contact_success'])) {
    $swal_type = 'success';
    $swal_title = 'Message Sent!';
    $swal_message = $_SESSION['contact_success'];
    unset($_SESSION['contact_success']);
} elseif (!empty($_SESSION['contact_errors'])) {
    $swal_type = 'error';
    $swal_title = 'Oops! Please fix the following';
    $swal_message = implode('<br>', array_map('htmlspecialchars', $_SESSION['contact_errors']));
    unset($_SESSION['contact_errors']);
} elseif (!empty($_SESSION['success'])) {
    $swal_type = 'success';
    $swal_title = 'Booking Confirmed!';
    $swal_message = $_SESSION['success'];
    unset($_SESSION['success']);
} elseif (!empty($_SESSION['errors'])) {
    $swal_type = 'error';
    $swal_title = 'Please fix the following';
    $swal_message = implode('<br>', array_map('htmlspecialchars', $_SESSION['errors']));
    unset($_SESSION['errors']);
}

if ($swal_type):
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: '<?php echo $swal_type; ?>',
                title: '<?php echo addslashes($swal_title); ?>',
                html: '<?php echo addslashes($swal_message); ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#c8a96e',
                background: '#fff',
                customClass: {
                    popup: 'swal-kunjdham-popup',
                    title: 'swal-kunjdham-title',
                    confirmButton: 'swal-kunjdham-btn'
                },
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        });
    </script>
<?php endif; ?>
</body>

</html>