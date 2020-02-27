<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionPool;
use App\Http\Resources\QuestionPool as QuestionPoolResource;

class QuestionPoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionPool = QuestionPool::paginate(15);
        return QuestionPoolResource::collection($questionPool);
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
            'question' => 'required|string',
            'language_id' => 'required|integer'
        ]);

       // $user =  User::findOrFail(auth()->user()->id);
        
        $newQuestionPool = QuestionPool::create([
            'question' => $request->question,
            'language_id' => $request->language_id,
            'active' => true
        ]);
    
        return response($newQuestionPool, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newQuestionPool = QuestionPool::findOrFail($id);

        return response($newQuestionPool,200);
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
            'question' => 'required|string',
            'language_id' => 'required|integer'
        ]);

      // $user =  auth()->user()->id;
       $questionPool = QuestionPool::findOrFail($id);

       $data = [
        'question' => $request->has('question')? $request->question: $questionPool->question,
        'language_id' => $request->has('language_id')? $request->language_id: $questionPool->language_id
       ];

        $questionPool->update($data);

       return response($questionPool, 200);
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
        $questionPool = QuestionPool::findOrFail($id);

        if($questionPool->delete()) 
        {
            return response($questionPool,200);
        }   
    }
}
