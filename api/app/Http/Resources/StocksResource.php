<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StocksResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "unit_price" => $this->unit_price,
            "updated_at" => $this->updated_at->todatestring(),
        ];
    }
}
