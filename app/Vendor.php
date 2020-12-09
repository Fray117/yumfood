<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

	public function orders()
    {
        return $this->morphToMany('App\Order', 'orders');
    }

	protected $fillable = [
		'name', 'logo'
	];
}
