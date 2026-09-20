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
        Schema::table('test_packages', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('slug')->unique()->after('name');
            $table->text('description')->nullable()->after('slug');
            $table->decimal('price', 10, 2)->default(0)->after('description');
            $table->decimal('discount_price', 10, 2)->nullable()->after('price');
            $table->string('image')->nullable()->after('discount_price');
            $table->string('status')->default('active')->after('image');
            $table->integer('sort_order')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_packages', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'slug', 'description', 'price', 
                'discount_price', 'image', 'status', 'sort_order'
            ]);
        });
    }
};
