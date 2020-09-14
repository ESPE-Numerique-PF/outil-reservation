<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image_path'];

    public function children()
    {
        return $this->hasMany('App/Category', 'parent_category_id');
    }
}
