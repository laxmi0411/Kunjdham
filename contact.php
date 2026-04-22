<?php
$page_title = 'Contact — Kunjdham Vrindavan';
include 'includes/header.php';
$old = $_SESSION['contact_old'] ?? [];
unset($_SESSION['contact_old']);
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/banner.png);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Booking Bar Start -->
<?php include 'includes/bookingBar.php'; ?>
<!-- Booking Bar End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-start text-primary text-uppercase">Contact Us</h6>
                <h1 class="mb-4">Get In <span class="text-primary">Touch</span></h1>
                <p class="mb-4">
                    Have a question or want to book a room? Fill in the form below and we'll get back to you as soon as
                    possible. You can also reach us directly via phone or email.
                </p>
                <form id="contactForm" method="POST" action="process_contact.php" novalidate>
                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_name" name="name"
                                    placeholder="Your Name" required
                                    value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>">
                                <label for="contact_name">Your Name *</label>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="contact_email" name="email"
                                    placeholder="Your Email" required
                                    value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
                                <label for="contact_email">Your Email *</label>
                            </div>
                        </div>
                        <!-- Phone -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="contact_phone" name="phone"
                                    placeholder="Phone Number" pattern="\+?\d{10,15}" maxlength="16"
                                    title="Enter 10–15 digit phone number"
                                    value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>">
                                <label for="contact_phone">Phone Number</label>
                            </div>
                        </div>
                        <!-- Room Interest -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="contact_room" name="room">
                                    <option value="">— No preference —</option>
                                    <option value="junior" <?php echo (($old['room'] ?? '') === 'junior') ? 'selected' : ''; ?>>Junior Suite — ₹1111/Night</option>
                                    <option value="executive" <?php echo (($old['room'] ?? '') === 'executive') ? 'selected' : ''; ?>>Executive Suite — ₹2151/Night</option>
                                    <option value="deluxe" <?php echo (($old['room'] ?? '') === 'deluxe') ? 'selected' : ''; ?>>Super Deluxe — ₹2151/Night</option>
                                </select>
                                <label for="contact_room">Interested Room</label>
                            </div>
                        </div>
                        <!-- Subject -->
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_subject" name="subject"
                                    placeholder="Subject"
                                    value="<?php echo htmlspecialchars($old['subject'] ?? ''); ?>">
                                <label for="contact_subject">Subject</label>
                            </div>
                        </div>
                        <!-- Message -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Your Message" id="contact_message"
                                    name="message" style="height: 130px;"
                                    required><?php echo htmlspecialchars($old['message'] ?? ''); ?></textarea>
                                <label for="contact_message">Your Message *</label>
                            </div>
                        </div>
                        <!-- Submit -->
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit" id="contactSubmitBtn">
                                <i class="fa fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Contact Info + Map -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-light rounded p-4 mb-4">
                    <h5 class="mb-4 text-primary"><i class="fa fa-info-circle me-2"></i>Contact Details</h5>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                            style="width:40px;height:40px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Address</small>
                            <p class="mb-0">Attala chungi, parikarma marg t.b, hospital lane,<br>Vrindavan, Uttar
                                Pradesh 281121</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                            style="width:40px;height:40px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Phone</small>
                            <p class="mb-0"><a href="tel:+918317795774" class="text-dark text-decoration-none">+91 87976
                                    74709</a></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                            style="width:40px;height:40px;">
                            <i class="fab fa-whatsapp text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">WhatsApp</small>
                            <p class="mb-0">
                                <a href="https://wa.me/918317795774" target="_blank"
                                    class="text-success text-decoration-none fw-bold">
                                    Chat on WhatsApp
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                            style="width:40px;height:40px;">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Email</small>
                            <p class="mb-0"><a href="mailto:lakshmitk2301@gmail.com"
                                    class="text-dark text-decoration-none">lakshmitk2301@gmail.com</a></p>
                        </div>
                    </div>
                </div>
                <!-- Google Map -->
                <div class="rounded overflow-hidden shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3537.3219490684327!2d77.6523!3d27.5784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3973042e99d3b035%3A0x69facdcef63547ac!2sVrindavan%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1681000000000!5m2!1sen!2sin"
                        width="100%" height="260" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php include 'includes/footer.php'; ?>