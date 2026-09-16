<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Test;
use App\Models\Invoice;
use App\Models\DiagnosticOrder;
use App\Models\Appointment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Dummy Doctors
        $doc1 = Doctor::create([
            'doctor_id' => 'DR-0001',
            'name' => 'Dr. Abul Hasan',
            'mobile' => '01711122233',
            'email' => 'abul@example.com',
            'specialization' => 'Medicine',
            'qualification' => 'MBBS, FCPS (Medicine)',
            'consultation_fee' => 1000,
            'status' => true,
        ]);
        
        $doc2 = Doctor::create([
            'doctor_id' => 'DR-0002',
            'name' => 'Dr. Sadia Islam',
            'mobile' => '01822233344',
            'email' => 'sadia@example.com',
            'specialization' => 'Gynaecology',
            'qualification' => 'MBBS, DGO, MCPS',
            'consultation_fee' => 1200,
            'status' => true,
        ]);

        // Dummy Patients
        $pat1 = Patient::create([
            'patient_id' => 'PT-' . date('ymd') . '-0001',
            'name' => 'Rahim Uddin',
            'mobile' => '01511112222',
            'age' => 45,
            'gender' => 'male',
            'blood_group' => 'O+',
            'address' => 'Mirpur, Dhaka',
        ]);
        
        $pat2 = Patient::create([
            'patient_id' => 'PT-' . date('ymd') . '-0002',
            'name' => 'Fatema Begum',
            'mobile' => '01622223333',
            'age' => 32,
            'gender' => 'female',
            'blood_group' => 'A+',
            'address' => 'Dhanmondi, Dhaka',
        ]);

        // Dummy Departments & Categories
        $dept = \App\Models\Department::create([
            'name' => 'Pathology',
            'description' => 'Pathology Department',
            'status' => true,
        ]);
        
        $cat = \App\Models\TestCategory::create([
            'name' => 'Hematology',
            'department_id' => $dept->id,
            'status' => true,
        ]);

        // Dummy Master Tests
        $test1 = Test::create([
            'test_code' => 'CBC-01',
            'name' => 'Complete Blood Count (CBC)',
            'department_id' => $dept->id,
            'test_category_id' => $cat->id,
            'price' => 500,
            'cost' => 200,
            'status' => true,
        ]);
        
        $test2 = Test::create([
            'test_code' => 'RBS-01',
            'name' => 'Random Blood Sugar (RBS)',
            'department_id' => $dept->id,
            'test_category_id' => $cat->id,
            'price' => 150,
            'cost' => 50,
            'status' => true,
        ]);

        // Dummy Appointment
        Appointment::create([
            'appointment_id' => 'APT-260916-0001',
            'patient_id' => $pat1->id,
            'doctor_id' => $doc1->id,
            'date' => date('Y-m-d'),
            'time' => '10:00:00',
            'status' => 'Pending',
        ]);

        // Dummy Lab Order
        DiagnosticOrder::create([
            'order_id' => 'ORD-260916-0001',
            'patient_id' => $pat2->id,
            'order_date' => date('Y-m-d'),
            'total_amount' => 650,
            'discount' => 50,
            'paid_amount' => 600,
            'due_amount' => 0,
            'payment_status' => 'Paid',
            'order_status' => 'Pending',
        ]);
        
        // Dummy Invoice
        Invoice::create([
            'invoice_no' => 'INV-260916-0001',
            'patient_id' => $pat1->id,
            'date' => date('Y-m-d'),
            'subtotal' => 1000,
            'discount' => 100,
            'total' => 900,
            'paid' => 900,
            'due' => 0,
            'payment_method' => 'Cash',
            'payment_status' => 'Paid',
        ]);
    }
}
