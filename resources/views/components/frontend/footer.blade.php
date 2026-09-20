<!-- CTA Banner -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Your Health. Our Priority.</h2>
        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Experience world-class diagnostic services with state-of-the-art technology and expert medical professionals.</p>
        <a href="{{ url('/appointment') }}" class="btn btn-light btn-lg px-5 rounded-pill text-primary fw-bold" data-aos="zoom-in" data-aos-delay="200">
            Book an Appointment Now
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <!-- Brand Info -->
            <div class="col-lg-4 col-md-6 mb-4 pe-lg-5">
                <a class="d-flex align-items-center text-decoration-none mb-3" href="{{ url('/') }}">
                    <i class="bi bi-heart-pulse-fill text-secondary fs-2 me-2"></i>
                    <div>
                        <h4 class="mb-0 text-white fw-bold">Medi<span class="text-secondary">Diag</span></h4>
                    </div>
                </a>
                <p class="mb-4">We are committed to providing accurate and timely diagnostic reports to help you make informed healthcare decisions.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/doctors') }}">Our Doctors</a></li>
                    <li><a href="{{ url('/reports') }}">Download Report</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Our Services</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/departments') }}">Pathology</a></li>
                    <li><a href="{{ url('/departments') }}">Radiology & Imaging</a></li>
                    <li><a href="{{ url('/departments') }}">Cardiology</a></li>
                    <li><a href="{{ url('/packages') }}">Health Packages</a></li>
                    <li><a href="{{ url('/tests') }}">Home Sample Collection</a></li>
                </ul>
            </div>

            <!-- Contact & Newsletter -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact Info</h5>
                <ul class="footer-links mb-4">
                    <li class="text-white"><i class="bi bi-geo-alt-fill text-secondary me-2"></i> 123 Healthcare Ave, Dhaka 1212, Bangladesh</li>
                    <li class="text-white"><i class="bi bi-telephone-fill text-secondary me-2"></i> +880 1711 000 000</li>
                    <li class="text-white"><i class="bi bi-envelope-fill text-secondary me-2"></i> info@diagnosticcenter.com</li>
                </ul>
                
                <h6 class="text-white mb-2">Subscribe to Newsletter</h6>
                <form class="d-flex">
                    <input type="email" class="form-control rounded-start-pill border-0" placeholder="Email Address" required>
                    <button class="btn btn-secondary rounded-end-pill px-3" type="submit"><i class="bi bi-send-fill"></i></button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom text-center">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} MediDiag Diagnostic Center. All Rights Reserved. Designed for Excellence.</p>
        </div>
    </div>
</footer>
