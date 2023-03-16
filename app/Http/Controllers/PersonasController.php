<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonasController extends Controller
{
protected $personas;
public function __construct(Persona $personas)
{
    $this->personas = $personas;
}
    //

    public function index()
    {
        $persona = $this->personas->obtenerPersonas();
        
        return json_code($persona);
    }

    public function show($id)
{
    $persona = $this->personas->personaDetalle($id);
    if ($persona != ""){
     $data =  $persona;
    }
    else {
        $data = ['error' =>'no existe'];
    }
    return response()->json(['success' => true, 'data' => $data], 200);
}

}