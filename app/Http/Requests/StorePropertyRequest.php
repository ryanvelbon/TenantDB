<?php

namespace App\Http\Requests;

use App\Models\Property;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class StorePropertyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => [
                'string',
                'nullable',
            ],
            'type' => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Property::TYPE_SELECT, 'value')),
            ],
            'size' => [
                'integer',
                'min:10',
                'max:1000',
                'nullable',
            ],
            'n_bedrooms' => [
                'integer',
                'min:0',
                'max:100',
                'nullable',
            ],
            'n_bathrooms' => [
                'numeric',
                'nullable',
            ],
        ];
    }
}