<?php

namespace App\Classes;

/**
 * @readonly
 * @class ConvertedRequest
 * @package App\Classes
 */
readonly class ConvertedRequest
{
    public function __construct(
        public string $queryString,
        public array $data
    ) {
    }
}
