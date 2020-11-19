<?php

namespace App;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class MaterialInstance extends Model
{
    protected $fillable = ['name', 'reference', 'note'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /** 
     * ===================
     *      FILTERS
     * ===================
     */

    public function scopeSortBy($query, $fieldName, $isDesc)
    {
        // TODO filter many field
        
        $query->orderBy($fieldName, ($isDesc ? 'DESC' : 'ASC'));

        return $query;
    }

}
