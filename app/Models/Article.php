<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;


    protected $fillable = [
        'MAKTX',
        'MTART',
        'MATKL',
        'MEINS',
        'XCHPF',
        'EKGRP',
        'BSTME',
        'BKLAS',
        'VPRSV_1',
        'status',
    ];
  public function typeArticle()
{
    return $this->belongsTo(TypeArticle::class, 'MTART', 'id');
}

  public function groupeArticle()
{
    return $this->belongsTo(GroupeArticle::class, 'MATKL', 'id');
}

public function achat()
{
    return $this->hasOne(Achat::class, 'article_id');
}


public function comptabilite()
{
    return $this->hasOne(Comptabilité::class);
}

}

