<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Psy\debug;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return ResourcesCategory::collection(Category::all());
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if image exists, store it into public image folder
        if (isset($request->image))
            $path = $request->image->store(self::IMAGE_PATH);
        else
            $path = null;

        // store new category
        return Category::create(
            [
                'image_path' => $path,
                'name' => $request->name,
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

        // update name
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
        Storage::delete($category->image_path);
        Category::destroy($id);
    }
}
