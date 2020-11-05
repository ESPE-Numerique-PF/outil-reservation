<?php

namespace App;

use App\Http\Controllers\Controller;
use App\Services\NestedService;
use App\Utilities\Filters\FilterBuilder;
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
        // TODO refactor for multiple filters
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

    public function scopeSortBy($query, $fieldName = "name", $isDesc = false)
    {
        if ($fieldName === "name") {
            $query->orderBy('name', ($isDesc ? 'DESC' : 'ASC'));
        }
        else {
            // TODO order by category name
            $query->orderBy('category_id', ($isDesc ? 'DESC' : 'ASC'))
            ->orderBy('name', ($isDesc ? 'DESC' : 'ASC'));
        }

        return $query;
    }
}
