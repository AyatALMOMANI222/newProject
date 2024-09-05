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
        Schema::create('conference_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_id') 
            ->constrained('conferences')  
            ->onDelete('cascade');        
        $table->string('price_type');      // نوع السعر (مثل "مشارك"، "متحدث"، "طالب")
        $table->decimal('price', 8, 2); 
        $table->text('description')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_prices');
    }
};
