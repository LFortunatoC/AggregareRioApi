<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use App\Http\Resources\Evaluation as EvaluationResource;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = Evaluation::paginate(15);
        return EvaluationResource::collection($evaluations);
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
            'evaluationValue'=>'required|Integer',
            'comment' => 'required|string',
            
        ]);
        

        $user =  User::findOrFail(auth()->user()->id);
        
        $newEvaluation = Evaluation::create([

            'evaluationValue' => $request->comment,
            'comment' => $request->comment,
            
        ]);

        return response($newEvaluation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evaluation = Evaluation::findOrFail($id);

        return response($evaluation,200);
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
            'evaluationValue'=>'required|Integer',
            'comment' => 'required|string',
        ]);

       $user =  auth()->user()->id;
       $evaluation = Evaluation::findOrFail($id);

       $data = [
            'evaluationValue'=> $request->has('evaluationValue')? $request->evaluationValue: $evaluation->evaluationValue,
           'comment'=> $request->has('comment')? $request->comment: $evaluation->comment,
          
       ];

        $evaluation->update($data);

       return response($evaluation, 200);
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
        $evaluation = Evaluation::findOrFail($id);

        if($evaluation->delete()) {
            return response($evaluation,200);
        }
    }
}
