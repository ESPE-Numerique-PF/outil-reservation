<?php

namespace App\Http\Controllers;

use App\Http\Resources\Material as ResourcesMaterial;
use App\Http\Resources\MaterialResource;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{

    const IMAGE_PATH = 'images/material';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }
    
    public function view()
    {
        return view('material');
    }

    public function adminView()
    {
        return view('admin.material');
    }

    /**
     * Get all materials with instances
     */
    public function index()
    {
        return MaterialResource::collection(
            Material::orderBy('category_id')
            ->orderBy('name')
            ->get()
        );
    }

    public function show($id)
    {
        return new MaterialResource(Material::find($id));
    }

    public function store(Request $request)
    {
        // store image (if exist)
        if (isset($request->image))
            $path = $request->image->store(self::IMAGE_PATH);
        else
            $path = null;

        // store new material
        $material = Material::create([
            'name' => $request->name,
            'image_path' => $path,
            'description' => $request->description,
            'note' => $request->note,
        ]);

        return new MaterialResource($material);
    }

    public function update()
    {
        // TODO
    }

    public function destroy()
    {
        // TODO
    }
}
