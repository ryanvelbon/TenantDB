<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantReportRequest;
use App\Models\TenantReport;
use App\Models\Country;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

class TenantReportController extends Controller
{
    public function create()
    {
        return Inertia::render('TenantReport/Create', [
            'data' => [
                'countries' => Country::all(),
            ],
        ]);
    }

    public function store(StoreTenantReportRequest $request)
    {
        TenantReport::create([
           'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'passport' => $request->input('passport'),
            'id_card' => $request->input('idCard'),
            'dob' => $request->input('dob'),
            'n_months' => $request->input('nMonths'),
            'lease_broken' => $request->input('leaseBroken'),
            'outstanding_rent' => $request->input('outstandingRent'),
            'property_damaged' => $request->input('propertyDamaged'),
            'nationality' => $request->input('nationality'),
            'created_by' => $request->user()->id, 
        ]);

        return redirect()->route('tenantReports.index');
    }
}