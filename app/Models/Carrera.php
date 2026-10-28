<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    //
}


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrera extends Model
{
    protected $fillable = ['nombre', 'codigo', 'facultad', 'duracion_semestres'];

    // Relación: Una carrera tiene muchos estudiantes
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class);
    }
}
