<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeAcheteur extends Model
{
    use HasFactory;
    public function achat()
{
    return $this->hasOne(Achat::class, 'groupe_acheteurs_id');
}

}
