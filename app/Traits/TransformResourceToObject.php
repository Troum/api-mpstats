<?php

namespace App\Traits;

trait TransformResourceToObject
{
    /**
     * Transform the resource into an object if it's an array.
     *
     * @param mixed $resource
     * @return object
     */
    public function transformResource(mixed $resource): object
    {
        if (is_array($resource)) {
            return (object) $resource;
        }

        return $resource;
    }
}

