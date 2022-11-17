<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
            'image' => asset($this->image),
            'new_price' =>(double) $this->new_price,
            'old_price' =>(double) $this->old_price,
            'cat_id' => (int) $this->cat_id,
            'cat' => $this->cat->name
        ];
    }
}
