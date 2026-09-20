@extends('layouts.frontend')
@section('title', 'Frequently Asked Questions - MediDiag')
@section('content')

<x-frontend.page-banner title="Frequently Asked Questions" :breadcrumbs="['Home' => url('/'), 'FAQ' => url('/faq')]" />

<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">Got Questions?</span>
            <h2>We Have Answers</h2>
            <p>Find answers to the most common questions about our services, booking process, and test reports.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                <div class="accordion accordion-flush bg-white rounded-4 shadow-sm p-4" id="faqAccordion">
                    
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button rounded-3 fw-bold bg-light-soft" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How can I book a home sample collection?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted pt-3 pb-4">
                                You can easily book a home sample collection by navigating to the <strong>Services > Home Collection</strong> page. Fill out the request form with your details, address, and preferred time slot. Our team will contact you to confirm the appointment.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed rounded-3 fw-bold bg-light-soft" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                When will I get my test reports?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted pt-3 pb-4">
                                Turnaround times vary depending on the specific test. Routine blood tests like CBC and Lipid profiles are usually delivered on the <strong>same day within 4-6 hours</strong>. Specialized tests may take 24-48 hours. You can check the specific turnaround time for each test on our Pricing page.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item border-0 mb-3">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed rounded-3 fw-bold bg-light-soft" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How can I download my report online?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted pt-3 pb-4">
                                Once your report is ready, you will receive an SMS notification. You can then go to the <strong>Download Report</strong> portal (via the header button), enter your Invoice ID and registered Mobile Number to securely download your PDF report.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed rounded-3 fw-bold bg-light-soft" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Do I need to fast before my blood test?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted pt-3 pb-4">
                                It depends on the test. Tests like Fasting Blood Sugar (FBS) and Lipid Profiles require a <strong>10-12 hour fasting period</strong> where you can only drink water. However, many other tests do not require fasting. We will provide specific instructions when you book your test.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="200">
            <p class="text-muted mb-3">Still have questions?</p>
            <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-4 fw-bold">Contact Support</a>
        </div>
    </div>
</section>

@endsection
