<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'         => $this->id,
            'type'       => $this->type,
            'prep'       => $this->prep,
            'cutting'    => $this->cutting,
            'mafroum'    => $this->mafroum,
            'head'       => $this->head,
            'kersh'      => $this->kersh,
            'status'     => $this->status,
            'pay_method' => $this->pay_method,
            'address'    => $this->address->title,
            'product'    => $this->product->name,
            'weight'     => $this->product->weight,
            'price'      => $this->product->new_price,
            'image'      => asset($this->product->image),
        ];
    }
}
