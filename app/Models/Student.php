<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Student extends Model
{
    protected $fillable = [
    'nom',
    'prenom',
    'email',
    'telephone',
    'date_naissance',
    'adresse',
   ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
