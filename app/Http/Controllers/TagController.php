<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    protected $etiquetas;
    public function __construct(Tag $tags)
    {
        $this->tags = $etiquetas;
    }
    
        public function index()
        {
            $etiquetas = $this->tags->obtenerEtiquetas();
            return response()->json($etiqueta, 200);
        }
    
       /* public function show($id)
        {
        $etiqueta = $this->tag->personaDetalle($id);
        if ($etiqueta != ""){
         $data =  $etiqueta;
        }
        else {
            $data = ['error' =>'no existe'];
        }
        return response()->json(['success' => true, 'data' => $data], 200);
        }
        */
    

}
