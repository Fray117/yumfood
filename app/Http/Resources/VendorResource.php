<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		if ($request->has('tags')) {
			foreach (TagResource::collection($this->tags) as $key => $tag) {
				if ($tag['name'] == $request->query('tags')) {
					break;
				} else {
					return;
				}
			}
		}

        return [
            'id'   => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
