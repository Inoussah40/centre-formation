<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;
use App\Models\Teacher;

class Formation extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'duree',
        'prix',
        'statut',
        'teacher_id',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}