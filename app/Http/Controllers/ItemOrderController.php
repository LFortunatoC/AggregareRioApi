<?php

namespace App\Http\Controllers;
use app\item;
use app\itemOrder;
use app\Order;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ItemOrder as ItemOrderResource;
use App\Http\Resources\Item as ItemResource;

class ItemOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemOrders = ItemOrder::paginate(15);
        return ItemOrderResource::collection($itemOrders);
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
            'qty' => 'required|int'

        ]);
            
       $user =  User::findOrFail(auth()->user()->id);


        $newItemOrder = ItemOrder::create([
            'description' => $request->description,
            'qty' => 'required|int',
            'active'=> true
        ]);

        return response($newItemOrder, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemOrder = ItemOrder::findOrFail($id);

        return response($itemOrder,200);
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
            'id' => 'required|int',
        ]);

       $user =  auth()->user()->id;
       $itemOrder = ItemOrder::findOrFail($id);

       $data = [
           'id'=> $request->has('id')? $request->id: $itemOr->id
           
       ];

        $itemOrder->update($data);

       return response($itemOrder, 200);
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
        $itemOrder = ItemOrder::findOrFail($id);

        if($itemOrder->delete()) {
            return response($itemOrder,200);
        }
    }
}
