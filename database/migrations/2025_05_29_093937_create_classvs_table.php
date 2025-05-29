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
        Schema::create('classvs', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('name'); // add after 'name' column
            $table->boolean('status')->default(1)->comment('0 = inactive, 1 = active');
            // Add foreign key constraint if you want:
            $table->unsignedBigInteger('type_article_id'); // add after 'name' column
            // Add foreign key constraint if you want:
            $table->foreign('type_article_id')
                ->references('id')
                ->on('type_articles')
                ->onDelete('cascade'); // optional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classvs');
    }
};
