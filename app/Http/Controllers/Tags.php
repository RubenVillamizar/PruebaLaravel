<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tags extends Controller
{
    protected $etiquetas;
    public function __construct(Etiqueta $Etiqueta)
    {
        $this->etiquetas = $etiquetas;
    }
    
        public function index()
        {
            $etiquetas = $this->etiqueta->obtenerEtiquetas();
            return response()->json($etiqueta, 200);
        }
    
        public function show($id)
        {
        $etiqueta = $this->etiquetas->personaDetalle($id);
        if ($etiqueta != ""){
         $data =  $etiqueta;
        }
        else {
            $data = ['error' =>'no existe'];
        }
        return response()->json(['success' => true, 'data' => $data], 200);
        }
    

}
