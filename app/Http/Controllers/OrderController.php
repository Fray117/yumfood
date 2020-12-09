<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return Order::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Check if customer Name not present
		if (!$request->has('customer')) return;

		// Insert to Database
		$vendor = Order::create([
			'vendor_id' => $request->input('vendor', 1),
			'dishes_id' => $request->input('dishes', 1),
			'customer' => $request->input('customer', 'John Dalton'),
			'quantity' => $request->input('quantity', 1),
			'notes' => $request->input('notes', 'Extra Sauce'),
			'order_type' => 'App\Vendor'
		]);

		// Return the Result
        return $vendor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::where('order_id', $id)->get();
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
		$v = Order::where('order_id', $id)->get();
        return [(Order::where('order_id', $id)->update([
			'customer' => $request->input('customer', $v[0]['customer']),
			'quantity' => $request->input('quantity', $v[0]['quantity']),
			'notes' => $request->input('notes', $v[0]['notes']),
			'updated_at' => now(),
		]) == 1)];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		return [(Order::where('order_id', $id)->delete() == 1)];
    }
}
