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
        Schema::table('departments', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
            $table->string('icon')->nullable()->after('description');
            $table->string('image')->nullable()->after('icon');
        });

        // Populate slugs for existing departments
        $departments = \Illuminate\Support\Facades\DB::table('departments')->get();
        foreach ($departments as $dept) {
            \Illuminate\Support\Facades\DB::table('departments')
                ->where('id', $dept->id)
                ->update(['slug' => \Illuminate\Support\Str::slug($dept->name)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn(['slug', 'icon', 'image']);
        });
    }
};
