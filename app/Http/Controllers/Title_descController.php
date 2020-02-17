<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title_desc;
use App\Http\Resources\Title_desc as Title_descResource;

class Title_descController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title_desc = Title_desc::paginate(15);
        return Title_descResource::collection($title_desc);
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
        ]);

        $user =  User::findOrFail(auth()->user()->id);
        
        $newtitle_desc = Title_desc::create([
            'title' => $request->title,
            'description' => $request->description,
            'active'=> true,
        ]);

        return response($newTitle_desc, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title_desc = Title_desc::findOrFail($id);

        return response($title_desc,200);
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
            'tiltle' => 'required|string',
            'description' => 'required|string',
        ]);

       $user =  auth()->user()->id;
       $title_desc = Title_desc::findOrFail($id);

       $data = [
           'title' => $request->has('title')? $request->title: $title_desc->title,
           'description'=> $request->has('description')? $request->description: $title_desc->description,
           'active' =>$request->has('active')? $request->active: $title_desc->active
       ];

        $title_desc->update($data);

       return response($title_desc, 200);
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
        $title_desc = Title_desc::findOrFail($id);

        if($title_desc->delete()) {
            return response($title_desc,200);
        }
    }
}
