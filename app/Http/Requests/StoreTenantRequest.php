<?php

namespace App\Http\Requests;

use App\Models\Tenant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTenantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tenant_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'last_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'email' => [
                'required',
            ],
            'phone' => [
                'string',
                'min:7',
                'max:20',
                'required',
            ],
            'nationality_id' => [
                'required',
                'integer',
            ],
            'passport' => [
                'string',
                'min:5',
                'max:20',
                'nullable',
            ],
            'id_card' => [
                'string',
                'min:6',
                'max:20',
                'nullable',
            ],
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}