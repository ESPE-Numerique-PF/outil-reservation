<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Services\NestedService;
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

    public function adminView()
    {
        return view('admin.category');
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
        $category = Category::create(
            [
                'image_path' => $path,
                'name' => $request->name,
                'position' => $position,
                'parent_category_id' => $parentId
            ]
        );

        // return new category
        return new CategoryResource($category);
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

        return new CategoryResource($category);
    }

    /**
     * Delete a category and all his children.
     * First delete images associated to each categories
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->recursiveDelete();
    }

    public function move(Request $request)
    {
        // get nested cageories from request and flatten them
        // add a position and parent_id field for each item
        $categories = $request->categories;
        $flatCategories = NestedService::flatten($categories);

        // update parent and position for each category in database
        foreach ($flatCategories as $flatCategory) {
            $category = Category::find($flatCategory['id']);
            $category->position = $flatCategory['position'];
            $category->parent_category_id = $flatCategory['parent_id'];

            $category->save();
        }
    }
}
