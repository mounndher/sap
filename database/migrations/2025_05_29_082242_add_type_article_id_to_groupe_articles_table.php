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
        Schema::table('groupe_articles', function (Blueprint $table) {
            //
        $table->unsignedBigInteger('type_article_id')->after('name'); // add after 'name' column

        // Add foreign key constraint if you want:
        $table->foreign('type_article_id')
              ->references('id')
              ->on('type_articles')
              ->onDelete('cascade'); // optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groupe_articles', function (Blueprint $table) {
            //
        });
    }
};
