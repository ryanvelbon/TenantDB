<?php

namespace App\Http\Requests;

use App\Models\TenantReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTenantReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tenant_report_create');
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
            'nationality' => [
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
            'n_months' => [
                'required',
                'integer',
                'min:1',
                'max:60',
            ],
            'lease_broken' => [
                'required',
            ],
            'outstanding_rent' => [
                'required',
            ],
            'property_damaged' => [
                'required',
            ],
        ];
    }
}