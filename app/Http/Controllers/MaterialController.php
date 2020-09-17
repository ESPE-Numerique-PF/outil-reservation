<?php

namespace App\Http\Controllers;

use App\Http\Resources\Material as ResourcesMaterial;
use App\Http\Resources\MaterialResource;
use App\Material;

class MaterialController extends Controller
{

    const IMAGE_PATH = 'images/material';
    
    public function view()
    {
        return view('material');
    }

    public function adminView()
    {
        return view('admin.material');
    }

    public function index()
    {
        return MaterialResource::collection(Material::withCount('materialInstances')->get());
    }

    public function show($id)
    {
        return new MaterialResource(Material::find($id));
    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
