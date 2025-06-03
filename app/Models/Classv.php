<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Comptabilité;
class Classv extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'name',
        'status',
        'type_article_id',
    ];

    public function typeArticle()
    {
        return $this->belongsTo(TypeArticle::class);
    }
     public function comptabilites()
    {
        return $this->hasMany(Comptabilité::class, 'classe_valoris_id');
    }
}
