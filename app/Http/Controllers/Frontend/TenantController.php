<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Models\Country;
use App\Models\Tenant;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

class TenantController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tenant_access'), Inertia::render('Error/403', ['message' => 'You are not authorized to access this resource.'], 403));

        return Inertia::render('Frontend/Tenant/Index', [
            'tenants' => auth()->user()->tenants()
                ->orderBy('first_name')
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($tenant) => [
                    'id'          => $tenant->id,
                    'firstName'   => $tenant->first_name,
                    'lastName'    => $tenant->last_name,
                    'email'       => $tenant->email,
                    'phone'       => $tenant->phone,
                    'idCard'      => $tenant->id_card,
                    'nationality' => $tenant->nationality,
                    'passport'    => $tenant->passport,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Frontend/Tenant/Create', [
            'countries' => Country::all()
                    ->map
                    ->only('id', 'nicename'),
        ]);
    }

    public function store(StoreTenantRequest $request)
    {
        auth()->user()->tenants()->create([
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'nationality' => $request->input('nationality'),
            'passport' => $request->input('passport'),
            'id_card' => $request->input('idCard'),
            'dob' => $request->input('dob'),
        ]);

        return Redirect::route('frontend.tenants.index')->with('success', 'Tenant created.');
    }
}