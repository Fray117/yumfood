<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function vendors()
    {
        return $this->morphedByMany('App\Vendor', 'orders');
    }

	protected $fillable = [
		'vendor_id', 'dishes_id', 'customer', 'quantity', 'notes', 'order_type'
	];
}
