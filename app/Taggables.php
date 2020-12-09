<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggables extends Model
{
	protected $fillable = [
		'taggable_id', 'tag_id', 'taggable_type'
	];
}
