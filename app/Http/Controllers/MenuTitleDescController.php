<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuTitleDesc;
use App\Http\Resources\MenuTitleDesc as MenuTitleDescResource;


class MenuTitleDescController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuTitleDesc = MenuTitleDesc::paginate(15);
        return MenuTitleDescResource::collection($menuTitleDesc);
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
            'title' => 'required|string',
            'description' => 'required|string',
            'menu_id' => 'required|integer',
            'language_id' => 'required|integer'
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        
        $newMenuTitleDesc = MenuTitleDesc::create([
            'menu_id' => $request->menu_id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'altText1' => $request->alterText1,
            'altText2' => $request->alterText2,
            'active'=> true,
        ]);

        return response($newMenuTitleDesc, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuTitleDesc = MenuTitleDesc::findOrFail($id);

        return response($menuTitleDesc,200);
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
            'title' => 'required|string',
            'description' => 'required|string',
            'menu_id' => 'required|integer',
            'language_id' => 'required|integer'
        ]);

       $user =  auth()->user()->id;
       $menuTitleDesc = MenuTitleDesc::findOrFail($id);

       $data = [
        'menu_id' => $request->has('menu_id')? $request->menu_id: $menuTitleDesc->menu_id,
        'language_id' => $request->has('language_id')? $request->language_id: $menuTitleDesc->language_id,
        'title' => $request->has('title')? $request->title: $menuTitleDesc->title,
        'description'=> $request->has('description')? $request->description: $menuTitleDesc->description,
        'altText1' => $request->has('altText1')? $request->altText1: $menuTitleDesc->altText1,
        'altText2' => $request->has('altText2')? $request->altText2: $menuTitleDesc->altText2,
        'active' =>$request->has('active')? $request->active: $menuTitleDesc->active
       ];

        $menuTitleDesc->update($data);

       return response($menuTitleDesc, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $user =  auth()->user()->id;
    $menuTitleDesc = MenuTitleDesc::findOrFail($id);

        if($menuTitleDesc->delete()) 
        {
            return response($menuTitleDesc,200);
        }   
    }
}
