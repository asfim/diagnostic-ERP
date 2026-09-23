@extends('layouts.frontend')
@section('title', 'Frequently Asked Questions - MediDiag')
@section('content')
<x-frontend.page-banner title="Frequently Asked Questions" :breadcrumbs="['Home' => url('/'), 'FAQ' => route('frontend.faq')]" />
<section class="section-padding bg-light-soft"><div class="container"><div class="section-header centered" data-aos="fade-up"><span class="label">Got Questions?</span><h2>We Have Answers</h2><p>Find answers to the most common questions about our services, booking process, and test reports.</p></div><div class="row justify-content-center"><div class="col-lg-8" data-aos="fade-up"><div class="accordion accordion-flush bg-white rounded-4 shadow-sm p-4" id="faqAccordion">
@forelse($faqs as $index => $faq)
    <div class="accordion-item border-0 mb-3"><h2 class="accordion-header" id="headingFaq{{ $faq->id }}"><button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} rounded-3 fw-bold bg-light-soft" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapseFaq{{ $faq->id }}">{{ $faq->question }}</button></h2><div id="collapseFaq{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="headingFaq{{ $faq->id }}" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted pt-3 pb-4">{{ $faq->answer }}</div></div></div>
@empty
    <div class="text-center py-5 text-muted"><i class="bi bi-question-circle fs-1 d-block mb-3"></i>No FAQs available yet.</div>
@endforelse
</div></div></div><div class="text-center mt-5" data-aos="fade-up"><p class="text-muted mb-3">Still have questions?</p><a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-4 fw-bold">Contact Support</a></div></div></section>
@endsection
