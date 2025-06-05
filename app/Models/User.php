<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap; // trait to authenticate with LDAP
use LdapRecord\Laravel\Auth\LdapAuthenticatable;    // interface for LDAP auth
use LdapRecord\Laravel\Auth\HasLdapUser;            // trait to access LDAP user info

class User extends Authenticatable implements LdapAuthenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use AuthenticatesWithLdap, HasLdapUser;  // Add LDAP traits here

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       // 'name',
        'username',  // Add username since you use it for login
        //'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
