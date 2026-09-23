<!-- CTA Banner -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3" data-aos="fade-up">{{ $footerSettings['cta_title'] }}</h2>
        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">{{ $footerSettings['cta_description'] }}</p>
        <a href="{{ $footerSettings['cta_button_link'] }}" class="btn btn-light btn-lg px-5 rounded-pill text-primary fw-bold" data-aos="zoom-in" data-aos-delay="200">
            {{ $footerSettings['cta_button_text'] }}
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
                    @if(!empty($siteSettings['site_logo']))
                        <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'MediDiag' }}" style="height: 60px;" class="me-2">
                    @else
                        <i class="bi bi-heart-pulse-fill text-secondary fs-2 me-2"></i>
                    @endif
                </a>
                <p class="mb-4">{{ $footerSettings['description'] }}</p>
                <div class="d-flex gap-3">
                    @foreach($footerSettings['socials'] as $social)
                        @if(!empty($social['url']))<a href="{{ $social['url'] }}" class="text-white fs-5" target="_blank" rel="noopener" title="{{ $social['name'] }}"><i class="bi {{ $social['icon'] }}"></i></a>@endif
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    @foreach($footerSettings['quick_links'] as $link)<li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>@endforeach
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Our Services</h5>
                <ul class="footer-links">
                    @foreach($footerSettings['service_links'] as $link)<li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>@endforeach
                </ul>
            </div>

            <!-- Contact & Newsletter -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact Info</h5>
                <ul class="footer-links mb-4">
                    <li class="text-white"><i class="bi bi-geo-alt-fill text-secondary me-2"></i> {{ $siteSettings['site_address'] }}</li>
                    <li class="text-white"><i class="bi bi-telephone-fill text-secondary me-2"></i> {{ $siteSettings['site_phone'] }}</li>
                    <li class="text-white"><i class="bi bi-envelope-fill text-secondary me-2"></i> {{ $siteSettings['site_email'] }}</li>
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
            <p class="mb-0">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'MediDiag' }} Diagnostic Center. All Rights Reserved.</p>
        </div>
    </div>
</footer>
