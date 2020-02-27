<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategoryTitle;
use App\Http\Resources\SubCategoryTitle as SubCategoryTitleResource;

class SubCategoryTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategorieTitles = SubCategoryTitle::paginate(15);
        return SubCategoryTitleResource::collection($subCategorieTitles);
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
            'sub_category_id'=> 'required|integer',
            'description' => 'required|string',
            'language_id'=> 'required|integer'
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        
        $newSubCategoryTitle = SubCategoryTitle::create([
            'sub_category_id'=> $request->sub_category_id,
            'description' => $request->description,
            'language_id'=> $request->language_id,
            'active'=> true
        ]);

        return response($newSubCategoryTitle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategoryTitle = SubCategoryTitle::findOrFail($id);
        return response($subCategoryTitle,200);
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
       $subCategoryTitle = SubCategoryTitle::findOrFail($id);

       $data = [
           'sub_category_id'=> $request->has('sub_category_id')? $request->sub_category_id: $subCategoryTitle->sub_category_id,
           'description'=> $request->has('description')? $request->description: $subCategoryTitle->description,
           'language_id' =>  $request->has('language_id')? $request->language_id: $subCategoryTitle->language_id,
           'active' =>$request->has('active')? $request->active: $subCategoryTitle->active
       ];

        $subCategoryTitle->update($data);

       return response($subCategoryTitle, 200);
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
       $subCategoryTitle = SubCategoryTitle::findOrFail($id);

       if($subCategoryTitle->delete()) {
           return response($subCategoryTitle,200);
       }
    }
}
