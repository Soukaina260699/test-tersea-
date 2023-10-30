<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    protected $fillable = ['nom', 'adresse','capitale'];

    public function employes(){
        return $this->hasMany(Employe::class);
    }
}
