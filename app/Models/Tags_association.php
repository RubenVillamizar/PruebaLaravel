<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Tags_association extends Model
{
    protected $table = 'TAGS_ASSOCIATIONS';

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'ids_tags');
    }

    public function tags_associations()
    {
        return $this->hasMany(Tags_association::class, 'ids_tags_associations');
    }
}
