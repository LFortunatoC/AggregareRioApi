<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Http\Resources\Order as OrderResource;

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
            'tableNumber' => 'required|Intenger',
            'canceled'=> false,
        ]);

        $user =  User::findOrFail(auth()->user()->id);
        
        $newOrder = Order::create([
            'tableNumber' => $request->tableNumber,
            'canceled'=> false,
        ]);

        return response($newOrder, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

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
        $validationData = $request->validate([
            
            'tableNumber' => 'required|Intenger',
        ]);

       $user =  auth()->user()->id;
       $order = Order::findOrFail($id);

       $data = [
        'tableNumber'=> $request->has('tableNumber')? $request->tableNumber: $order->tableNumber,
           'canceled' =>$request->has('canceled')? $request->canceled: $order->canceled
       ];

        $order->update($data);

       return response($order, 200);
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
        $order = Order::findOrFail($id);

        if($order->delete()) {
            return response($order,200);
        }
    }
}
