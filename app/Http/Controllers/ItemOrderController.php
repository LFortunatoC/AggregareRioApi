<?php

namespace App\Http\Controllers;
use App\ItemOrder;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemOrder as ItemOrderResource;

class ItemOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemOrder = ItemOrder::paginate(15);
        return ItemOrderResource::collection($itemOrder);
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

            'order_Id' =>'required|integer',
            'Item_Id' =>'required|integer',
            'qty' => 'required|integer',
            'currPrice' => 'required|numeric',

        ]);
        $user =  User::findOrFail(auth()->user()->id);
        $item = Item::findOrFail($request->item_id);

        $newItemOrder = ItemOrder::create([
            'order_Id' =>$request->order_Id,
            'Item_Id' =>$request->Item_Id,
            'qty' =>$request->qty,
            'currPrice' => $request->currPrice,
            'canceled'=>false,
        ]);

        return response($newItemOrder,201);

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

            'order_Id' =>'required|integer',
            'Item_Id' =>'required|integer',
            'qty' => 'required|integer',
            'currPrice' => 'required|numeric',

        ]);
        $itemOrder = ItemOrder::findOrFail($id);

        $data = [
            'order_Id' =>$request->has('order_Id')?$request->order_Id:$itemOrder->order_Id,
            'Item_Id' =>$request->has('Item_Id')?$request->Item_Id:$itemOrder->Item_Id,
            'qty' =>$request->has('qty')?$request->qty:$itemOrder->qty,
            'currPrice' => $request->has('currPrice')?$request->currPrice:$itemOrder->currPrice,
            'canceled'=>$request->has('canceled')?$request->canceled:$itemOrder->canceled
            
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
