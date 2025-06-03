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
        Schema::create('comptabilités', function (Blueprint $table) {
          $table->id();
            $table->unsignedBigInteger('classe_valoris_id'); // ✅ même type que classvs.id
            $table->string('code_prix');
            $table->boolean('status')->default(1)->comment('0 = invalide, 1 = valide');
            $table->timestamps();

            // ✅ foreign key définie après la colonne
            $table->foreign('classe_valoris_id')
                  ->references('id')
                  ->on('classvs')
                  ->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptabilités');
    }
};
