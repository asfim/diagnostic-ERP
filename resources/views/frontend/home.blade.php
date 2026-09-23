@extends('layouts.frontend')

@section('title', 'MediDiag – Advanced Diagnostic Care You Can Trust')

@section('content')

{{-- ============================================================
     HERO SECTION
     ============================================================ --}}
@if(!isset($hero) || (isset($hero) && $hero->status == 1))
<section class="hero-section" style="
    @if(!empty($hero->bg_image)) 
        background-image: url('{{ asset('storage/' . $hero->bg_image) }}'); 
        background-size: cover; 
        background-position: center; 
    @endif
">
    <div class="hero-bg" style="
        @if(!empty($hero->bg_image) && !empty($hero->overlay_color)) 
            background: {{ $hero->overlay_color }}; 
        @endif
    ">
        <div class="container" style="position:relative; z-index:2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-right" data-aos-duration="800">
                    {{-- Badge --}}
                    <div class="hero-badge mb-3">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        Bangladesh's Most Trusted Diagnostic Network
                    </div>

                    {{-- Title --}}
                    <h1 class="display-4 fw-bold text-white mb-3">
                        {!! nl2br(e($hero->title ?? "Advanced Care &\nPrecision Diagnostics\nYou Can Trust")) !!}
                    </h1>

                    <p class="text-white-50 mb-4" style="font-size:1.1rem; max-width:520px; line-height:1.8;">
                        {!! nl2br(e($hero->subtitle ?? "Expert consultants, state-of-the-art labs & compassionate care —\navailable 24/7 for you and your family.")) !!}
                    </p>

                    {{-- Search Bar --}}
                    <div class="hero-search mb-4">
                        <i class="bi bi-search text-muted fs-5 me-2 flex-shrink-0"></i>
                        <input type="text" class="form-control" placeholder="Search tests, packages, doctors…" id="heroSearchInput">
                        <button class="btn btn-primary fw-bold" onclick="window.location.href='{{ url('/tests') }}'">Search</button>
                    </div>

                    {{-- CTAs --}}
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="{{ $hero->button_link ?? url('/appointment') }}" class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow">
                            <i class="bi bi-calendar-check-fill me-2"></i>{{ $hero->button_text ?? 'Book Appointment' }}
                        </a>
                        <a href="{{ url('/packages') }}" class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill">
                            <i class="bi bi-box-seam me-2"></i>View Packages
                        </a>
                    </div>

                    {{-- Stats Strip --}}
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="stat-value">{{ $stats['doctors'] ?? '50+' }}</div>
                            <span class="stat-label">Expert Doctors</span>
                        </div>
                        <div class="hero-stat" style="border-left:1px solid rgba(255,255,255,.2); padding-left:2rem;">
                            <div class="stat-value">{{ $stats['tests'] ?? '500+' }}</div>
                            <span class="stat-label">Diagnostic Tests</span>
                        </div>
                        <div class="hero-stat" style="border-left:1px solid rgba(255,255,255,.2); padding-left:2rem;">
                            <div class="stat-value">{{ $stats['patients'] ?? '100k+' }}</div>
                            <span class="stat-label">Happy Patients</span>
                        </div>
                        <div class="hero-stat" style="border-left:1px solid rgba(255,255,255,.2); padding-left:2rem;">
                            <div class="stat-value">{{ $stats['support'] ?? '24/7' }}</div>
                            <span class="stat-label">Emergency Support</span>
                        </div>
                    </div>
                </div>

                @if(!empty($hero->image))
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('storage/' . $hero->image) }}" class="img-fluid rounded-4 shadow-lg" alt="Hero Image">
                </div>
                @else
                {{-- Right side visual card --}}
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="bg-white bg-opacity-10 rounded-4 p-4 border border-white border-opacity-25" style="backdrop-filter:blur(12px);">
                        <h6 class="text-white fw-bold mb-3"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Quick Actions</h6>
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ url('/appointment') }}" class="d-flex align-items-center gap-3 bg-white bg-opacity-10 rounded-3 p-3 text-white text-decoration-none" style="transition:all .3s; border:1px solid rgba(255,255,255,.15);" onmouseover="this.style.background='rgba(255,255,255,.2)'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;">
                                    <i class="bi bi-calendar-check fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size:.95rem;">Book Appointment</div>
                                    <div style="font-size:.78rem; opacity:.7;">Schedule with our specialists</div>
                                </div>
                                <i class="bi bi-chevron-right ms-auto opacity-50"></i>
                            </a>
                            <a href="{{ url('/reports') }}" class="d-flex align-items-center gap-3 bg-white bg-opacity-10 rounded-3 p-3 text-white text-decoration-none" style="transition:all .3s; border:1px solid rgba(255,255,255,.15);" onmouseover="this.style.background='rgba(255,255,255,.2)'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;">
                                    <i class="bi bi-file-earmark-medical fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size:.95rem;">Download Report</div>
                                    <div style="font-size:.78rem; opacity:.7;">Access results securely online</div>
                                </div>
                                <i class="bi bi-chevron-right ms-auto opacity-50"></i>
                            </a>
                            <a href="{{ url('/home-collection') }}" class="d-flex align-items-center gap-3 bg-white bg-opacity-10 rounded-3 p-3 text-white text-decoration-none" style="transition:all .3s; border:1px solid rgba(255,255,255,.15);" onmouseover="this.style.background='rgba(255,255,255,.2)'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:44px;height:44px;">
                                    <i class="bi bi-truck fs-5 text-dark"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size:.95rem;">Home Collection</div>
                                    <div style="font-size:.78rem; opacity:.7;">Sample pickup at your doorstep</div>
                                </div>
                                <i class="bi bi-chevron-right ms-auto opacity-50"></i>
                            </a>
                        </div>
                        <div class="mt-3 pt-3 border-top border-white border-opacity-15 text-center">
                            <small class="text-white-50"><i class="bi bi-lock-fill me-1 text-success"></i>Your data is safe & encrypted</small>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

    {{-- ============================================================
         QUICK ACTION CARDS (overlap hero bottom)
         ============================================================ --}}
    <div class="quick-actions">
        <div class="container">
            <div class="row g-4">
                @foreach($quickActions as $index => $action)
                <div class="col-lg-4 col-md-6 {{ $index == 2 ? 'mx-auto' : '' }}" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="quick-card">
                        <div class="q-icon bg-{{ $action['color'] ?? 'primary' }} bg-opacity-10 text-{{ $action['color'] ?? 'primary' }} mx-auto">
                            <i class="bi {{ $action['icon'] ?? 'bi-star' }}"></i>
                        </div>
                        <h4 class="fw-bold">{{ $action['title'] ?? '' }}</h4>
                        <p>{{ $action['description'] ?? '' }}</p>
                        <a href="{{ $action['link'] ?? '#' }}" class="text-{{ $action['color'] ?? 'primary' }}">{{ $action['button_text'] ?? 'View More' }} <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     ABOUT SECTION
     ============================================================ --}}
<section class="section-padding bg-white" style="padding-top: 120px;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80"
                         alt="MediDiag Center" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover; max-height:440px;">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-4 rounded-4 shadow-lg m-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="display-6 fw-bold">15+</span>
                            <span class="fw-semibold lh-sm">Years of<br>Excellence</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="section-header mb-4">
                    <span class="label">About MediDiag</span>
                    <h2>Leading the Way in Medical Diagnostics</h2>
                    <p class="mt-3">We provide comprehensive diagnostic services with a commitment to accuracy, reliability, and patient comfort. Our state-of-the-art facility is equipped with the latest medical technology.</p>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <span class="fw-semibold">Advanced Equipment</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <span class="fw-semibold">Expert Pathologists</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <span class="fw-semibold">Accurate Reports</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            <span class="fw-semibold">Fast Turnaround</span>
                        </div>
                    </div>
                </div>
                {{-- Stats Row --}}
                <div class="row g-3 mb-4 text-center">
                    <div class="col-4 py-3 bg-light-soft rounded-3">
                        <h3 class="fw-bold text-primary mb-0">50+</h3>
                        <small class="text-muted">Doctors</small>
                    </div>
                    <div class="col-4 py-3 bg-light-soft rounded-3">
                        <h3 class="fw-bold text-primary mb-0">100k+</h3>
                        <small class="text-muted">Patients</small>
                    </div>
                    <div class="col-4 py-3 bg-light-soft rounded-3">
                        <h3 class="fw-bold text-primary mb-0">500+</h3>
                        <small class="text-muted">Tests</small>
                    </div>
                </div>
                <a href="{{ url('/about') }}" class="btn btn-primary rounded-pill px-4">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     POPULAR DIAGNOSTIC TESTS
     ============================================================ --}}
<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered mb-5" data-aos="fade-up">
            <span class="label">Diagnostics</span>
            <h2>Popular Diagnostic Tests</h2>
            <p class="mt-2">Explore our most requested tests. We ensure precise and timely results.</p>
        </div>

            @foreach($tests as $i => $test)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i+1)*80 }}">
                <div class="test-card d-flex flex-column">
                    <div class="t-icon bg-primary bg-opacity-10 text-primary mx-auto">
                        <i class="bi bi-activity"></i>
                    </div>
                    <h5 class="fw-bold">{{ $test->name }}</h5>
                    <p class="text-truncate">{{ $test->description ?? 'Accurate and reliable diagnostic test.' }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                        <span class="price">৳ {{ number_format($test->price, 0) }}</span>
                        <a href="{{ url('/appointment') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Book</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ url('/tests') }}" class="btn btn-outline-primary rounded-pill px-5">View All Tests</a>
        </div>
    </div>
</section>

{{-- ============================================================
     HEALTH PACKAGES
     ============================================================ --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="section-header centered mb-5" data-aos="fade-up">
            <span class="label">Preventive Care</span>
            <h2>Comprehensive Health Packages</h2>
            <p class="mt-2">Preventive health checkups tailored to your age, gender, and lifestyle.</p>
        </div>

        <div class="row g-4">
            @foreach($packages as $i => $pkg)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i+1)*100 }}">
                <div class="package-card {{ $i === 1 ? 'featured' : '' }}">
                    <div class="pkg-header {{ $i === 1 ? 'bg-success' : 'bg-primary' }} text-white">
                        @if($pkg->discount_price)
                        <div class="pkg-badge bg-warning text-dark">Save {{ number_format($pkg->price - $pkg->discount_price, 0) }} ৳</div>
                        @endif
                        <i class="bi bi-shield-check fs-1 opacity-50"></i>
                        <h4 class="fw-bold mt-2 mb-0">{{ $pkg->name }}</h4>
                        <div class="pkg-price">
                            @if($pkg->discount_price)
                            ৳ {{ number_format($pkg->discount_price, 0) }} <small>৳ {{ number_format($pkg->price, 0) }}</small>
                            @else
                            ৳ {{ number_format($pkg->price, 0) }}
                            @endif
                        </div>
                    </div>
                    <div class="pkg-body">
                        <p class="small text-muted">{{ $pkg->description }}</p>
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ url('/packages') }}" class="btn btn-outline-{{ $i === 1 ? 'success' : 'primary' }} rounded-pill">View Details</a>
                            <a href="{{ url('/appointment') }}" class="btn btn-{{ $i === 1 ? 'success text-white' : 'primary' }} rounded-pill">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     DEPARTMENTS
     ============================================================ --}}
<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered mb-5" data-aos="fade-up">
            <span class="label">Specialties</span>
            <h2>Our Departments</h2>
        </div>

        <div class="row g-4">
            @foreach($departments as $i => $dept)
            <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in" data-aos-delay="{{ ($i+1)*60 }}">
                <a href="{{ url('/departments/' . ($dept->slug ?? '')) }}" class="dept-card">
                    <i class="bi {{ $dept->icon ?? 'bi-heart-pulse' }} dept-icon"></i>
                    <h5>{{ $dept->name }}</h5>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     EXPERT DOCTORS
     ============================================================ --}}
<section class="section-padding bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3" data-aos="fade-up">
            <div class="section-header mb-0">
                <span class="label">Medical Team</span>
                <h2 class="mb-0">Our Expert Doctors</h2>
            </div>
            <a href="{{ url('/doctors') }}" class="btn btn-outline-primary rounded-pill">View All Doctors</a>
        </div>

        <div class="row g-4">
            @foreach($doctors as $i => $doc)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i+1)*100 }}">
                <div class="doctor-card">
                    <img src="{{ $doc->image ? asset('storage/'.$doc->image) : 'https://images.unsplash.com/photo-1594824436998-058a23116fc7?auto=format&fit=crop&w=500&q=80' }}" alt="{{ $doc->name }}">
                    <div class="doc-body">
                        <h5>{{ $doc->name }}</h5>
                        <p class="specialty text-primary fw-semibold">{{ $doc->department ? $doc->department->name : 'Specialist' }}</p>
                        <p class="degree">{{ $doc->specialization }}<br>{{ $doc->experience_years }} Years Experience</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('/appointment') }}" class="btn btn-sm btn-primary rounded-pill px-3">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     WHY CHOOSE US
     ============================================================ --}}
<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=800&q=80"
                     alt="Laboratory" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover; max-height:440px;">
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <div class="section-header mb-4">
                    <span class="label">Why Choose Us</span>
                    <h2>The MediDiag Difference</h2>
                    <p class="mt-2">We merge medical expertise with advanced technology to deliver unparalleled diagnostic accuracy and patient care.</p>
                </div>

                @php
                $features = [
                    ['icon'=>'bi-shield-check','color'=>'primary','title'=>'Accurate &amp; Reliable Reports','desc'=>'Rigorous quality control ensuring ISO-certified accuracy in every result.'],
                    ['icon'=>'bi-clock-history','color'=>'success','title'=>'Fast Report Delivery','desc'=>'Minimum waiting time with online report access within hours.'],
                    ['icon'=>'bi-cash-coin','color'=>'warning','title'=>'Affordable Pricing','desc'=>'Premium diagnostics at transparent, competitive rates. No hidden charges.'],
                    ['icon'=>'bi-house-door','color'=>'danger','title'=>'Home Sample Collection','desc'=>'We come to you — convenient, safe, and timely doorstep service.'],
                ];
                @endphp

                @foreach($features as $f)
                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box bg-{{ $f['color'] }} bg-opacity-10 text-{{ $f['color'] }} rounded-3 flex-shrink-0" style="width:54px;height:54px;">
                        <i class="bi {{ $f['icon'] }} fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{!! $f['title'] !!}</h5>
                        <p class="text-muted mb-0 small">{{ $f['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     HOW IT WORKS
     ============================================================ --}}
<section class="section-padding bg-white">
    <div class="container text-center">
        <div class="section-header centered mb-5" data-aos="fade-up">
            <span class="label">Process</span>
            <h2>How It Works</h2>
        </div>

        <div class="row g-4 position-relative">
            {{-- Connecting line --}}
            <div class="d-none d-lg-block position-absolute top-0 start-0 w-100" style="top:40px!important;z-index:1;">
                <div class="border-top border-2 border-primary" style="margin: 0 10%; opacity:.2;"></div>
            </div>

            @php
            $steps = [
                ['n'=>'1','icon'=>'bi-search','title'=>'Choose Service','desc'=>'Browse our tests, packages, or select a doctor for consultation.'],
                ['n'=>'2','icon'=>'bi-calendar-check','title'=>'Book Appointment','desc'=>'Pick a convenient date and time slot online or via phone.'],
                ['n'=>'3','icon'=>'bi-hospital','title'=>'Visit or Home','desc'=>'Visit our center, or we collect the sample from your home.'],
                ['n'=>'4','icon'=>'bi-file-earmark-check','title'=>'Get Report Online','desc'=>'Download your verified report securely from our portal.'],
            ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="col-lg-3 col-md-6 position-relative" style="z-index:2;" data-aos="fade-up" data-aos-delay="{{ ($i+1)*100 }}">
                <div class="step-circle mx-auto">{{ $step['n'] }}</div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3" style="width:56px;height:56px;">
                    <i class="bi {{ $step['icon'] }} fs-4"></i>
                </div>
                <h5 class="fw-bold mb-2">{{ $step['title'] }}</h5>
                <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     TESTIMONIALS
     ============================================================ --}}
<section class="section-padding bg-primary">
    <div class="container">
        <div class="section-header centered text-white mb-5" data-aos="fade-up">
            <span class="label" style="color:rgba(255,255,255,.6);">Patient Reviews</span>
            <h2 style="color:#fff;">What Our Patients Say</h2>
        </div>

        <div class="row g-4 justify-content-center">
            @php
            $reviews = [
                ['name'=>'Tasnim Alam','loc'=>'Dhaka','img'=>'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=100&q=80','review'=>'"The service was incredibly fast and professional. I booked online, gave my sample, and got the report by email — no second visit needed!"'],
                ['name'=>'Imran Hossain','loc'=>'Mirpur, Dhaka','img'=>'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80','review'=>'"Their home collection service is a lifesaver for my elderly parents. The phlebotomist was gentle and arrived exactly on time. Highly recommended!"'],
                ['name'=>'Ruma Begum','loc'=>'Sylhet','img'=>'https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=100&q=80','review'=>'"The executive health package gives excellent value for money. Reports were thorough, and the doctor consultation was very helpful."'],
            ];
            @endphp

            @foreach($reviews as $i => $r)
            <div class="col-lg-4 col-md-6" data-aos="{{ $i === 0 ? 'fade-right' : ($i === 2 ? 'fade-left' : 'fade-up') }}" data-aos-delay="{{ $i*100 }}">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <div class="stars mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>{{ $r['review'] }}</p>
                    <div class="avatar d-flex align-items-center gap-3">
                        <img src="{{ $r['img'] }}" alt="{{ $r['name'] }}">
                        <div>
                            <h6 class="mb-0">{{ $r['name'] }}</h6>
                            <small>{{ $r['loc'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     BLOG / HEALTH ARTICLES
     ============================================================ --}}
<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3" data-aos="fade-up">
            <div class="section-header mb-0">
                <span class="label">Health Articles</span>
                <h2 class="mb-0">Latest Medical News</h2>
            </div>
            <a href="{{ url('/blog') }}" class="btn btn-outline-primary rounded-pill">Read All Articles</a>
        </div>

        @php
        $blogs = [
            ['img'=>'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80','cat'=>'Health Tips','date'=>'Oct 15, 2023','title'=>'Importance of Regular Health Checkups','desc'=>'Discover why routine health screenings are vital for early detection and prevention of chronic diseases.'],
            ['img'=>'https://images.unsplash.com/photo-1584362917165-526a968579e8?auto=format&fit=crop&w=600&q=80','cat'=>'Diet & Nutrition','date'=>'Oct 10, 2023','title'=>'Best Foods for a Healthy Heart','desc'=>'Learn about the superfoods that can help lower cholesterol and improve your cardiovascular health.'],
            ['img'=>'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=600&q=80','cat'=>'Medical Tech','date'=>'Oct 05, 2023','title'=>'How MRI Scans Changed Diagnostics','desc'=>'An in-depth look at how magnetic resonance imaging provides unparalleled insights into the human body.'],
        ];
        @endphp

        <div class="row g-4">
            @foreach($blogs as $i => $blog)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i+1)*100 }}">
                <div class="blog-card">
                    <div class="overflow-hidden">
                        <img src="{{ $blog['img'] }}" alt="{{ $blog['title'] }}">
                    </div>
                    <div class="blog-body">
                        <div class="blog-meta d-flex gap-3">
                            <span><i class="bi bi-tag-fill"></i> {{ $blog['cat'] }}</span>
                            <span><i class="bi bi-calendar3"></i> {{ $blog['date'] }}</span>
                        </div>
                        <h5 class="fw-bold mb-2"><a href="#">{{ $blog['title'] }}</a></h5>
                        <p class="mb-3">{{ $blog['desc'] }}</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WhatsApp Floating Button --}}
<a href="https://wa.me/8801711000000" class="btn-whatsapp" title="Chat on WhatsApp" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>

{{-- Mobile Sticky Bottom Bar --}}
<div class="mobile-bottom-bar">
    <a href="{{ url('/appointment') }}" class="btn btn-primary rounded-pill">
        <i class="bi bi-calendar-check me-1"></i> Book Appointment
    </a>
    <a href="{{ url('/reports') }}" class="btn btn-outline-primary rounded-pill">
        <i class="bi bi-file-medical me-1"></i> Reports
    </a>
</div>

@endsection
