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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location');
            $table->enum('status', ['upcoming', 'past']); // 'upcoming' للمؤتمرات القادمة و 'past' للمؤتمرات السابقة
            $table->longText('image')->nullable(); // صورة صغيرة
            $table->longText('first_announcement_pdf')->nullable(); // رابط الإعلان الأول بصيغة PDF
            $table->longText('second_announcement_pdf')->nullable(); // رابط الإعلان الثاني بصيغة PDF
            $table->longText('conference_brochure_pdf')->nullable(); // رابط كتيب المؤتمر بصيغة PDF
            $table->longText('conference_scientific_program_pdf')->nullable(); // رابط البرنامج العلمي للمؤتمر بصيغة PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
