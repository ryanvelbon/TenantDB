<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Gate;
use Illuminate\Http\Request;
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
}