<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Arr;
use App\ItemOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(15);
        return OrderResource::collection($orders);
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
            'tableNumber' => 'required|integer',
            'deliveredAt'=>'required|date',
            '*.itemList.*.item_id' => 'required|exists:itemList,item_id',
            '*.itemList.*.qty' => 'required|exists:itemList,qty',
            '*.itemList.*.currPrice' => 'required|exists:itemList,currPrice',
        ]);

        // $user =  User::findOrFail(auth()->user()->id);
        
        $newOrder = Order::create([
            'tableNumber' => $request->tableNumber,
            'canceled'=> false,
            'deliveredAt'=>$request->deliveredAt,
            
        ]);

        $itemList = $request->itemList;
        $newOrderItemList = array();

        foreach($itemList as $item) {
            $newItemOrder = ItemOrder::Create([
                'order_id' => $newOrder->id,
                'item_id' => $item['item_id'],
                'qty' => $item['qty'],
                'currPrice' => $item['currPrice'],
                'canceled'=>false,
                'active'=> true

            ]);

            array_push($newOrderItemList, $newItemOrder);

            $data = [
                'order' => $newOrder,
                'items' => $newOrderItemList
            ];
        }

        return response($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);

        return response($order,200);
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
       $order = Order::findOrFail($id);

       $data = [
        'tableNumber'=> $request->has('tableNumber')? $request->tableNumber: $order->tableNumber,
        'canceled' =>$request->has('canceled')? $request->canceled: $order->canceled,
        'deliveredAt' =>$request->has('deliveredAt')? $request->deliveredAt: $order->deliveredAt,
       ];

        $order->update($data);

        if ($request->has('itemList'))
        {
            $itemList = $request->itemList;
            $newOrderItemList = array();
    
            foreach($itemList as $item) {
                $newItemOrder = ItemOrder::findOrFail($item['itemOrder_id']);
                
                $data = [
                    'qty' => Arr::exists($item, 'qty')? $item['qty'] : $newItemOrder->qty,
                    'currPrice' => Arr::exists($item, 'currPrice')? $item['currPrice']: $newItemOrder->currPrice ,
                    'canceled'=>  Arr::exists($item, 'canceled')? $item['canceled'] : $newItemOrder->canceled,
                    'active'=>  Arr::exists($item, 'active') ? $item['active'] : $newItemOrder->active,
                ];

                $newItemOrder->update($data);

                array_push($newOrderItemList, $newItemOrder);
            }

        }

        
        $data = [
            'order' => $order,
            'items' => $newOrderItemList
        ];

       return response($data, 200);
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
        $order = Order::findOrFail($id);

        if($order->delete()) {
            return response($order,200);
        }
    }
}
