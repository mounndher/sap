<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settingsLdap extends Model
{
    use HasFactory;
    protected $table = 'settings_ldaps';
    protected $fillable = [
        'LDAP_HOST',
        'LDAP_CONNECTION',
        'LDAP_PORT',
        'LDAP_BASE_DN',
        'LDAP_USERNAME',
        'LDAP_PASSWORD',
        'LDAP_USE_SSL',
        'LDAP_USE_TLS',
        'LDAP_TIMEOUT',
        'LDAP_LOGGING'
    ];
}
