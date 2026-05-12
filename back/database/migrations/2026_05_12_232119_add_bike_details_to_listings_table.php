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
        Schema::table('listings', function (Blueprint $table) {
            $table->foreignId('bike_brand_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
            $table->foreignId('bike_model_id')->nullable()->after('bike_brand_id')->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('year')->nullable()->after('condition');
            $table->string('frame_size', 30)->nullable()->after('year');
            $table->string('wheel_size', 30)->nullable()->after('frame_size');
            $table->string('color')->nullable()->after('wheel_size');
            $table->decimal('daily_rate', 10, 2)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('bike_model_id');
            $table->dropConstrainedForeignId('bike_brand_id');
            $table->dropColumn([
                'year',
                'frame_size',
                'wheel_size',
                'color',
                'daily_rate',
            ]);
        });
    }
};
