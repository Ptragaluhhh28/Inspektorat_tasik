<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First convert existing ENUM values to integers
        DB::statement("UPDATE berita SET status = CASE 
            WHEN status = 'published' THEN 1 
            WHEN status = 'draft' THEN 0 
            ELSE 0 
        END WHERE status IN ('published', 'draft')");
        
        // Then change column type to tinyInteger
        Schema::table('berita', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert back to ENUM
        Schema::table('berita', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published'])->default('draft')->change();
        });
        
        // Update values back to ENUM
        DB::statement("UPDATE berita SET status = CASE 
            WHEN status = 1 THEN 'published' 
            WHEN status = 0 THEN 'draft' 
            ELSE 'draft' 
        END");
    }
};
