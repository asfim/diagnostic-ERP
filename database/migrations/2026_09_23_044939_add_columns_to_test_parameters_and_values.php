<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('test_parameters', function (Blueprint $table) {
            $table->foreignId('test_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('unit')->nullable();
            $table->string('reference_range')->nullable();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('test_result_values', function (Blueprint $table) {
            $table->foreignId('test_result_id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_parameter_id')->constrained()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->string('flag')->nullable(); // High, Low, Normal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_parameters', function (Blueprint $table) {
            $table->dropForeign(['test_id']);
            $table->dropColumn(['test_id', 'name', 'unit', 'reference_range', 'sort_order']);
        });

        Schema::table('test_result_values', function (Blueprint $table) {
            $table->dropForeign(['test_result_id']);
            $table->dropForeign(['test_parameter_id']);
            $table->dropColumn(['test_result_id', 'test_parameter_id', 'value', 'flag']);
        });
    }
};
