<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialInstanceResource;
use App\MaterialInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialInstanceController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'reference' => ['required', 'string', 'max:255'], // TODO unique reference
        ]);
    }

    public function view()
    {
        // TODO view all material instance
        // return view('material_instance');
    }

    public function adminView()
    {
        // TODO view all material instance admin
        // return view('admin.material_instance');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $materialsId = $request->materialsId;
        $sortBy = $request->sortBy ?? 'material_id';
        $sortDesc = $request->sortDesc ?? false;


        // prepare query
        $query = MaterialInstance::query();

        // apply filters
        // TODO filter by many categories
        if (!empty($materialsId))
            $query->whereIn('material_id', $materialsId);
        
        $query->sortBy($sortBy, $sortDesc);

        // send filtered materials
        return MaterialInstanceResource::collection(
            $query->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO
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
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO
    }
}
