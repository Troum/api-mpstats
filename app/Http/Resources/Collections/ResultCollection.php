<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\ResultResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResultCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray(Request $request): AnonymousResourceCollection
    {
        return ResultResource::collection($this->collection);
    }
}
