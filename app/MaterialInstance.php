<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialInstance extends Model
{
    protected $fillable = ['name', 'reference', 'note'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
