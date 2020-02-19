<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemTitleDescription;
use App\Http\Resources\ItemTitleDescription as TitleDescResource;
use App\Language;
use App\Item;
use App\Constants;

class ItemTitleDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titleDesc = ItemTitleDescription::paginate(15);
        return TitleDescResource::collection($titleDesc);
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
            'item_id' => 'required|integer',
            'language_id'=> 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        $item = Item::findOrFail($request->item_id);
        $language = Language::findOrFail($request->language_id);
        
        $newTitleDesc = ItemTitleDescription::create([
            'item_id'=> $request->item_id,
            'language_id'=>$request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'active'=> true,
        ]);

        return response($newTitleDesc, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $titleDesc = ItemTitleDescription::findOrFail($id);

        return response($titleDesc,200);
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
            'item_id' => 'required|integer',
            'language_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

       //$user =  auth()->user()->id;
       $titleDesc = ItemTitleDescription::findOrFail($id);

       $data = [
           'item_id'=>$request->has('item_id')? $request->item_id: $titleDesc->item_id,
           'language'=>$request->has('language_id')? $request->language_id: $titleDesc->language_id,
           'title' => $request->has('title')? $request->title: $titleDesc->title,
           'description'=> $request->has('description')? $request->description: $titleDesc->description,
           'active' =>$request->has('active')? $request->active: $titleDesc->active
       ];

        $titleDesc->update($data);

       return response($titleDesc, 200);
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
        $titleDesc = ItemTitleDescription::findOrFail($id);

        if($titleDesc->delete()) {
            return response($titleDesc,200);
        }
    }
}
