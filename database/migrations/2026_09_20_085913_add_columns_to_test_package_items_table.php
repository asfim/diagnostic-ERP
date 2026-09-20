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
        Schema::table('test_package_items', function (Blueprint $table) {
            $table->foreignId('test_package_id')->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_id')->after('test_package_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_package_items', function (Blueprint $table) {
            $table->dropForeign(['test_package_id']);
            $table->dropForeign(['test_id']);
            $table->dropColumn(['test_package_id', 'test_id']);
        });
    }
};
