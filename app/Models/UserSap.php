<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSap extends Model
{
    use HasFactory;
    protected $fillable = [
      
        'username',  // Add username since you use it for login

        'password',
    ];
}
