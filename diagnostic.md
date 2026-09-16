অবশ্যই। নিচে আমি আপনার জন্য আরও **professional, organized এবং AI coding tool-এ দেওয়ার মতো complete project plan** দিলাম। এটা এমনভাবে সাজানো যে আগে architecture/database final হবে, তারপর UI, তারপর module-by-module development হবে।

# 🏥 Clinic & Diagnostic Center Management ERP

## 1. Project Overview

Build a complete, production-ready **Clinic & Diagnostic Center Management ERP** for clinics, diagnostic centers, pathology laboratories and imaging centers.

The system must manage the complete workflow from:

**Patient Registration → Appointment → Consultation → Test Order → Billing → Sample Collection → Laboratory Processing → Result Entry → Verification → Report Approval → PDF/QR Report → Patient Portal**

The application must be scalable, secure, responsive and suitable for commercial deployment.

---

# 2. Technology Stack

### Backend

* Laravel 12+
* PHP 8.3+
* MySQL 8+
* Laravel Queue
* Laravel Notifications
* Laravel Storage

### Frontend

* Blade
* Bootstrap 5.3
* JavaScript
* AJAX / Fetch API
* jQuery where useful
* DataTables
* Chart.js
* SweetAlert2

### Packages

* Spatie Laravel Permission
* Laravel DomPDF
* QR Code package
* Excel export package
* Barcode generation package

Use stable and actively maintained packages.

---

# 3. System Architecture

Use a clean modular architecture.

```text
Authentication
      ↓
Roles & Permissions
      ↓
Branch & Settings
      ↓
Core Modules
      ↓
Clinic
Diagnostic
Radiology
Billing
Operations
Reports
Online Portal
```

Business logic must not be placed directly inside controllers.

Use:

```text
Models
Controllers
Form Requests
Policies
Services
Events
Listeners
Jobs
Notifications
Enums
Traits
Reusable Components
```

---

# 4. User Roles

Create granular role-based permissions.

### Default Roles

1. Super Admin
2. Admin
3. Branch Manager
4. Receptionist
5. Doctor
6. Nurse
7. Lab Technician
8. Pathologist
9. Radiologist
10. Accountant
11. Report Manager
12. Inventory Manager
13. Home Collection Collector

Users must only see the modules and records they are authorized to access.

---

# 5. Permission System

Use Spatie Laravel Permission.

Example permissions:

```text
patient.view
patient.create
patient.edit
patient.delete

appointment.view
appointment.create
appointment.edit
appointment.cancel

consultation.view
consultation.create
consultation.edit

test.view
test.create
test.edit
test.delete

sample.collect
sample.receive
sample.reject

result.view
result.create
result.edit
result.verify

report.view
report.approve
report.publish
report.print
report.download

invoice.view
invoice.create
invoice.edit

payment.create
payment.refund

expense.view
expense.create

commission.view
commission.pay

settings.manage
users.manage
roles.manage
```

---

# 6. Multi-Branch Architecture

The system must be multi-branch ready.

Create:

```text
branches
```

Each relevant transaction should support:

```text
branch_id
```

Super Admin:

```text
All Branches
```

Branch Manager:

```text
Own Branch
```

Branch-specific users:

```text
Only authorized branch data
```

---

# 7. Dashboard

Create a modern medical ERP dashboard.

### Statistics

```text
Today's Patients
Today's Appointments
Today's Consultations
Today's Tests
Pending Samples
Pending Results
Pending Reports
Today's Collection
Today's Due
Monthly Revenue
```

### Charts

```text
Patient Registration
Daily Revenue
Test Sales
Doctor-wise Patients
Department-wise Tests
Pending vs Completed Reports
```

### Quick Actions

```text
+ New Patient
+ Appointment
+ OPD Consultation
+ Diagnostic Order
+ Sample Collection
+ Payment
+ Expense
```

---

# 8. Patient Management

## Patient Registration

Fields:

```text
Patient ID
Name
Photo
Gender
Date of Birth
Age
Blood Group
Mobile
Alternative Mobile
Email
NID / Passport
Guardian Name
Guardian Mobile
Address
Emergency Contact
Notes
```

Auto-generated patient number:

```text
P-2026-000001
```

## Patient Profile

Create a professional patient profile with tabs:

```text
Overview
Appointments
Visits
Prescriptions
Diagnostic Orders
Lab Reports
Radiology Reports
Invoices
Payments
Documents
Timeline
```

Patient timeline example:

```text
Patient Registered
       ↓
Appointment
       ↓
Consultation
       ↓
Prescription
       ↓
Diagnostic Test
       ↓
Sample Collection
       ↓
Result
       ↓
Report
       ↓
Payment
```

---

# 9. Doctor Management

Doctor fields:

```text
Doctor ID
Name
Photo
Specialization
Qualification
BMDC Registration No
Mobile
Email
Address
Consultation Fee
Status
User Account
```

## Doctor Schedule

```text
Day
Start Time
End Time
Break Time
Maximum Patient
Consultation Fee
```

Example:

```text
Saturday
05:00 PM - 09:00 PM
Maximum 30 Patients
```

---

# 10. Appointment Management

Appointment fields:

```text
Appointment ID
Patient
Doctor
Branch
Date
Time
Token
Appointment Type
Consultation Fee
Discount
Paid
Due
Status
Notes
```

Statuses:

```text
Scheduled
Confirmed
Waiting
In Consultation
Completed
Cancelled
No Show
```

## Token System

Example:

```text
Token 01 — Completed
Token 02 — In Consultation
Token 03 — Waiting
Token 04 — Waiting
```

Receptionist can call the next patient.

---

# 11. Clinic / OPD Module

Doctor dashboard:

```text
Today's Appointments
Waiting Patients
Current Patient
Completed Visits
Follow-ups
```

## Consultation

Record:

```text
Chief Complaint
Symptoms
Medical History
Vitals
Clinical Notes
Diagnosis
Advice
Follow-up
```

## Vitals

```text
Blood Pressure
Pulse
Temperature
Weight
Height
BMI
SpO2
Respiratory Rate
```

## Diagnosis

Allow multiple diagnoses.

```text
Diagnosis Name
ICD Code
Notes
```

---

# 12. Prescription Management

Prescription:

```text
Medicine
Dosage
Frequency
Duration
Route
Instruction
Before/After Meal
Notes
```

Example:

```text
Medicine
Paracetamol

Dosage
500mg

Frequency
1+1+1

Duration
5 Days
```

Allow:

```text
Print Prescription
PDF
Patient Portal
```

---

# 13. Diagnostic Department

Create diagnostic departments:

```text
Hematology
Biochemistry
Clinical Pathology
Microbiology
Immunology
Serology
Hormone
Histopathology
```

---

# 14. Test Management

Test fields:

```text
Test Code
Test Name
Department
Category
Specimen Type
Container
Price
Cost
Turnaround Time
Status
```

Example:

```text
CBC
Code: LAB-CBC
Price: 500
Specimen: Blood
```

---

# 15. Test Parameter Management

Each test can have multiple parameters.

Example:

```text
CBC
│
├── Hemoglobin
├── RBC
├── WBC
├── Platelet
├── MCV
├── MCH
├── MCHC
└── ESR
```

Parameter fields:

```text
Parameter Name
Short Name
Unit
Display Order
Result Type
```

Result Types:

```text
Numeric
Text
Positive / Negative
Dropdown
```

---

# 16. Reference Range

Reference ranges must support:

```text
Male
Female
Child
Infant
Age Based
Pregnancy
```

Fields:

```text
Parameter
Gender
Age From
Age To
Minimum
Maximum
Critical Minimum
Critical Maximum
Unit
```

The system automatically determines whether the result is:

```text
LOW
NORMAL
HIGH
CRITICAL
```

---

# 17. Test Packages

Create diagnostic packages.

Example:

### Executive Health Package

```text
CBC
Blood Sugar
Lipid Profile
SGPT
Creatinine
Urine R/E
```

Individual Price:

```text
৳3,500
```

Package Price:

```text
৳2,500
```

When package is selected, all included tests are automatically added to the diagnostic order.

---

# 18. Unified Services

Create a `services` table.

Services may include:

```text
Doctor Consultation
CBC
Blood Sugar
USG
X-Ray
ECG
Echo
Home Sample Collection
Other Services
```

This allows the billing system to manage all chargeable services consistently.

---

# 19. Diagnostic Order

Workflow:

```text
Patient
   ↓
Test / Package Selection
   ↓
Order Creation
   ↓
Invoice
   ↓
Payment
   ↓
Sample Collection
   ↓
Processing
   ↓
Result Entry
   ↓
Verification
   ↓
Report Approval
   ↓
Report Published
```

Diagnostic Order fields:

```text
Order ID
Patient
Doctor
Branch
Order Date
Priority
Subtotal
Discount
Total
Paid
Due
Payment Status
Order Status
```

Statuses:

```text
Pending
Sample Pending
Processing
Result Pending
Verification Pending
Completed
Cancelled
```

---

# 20. Sample Collection & Barcode

Generate unique sample number:

```text
S-2026-000001
```

Fields:

```text
Sample ID
Order ID
Patient
Test
Sample Type
Barcode
Collected By
Collection Date
Collection Time
Received By
Received Time
Status
Rejection Reason
```

Statuses:

```text
Pending
Collected
Received
Processing
Rejected
Completed
```

Allow:

```text
Barcode Generate
Barcode Print
Barcode Scan
Sample Search
```

---

# 21. Laboratory Result Entry

Create a fast technician interface.

```text
Patient Information

Sample Information

Test Information

-------------------------------------
Parameter | Result | Unit | Range
-------------------------------------
Hemoglobin | 13.5 | g/dL | 13-17
WBC        | 8000 | /µL  | 4000-11000
Platelet   | 250  | K/µL | 150-450
-------------------------------------
```

Features:

```text
Auto Flag
Critical Alert
Draft Save
Edit Result
Submit Result
```

---

# 22. Result Verification

Workflow:

```text
Lab Technician
       ↓
Result Submitted
       ↓
Pathologist
       ↓
Verify
       ↓
Approve
       ↓
Publish
```

A technician should not be able to approve their own result when separation-of-duty is enabled.

---

# 23. Pathology Report

Create professional A4 report.

### Header

```text
Logo
Diagnostic Center Name
Address
Phone
Email
```

### Patient Section

```text
Patient Name
Patient ID
Age
Gender
Sample ID
Collection Date
Report Date
```

### Result

```text
Parameter
Result
Unit
Reference Range
Flag
```

### Footer

```text
Pathologist Name
Qualification
BMDC / Registration No
Digital Signature
```

Generate:

```text
PDF
Print
Download
QR Verification
```

---

# 24. Radiology Module

Separate Radiology from Laboratory.

Types:

```text
X-Ray
USG
CT Scan
MRI
Mammography
Echo
```

Radiology order:

```text
Patient
Doctor
Study
Clinical History
Technician
```

Radiologist report:

```text
Findings
Impression
Recommendation
```

Allow image/document attachments.

---

# 25. Report Versioning

Never delete an approved report.

Statuses:

```text
Draft
Result Entered
Verification Pending
Verified
Approval Pending
Approved
Published
Amended
Cancelled
```

If a published report needs correction:

```text
Report #001
Version 1
       ↓
Amended
       ↓
Report #001
Version 2
```

Maintain complete history.

---

# 26. Billing System

Create unified billing.

Invoice types:

```text
Consultation
Diagnostic Test
Test Package
Radiology
Other Service
```

Example:

```text
Consultation       ৳800
CBC                ৳500
Blood Sugar         ৳200
USG                 ৳800
-------------------------
Subtotal          ৳2300
Discount            ৳300
-------------------------
Total              ৳2000
Paid               ৳1000
Due                ৳1000
```

Payment methods:

```text
Cash
Card
bKash
Nagad
Rocket
Bank
Online Payment
```

---

# 27. Payment & Refund

Support partial payment.

Maintain:

```text
Payment History
Due History
Refund History
```

Financial transactions must never be silently deleted.

Refund:

```text
Refund Amount
Reason
Approved By
Date
Payment Method
```

---

# 28. Doctor Commission

Support:

```text
Consultation Commission
Diagnostic Commission
Fixed Commission
Percentage Commission
```

Example:

```text
Consultation = ৳1000
Commission = 30%

Doctor Commission = ৳300
```

Statuses:

```text
Pending
Approved
Paid
```

Create doctor commission statement.

---

# 29. Expense Management

Categories:

```text
Rent
Electricity
Internet
Staff Salary
Equipment
Maintenance
Marketing
Office Expense
Other
```

Fields:

```text
Expense No
Category
Amount
Date
Payment Method
Description
Attachment
Created By
Branch
```

---

# 30. Diagnostic Inventory

Manage:

```text
Reagents
Test Tubes
Syringes
Gloves
Masks
Chemical
Cotton
Printer Paper
Other Consumables
```

Features:

```text
Purchase
Stock In
Stock Out
Adjustment
Low Stock Alert
Expiry Alert
Supplier
```

---

# 31. Home Sample Collection

Patient can request home collection.

Workflow:

```text
Request
 ↓
Admin Confirmation
 ↓
Collector Assignment
 ↓
Sample Collection
 ↓
Laboratory
 ↓
Result
 ↓
Report
```

Fields:

```text
Patient
Address
Mobile
Date
Time
Collector
Collection Charge
Status
```

---

# 32. Staff Management

Staff:

```text
Receptionist
Lab Technician
Nurse
Accountant
Manager
Collector
Other
```

Features:

```text
Employee Profile
Attendance
Leave
Salary
Advance
Salary Payment
```

---

# 33. Patient Portal

Patient login.

Dashboard:

```text
Upcoming Appointment
Recent Reports
Due Amount
Recent Prescriptions
```

Patient can view:

```text
Profile
Appointments
Consultations
Prescriptions
Diagnostic Orders
Lab Reports
Radiology Reports
Invoices
Payments
```

Patient can download reports.

---

# 34. Online Appointment

Public website:

```text
Doctors
Departments
Services
Diagnostic Tests
Packages
Appointment Booking
```

Patient submits:

```text
Name
Mobile
Doctor
Date
Time
```

Admin confirms appointment.

---

# 35. Online Diagnostic Booking

Allow:

```text
Test Selection
Package Selection
Preferred Date
Home Collection
Address
```

Online booking should generate a pending order/request that staff can confirm.

---

# 36. Notification System

Prepare provider-independent notification architecture.

Events:

```text
Appointment Confirmation
Appointment Reminder
Payment Confirmation
Sample Collected
Report Ready
Due Reminder
```

Keep SMS/WhatsApp providers configurable.

---

# 37. Reports

Create:

### Patient Reports

```text
Patient Registration
Patient History
Daily Patients
Doctor-wise Patients
```

### Diagnostic Reports

```text
Test Sales
Department Sales
Package Sales
Pending Reports
Completed Reports
Cancelled Tests
Sample Collection
```

### Financial Reports

```text
Daily Collection
Monthly Collection
Due Report
Payment Report
Refund Report
Expense Report
Doctor Commission
Profit/Loss Summary
```

Filters:

```text
Date From
Date To
Branch
Doctor
Department
Test
Payment Status
```

Export:

```text
PDF
Excel
CSV
Print
```

---

# 38. Audit Log

Track sensitive activities:

```text
Patient Edited
Invoice Created
Payment Received
Refund Created
Result Edited
Result Verified
Report Approved
Report Amended
Permission Changed
User Login
```

Audit fields:

```text
User
Action
Module
Record ID
Old Value
New Value
IP Address
Timestamp
```

---

# 39. Security

Implement:

```text
CSRF Protection
XSS Protection
Authorization
Form Validation
Rate Limiting
Secure File Upload
Private Medical Documents
Role Permissions
Audit Logs
Database Transactions
```

Medical documents must use private storage.

Do not expose patient files through public direct URLs.

---

# 40. Database Architecture

Core:

```text
users
branches
settings
roles
permissions
model_has_roles
model_has_permissions
audit_logs
```

Patient:

```text
patients
patient_documents
```

Doctor:

```text
doctors
doctor_schedules
doctor_commissions
```

Clinic:

```text
appointments
appointment_status_histories
visits
vitals
diagnoses
prescriptions
prescription_items
follow_ups
```

Diagnostic:

```text
departments
test_categories
tests
test_parameters
test_parameter_ranges
test_packages
test_package_items
services
```

Orders:

```text
diagnostic_orders
diagnostic_order_items
```

Samples:

```text
samples
sample_status_histories
```

Results:

```text
test_results
test_result_values
```

Reports:

```text
reports
report_versions
report_approvals
```

Radiology:

```text
radiology_orders
radiology_reports
radiology_attachments
```

Billing:

```text
invoices
invoice_items
payments
refunds
```

Operations:

```text
expense_categories
expenses
suppliers
inventory_categories
inventory_items
inventory_transactions
purchases
purchase_items
```

HR:

```text
staff
staff_attendance
salary_payments
```

Online:

```text
home_collection_requests
online_appointments
online_test_bookings
```

---

# 41. Important Database Relationships

```text
Patient
 ├── Appointments
 ├── Visits
 ├── Prescriptions
 ├── Diagnostic Orders
 ├── Reports
 └── Invoices

Doctor
 ├── Schedules
 ├── Appointments
 ├── Visits
 └── Commissions

Diagnostic Order
 ├── Order Items
 ├── Samples
 └── Billing Reference

Test
 ├── Parameters
 └── Packages

Test Parameter
 └── Reference Ranges

Sample
 └── Result

Test Result
 └── Result Values

Report
 ├── Approvals
 └── Versions

Invoice
 ├── Invoice Items
 ├── Payments
 └── Refunds
```

---

# 42. UI / UX Design

Create a premium medical ERP interface.

## Admin Layout

```text
┌──────────────────────────────────────────┐
│ Logo       Search      Notification User │
├───────────┬──────────────────────────────┤
│           │                              │
│ Dashboard │       Main Content           │
│ Patients  │                              │
│ Clinic    │                              │
│ Diagnostic│                              │
│ Radiology │                              │
│ Billing   │                              │
│ Reports   │                              │
│ Settings  │                              │
│           │                              │
└───────────┴──────────────────────────────┘
```

Use:

```text
Clean Cards
Modern Tables
Status Badges
Tabs
Modal Forms
Offcanvas
Charts
DataTables
Responsive Forms
```

---

# 43. Role-Based Dashboard

Do not show the same dashboard to every user.

### Receptionist

```text
Patients
Appointments
Token Queue
Diagnostic Orders
Billing
Payments
```

### Doctor

```text
Appointments
Waiting Patients
Consultation
Prescription
Patient History
```

### Lab Technician

```text
Pending Samples
Received Samples
Result Entry
Pending Results
```

### Pathologist

```text
Verification Queue
Pending Reports
Approved Reports
```

### Accountant

```text
Collection
Due
Expenses
Refund
Commission
Financial Reports
```

---

# 44. Diagnostic Reception UI

Create a fast POS-style screen.

```text
Patient Search
       ↓
Select Test / Package
       ↓
Current Order
       ↓
Discount
       ↓
Payment
       ↓
Print Invoice
       ↓
Print Barcode
```

Example:

```text
CBC                 ৳500
Blood Sugar         ৳200
Lipid Profile       ৳800

Subtotal           ৳1500
Discount             ৳100
Total              ৳1400
Paid               ৳1000
Due                 ৳400
```

---

# 45. Laboratory UI

Lab Technician:

```text
Pending Samples
      ↓
Scan Barcode
      ↓
Patient
      ↓
Test
      ↓
Result Entry
      ↓
Submit
```

Keep this interface extremely simple and keyboard-friendly.

---

# 46. Report Verification

Each approved report receives a unique public UUID.

QR Code:

```text
Scan QR
   ↓
Report Verification Page
   ↓
Report ID
Patient
Test
Report Date
Status
```

Do not expose unnecessary patient information publicly.

---

# 47. Route Structure

```text
/dashboard

/patients
/patients/create
/patients/{patient}

/doctors
/doctors/create
/doctors/{doctor}
/doctors/schedules

/appointments
/appointments/calendar
/appointments/token

/clinic/consultations
/clinic/consultations/{visit}

/diagnostic/tests
/diagnostic/categories
/diagnostic/parameters
/diagnostic/packages
/diagnostic/orders
/diagnostic/samples
/diagnostic/results

/radiology/orders
/radiology/reports

/billing/invoices
/billing/payments
/billing/refunds
/billing/due

/commissions

/home-collection

/inventory

/expenses

/staff

/reports

/users
/roles
/permissions

/settings

/report/verify/{uuid}
```

All routes must be protected by authentication and permissions.

---

# 48. Development Phases

## Phase 1 — Foundation

```text
Laravel Setup
MySQL
Authentication
Spatie Permission
Branch
Settings
Admin Layout
Audit Log
```

## Phase 2 — Patient & Doctor

```text
Patient
Doctor
Doctor Schedule
Appointment
Token
```

## Phase 3 — Clinic

```text
Consultation
Vitals
Diagnosis
Prescription
Follow-up
```

## Phase 4 — Diagnostic Master

```text
Departments
Categories
Tests
Parameters
Reference Ranges
Packages
Services
```

## Phase 5 — Diagnostic Workflow

```text
Diagnostic Order
Sample
Barcode
Result Entry
Verification
Report
QR Verification
```

## Phase 6 — Radiology

```text
X-Ray
USG
CT
MRI
Echo
Radiology Reports
Attachments
```

## Phase 7 — Billing

```text
Invoices
Payments
Due
Refund
Doctor Commission
```

## Phase 8 — Operations

```text
Expenses
Inventory
Suppliers
Purchases
Staff
Attendance
Salary
```

## Phase 9 — Online System

```text
Online Appointment
Online Test Booking
Home Collection
Patient Portal
Notifications
```

## Phase 10 — Reports & Security

```text
Advanced Reports
Export
Audit
Security
Performance
Testing
Backup
```

---

# 49. Testing Strategy

Use Pest/PHPUnit.

Test:

```text
Patient Registration
Appointment Creation
Token Generation
Consultation
Prescription
Diagnostic Order
Package Calculation
Invoice Calculation
Discount
Partial Payment
Due Calculation
Refund
Sample Workflow
Result Flagging
Critical Value
Report Approval
Commission Calculation
Permissions
Branch Isolation
```

---

# 50. Critical Business Rules

### Patient

Patient ID must be unique.

### Appointment

Same doctor + same time slot must not create conflicting appointments.

### Token

Token must be unique for doctor/date/branch.

### Invoice

Invoice totals must be calculated server-side.

### Payment

Payment cannot exceed allowed outstanding amount unless overpayment handling is explicitly implemented.

### Refund

Refund cannot exceed refundable amount.

### Result

Approved results cannot be directly edited.

### Report

Published reports cannot be deleted.

### Amendment

Corrections create a new report version.

### Branch

Branch users cannot access unauthorized branch records.

### Permission

Every sensitive action must check authorization.

---

# 51. Seed Demo Data

Create realistic demo data:

```text
1 Admin
1 Branch
5 Doctors
50 Patients
20 Tests
100 Parameters
5 Packages
30 Appointments
30 Diagnostic Orders
Samples
Results
Reports
Invoices
Payments
Expenses
```

Create demo credentials through seeders.

---

# 52. Final Quality Requirements

The final ERP must be:

* Production Ready
* Responsive
* Secure
* Fast
* Scalable
* Multi-branch Ready
* Role-based
* Audit-friendly
* Medical-record safe
* Financially accurate
* Commercially usable

Do not build it as a simple CRUD project.

Every module must contain:

```text
Migration
Model
Relationships
Form Request
Policy
Service
Controller
Routes
Blade Views
Validation
Permissions
Seeder
Reports
```

Where applicable.

---

# 53. Development Rule

DO NOT start by generating hundreds of files randomly.

First complete:

### Step 1

Database ERD

### Step 2

Complete table/column specification

### Step 3

Relationship map

### Step 4

Permission matrix

### Step 5

Module dependency map

### Step 6

Route map

### Step 7

UI page map

### Step 8

Laravel migrations

### Step 9

Models & relationships

### Step 10

Module-by-module implementation

After every phase:

```text
Migration Test
Database Test
Feature Test
Permission Test
UI Test
Workflow Test
```

Only after one phase is stable should the next phase begin.

---

# 54. Final Core Workflow

## Clinic

```text
Patient Registration
        ↓
Appointment
        ↓
Token
        ↓
Doctor Consultation
        ↓
Diagnosis
        ↓
Prescription
        ↓
Test Recommendation
        ↓
Diagnostic Order
```

## Diagnostic

```text
Diagnostic Order
        ↓
Invoice
        ↓
Payment
        ↓
Sample Collection
        ↓
Barcode
        ↓
Lab Processing
        ↓
Result Entry
        ↓
Pathologist Verification
        ↓
Report Approval
        ↓
PDF + QR
        ↓
Patient Portal
```

## Radiology

```text
Order
 ↓
Patient Preparation
 ↓
Imaging
 ↓
Technician
 ↓
Radiologist
 ↓
Findings
 ↓
Impression
 ↓
Approval
 ↓
PDF Report
```

## Home Collection

```text
Online Request
 ↓
Confirmation
 ↓
Collector Assignment
 ↓
Sample Collection
 ↓
Laboratory
 ↓
Result
 ↓
Report
```

The completed application should provide a seamless connection between **Clinic, Diagnostic Laboratory, Radiology, Patient, Doctor, Billing and Management** while maintaining strict permission control, medical data security, financial accuracy and a professional healthcare user experience.
