<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return parent::toArray($request);

        // return [
        //     "id" => (int)$this->id,
        //     "name" => (string) $this->name,
        //     "email" => (string) $this->email,
        //     "number" => (string) $this->number,
        // ];

    }
}
