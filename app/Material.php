<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'description', 'note'];
    

    public function materialInstances()
    {
        return $this->hasMany(MaterialInstance::class);
    }
}
