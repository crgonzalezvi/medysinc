<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

     // Relación con User (un rol puede tener muchos usuarios)
     public function users()
     {
         return $this->hasMany(User::class, 'role_id'); // Relación de uno a muchos
     }
}
