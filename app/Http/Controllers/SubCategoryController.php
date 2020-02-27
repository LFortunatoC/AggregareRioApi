<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SubCategory as SubCategoryResource;
use App\SubCategory;
use App\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::paginate(15);
        return SubCategoryResource::collection($subcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        
        $newSubCategory = SubCategory::create([
            'description' => $request->description,
            'active'=> true
        ]);

        return response($newSubCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        return response($subcategory,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validationData = $request->validate([
            'description' => 'required|string',
        ]);

       //$user =  auth()->user()->id;
       $subcategory = SubCategory::findOrFail($id);

       $data = [
           'description'=> $request->has('description')? $request->description: $subcategory->description,
           'active' =>$request->has('active')? $request->active: $subcategory->active
       ];

        $subcategory->update($data);

       return response($subcategory, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$user =  auth()->user()->id;
        $subcategory = SubCategory::findOrFail($id);

        if($subcategory->delete()) {
            return response($subcategory,200);
        }
    }
}
