<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

App\Models\TestResultValue::query()->delete();
App\Models\TestParameter::query()->delete();
App\Models\TestParameter::insert([
    ['test_id' => 1, 'name' => 'Hemoglobin (Hb)', 'unit' => 'g/dL', 'reference_range' => 'Male: 13.8-17.2, Female: 12.1-15.1', 'sort_order' => 1],
    ['test_id' => 1, 'name' => 'Total RBC count', 'unit' => 'millions/cumm', 'reference_range' => '4.5 - 5.5', 'sort_order' => 2],
    ['test_id' => 1, 'name' => 'Total WBC count', 'unit' => 'cells/cumm', 'reference_range' => '4000 - 11000', 'sort_order' => 3],
    ['test_id' => 1, 'name' => 'Platelet count', 'unit' => 'lakhs/cumm', 'reference_range' => '1.5 - 4.5', 'sort_order' => 4],
    ['test_id' => 1, 'name' => 'Neutrophils', 'unit' => '%', 'reference_range' => '40 - 75', 'sort_order' => 5],
    ['test_id' => 1, 'name' => 'Lymphocytes', 'unit' => '%', 'reference_range' => '20 - 45', 'sort_order' => 6],
    ['test_id' => 1, 'name' => 'Monocytes', 'unit' => '%', 'reference_range' => '2 - 10', 'sort_order' => 7],
    ['test_id' => 1, 'name' => 'Eosinophils', 'unit' => '%', 'reference_range' => '1 - 6', 'sort_order' => 8],
    ['test_id' => 2, 'name' => 'Blood Glucose (Random)', 'unit' => 'mg/dL', 'reference_range' => '< 140', 'sort_order' => 1]
]);
echo "Seeded successfully.\n";
