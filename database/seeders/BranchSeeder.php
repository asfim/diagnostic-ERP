<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        if (Branch::count() === 0) {
            Branch::create([
                'name' => 'Dhaka Main Center',
                'address' => '123 Health Avenue, Dhanmondi, Dhaka 1205',
                'phone' => '+880 2 1234 5678',
                'email' => 'dhaka@medidiag.com',
                'badge' => 'Headquarters',
                'opening_hours' => 'Open 24/7',
                'map_link' => 'https://maps.google.com',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80',
                'status' => true,
                'is_upcoming' => false,
                'sort_order' => 1,
            ]);

            Branch::create([
                'name' => 'Chattogram Branch',
                'address' => '45 GEC Circle, CDA Avenue, Chattogram',
                'phone' => '+880 31 9876 5432',
                'email' => 'ctg@medidiag.com',
                'badge' => 'Regional Center',
                'opening_hours' => '8:00 AM - 10:00 PM',
                'map_link' => 'https://maps.google.com',
                'image' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=600&q=80',
                'status' => true,
                'is_upcoming' => false,
                'sort_order' => 2,
            ]);

            Branch::create([
                'name' => 'Sylhet Branch',
                'address' => '78 Zindabazar, Sylhet City Center',
                'phone' => '+880 821 5555 6666',
                'email' => 'sylhet@medidiag.com',
                'badge' => 'New Center',
                'opening_hours' => '9:00 AM - 9:00 PM',
                'map_link' => 'https://maps.google.com',
                'image' => 'https://images.unsplash.com/photo-1538108149393-fbbd81895907?auto=format&fit=crop&w=600&q=80',
                'status' => true,
                'is_upcoming' => false,
                'sort_order' => 3,
            ]);

            Branch::create([
                'name' => 'Rajshahi Branch',
                'address' => 'Greater Road, Rajshahi',
                'phone' => '+880 721 1122 3344',
                'email' => 'rajshahi@medidiag.com',
                'badge' => 'Coming Soon',
                'opening_hours' => 'Opening Soon',
                'map_link' => null,
                'image' => null,
                'status' => true,
                'is_upcoming' => true,
                'description' => 'Opening soon in early 2027 to serve the northern region!',
                'sort_order' => 4,
            ]);
        }
    }
}
