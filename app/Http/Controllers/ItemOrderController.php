<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\ItemOrder;
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
            'order_id' => 'required|integer',
            'item_id' => 'required|integer',
            'qty' => 'required|integer',
            'currPrice' => 'required|numeric',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        
        $newItemOrder = ItemOrder::create([
            'order_id' => $request->order_id,
            'item_id' => $request->item_id,
            'qty' => $request->qty,
            'currPrice' => $request->currPrice,
            'canceled'=>false,
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
        //$itemOrder = ItemOrder::findOrFail($id);
        $itemOrder = ItemOrder::with('items')->find($id);
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
        //$user =  auth()->user()->id;
        $itemOrder = ItemOrder::findOrFail($id);

        //$user =  User::findOrFail(auth()->user()->id);
        
        $data =  [
            'order_id' => $request->has('order_id') ? $request->order_id : $itemOrder->order_id,
            'item_id' => $request->has('item_id') ? $request->item_id: $itemOrder->item_id,
            'qty' => $request->has('qty') ? $request->qty: $itemOrder->qty,
            'currPrice' => $request->has('currPrice') ? $request->currPrice: $itemOrder->currPrice,
            'canceled'=> $request->has('canceled') ? $request->canceled: $itemOrder->canceled,
            'active'=> $request->has('active') ? $request->active: $itemOrder->active,
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
        //$user =  auth()->user()->id;
        $itemOrder = ItemOrder::findOrFail($id);

        if($itemOrder->delete()) {
            return response($itemOrder,200);
        }
    }

    public function getItemsofAnOrder ($order_id)
    {
        $itemOfOrder = ItemOrder::ofOrder($order_id)->with('items')->get();
        return ItemOrderResource::collection($itemOfOrder);
    }
}
