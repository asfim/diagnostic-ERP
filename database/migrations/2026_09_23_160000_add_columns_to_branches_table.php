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
        Schema::table('branches', function (Blueprint $table) {
            $table->string('image')->nullable()->after('email');
            $table->string('badge')->nullable()->after('image');
            $table->string('opening_hours')->nullable()->after('badge');
            $table->string('map_link')->nullable()->after('opening_hours');
            $table->boolean('is_upcoming')->default(false)->after('status');
            $table->text('description')->nullable()->after('is_upcoming');
            $table->integer('sort_order')->default(0)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn([
                'image',
                'badge',
                'opening_hours',
                'map_link',
                'is_upcoming',
                'description',
                'sort_order',
            ]);
        });
    }
};
