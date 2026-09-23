@extends('layouts.frontend')
@section('title', 'Book Appointment - MediDiag')
@section('content')

<x-frontend.page-banner title="Book Appointment" :breadcrumbs="['Appointment' => url('/appointment')]" />

<section class="section-padding">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">

                {{-- Step Indicator --}}
                <div class="d-flex justify-content-center mb-5">
                    @foreach(['Department & Doctor', 'Date & Time', 'Patient Info', 'Confirm'] as $i => $step)
                    <div class="d-flex align-items-center">
                        <div class="step-indicator {{ $i === 0 ? 'active' : '' }}" id="stepDot{{ $i+1 }}">
                            <div class="step-num">{{ $i+1 }}</div>
                            <div class="step-label">{{ $step }}</div>
                        </div>
                        @if($i < 3)
                        <div class="step-line"></div>
                        @endif
                    </div>
                    @endforeach
                </div>

                <form action="{{ url('/appointment') }}" method="POST" id="appointmentForm">
                    @csrf

                    {{-- Step 1: Department & Doctor --}}
                    <div class="step-content" id="step1">
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                            <h4 class="fw-bold mb-4">
                                <span class="badge bg-primary rounded-pill me-2">1</span>
                                Select Department & Doctor
                            </h4>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                                <select name="department_id" id="departmentSelect" class="form-select rounded-pill border-primary" required>
                                    <option value="">— Choose Department —</option>
                                    @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ (isset($selectedTest) && $selectedTest->department_id == $dept->id) ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if(isset($selectedTest))
                                <div class="mt-2 text-success small fw-semibold">
                                    <i class="bi bi-check-circle me-1"></i> Department auto-selected for: {{ $selectedTest->name }}
                                </div>
                                <input type="hidden" name="notes" value="Booking for Test: {{ $selectedTest->name }} ({{ $selectedTest->test_code }})">
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Service Type <span class="text-danger">*</span></label>
                                <div class="row g-3">
                                    @foreach(['consultation' => ['icon'=>'bi-person-check','label'=>'Consultation'], 'followup' => ['icon'=>'bi-arrow-repeat','label'=>'Follow Up'], 'diagnostic' => ['icon'=>'bi-clipboard2-pulse','label'=>'Diagnostic']] as $val => $opt)
                                    <div class="col-md-4">
                                        <input type="radio" class="btn-check" name="appointment_type" id="type_{{ $val }}" value="{{ $val }}" 
                                            {{ (isset($selectedTest) && $val == 'diagnostic') ? 'checked' : (!isset($selectedTest) && $loop->first ? 'checked' : '') }}>
                                        <label class="btn btn-outline-primary w-100 rounded-3 py-3 d-flex flex-column align-items-center gap-2" for="type_{{ $val }}">
                                            <i class="bi {{ $opt['icon'] }} fs-3"></i>
                                            <span class="fw-semibold">{{ $opt['label'] }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-4" id="doctorSelectionDiv">
                                <label class="form-label fw-semibold">Doctor <span class="text-danger">*</span></label>
                                <select name="doctor_id" id="doctorSelect" class="form-select rounded-pill border-primary" required>
                                    <option value="">— Select Department First —</option>
                                    @foreach($doctors as $doc)
                                    <option value="{{ $doc->id }}"
                                            data-fee="{{ $doc->consultation_fee }}"
                                            data-dept="{{ $doc->department_id }}">
                                        {{ $doc->name }} — {{ $doc->specialization }}
                                        @if($doc->consultation_fee) (৳ {{ number_format($doc->consultation_fee) }}) @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4" id="testSelectionDiv" style="display: none;">
                                <label class="form-label fw-semibold">Diagnostic Test <span class="text-danger">*</span></label>
                                <select name="test_id" id="testSelect" class="form-select rounded-pill border-primary">
                                    <option value="">— Select Department First —</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-primary rounded-pill px-5 py-2 fw-bold next-step" data-next="2">
                                Next: Select Date &amp; Time <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Step 2: Date & Time --}}
                    <div class="step-content d-none" id="step2">
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                            <h4 class="fw-bold mb-4">
                                <span class="badge bg-primary rounded-pill me-2">2</span>
                                Select Date &amp; Time
                            </h4>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Preferred Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control rounded-pill border-primary"
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Preferred Time <span class="text-danger">*</span></label>
                                    <select name="time" class="form-select rounded-pill border-primary" required>
                                        <option value="">Select time…</option>
                                        @foreach(['09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','02:00 PM','02:30 PM','03:00 PM','03:30 PM','04:00 PM','04:30 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM','09:00 PM'] as $slot)
                                        <option value="{{ $slot }}">{{ $slot }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mt-4">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 prev-step" data-prev="1">
                                    <i class="bi bi-arrow-left me-2"></i>Back
                                </button>
                                <button type="button" class="btn btn-primary rounded-pill px-5 py-2 fw-bold next-step" data-next="3">
                                    Next: Patient Info <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Step 3: Patient Info --}}
                    <div class="step-content d-none" id="step3">
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                            <h4 class="fw-bold mb-4">
                                <span class="badge bg-primary rounded-pill me-2">3</span>
                                Patient Information
                            </h4>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="patient_name" class="form-control rounded-pill border-primary"
                                           placeholder="Patient's full name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Mobile <span class="text-danger">*</span></label>
                                    <input type="tel" name="mobile" class="form-control rounded-pill border-primary"
                                           placeholder="+880 1xxx xxxxxx" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control rounded-pill"
                                           placeholder="patient@email.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Gender</label>
                                    <select name="gender" class="form-select rounded-pill">
                                        <option value="">Select…</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control rounded-pill">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text" name="address" class="form-control rounded-pill" placeholder="Your address">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Notes / Chief Complaint</label>
                                    <textarea name="notes" class="form-control rounded-4" rows="3"
                                              placeholder="Describe your symptoms or notes for the doctor…"></textarea>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mt-4">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 prev-step" data-prev="2">
                                    <i class="bi bi-arrow-left me-2"></i>Back
                                </button>
                                <button type="button" class="btn btn-primary rounded-pill px-5 py-2 fw-bold next-step" data-next="4">
                                    Review Appointment <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Step 4: Confirm --}}
                    <div class="step-content d-none" id="step4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                            <h4 class="fw-bold mb-4">
                                <span class="badge bg-primary rounded-pill me-2">4</span>
                                Confirm Appointment
                            </h4>

                            <div id="summaryBox" class="bg-light-soft rounded-4 p-4 mb-4">
                                <p class="text-muted text-center small">Fill in previous steps to see your appointment summary.</p>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                <label class="form-check-label text-muted small" for="agreeTerms">
                                    I agree to the <a href="#" class="text-primary">Terms & Conditions</a> and confirm the information provided is correct.
                                </label>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 prev-step" data-prev="3">
                                    <i class="bi bi-arrow-left me-2"></i>Back
                                </button>
                                <button type="submit" class="btn btn-secondary btn-lg rounded-pill px-5 fw-bold">
                                    <i class="bi bi-calendar-check me-2"></i>Confirm Appointment
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Step Indicator */
.step-indicator { text-align: center; }
.step-num {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    font-weight: 800;
    font-size: 1rem;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto .4rem;
    transition: all .3s;
}
.step-indicator.active .step-num,
.step-indicator.done .step-num {
    background: var(--primary); color: #fff;
}
.step-indicator.done .step-num::before { content: '✓'; }
.step-label { font-size: .72rem; font-weight: 600; color: #6c757d; white-space: nowrap; }
.step-indicator.active .step-label { color: var(--primary); }
.step-line { width: 60px; height: 2px; background: #dee2e6; margin: 0 .5rem; margin-bottom: 1.8rem; transition: background .3s; }
.step-line.done { background: var(--primary); }
</style>
@endpush

@push('scripts')
<script>
// Multi-step form
const nextBtns = document.querySelectorAll('.next-step');
const prevBtns = document.querySelectorAll('.prev-step');

function showStep(num) {
    document.querySelectorAll('.step-content').forEach(el => el.classList.add('d-none'));
    document.getElementById('step' + num).classList.remove('d-none');

    document.querySelectorAll('.step-indicator').forEach((dot, i) => {
        dot.classList.remove('active', 'done');
        if (i + 1 < num) dot.classList.add('done');
        if (i + 1 === num) dot.classList.add('active');
    });
    document.querySelectorAll('.step-line').forEach((line, i) => {
        line.classList.toggle('done', i + 1 < num);
    });
    window.scrollTo({ top: 300, behavior: 'smooth' });
}

nextBtns.forEach(btn => btn.addEventListener('click', function() {
    const nextStepNum = parseInt(this.dataset.next);
    const currentStepNum = nextStepNum - 1;
    const currentStepEl = document.getElementById('step' + currentStepNum);
    
    // Validate current step fields
    const invalidInputs = currentStepEl.querySelectorAll(':invalid');
    if (invalidInputs.length > 0) {
        invalidInputs[0].reportValidity();
        return;
    }

    showStep(nextStepNum);

    // Populate Summary on Step 4
    if (nextStepNum === 4) {
        const deptText = document.getElementById('departmentSelect').options[document.getElementById('departmentSelect').selectedIndex].text;
        const doctorText = document.getElementById('doctorSelect').value ? document.getElementById('doctorSelect').options[document.getElementById('doctorSelect').selectedIndex].text.split('—')[0] : 'None (Diagnostic)';
        const date = document.querySelector('input[name="date"]').value;
        const time = document.querySelector('select[name="time"]').value;
        const patient = document.querySelector('input[name="patient_name"]').value;
        const mobile = document.querySelector('input[name="mobile"]').value;
        const sType = document.querySelector('input[name="appointment_type"]:checked').value;
        const testText = document.getElementById('testSelect').value ? document.getElementById('testSelect').options[document.getElementById('testSelect').selectedIndex].text : '';
        
        document.getElementById('summaryBox').innerHTML = `
            <div class="row g-3">
                <div class="col-6"><small class="text-muted d-block">Department</small><strong>${deptText}</strong></div>
                <div class="col-6"><small class="text-muted d-block">Doctor</small><strong>${doctorText}</strong></div>
                <div class="col-6"><small class="text-muted d-block">Service Type</small><strong class="text-capitalize">${sType}</strong></div>
                ${sType === 'diagnostic' && testText ? `<div class="col-6"><small class="text-muted d-block">Test</small><strong>${testText}</strong></div>` : ''}
                <div class="col-6"><small class="text-muted d-block">Date & Time</small><strong>${date} at ${time}</strong></div>
                <div class="col-6"><small class="text-muted d-block">Patient</small><strong>${patient}</strong></div>
                <div class="col-6"><small class="text-muted d-block">Contact</small><strong>${mobile}</strong></div>
            </div>
        `;
    }
}));
prevBtns.forEach(btn => btn.addEventListener('click', () => showStep(parseInt(btn.dataset.prev))));

// Department → Doctor & Test filter
document.getElementById('departmentSelect').addEventListener('change', function() {
    const deptId = this.value;
    const docSelect = document.getElementById('doctorSelect');
    const testSelect = document.getElementById('testSelect');
    
    docSelect.innerHTML = '<option value="">Loading…</option>';
    testSelect.innerHTML = '<option value="">Loading…</option>';

    if (!deptId) {
        docSelect.innerHTML = '<option value="">— Select Department First —</option>';
        testSelect.innerHTML = '<option value="">— Select Department First —</option>';
        return;
    }

    // Fetch Doctors
    fetch('/api/doctors-by-department?department_id=' + deptId)
        .then(r => r.json())
        .then(docs => {
            docSelect.innerHTML = '<option value="">— Select Doctor —</option>';
            docs.forEach(d => {
                docSelect.innerHTML += `<option value="${d.id}" data-fee="${d.consultation_fee}">${d.name} — ${d.specialization} (৳ ${Number(d.consultation_fee||0).toLocaleString()})</option>`;
            });
        });

    // Fetch Tests
    fetch('/api/tests-by-department?department_id=' + deptId)
        .then(r => r.json())
        .then(tests => {
            testSelect.innerHTML = '<option value="">— Select Test —</option>';
            tests.forEach(t => {
                testSelect.innerHTML += `<option value="${t.id}">${t.name} (৳ ${Number(t.price||0).toLocaleString()})</option>`;
            });
        });
});

// Toggle Doctor/Test visibility based on Service Type
function toggleDoctorVisibility() {
    const isDiagnostic = document.querySelector('input[name="appointment_type"]:checked').value === 'diagnostic';
    const doctorDiv = document.getElementById('doctorSelectionDiv');
    const doctorSelect = document.getElementById('doctorSelect');
    const testDiv = document.getElementById('testSelectionDiv');
    const testSelect = document.getElementById('testSelect');
    
    if (isDiagnostic) {
        // Show Test, Hide Doctor
        doctorDiv.style.display = 'none';
        doctorSelect.removeAttribute('required');
        doctorSelect.value = ''; 
        
        testDiv.style.display = 'block';
        testSelect.setAttribute('required', 'required');
    } else {
        // Show Doctor, Hide Test
        doctorDiv.style.display = 'block';
        doctorSelect.setAttribute('required', 'required');
        
        testDiv.style.display = 'none';
        testSelect.removeAttribute('required');
        testSelect.value = '';
    }
}

document.querySelectorAll('input[name="appointment_type"]').forEach(radio => {
    radio.addEventListener('change', toggleDoctorVisibility);
});

// Run once on load
toggleDoctorVisibility();

@if(isset($selectedTest))
    // Auto-trigger department change if pre-selected
    document.addEventListener('DOMContentLoaded', function() {
        const deptSelect = document.getElementById('departmentSelect');
        if (deptSelect.value) {
            deptSelect.dispatchEvent(new Event('change'));
        }
    });
@endif
</script>
@endpush

@endsection
