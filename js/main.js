(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        // videoSrc logged only when used; removed noisy console output

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });

    // Simple client-side form validation for booking and contact forms
    $(document).ready(function () {
        function showFormErrors($form, errors) {
            $form.find('.invalid-feedback').remove();
            Object.keys(errors).forEach(function (name) {
                var msg = errors[name];
                var $field = $form.find('[name="' + name + '"]').first();
                if (!$field.length) $field = $form.find('#' + name);
                if ($field.length) {
                    $field.addClass('is-invalid');
                    if (!$field.next('.invalid-feedback').length) {
                        $field.after('<div class="invalid-feedback">' + msg + '</div>');
                    }
                }
            });
        }

        function clearFormErrors($form) {
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('.invalid-feedback').remove();
        }

        function isValidEmail(email) {
            return /^[\w-.+]+@[\w-]+\.[A-Za-z]{2,}$/.test(email);
        }

        $('form').on('submit', function (e) {
            var $form = $(this);
            // Booking form validation
            if ($form.is('#bookingForm')) {
                clearFormErrors($form);
                var errors = {};
                var name = $form.find('[name="name"]').val();
                var email = $form.find('[name="email"]').val();
                var phone = $form.find('[name="phone"]').val();
                var checkin = $form.find('[name="checkin"]').val();
                var checkout = $form.find('[name="checkout"]').val();
                var room = $form.find('[name="room"]').val();
                if (!name) errors['name'] = 'Please enter your name';
                if (!email || !isValidEmail(email)) errors['email'] = 'Please enter a valid email';
                // Basic phone validation: at least 10 digits (allow formatting characters)
                var phoneDigits = (phone || '').replace(/\D/g, '');
                if (!phone || phoneDigits.length < 10) errors['phone'] = 'Please enter a valid phone number';
                if (!checkin) errors['checkin'] = 'Please select a check-in date';
                if (!checkout) errors['checkout'] = 'Please select a check-out date';
                if (!room) errors['room'] = 'Please select a room';
                if (Object.keys(errors).length) {
                    e.preventDefault();
                    showFormErrors($form, errors);
                    return;
                }
                // No client-side errors: allow normal form submission to server
                var $btn = $form.find('button[type="submit"]');
                $btn.prop('disabled', true).text('Sending...');
                // let the browser submit the form (no preventDefault)
                return true;
            }

            // Contact form validation
            if ($form.is('#contactForm')) {
                e.preventDefault();
                clearFormErrors($form);
                var errors = {};
                var cname = $form.find('[name="name"]').val();
                var cemail = $form.find('[name="email"]').val();
                var message = $form.find('[name="message"]').val();
                if (!cname) errors['name'] = 'Please enter your name';
                if (!cemail || !isValidEmail(cemail)) errors['email'] = 'Please enter a valid email';
                if (!message) errors['message'] = 'Please enter your message';
                if (Object.keys(errors).length) { showFormErrors($form, errors); return; }
                var $btn = $form.find('button[type="submit"]');
                $btn.prop('disabled', true).text('Sending...');
                setTimeout(function () {
                    $form[0].reset();
                    $btn.prop('disabled', false).text('Send Message');
                    alert('Thanks — your message has been sent.');
                }, 800);
                return false;
            }
        });

        // Clear field error on input/change
        $('form').on('input change', 'input,textarea,select', function () {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        });
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            }
        }
    });

})(jQuery);

