<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    public function obtenerPersonas()
{
    return Persona::all(['id','nombre_completo']);

}

    public function personaDetalle($id)
{
    return Persona::find($id);
}
}
