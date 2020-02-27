<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryTitle;
use App\Http\Resources\CategoryTitle as CategoryTitleResource;

class CategoryTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorieTitles = CategoryTitle::paginate(15);
        return CategoryTitleResource::collection($categorieTitles);
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
            'category_id'=> 'required|integer',
            'description' => 'required|string',
            'language_id'=> 'required|integer'
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        
        $newCategoryTitle = CategoryTitle::create([
            'category_id'=> $request->category_id,
            'description' => $request->description,
            'language_id'=> $request->language_id,
            'active'=> true
        ]);

        return response($newCategoryTitle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoryTitle = CategoryTitle::findOrFail($id);
        return response($categoryTitle,200);
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
       $categoryTitle = CategoryTitle::findOrFail($id);

       $data = [
           'category_id'=> $request->has('category_id')? $request->category_id: $categoryTitle->category_id,
           'description'=> $request->has('description')? $request->description: $categoryTitle->description,
           'language_id' =>  $request->has('language_id')? $request->language_id: $categoryTitle->language_id,
           'active' =>$request->has('active')? $request->active: $categoryTitle->active
       ];

        $categoryTitle->update($data);

       return response($categoryTitle, 200);
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
        $categoryTitle = CategoryTitle::findOrFail($id);

        if($category->delete()) {
            return response($categoryTitle,200);
        }
    }
}
