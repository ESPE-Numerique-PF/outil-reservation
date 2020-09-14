<?php

namespace App\Http\Controllers;

use App\Http\Resources\Material as ResourcesMaterial;
use App\Material;

class MaterialController extends Controller
{
    
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
        return []; // TODO
    }
}
