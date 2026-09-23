<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_collection_requests', function (Blueprint $table) {
            $table->string('patient_name')->after('id');
            $table->string('phone', 30);
            $table->date('preferred_date');
            $table->string('preferred_time', 50);
            $table->text('address');
            $table->string('tests_required')->nullable();
            $table->string('status')->default('pending')->index();
        });
    }

    public function down(): void
    {
        Schema::table('home_collection_requests', function (Blueprint $table) {
            $table->dropColumn(['patient_name', 'phone', 'preferred_date', 'preferred_time', 'address', 'tests_required', 'status']);
        });
    }
};
