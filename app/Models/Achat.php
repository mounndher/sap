<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    public function article()
{
    return $this->belongsTo(Article::class);
}

    protected $fillable = ['BSTME', 'article_id', 'from', 'groupe_acheteurs_id', 'to'];
    protected $table = 'achats'; // Specify the table name if it differs from the default
}
