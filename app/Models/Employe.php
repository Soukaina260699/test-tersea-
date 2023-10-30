<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employe extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name', 'address','email','password', 'phone', 'birth_date', 'verified', 'societe_id',
    ];

    public function societe(){
        return $this->belongsTo(Societe::class);
    }
}
