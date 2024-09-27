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
            'rating' => $this->when(isset($this->resource->rating), $this->resource->rating),
            'final_price' => $this->when(isset($this->resource->final_price), $this->resource->final_price),
            'final_price_max' => $this->when(isset($this->resource->final_price_max), $this->resource->final_price_max),
            'final_price_average' => $this->when(isset($this->resource->final_price_average), $this->resource->final_price_average),
            'final_price_median' => $this->when(isset($this->resource->final_price_median), $this->resource->final_price_median),
            'basic_sale' => $this->when(isset($this->resource->basic_sales), $this->resource->basic_sales),
            'basic_price' => $this->when(isset($this->resource->basic_price), $this->resource->basic_price),
            'sales' => $this->when(isset($this->resource->sales), $this->resource->sales),
            'sales_per_day_average' => $this->when(isset($this->resource->sales_per_day_average), $this->resource->sales_per_day_average),
            'revenue' => $this->when(isset($this->resource->revenue), $this->resource->revenue),
            'revenue_potential' => $this->when(isset($this->resource->revenue_potential), $this->resource->revenue_potential),
            'revenue_average' => $this->when(isset($this->resource->revenue_average), $this->resource->revenue_average),
            'days_in_stock' => $this->when(isset($this->resource->days_in_stock), $this->resource->days_in_stock),
            'days_with_sales' => $this->when(isset($this->resource->days_with_sales), $this->resource->days_with_sales),
            'is_fbs' => $this->when(isset($this->resource->is_fbs), $this->resource->is_fbs),
            'turnover_days' => $this->when(isset($this->resource->turnover_days), $this->resource->turnover_days),
        ];
    }

}
