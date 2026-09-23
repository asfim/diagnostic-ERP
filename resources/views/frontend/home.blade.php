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
                    <img src="{{ !empty($about['image']) ? asset('storage/' . $about['image']) : 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80' }}"
                         alt="{{ $about['title'] ?? 'About MediDiag' }}" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover; max-height:440px;">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-4 rounded-4 shadow-lg m-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="display-6 fw-bold">{{ $about['years_number'] ?? '15+' }}</span>
                            <span class="fw-semibold lh-sm">{!! nl2br(e($about['years_text'] ?? "Years of\nExcellence")) !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="section-header mb-4">
                    <span class="label">{{ $about['label'] ?? 'About MediDiag' }}</span>
                    <h2>{{ $about['title'] ?? 'Leading the Way in Medical Diagnostics' }}</h2>
                    <p class="mt-3">{{ $about['description'] ?? '' }}</p>
                </div>
                <div class="row g-3 mb-4">
                    @if(!empty($about['features']) && is_array($about['features']))
                        @foreach($about['features'] as $feature)
                        @if(!empty($feature))
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <span class="fw-semibold">{{ $feature }}</span>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    @endif
                </div>
                {{-- Stats Row --}}
                <div class="row g-3 mb-4 text-center">
                    <div class="col-4 py-3 bg-light-soft rounded-3">
                        <h3 class="fw-bold text-primary mb-0">{{ $stats['doctors'] ?? '50+' }}</h3>
                        <small class="text-muted">Doctors</small>
                    </div>
                    <div class="col-4 py-3 bg-light-soft rounded-3">
                        <h3 class="fw-bold text-primary mb-0">{{ $stats['patients'] ?? '100k+' }}</h3>
                        <small class="text-muted">Patients</small>
                    </div>
                    <div class="col-4 py-3 bg-light-soft rounded-3">
                        <h3 class="fw-bold text-primary mb-0">{{ $stats['tests'] ?? '500+' }}</h3>
                        <small class="text-muted">Tests</small>
                    </div>
                </div>
                <a href="{{ $about['button_link'] ?? url('/about') }}" class="btn btn-primary rounded-pill px-4">{{ $about['button_text'] ?? 'Learn More' }} <i class="bi bi-arrow-right ms-1"></i></a>
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

            <div class="row g-4 justify-content-center">
            @foreach($tests->take(3) as $i => $test)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i+1)*80 }}">
                <div class="test-card-premium h-100 d-flex flex-column" style="cursor: pointer;" onclick="window.location.href='{{ url('/tests/'.$test->id) }}'">
                    <div class="t-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-activity fs-4"></i>
                    </div>
                    <div class="test-card-body p-4 text-center flex-grow-1">
                        <h5 class="fw-bold"><a href="{{ url('/tests/'.$test->id) }}" class="text-dark text-decoration-none">{{ $test->name }}</a></h5>
                        <p class="text-muted text-truncate mb-0">{{ $test->description ?? 'Accurate and reliable diagnostic test.' }}</p>
                    </div>
                    <div class="test-card-footer bg-light-soft border-top p-3 d-flex justify-content-between align-items-center">
                        <span class="price fw-bold text-primary fs-5">৳ {{ number_format($test->price, 0) }}</span>
                        <div class="d-flex gap-2">
                            <a href="{{ url('/tests/'.$test->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Details</a>
                            <a href="{{ url('/appointment') }}?test={{ $test->id }}" class="btn btn-sm btn-primary rounded-pill px-4">Book</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ url('/tests') }}" class="btn btn-outline-primary rounded-pill px-5">View All Tests</a>
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
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="{{ ($i+1)*60 }}">
                <a href="{{ url('/departments/' . ($dept->slug ?? '')) }}" class="text-decoration-none">
                    <div class="dept-card-premium h-100 p-4 text-center">
                        <div class="dept-icon-wrapper mx-auto mb-3">
                            <i class="bi {{ $dept->icon ?? 'bi-heart-pulse' }} text-primary"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $dept->name }}</h5>
                        <div class="d-flex justify-content-center gap-3 mt-3 opacity-75">
                            <div class="text-muted small">
                                <i class="bi bi-person-fill text-primary"></i> {{ $dept->doctors_count }} Doctors
                            </div>
                            <div class="text-muted small">
                                <i class="bi bi-clipboard2-pulse text-success"></i> {{ $dept->tests_count }} Tests
                            </div>
                        </div>
                    </div>
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
                <div class="doctor-card-premium h-100">
                    <div class="doc-img-wrapper">
                        <img src="{{ $doc->photo ? asset('storage/'.$doc->photo) : 'https://images.unsplash.com/photo-1594824436998-058a23116fc7?auto=format&fit=crop&w=500&q=80' }}" alt="{{ $doc->name }}" class="img-fluid w-100">
                    </div>
                    <div class="doc-body p-4 text-center">
                        <h5 class="fw-bold mb-1">{{ $doc->name }}</h5>
                        <p class="specialty text-primary fw-semibold mb-2">
                            <i class="bi bi-heart-pulse-fill me-1"></i>{{ $doc->department ? $doc->department->name : 'Specialist' }}
                        </p>
                        <p class="degree small text-muted mb-3">{{ $doc->specialization }}</p>
                        
                        <div class="d-flex justify-content-center gap-3 mb-3 border-top pt-3 opacity-75">
                            <div class="text-muted small" title="Experience">
                                <i class="bi bi-briefcase-fill text-primary"></i> {{ $doc->experience_years ?? 0 }} Yrs
                            </div>
                            <div class="text-muted small" title="Fee">
                                <i class="bi bi-cash-coin text-success"></i> ৳{{ $doc->consultation_fee ?? 0 }}
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('/appointment') }}?doctor={{ $doc->id }}" class="btn btn-primary rounded-pill px-4 w-100 fw-bold">Book Now</a>
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
                <img src="{{ !empty($whyChoose['image']) ? asset('storage/' . $whyChoose['image']) : 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=800&q=80' }}"
                     alt="Laboratory" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover; max-height:440px;">
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <div class="section-header mb-4">
                    <span class="label">{{ $whyChoose['label'] ?? 'Why Choose Us' }}</span>
                    <h2>{{ $whyChoose['title'] ?? 'The MediDiag Difference' }}</h2>
                    <p class="mt-2">{{ $whyChoose['description'] ?? '' }}</p>
                </div>

                @if(!empty($whyChoose['features']) && is_array($whyChoose['features']))
                @foreach($whyChoose['features'] as $f)
                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box bg-{{ $f['color'] ?? 'primary' }} bg-opacity-10 text-{{ $f['color'] ?? 'primary' }} rounded-3 flex-shrink-0" style="width:54px;height:54px;">
                        <i class="bi {{ $f['icon'] ?? 'bi-check-circle' }} fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{!! $f['title'] ?? '' !!}</h5>
                        <p class="text-muted mb-0 small">{{ $f['desc'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
                @endif
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
@php
    $waNumber = \App\Models\Setting::get('site_whatsapp', '8801711000000');
@endphp
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waNumber) }}" class="btn-whatsapp" title="Chat on WhatsApp" target="_blank">
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

@push('styles')
<style>
/* Premium Test Card Styles for Homepage */
.test-card-premium {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 1.25rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
}
.test-card-premium:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    border-color: rgba(var(--bs-primary-rgb), 0.15);
}
.test-card-premium::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--bs-primary), #00b4d8);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.test-card-premium:hover::before {
    opacity: 1;
}

/* Premium Department Card Styles */
.dept-card-premium {
    background: #ffffff;
    border-radius: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.03);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    overflow: hidden;
}
.dept-card-premium:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    border-color: rgba(var(--bs-primary-rgb), 0.2);
}
.dept-card-premium::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: var(--bs-primary);
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.3s ease;
}
.dept-card-premium:hover::before {
    transform: scaleX(1);
}
.dept-icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: rgba(var(--bs-primary-rgb), 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    transition: all 0.3s ease;
}
.dept-card-premium:hover .dept-icon-wrapper {
    background: var(--bs-primary);
    color: #ffffff !important;
}
.dept-card-premium:hover .dept-icon-wrapper i {
    color: #ffffff !important;
}

/* Premium Doctor Card Styles */
.doctor-card-premium {
    background: #ffffff;
    border-radius: 1.25rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.03);
    transition: all 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.doctor-card-premium:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    border-color: rgba(var(--bs-primary-rgb), 0.15);
}
.doc-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 240px;
}
.doc-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    transition: transform 0.5s ease;
}
.doctor-card-premium:hover .doc-img-wrapper img {
    transform: scale(1.05);
}
.doctor-card-premium .doc-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
</style>
@endpush

@endsection
