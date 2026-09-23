@extends('layouts.frontend')
@section('title', 'Pricing - MediDiag')
@section('content')
<x-frontend.page-banner title="Test Pricing & Packages" :breadcrumbs="['Services' => '#', 'Pricing' => route('frontend.pricing')]" />
<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">{{ $content['label'] }}</span>
            <h2>{{ $content['title'] }}</h2>
            <p>{{ $content['description'] }}</p>
        </div>

        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-8">
                <div class="card card-soft border-0 shadow-sm p-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                        <input id="pricingTestSearch" type="search" class="form-control border-0" placeholder="Search for a test name or code..." autocomplete="off" style="box-shadow:none;">
                        <button id="clearPricingSearch" type="button" class="btn btn-light border-0 d-none" title="Clear search"><i class="bi bi-x-lg"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold mb-0">Popular Tests</h4>
                        <small id="pricingTestCount" class="text-muted">{{ $tests->count() }} tests</small>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light"><tr><th class="ps-4">Test Name</th><th>Code</th><th>Report Time</th><th class="text-end pe-4">Price (৳)</th></tr></thead>
                                <tbody id="pricingTestRows">
                                    @forelse($tests as $test)
                                        <tr data-search="{{ strtolower($test->name . ' ' . $test->test_code) }}">
                                            <td class="ps-4 fw-semibold">{{ $test->name }}</td>
                                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $test->test_code }}</span></td>
                                            <td><span class="text-success small"><i class="bi bi-clock me-1"></i>{{ $test->turnaround_time ? $test->turnaround_time . ' Hours' : 'Same Day' }}</span></td>
                                            <td class="text-end pe-4 fw-bold text-primary">{{ number_format($test->price, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center py-5 text-muted">No active tests available.</td></tr>
                                    @endforelse
                                    <tr id="pricingNoResults" class="d-none"><td colspan="4" class="text-center py-5 text-muted"><i class="bi bi-search fs-3 d-block mb-2"></i>No matching tests found.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top p-3 text-center"><a href="{{ url('/tests') }}" class="btn btn-link text-decoration-none fw-bold">View All Tests <i class="bi bi-arrow-right"></i></a></div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 text-center bg-primary text-white position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background:radial-gradient(circle,transparent 20%,var(--primary-dark) 20%,var(--primary-dark) 80%,transparent 80%,transparent) 0% 0% / 20px 20px;"></div>
                    <div class="card-body p-5 position-relative z-index-1 d-flex flex-column justify-content-center">
                        <div class="mb-4"><i class="bi {{ $content['promo_icon'] }} display-1"></i></div>
                        <h3 class="fw-bold mb-3">{{ $content['promo_title'] }}</h3>
                        <p class="mb-4 text-white-50">{{ $content['promo_description'] }}</p>
                        <a href="{{ $content['promo_button_link'] }}" class="btn btn-light btn-lg rounded-pill fw-bold text-primary w-100">{{ $content['promo_button_text'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const pricingSearch = document.getElementById('pricingTestSearch');
    const clearPricingSearch = document.getElementById('clearPricingSearch');
    const pricingRows = [...document.querySelectorAll('#pricingTestRows tr[data-search]')];
    const pricingNoResults = document.getElementById('pricingNoResults');
    const pricingTestCount = document.getElementById('pricingTestCount');

    function filterPricingTests() {
        const query = pricingSearch.value.trim().toLowerCase();
        let visible = 0;
        pricingRows.forEach((row) => {
            const matches = !query || row.dataset.search.includes(query);
            row.classList.toggle('d-none', !matches);
            if (matches) visible += 1;
        });
        pricingNoResults.classList.toggle('d-none', visible !== 0);
        pricingTestCount.textContent = `${visible} ${visible === 1 ? 'test' : 'tests'}`;
        clearPricingSearch.classList.toggle('d-none', !query);
    }

    pricingSearch.addEventListener('input', filterPricingTests);
    clearPricingSearch.addEventListener('click', () => {
        pricingSearch.value = '';
        pricingSearch.focus();
        filterPricingTests();
    });
</script>
@endpush
