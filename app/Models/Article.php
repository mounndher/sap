<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public function achat()
{
    return $this->hasOne(Achat::class);
}

    protected $fillable = [
        'MAKTX',
        'MTART',
        'MATKL',
        'MEINS',
        'XCHPF',
        'EKGRP',
    ];
}

