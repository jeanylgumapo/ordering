<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        return response()->json(['order'=>$order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order=new Order();
        $order->invoice_id=$request->input('invoice_id');
        $order->item=$request->input('item');
        $order->qty=$request->input('qty');
        $order->save();
        return response()->json(['status'=>200, 'message'=>'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $or_id)
    {
        $order=Order::where('orid', '=', $or_id)->update(['invoice_id' => $request->input('invoice_id')]);
        return response()->json(['status'=>200, 'message'=>'Saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($orid)
    {
        $$order=DB::table('orders')->where('orid', $orid)->delete();
            return response()->json(['status'=>200, 'message'=>'Saved']);
        
    }
    public function getOrders(){
        $order = DB::table('orders')
            ->select('orders.orid AS orid','orders.invoice_id as invoice_id','orders.item as item', 'orders.qty as qty', 'submenus.id as id', 'submenus.item_name as item_name', 'submenus.price as price')
            ->join('submenus','submenus.id','=','orders.item' )
            ->where("orders.invoice_id", null)->get();
        return response()->json(['order'=>$order]);

    }
}
