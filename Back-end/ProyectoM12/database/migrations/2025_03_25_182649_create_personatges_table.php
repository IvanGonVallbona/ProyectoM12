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
        Schema::create('personatges', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->integer('nivell');
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('raza_id')->constrained('razas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('campanya_id')->nullable()->constrained('campanyes')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personatges');
    }
};
