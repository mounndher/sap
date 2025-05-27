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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->char('MTART', 4)->comment("type d'article");
            $table->char('MATKL', 9)->comment("Groupe d'articles");
            $table->char('MEINS', 20)->comment("Unité de quantité de base");
            $table->char('XCHPF', 1)->comment('gestion de lot ');
            $table->char('MAKTX', 40)->comment('Designation');
            $table->char('EKGRP', 3)->comment('Groupe dacheteurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
