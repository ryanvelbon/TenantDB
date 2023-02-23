<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantReportRequest;
use App\Models\TenantReport;
use App\Models\Country;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

class TenantReportController extends Controller
{
    public function index()
    {
        $reports = TenantReport::all();

        return Inertia::render('Frontend/TenantReport/Index', [
            'data' => [
                'reports' => $reports,
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Frontend/TenantReport/Create', [
            'tenants'   => auth()->user()->tenants()
                ->orderBy('first_name')
                ->get()
                ->map
                ->only('id', 'first_name', 'last_name'),
        ]);
    }

    public function store(StoreTenantReportRequest $request)
    {
        TenantReport::create([
            'n_months' => $request->input('nMonths'),
            'lease_broken' => $request->input('leaseBroken'),
            'outstanding_rent' => $request->input('outstandingRent'),
            'property_damaged' => $request->input('propertyDamaged'),
            'created_by' => $request->user()->id, 
        ]);

        return redirect()->route('frontend.tenantReports.index');
    }

    public function searchPage(Request $request)
    {
        return Inertia::render('Frontend/TenantReport/Search', [
            'data' => [
                
            ],
        ]);
    }
}