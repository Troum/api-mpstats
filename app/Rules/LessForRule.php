<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LessForRule implements ValidationRule
{
    private int $lessValue;
    private int $limit;
    private string $lessAttribute;
    private string $attribute;

    public function __construct(mixed $lessValue, int $limit, string $attribute, string $lessAttribute)
    {
        $this->lessValue = (int) $lessValue;
        $this->limit = $limit;
        $this->attribute = $attribute;
        $this->lessAttribute = $lessAttribute;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute (string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = (int)$value;
        if ($value > $this->lessValue && ($value - $this->lessValue) > $this->limit) {
            $fail("Значение атрибута $this->attribute не может быть больше $this->lessAttribute, чем на $this->limit");
        }
    }
}
