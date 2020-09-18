<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    const IMAGE_PATH = 'images/category';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Get all categories and there subcategories in nested style
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('parent_category_id')
            ->orderBy('position')
            ->with('children')
            ->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parentId = $request->parent_category_id;

        // store image (if exist)
        if (isset($request->image))
            $path = $request->image->store(self::IMAGE_PATH);
        else
            $path = null;

        // get new position for the category
        $position = Category::getNextPosition($parentId);

        // store new category
        return Category::create(
            [
                'image_path' => $path,
                'name' => $request->name,
                'position' => $position,
                'parent_category_id' => $request->parentId
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     * Update only image and name.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        // change image only if image has changed (and delte old image)
        $imageHasChanged = $request->boolean('imageHasChanged') ?? false;
        if ($imageHasChanged && ($category->image_path != self::NO_IMAGE_PATH)) {
            Storage::delete($category->image_path);
            if (isset($request->image)) {
                $category->image_path = $request->image->store(self::IMAGE_PATH);
            }
        }

        $category->name = $request->name;

        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $imageToDeletePath = $category->image_path;

        // add offset position to siblings (only with superior position)
        $parent = $category->parent;
        $siblings = $category->siblings($category->position + 1);
        $offset = $category->children->count() - 1;
        foreach ($siblings as $sibling) {
            $sibling->position += $offset;
            $sibling->save();
        }

        // if current category has children, give these children the parent of the current category
        // (if the current category has no parent, his children will have no parent)
        $childPosition = 0;
        foreach ($category->children as $child) {
            $child->position = $childPosition + $category->position;
            $child->parent()->associate($parent);
            $child->save();
            $childPosition++;
        }

        // delete category then image
        Category::destroy($id);
        Storage::delete($imageToDeletePath);
    }

    public function move(Request $request)
    {
        $position[] = [];
        $nullPosition = 0;
        // array_walk_recursive($request, function($category, $position) {
        //     if (!isset($category->parent_category_id))
        //         self::debug($category);
        // });
    }
}
