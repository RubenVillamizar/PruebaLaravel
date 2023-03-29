<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tags_association;

class Tag extends Model
{
    protected $table = 'TAGS';

    protected $fillable = [
        'nombre',
    ];

    public function tags_associations()
    {
        return $this->hasMany(Tags_association::class, 'ids_tags');
    }

  
}
