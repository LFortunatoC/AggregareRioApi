<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\CategoryTitle;
use App\Http\Resources\Category as CategoryResource;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return CategoryResource::collection($categories);
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
        
        $newCategory = Category::create([
            'description' => $request->description,
            'active'=> true,
        ]);

        return response($newCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response($category,200);
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
       $category = Category::findOrFail($id);

       $data = [
           'description'=> $request->has('description')? $request->description: $category->description,
           'active' =>$request->has('active')? $request->active: $category->active
       ];

        $category->update($data);

       return response($category, 200);
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
        $category = Category::findOrFail($id);

        if($category->delete()) {
            return response($category,200);
        }
    }

    public function search(Request $request, $language_id)
    {
        $category = CategoryTitle::where('language_id', '=', $language_id)->get();     
        return response($category,200);
    }
}
