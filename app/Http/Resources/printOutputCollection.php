<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class printOutputCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'weather_forecast' => $weatherDate = key($weatherDateList),
            'date' => $weatherDateList[$weatherDate],
            'products' => $this->searchProducts($weatherDate)
        ];
    }
}
