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
        Schema::create('esdeveniments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->string('descripcio');
            $table->date('data');
            $table->string('tipus');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esdeveniments');
    }
};
