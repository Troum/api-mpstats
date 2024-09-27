<?php

namespace App\Classes;

readonly class ConvertedResponse
{
    public array $data;
    public function __construct(
        array $data
    ) {
        $this->data = array_key_exists('data', $data) ? $data['data'] : $data;
    }
}
