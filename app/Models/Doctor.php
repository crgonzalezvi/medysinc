<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialties_id', 'users_id'
    ];

    // Relación con el modelo Specialty
    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialties_id');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function appointments()
{
    return $this->hasMany(Appointment::class, 'doctor_id');
}
}

