Build a complete, production-ready **Clinic & Diagnostic Center Management ERP** using:

* Laravel 12+
* PHP 8.3+
* MySQL 8+
* Bootstrap 5.3
* Blade
* JavaScript
* AJAX / Fetch API
* jQuery where useful
* DataTables
* Chart.js
* SweetAlert2
* Laravel Notifications
* Laravel Storage
* Spatie Laravel Permission

The software must be designed as a professional commercial ERP suitable for Bangladesh-based clinics and diagnostic centers.

Do NOT build a simple CRUD application. Build a complete real-world ERP with proper relationships, workflows, validation, permissions, audit logs, reporting, responsive UI and scalable architecture.

==================================================

1. SYSTEM CONCEPT
   ==================================================

The software will manage:

1. Clinic / OPD
2. Diagnostic Laboratory
3. Pathology
4. Radiology / Imaging
5. Patient Management
6. Doctor Management
7. Appointment & Token
8. Prescription
9. Test Booking
10. Sample Collection
11. Test Result
12. Report Generation
13. Billing & Payments
14. Doctor Commission
15. Expenses
16. Staff Management
17. Inventory for diagnostic consumables
18. SMS / Notification
19. Patient Portal
20. Website Appointment & Test Booking
21. Reports
22. Settings
23. Roles & Permissions
24. Audit Logs

The system should support future multi-branch functionality.

==================================================
2. USER ROLES
=============

Create role-based access control.

Default roles:

Super Admin
Admin
Branch Manager
Receptionist
Doctor
Lab Technician
Pathologist
Radiologist
Accountant
Nurse
Report Manager
Inventory Manager

Permission examples:

patient.view
patient.create
patient.edit
patient.delete

appointment.view
appointment.create
appointment.edit
appointment.cancel

test.view
test.create
test.edit
test.delete

sample.collect
sample.receive
sample.process

result.create
result.edit
result.verify
result.approve

report.view
report.print
report.download
report.approve

invoice.create
invoice.edit
payment.create
refund.create

doctor.commission.view
doctor.commission.pay

expense.create
expense.edit

settings.manage

Every module must have granular permissions.

==================================================
3. DASHBOARD
============

Create a modern professional dashboard.

Top cards:

Today's Patients
Today's Appointments
Today's Tests
Pending Reports
Completed Reports
Today's Collection
Today's Due
Monthly Revenue

Charts:

Daily Patient Statistics
Daily Revenue
Test-wise Sales
Doctor-wise Patients
Pending vs Completed Reports

Quick Actions:

* New Patient
* New Appointment
* New Test Invoice
* Sample Collection
* New Expense
* Doctor Visit

Recent Activities:

Patient registered
Appointment created
Test booked
Sample collected
Result entered
Report approved
Payment received

==================================================
4. PATIENT MANAGEMENT
=====================

Patient registration fields:

Patient ID
Barcode / QR Code
Name
Gender
Date of Birth
Age
Blood Group
Mobile
Alternative Mobile
Email
NID / Passport
Address
Guardian Name
Guardian Mobile
Occupation
Emergency Contact
Photo
Notes

Patient ID must be automatically generated.

Example:

P-2026-000001

Create patient profile page:

Patient Information
Visit History
Appointment History
Prescription History
Diagnostic History
Lab Reports
Radiology Reports
Billing History
Payment History
Doctor History
Documents

Patient timeline:

Registration
Consultation
Test
Result
Report
Payment

Allow printing patient card.

==================================================
5. DOCTOR MANAGEMENT
====================

Doctor fields:

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

Doctor schedule:

Day
Start Time
End Time
Break Time
Maximum Patients

Example:

Saturday
5:00 PM - 9:00 PM
Maximum 30 patients

Doctor commission configuration:

Consultation commission
Test commission
Percentage commission
Fixed commission

==================================================
6. APPOINTMENT SYSTEM
=====================

Appointment fields:

Appointment ID
Patient
Doctor
Date
Time
Token Number
Appointment Type
Consultation Fee
Discount
Payment Status
Status
Notes

Statuses:

Scheduled
Confirmed
Waiting
In Consultation
Completed
Cancelled
No Show

Create calendar view.

Create daily token queue.

Example:

Token 01 - Waiting
Token 02 - In Consultation
Token 03 - Completed

Receptionist can call next patient.

==================================================
7. OPD / CONSULTATION
=====================

Doctor dashboard.

Doctor can see:

Today's appointments
Waiting patients
Completed patients
Patient history

Consultation screen:

Chief Complaint
Symptoms
Vitals
Blood Pressure
Pulse
Temperature
Weight
Height
Oxygen Saturation

Diagnosis
Clinical Notes
Advice
Follow-up Date

Prescription:

Medicine
Dosage
Frequency
Duration
Instruction

Doctor can save prescription and print it.

==================================================
8. DIAGNOSTIC TEST MANAGEMENT
=============================

Create:

Test Categories

Example:

Hematology
Biochemistry
Clinical Pathology
Immunology
Microbiology
Hormone
Serology
Radiology
Ultrasonography
X-Ray
CT Scan
MRI

Test fields:

Test Code
Test Name
Category
Specimen Type
Container
Department
Price
Cost
Turnaround Time
Reference Range
Status

Example:

CBC

Parameters:

Hemoglobin
WBC
RBC
Platelet
ESR
MCV
MCH
MCHC

Each parameter must have:

Parameter Name
Unit
Normal Range
Male Range
Female Range
Child Range
Display Order
Result Type

Result type:

Numeric
Text
Dropdown
Positive/Negative

==================================================
9. TEST PACKAGE
===============

Create test packages.

Example:

Executive Health Package

Contains:

CBC
Blood Sugar
Lipid Profile
SGPT
Creatinine
Urine R/E

Package price:

Individual total = 3500
Package price = 2500

When package is booked, all tests must automatically appear in the patient's diagnostic order.

==================================================
10. TEST BOOKING / ORDER
========================

Create diagnostic order.

Workflow:

Patient
↓
Select Test / Package
↓
Apply Discount
↓
Generate Invoice
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
Report Delivery

Diagnostic order fields:

Order ID
Patient
Doctor
Branch
Order Date
Priority
Discount
Subtotal
Total
Paid
Due
Payment Status
Order Status

Order statuses:

Pending
Sample Pending
Processing
Result Pending
Verification Pending
Completed
Cancelled

==================================================
11. SAMPLE COLLECTION
=====================

Create sample collection module.

Sample ID must be generated.

Example:

S-2026-000001

Fields:

Sample ID
Order ID
Patient
Test
Sample Type
Collection Date
Collection Time
Collected By
Barcode
Status

Statuses:

Pending
Collected
Received
Processing
Rejected
Completed

Sample rejection reason:

Insufficient Sample
Wrong Container
Hemolyzed
Improper Storage
Other

Allow barcode printing.

==================================================
12. LAB RESULT ENTRY
====================

Create professional result-entry interface.

Technician sees:

Patient
Sample
Test
Parameter
Unit
Reference Range

Example:

Hemoglobin | 13.5 | g/dL | 13-17

Allow:

Numeric result
Text result
Positive / Negative
Dropdown

Automatically flag:

LOW
HIGH
NORMAL
CRITICAL

Critical value alert.

Technician submits result.

Then:

Technician Submit
↓
Pathologist Verification
↓
Report Approval

==================================================
13. PATHOLOGY REPORT
====================

Create professional pathology report templates.

Report header:

Clinic / Diagnostic Center Logo
Name
Address
Phone
Email

Patient section:

Patient Name
Patient ID
Age
Gender
Sample ID
Report Date

Test result table:

Parameter
Result
Unit
Reference Range
Flag

Footer:

Pathologist Name
Qualification
Registration Number
Digital Signature

Generate:

Print
PDF
Download

Use A4 professional report layout.

==================================================
14. RADIOLOGY / IMAGING
=======================

Create Radiology module.

Types:

X-Ray
USG
CT Scan
MRI
Mammography
Echo

Radiology order:

Patient
Doctor
Study
Clinical History
Findings
Impression
Technologist
Radiologist

Allow image/document attachment.

Radiologist enters:

Findings
Impression
Advice

Generate radiology report.

==================================================
15. BILLING SYSTEM
==================

Create unified billing system.

Invoice types:

Consultation
Diagnostic Test
Test Package
Radiology
Other Services

Invoice fields:

Invoice No
Patient
Date
Items
Subtotal
Discount
Tax
Total
Paid
Due
Payment Method

Payment methods:

Cash
Card
Mobile Banking
Bank
Online Payment

Auto-generate invoice number.

Example:

INV-2026-000001

Allow:

Print Invoice
PDF
Payment Receipt

==================================================
16. PAYMENT & DUE
=================

Allow partial payments.

Example:

Total = 3000
Paid = 1000
Due = 2000

Later:

Paid = 1000
Remaining = 1000

Keep complete payment history.

Refund system:

Refund amount
Reason
Approved by
Refund date

Never delete financial transactions.

==================================================
17. DOCTOR COMMISSION
=====================

Automatically calculate doctor commission.

Example:

Consultation Fee = 1000
Doctor Commission = 30%

Commission = 300

For diagnostic tests:

CBC = 500
Doctor commission = 10%

Commission = 50

Commission statuses:

Pending
Approved
Paid

Generate doctor commission statement.

==================================================
18. EXPENSE MANAGEMENT
======================

Expense categories:

Rent
Electricity
Internet
Staff Salary
Equipment
Maintenance
Marketing
Office Expense
Other

Expense fields:

Expense No
Category
Amount
Date
Payment Method
Description
Attachment
Created By

==================================================
19. INVENTORY
=============

Inventory is only for clinic/diagnostic requirements.

Items:

Reagents
Test Tubes
Syringes
Gloves
Masks
Cotton
Chemical
Printer Paper
Radiology Consumables

Fields:

Item
Category
Unit
Purchase Price
Stock
Minimum Stock
Supplier
Expiry Date

Features:

Purchase
Stock In
Stock Out
Adjustment
Expiry Alert
Low Stock Alert

==================================================
20. STAFF MANAGEMENT
====================

Staff:

Receptionist
Lab Technician
Nurse
Accountant
Cleaner
Manager
Other

Fields:

Name
Photo
Mobile
Email
Address
Joining Date
Salary
Designation
Status

Attendance:

Present
Absent
Late
Leave

Basic payroll system.

==================================================
21. PATIENT PORTAL
==================

Create patient login.

Patient can see:

Profile
Appointments
Prescriptions
Diagnostic Orders
Lab Reports
Radiology Reports
Invoices
Payments
Due

Patient can download PDF reports.

==================================================
22. ONLINE APPOINTMENT
======================

Public website:

Doctors
Departments
Services
Tests
Packages
Appointment Booking

Patient submits:

Name
Mobile
Doctor
Date
Time

Admin receives booking notification.

Receptionist confirms appointment.

==================================================
23. ONLINE TEST BOOKING
=======================

Patients can select:

Test
Package
Preferred Date
Home Sample Collection

Fields:

Patient Name
Mobile
Address
Test
Date
Time

Order goes to admin.

==================================================
24. HOME SAMPLE COLLECTION
==========================

Create Home Collection module.

Fields:

Patient
Address
Collection Date
Time
Collector
Mobile
Order
Collection Charge
Status

Statuses:

Requested
Assigned
Collected
Completed
Cancelled

==================================================
25. SMS / WHATSAPP NOTIFICATION
===============================

Prepare notification architecture.

Events:

Appointment Confirmation
Appointment Reminder
Sample Collected
Report Ready
Due Reminder
Payment Confirmation

Use provider abstraction so SMS/WhatsApp API can be connected later.

Do not hardcode one provider.

==================================================
26. REPORTS
===========

Create professional reporting module.

Patient Reports
Appointment Reports
Doctor Reports
Diagnostic Sales
Test-wise Sales
Package Sales
Daily Collection
Monthly Collection
Due Report
Refund Report
Expense Report
Doctor Commission
Sample Collection
Pending Reports
Completed Reports
Cancelled Tests
Profit/Loss Summary

Filters:

Date From
Date To
Doctor
Test
Category
Payment Status
Branch

Export:

PDF
Excel
CSV
Print

==================================================
27. DATABASE DESIGN
===================

Use normalized relational database.

Main tables:

users
roles
permissions
model_has_roles
model_has_permissions

patients
patient_documents

doctors
doctor_schedules
doctor_commissions

appointments
appointment_status_histories

visits
vitals
diagnoses

prescriptions
prescription_items

departments

test_categories
tests
test_parameters
test_parameter_ranges
test_packages
test_package_items

diagnostic_orders
diagnostic_order_items

samples
sample_collections
sample_status_histories

test_results
test_result_values

report_templates
reports
report_approvals

radiology_orders
radiology_reports
radiology_attachments

invoices
invoice_items
payments
refunds

expenses
expense_categories

inventory_items
inventory_categories
inventory_transactions
suppliers
purchases
purchase_items

staff
staff_attendance
salary_payments

home_collection_requests

notifications
settings
branches

audit_logs

==================================================
28. IMPORTANT DATABASE RELATIONSHIPS
====================================

Patient:

patients
hasMany appointments
hasMany visits
hasMany diagnostic_orders
hasMany invoices
hasMany payments
hasMany prescriptions

Doctor:

doctors
hasMany appointments
hasMany visits
hasMany doctor_commissions

Diagnostic Order:

diagnostic_orders
belongsTo patient
belongsTo doctor
hasMany diagnostic_order_items
hasMany samples
belongsTo invoice

Test:

tests
belongsTo test_category
hasMany test_parameters

Test Parameter:

test_parameters
belongsTo test
hasMany test_parameter_ranges

Report:

reports
belongsTo diagnostic_order
belongsTo patient
belongsTo approved_by

==================================================
29. AUDIT LOG
=============

Every important action must be logged.

Example:

User
Action
Module
Record ID
Old Value
New Value
IP Address
Timestamp

Track:

Patient edit
Invoice edit
Payment
Refund
Result edit
Report approval
Permission change

Financial and medical records must not be silently deleted.

==================================================
30. SECURITY
============

Implement:

CSRF Protection
XSS Protection
Validation
Authorization
Role Permission
Rate Limiting
Secure File Upload
File Type Validation
Private Patient Documents
Audit Logging

Patient medical documents must not be publicly accessible through direct URLs.

Use Laravel Storage private disk.

==================================================
31. UI / UX DESIGN
==================

Create a premium professional medical ERP dashboard.

Design style:

Clean
Modern
Minimal
Professional
Medical
Responsive

Desktop:

Sidebar
Top Navbar
Main Content

Mobile:

Responsive sidebar
Mobile-friendly tables
Mobile-friendly forms

Use:

Bootstrap 5.3
Cards
Tabs
Modals
Offcanvas
DataTables
Badges
Alerts
Progress indicators

Color usage should feel like a modern healthcare application, not a generic admin template.

==================================================
32. SIDEBAR STRUCTURE
=====================

Dashboard

Patient Management

* All Patients
* Add Patient
* Patient History

Appointments

* Calendar
* Today's Appointments
* Token Queue

Clinic

* OPD
* Visits
* Prescriptions

Diagnostic

* Test Categories
* Tests
* Test Parameters
* Test Packages
* Diagnostic Orders
* Sample Collection
* Result Entry
* Pending Reports
* Completed Reports

Radiology

* Orders
* Reports

Billing

* Invoices
* Payments
* Due
* Refunds

Doctor Commission

Home Collection

Inventory

Expenses

Staff & HR

Reports

Users & Roles

Settings

==================================================
33. PATIENT PROFILE UI
======================

Create a professional patient profile.

Header:

Patient Photo
Patient Name
Patient ID
Age
Gender
Mobile
Blood Group

Tabs:

Overview
Appointments
Visits
Prescriptions
Diagnostic Tests
Reports
Invoices
Payments
Documents

Add timeline on Overview.

==================================================
34. DIAGNOSTIC ORDER UI
=======================

Design a fast reception-friendly interface.

Left:

Patient Search

Middle:

Available Tests / Packages

Right:

Current Order

Example:

CBC                 500
Blood Sugar         200
Lipid Profile       800

Subtotal             1500
Discount              100
Total                1400
Paid                 1000
Due                   400

Buttons:

Save Order
Receive Payment
Print Invoice
Print Sample Label

==================================================
35. RESULT ENTRY UI
===================

Create table-based result entry.

Patient information at top.

Test information.

Then:

Parameter | Result | Unit | Reference | Flag

Allow keyboard-friendly navigation.

Auto-save draft.

Submit Result button.

Technician cannot approve own report if approval separation is enabled.

==================================================
36. REPORT DESIGN
=================

A4 report.

Header:

Logo
Diagnostic Center Name
Address
Contact

Patient information.

Report title.

Result table.

Doctor / Pathologist information.

QR Code containing report verification URL.

Footer:

"This report is electronically generated."

Add report verification page:

/report/verify/{report_uuid}

Patient or doctor can scan QR and verify report authenticity.

==================================================
37. SETTINGS
============

General Settings:

Company Name
Logo
Favicon
Address
Phone
Email
Website

Invoice Settings

Report Settings

Patient ID Prefix

Invoice Prefix

Sample Prefix

Date Format

Currency

Timezone

Notification Settings

SMS API Settings

WhatsApp API Settings

Payment Gateway Settings

==================================================
38. BANGLADESH READY
====================

Default currency:

BDT / ৳

Date format:

DD-MM-YYYY

Timezone:

Asia/Dhaka

Payment methods should support:

Cash
bKash
Nagad
Rocket
Card
Bank

Keep payment gateway architecture configurable.

==================================================
39. MULTI-BRANCH READY
======================

Even if multi-branch is initially disabled, database architecture must support it.

branches table.

Relevant records should contain:

branch_id

Admin can select branch.

Branch users should only see authorized branch data.

Super Admin can see all branches.

==================================================
40. SOFTWARE WORKFLOW
=====================

CLINIC:

Patient
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
↓
Payment
↓
Sample Collection
↓
Result
↓
Report

DIAGNOSTIC:

Patient
↓
Test Selection
↓
Invoice
↓
Payment
↓
Sample Collection
↓
Lab Processing
↓
Result Entry
↓
Pathologist Verification
↓
Report Approval
↓
PDF Report
↓
Patient Download

HOME COLLECTION:

Online Request
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

==================================================
41. DEVELOPMENT ARCHITECTURE
============================

Use clean Laravel architecture.

Use:

Models
Controllers
Form Requests
Policies
Services
Repositories where useful
Events
Listeners
Notifications
Jobs
Enums
Traits

Business logic must not be placed entirely inside controllers.

Create services such as:

PatientService
AppointmentService
DiagnosticOrderService
SampleService
ResultService
ReportService
BillingService
PaymentService
CommissionService
InventoryService

==================================================
42. DATABASE RULES
==================

Use:

Primary Keys
Foreign Keys
Indexes
Unique Constraints
Soft Deletes where appropriate
Transactions for financial operations

Never physically delete:

Invoices
Payments
Refunds
Medical reports
Approved results

Use status fields instead.

Use UUID where useful for public report verification.

==================================================
43. SEEDERS
===========

Create demo data.

Roles
Permissions
Departments
Doctors
Patients
Tests
Test Parameters
Packages
Appointments
Diagnostic Orders
Invoices

Create realistic demo data for testing.

==================================================
44. INSTALLATION
================

Create installation-ready project.

Include:

.env.example
Database migration
Seeders
Storage setup
Admin account setup

Provide installation instructions.

==================================================
45. FINAL REQUIREMENT
=====================

The final application must feel like a real commercial Clinic & Diagnostic ERP, not a student project.

Prioritize:

1. Correct database relationships
2. Real-world workflow
3. Fast reception operation
4. Accurate billing
5. Secure medical records
6. Professional diagnostic reports
7. Role-based access
8. Audit trail
9. Responsive UI
10. Scalable architecture

Before coding:

First create:

A. Complete database ERD
B. Database table list
C. Relationship explanation
D. Module dependency map
E. User workflow
F. UI page list
G. Route structure
H. Permission matrix

Then implement the software module by module.

For every module provide:

Migration
Model
Relationship
Form Request
Policy
Service
Controller
Routes
Blade Views
JavaScript/AJAX
Validation
Permission
Seeder
Report/Print functionality where applicable.

Do not skip database design.

Do not create duplicate tables for the same concept.

Use reusable components and layouts.

Create:

resources/views/layouts/admin.blade.php
resources/views/layouts/auth.blade.php
resources/views/components/
resources/views/admin/

Keep:

header
sidebar
footer
breadcrumb
modal
alert
form
table
pagination

as reusable components.

The final UI must be clean, responsive, fast and suitable for commercial deployment.
