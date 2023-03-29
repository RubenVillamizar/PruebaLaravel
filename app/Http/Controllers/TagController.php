<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Tags_association;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    protected $tags_association;
    protected $tags;

    public function __construct(Tags_association $tags_association, Tag $tags)
    {
        $this->tags_association = $tags_association;
        $this->tags = $tags;
    }

    public function indexNivelUno()
    {
        $etiquetas_nivel_1 = Tag::join('tags_associations', 'tags.id', '=', 'tags_associations.ids_tags')
            ->select('tags.id', 'tags.nombre')
            ->distinct()
            ->get();
        return response()->json($etiquetas_nivel_1);
    }

    // Obtiene las etiquetas por niveles

    public function indexIdAssociation($id, $currentLevel, $previousLevels = null)
    { 
        $nextLevel = $currentLevel + 1;
        $max_levels = Tags_association::selectRaw('MAX(LENGTH(ids_tags) - LENGTH(REPLACE(ids_tags, ",", ""))) + 1 as max_levels')->first()->max_levels;
        $tags_by_level = [];

        $previousTagIds = [];
        if (!is_null($previousLevels)) {
            $previousTagIds = explode(',', $previousLevels);
        }
    
    if ($nextLevel > $max_levels) {
        $response = [
            'next_level' => 'fin',
        ];
    
        } else {
            $tags = Tag::whereIn('id', function ($query) use ($nextLevel, $id, $previousTagIds) {
                $query->select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(ids_tags, ',', $nextLevel), ',', -1) as tag_id"))
                    ->from('tags_associations')
                    ->where(function ($query) use ($id) {
                        $query->where('ids_tags', 'LIKE', "$id,%")
                            ->orWhere('ids_tags', 'LIKE', "%,$id,%")
                            ->orWhere('ids_tags', 'LIKE', "%,$id");
                    })
                    ->where(function ($query) use ($nextLevel) {
                        $query->whereRaw("LENGTH(ids_tags) - LENGTH(REPLACE(ids_tags, ',', '')) + 1 = $nextLevel");
                    });
                // Agregar IDs de niveles anteriores
                foreach ($previousTagIds as $tagId) {
                    $query->orWhere('ids_tags', 'LIKE', "%,$tagId,%")
                        ->orWhere('ids_tags', 'LIKE', "$tagId,%")
                        ->orWhere('ids_tags', 'LIKE', "%,$tagId");
                }
            })
            ->select('id', 'nombre')
            ->distinct()
            ->get();
            // Agregar tags por nivel
            $tags_by_level = $tags; 
    
            // Actualizar respuesta
            $response = [
                'tags_by_level'=>$tags_by_level,
                'next_level' => $nextLevel,
            ];
        }
    
        return response()->json($response);
       
    }
} 
