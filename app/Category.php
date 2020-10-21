<?php

namespace App;

use App\Http\Controllers\CategoryController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['name', 'image_path', 'position', 'parent_category_id'];

    /**
     * Get children recursively (children will provide also their children...)
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id')->with('children')->orderBy('position');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    /**
     * Get all siblings of the current category (including the category itself)
     * orderd by 'position' field.
     * The parameter $minPos will allow to retrieve only siblings with position >= $minPos.
     */
    public function siblings($minPos = 0)
    {
        if (is_null($this->parent)) {
            return Category::whereNull('parent_category_id')
                ->orderBy('position')
                ->where('position', '>=', $minPos)
                ->get();
        } else {
            return $this->parent->children()
                ->orderBy('position')
                ->where('position', '>=', $minPos)
                ->get();
        }
    }

    /**
     * Return the next position of a set of categories with the same parent.
     * Return by default 0 if the parent has no child.
     */
    public static function getNextPosition($parentId = null)
    {
        $lastPosition = self::select('name', 'position')
            ->where('parent_category_id', $parentId)
            ->max('position');

        if (!isset($lastPosition))
            return 0;
        else
            return $lastPosition + 1;
    }

    /**
     * Delete a category and all his children
     */
    public function recursiveDelete()
    {
        // delete all children
        foreach ($this->children as $child) {
            $child->recursiveDelete();
        }

        // delete current image from storage
        if ($this->image_path != CategoryController::NO_IMAGE_PATH) {
            Storage::delete($this->image_path);
        }
        $this->delete();
    }
}
