<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image_path'];

    public function children()
    {
        // recursive nested categories
        return $this->hasMany(Category::class, 'parent_category_id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
}
