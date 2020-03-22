<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\SubCategoryTitle;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SubCategory as SubCategoryResource;
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
            'category_id'=>  'required|integer',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        $category = Category::find($request->category_id);

        if (!$category) {
            abort( response()->json('Invalid category Id', 422) );
        }
        
        $newSubCategory = SubCategory::create([
            'description' => $request->description,
            'category_id' => $request->category_id,
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
           'category_id'=> $request->has('category_id')? $request->category_id: $subcategory->category_id,
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

    public function search($category_id, $language_id)
    {

        $subCategories = DB::table('sub_categories')
            ->join ('sub_category_titles', function ($join) use($category_id, $language_id){
            $join->on('sub_categories.id','=','sub_category_titles.sub_category_id')
            ->where(['sub_categories.category_id'=>$category_id,'sub_category_titles.language_id'=>$language_id]);
        })
        ->get();

        return response($subCategories,200);
    }
}
