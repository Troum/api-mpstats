<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends BasicResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'brand' => $this->resource->brand,
            'rating' => $this->resource->rating,
            'final_price' => $this->resource->final_price,
            'final_price_max' => $this->resource->final_price_max,
            'final_price_average' => $this->resource->final_price_average,
            'final_price_median' => $this->resource->final_price_median,
            'basic_sale' => $this->resource->basic_sales,
            'basic_price' => $this->resource->basic_price,
            'sales' => $this->resource->sales,
            'sales_per_day_average' => $this->resource->sales_per_day_average,
            'revenue' => $this->resource->revenue,
            'revenue_potential' => $this->resource->revenue_potential,
            'revenue_average' => $this->resource->revenue_average,
            'days_in_stock' => $this->resource->days_in_stock,
            'days_with_sales' => $this->resource->days_with_sales,
            'is_fbs' => $this->resource->is_fbs,
            'turnover_days' => $this->resource->turnover_days,

        ];
    }
}
