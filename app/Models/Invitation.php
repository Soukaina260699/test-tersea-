<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'name','token', 'is_accepted', 'societe_id'];

    public function societe(){
        return $this->belongsTo(Societe::class, 'societe_id');
    }
}
