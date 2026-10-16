<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'specialite',
    ];
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
