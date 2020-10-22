<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'description', 'note', 'image_path'];

    public function materialInstances()
    {
        return $this->hasMany(MaterialInstance::class);
    }
}
