<?php

namespace App\Http\Resources;

use App\Traits\TransformResourceToObject;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicResource extends JsonResource
{
    use TransformResourceToObject;

    /**
     * Create a new instance of the resource.
     *
     * @param mixed $resource
     */
    public function __construct($resource)
    {
        $this->resource = $this->transformResource($resource);

        parent::__construct($this->resource);
    }
}
