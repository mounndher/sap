<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comptabilité extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'article_id', 'classe_valoris_id', 'code_prix', 'status'];

}
