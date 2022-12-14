<?php

namespace App\Http\Resources\Product;

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
        return [
            'name'         => $this->name,
            'descriptions' => $this->detail,
            'price'        => $this->price,
            'stock'        => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'discount'     => $this->discount,
            'total_price'  => round((1 - $this->discount / 100) * $this->price,2),

            'ratings'      => $this->reviews->count() > 0 ?
                round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'No Rating now',
            'reviews'  => route('reviews.index', $this->id),

        ];
    }
}
