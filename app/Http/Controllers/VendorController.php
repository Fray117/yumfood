<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Vendor;
use App\Order;
use App\Taggables;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return VendorResource::collection(Vendor::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Check if Vendor name too length nor present
		if (!$request->has('name')) return ['Vendor Name not provided'];
		if (strlen($request->input('name')) > 128) return ['Length above than 128 not allowed'];

		// Insert to Database
		$vendor = Vendor::create([
			'name' => $request->input('name'),
			'logo' => $request->input('logo', 'http://lorempixel.com/output/animals-q-g-640-480-7.jpg'),
		]);

		// Split Comma
		foreach (explode(',', $request->input('tags', '1')) as $key => $value) {
			Taggables::create([
				'taggable_id' => $vendor['id'],
				'tag_id' => $value,
				'taggable_type' => 'App\Vendor'
			]);
		}

		// Return the Result
        return VendorResource::collection(Vendor::where('id', $vendor['id'])->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return VendorResource::collection(Vendor::where('id', $id)->get());
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
		$v = Vendor::where('id', $id)->get();
        return (Vendor::where('id', $id)->update([
			'name' => $request->input('name', $v[0]['name']),
			'logo' => $request->input('logo', $v[0]['logo']),
			'updated_at' => now(),
		]) == 1) ? true : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$x['data'] = (Vendor::where('id', $id)->delete() == 1) ? true : false;

		$x['tags'] = Taggables::where('taggable_id', $id)->delete();

		$x['order'] = Order::where('vendor_id', $id)->delete();

		return $x;
    }
}
