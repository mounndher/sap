<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LdapRecord\Models\ActiveDirectory\Group as BaseGroup;
class Group extends Model
{
    use HasFactory;
}
