<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'description', 'note', 'image_path', 'category_id'];

    public function materialInstances()
    {
        return $this->hasMany(MaterialInstance::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
