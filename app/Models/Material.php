<?php

namespace App\Models;

use App\Services\NestedService;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'description', 'note', 'image_path', 'category_id'];

    /** 
     * ===================
     *      RELATIONSHIPS
     * ===================
     */

    public function materialInstances()
    {
        return $this->hasMany(MaterialInstance::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /** 
     * ===================
     *      FILTERS
     * ===================
     */

    public function scopeFilterByCategoriesId($query, $categoriesId)
    {
        // flaten categories
        $category = Category::select('id', 'name')
            ->whereIn('id', $categoriesId)
            ->with('children')
            ->get();
        $flat = NestedService::flatten($category->toArray());

        // create array with distinct categories (id only)
        $categoriesDistinctId = [];
        foreach ($flat as $item) {
            $categoriesDistinctId[$item['id']] = $item['id'];
        }

        // apply filter
        return $query->whereIn('category_id', $categoriesDistinctId);
    }

    public function scopeSortBy($query, $fieldName, $isDesc)
    {
        $orderDesc = $isDesc ? 'DESC' : 'ASC';

        $query->orderBy($fieldName, $orderDesc);

        return $query;
    }
}
