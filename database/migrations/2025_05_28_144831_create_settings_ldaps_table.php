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
        Schema::create('settings_ldaps', function (Blueprint $table) {
            $table->id();
            $table->string('LDAP_CONNECTION');
            $table->string('LDAP_HOST');
            $table->integer('LDAP_PORT');
            $table->text('LDAP_BASE_DN');
            $table->text('LDAP_USERNAME');
            $table->text('LDAP_PASSWORD');
            $table->boolean('LDAP_USE_SSL');
            $table->boolean('LDAP_USE_TLS');
            $table->integer('LDAP_TIMEOUT');
            $table->boolean('LDAP_LOGGING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_ldaps');
    }
};
