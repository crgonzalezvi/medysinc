<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

     // Relación con el modelo Doctor
     public function doctors()
     {
         return $this->hasMany(Doctor::class, 'specialties_id');
     }
     protected $fillable = ['specialtyId', 'name'];

}
