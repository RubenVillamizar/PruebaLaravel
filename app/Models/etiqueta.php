<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
   
    public function obtenerEtiquetas()
    {
        return Etiqueta::all(['id','nombre']); 
    }

    public function personaDetalle($id)
    {
        return Etiqueta::find($id);
    }
}
