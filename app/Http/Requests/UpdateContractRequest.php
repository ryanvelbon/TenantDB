<?php

namespace App\Http\Requests;

use App\Models\Contract;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContractRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_edit');
    }

    public function rules()
    {
        return [
            'startDate' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'endDate' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tenant' => [
                'required',
                'integer',
            ],
            'property' => [
                'required',
                'integer',
            ],
        ];
    }
}