<?php

namespace App\Http\Requests;

use App\Enums\ServicesEnum;
use App\Rules\LessForRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'service' => ['required', 'string', Rule::enum(ServicesEnum::class)],
            'path' => ['required', 'string'],
            'fbs' => ['numeric', 'nullable'],
            'd1' => ['date_format:Y-m-d', 'nullable'],
            'd2' => ['date_format:Y-m-d', 'nullable'],
            'startRow' => ['integer', 'min:0'],
            'endRow' => ['integer', new LessForRule(
                $this->request->get('startRow'),
                5000,
                'Номер строки конца получения данных',
                'Номера строки начала получения данных'
            )
            ],
            'filterModel' => ['nullable', 'array'],
            'sortModel' => ['nullable', 'array'],
        ];
    }
}
