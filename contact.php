<?php
$page_title = 'Contact — Kunjdham Vrindavan';
include 'includes/header.php';
?>

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/banner.png);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Adult</option>
                                        <option value="1">Adult 1</option>
                                        <option value="2">Adult 2</option>
                                        <option value="3">Adult 3</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Child</option>
                                        <option value="1">Child 1</option>
                                        <option value="2">Child 2</option>
                                        <option value="3">Child 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->

        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="section-title text-start text-primary text-uppercase">Contact</h6>
                        <h1 class="mb-4">Get In Touch</h1>
                        <p class="mb-4">If you have any questions or would like to make a booking, please reach out using the form or contact details below.</p>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="bg-white rounded p-4">
                            <h5 class="mb-3">Contact Details</h5>
                            <p class="mb-2"><i class="fa fa-map-marker-alt me-2"></i>Attala chungi, parikarma marg t.b, hospital lane, Vrindavan, Uttar Pradesh 281121</p>
                            <p class="mb-2"><i class="fa fa-phone-alt me-2"></i>+012 345 67890</p>
                            <p class="mb-2"><i class="fa fa-envelope me-2"></i>booking@kunjdham.com</p>
                        </div>
                        <div class="mt-4">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!2m12..." width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

<?php include 'includes/footer.php'; ?>
