<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\Item;
use App\Http\Resources\Promotion as PromotionResource;
class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotion = Promotion::paginate(15);
        return PromotionResource::collection($promotion);
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
            'daysAvailable' => 'required|string',
            'value' => 'required|numeric',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        $item = Item::findOrFail($request->item_id);
      

        $newPromotion = Promotion::create([
            'item_id'=> $request->item_id,
            'daysAvailable' => $request->daysAvailable,
            'value' => $request->value,
            'active'=> true,
        ]);

        return response($newPromotion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);

        return response($promotion,200);
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
            'daysAvailable' => 'required|string',
            'value' => 'required|numeric',
        ]);

       //$user =  auth()->user()->id;
       $promotion = Promotion::findOrFail($id);

       $data = [
           'item_id'=>$request->has('item_id')? $request->item_id: $promotion->item_id,
           'daysAvailable' => $request->has('daysAvailable')? $request->daysAvailable: $promotion->daysAvailable,
           'value' => $request->has('value')? $request->value: $promotion->value,
           'active' =>$request->has('active')? $request->active: $promotion->active
       ];

        $promotion->update($data);

       return response($promotion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);

        if($promotion->delete()) {
            return response($promotion,200);
        }
    }
}
