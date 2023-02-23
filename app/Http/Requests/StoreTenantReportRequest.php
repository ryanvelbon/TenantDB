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
            'tenant' => [
                'required',
                'integer',
            ],
            'nMonths' => [
                'required',
                'integer',
                'min:1',
                'max:60',
            ],
            'leaseBroken' => [
                'required',
            ],
            'outstandingRent' => [
                'required',
            ],
            'propertyDamaged' => [
                'required',
            ],
        ];
    }
}