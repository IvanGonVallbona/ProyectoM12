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
        Schema::create('classe_campanya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campanya_id')->constrained('campanyes')->onDelete('cascade');
            
            /*
            Primer crea la columna classe_id com a unsignedBigInteger per a permnetre que puguir se null
            i després afegeix la clau forana, si ni es null les dades han de coincidir
            amb la id de classes.
            */
            $table->unsignedBigInteger('classe_id')->nullable();
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_campanya');
    }
};
