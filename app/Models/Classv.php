<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
