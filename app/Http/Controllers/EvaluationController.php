<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use App\Http\Resources\Evaluation as EvaluationResource;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Order;
use App\QuestionPool;

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
            'order_id'=>'required|integer',
            'questionpool_id'=>'required|integer',
             // 'client_id'=>'required|integer',
            'evaluationValue'=>'required|integer',            
        ]);
        

       // $user =  User::findOrFail(auth()->user()->id);
        
        $newEvaluation = Evaluation::create([
            'order_id' => $request->order_id,
            'questionpool_id' => $request->questionpool_id,
            'client_id' => 22,
            //'client_id' => $request->client_id,
             'evaluationValue' => $request->evaluationValue,
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
        
      // $user =  auth()->user()->id;
       $evaluation = Evaluation::findOrFail($id);

       $data = [
        'order_id' =>  $request->has('order_id')? $request->order_id : $evaluation->order_id,
        'questionpool_id' =>  $request->has('questionpool_id')? $request->questionpool_id : $evaluation->questionpool_id,
        //'client_id' =>  $request->has('client_id')? $request->client_id : $evaluation->client_id,
        'client_id' =>  22,
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
       // $user =  auth()->user()->id;
        $evaluation = Evaluation::findOrFail($id);

        if($evaluation->delete()) {
            return response($evaluation,200);
        }
    }
}
