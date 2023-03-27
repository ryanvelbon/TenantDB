<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ContractController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/Contract/Index', [
            'filters' => Request::all('search', 'trashed'),
            'contracts' => Auth::user()->contracts()
                ->with('tenant')
                // ->orderByEndDate()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($contract) => [
                    'id' => $contract->id,
                    'startDate' => $contract->start_date,
                    'endDate' => $contract->end_date,
                    'rent' => $contract->rent,
                    'deposit' => $contract->deposit,
                    'tenant' => $contract->tenant ? $contract->tenant->only(['first_name', 'last_name']) : null,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Frontend/Contract/Create', [
            'tenants' => Auth::user()->tenants()
                ->orderBy('first_name')
                ->get()
                ->map
                ->only('id', 'first_name'),
            'properties' => Auth::user()->properties()
                ->get()
                ->map
                ->only('id', 'address')
        ]);
    }

    public function store(StoreContractRequest $request)
    {
        Auth::user()->contracts()->create([
            'rent'        => $request->input('rent'),
            'deposit'     => $request->input('deposit'),
            'start_date'  => $request->input('startDate'),
            'end_date'    => $request->input('endDate'),
            'tenant_id'   => $request->input('tenant'),
            'property_id' => $request->input('property'),
        ]);

        return Redirect::route('frontend.contracts.index')->with('success', 'Contract created.');
    }

    public function edit(Contract $contract)
    {
        return Inertia::render('Frontend/Contract/Edit', [
            'contract' => [
                'id' => $contract->id,
                'startDate' => $contract->start_date,
                'endDate' => $contract->end_date,
                'rent' => $contract->rent,
                'deposit' => $contract->deposit,
                'tenant' => $contract->tenant->only(['id', 'first_name', 'last_name']),
                'property' => $contract->property->only(['id', 'type', 'address']),
                'deletedAt' => $contract->deleted_at,
            ],
            'tenants' => Auth::user()->tenants()
                ->orderBy('first_name')
                ->get()
                ->map
                ->only('id', 'first_name'),
            'properties' => Auth::user()->properties()
                ->get()
                ->map
                ->only('id', 'address')
        ]);
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update([
            'rent'        => $request->input('rent'),
            'deposit'     => $request->input('deposit'),
            'start_date'  => $request->input('startDate'),
            'end_date'    => $request->input('endDate'),
            'tenant_id'   => $request->input('tenant'),
            'property_id' => $request->input('property'),
        ]);

        return Redirect::route('frontend.contracts.index')->with('success', 'Contract updated.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();

        return Redirect::route('frontend.contracts.index')->with('success', 'Contract deleted.');
    }

    public function massDestroy(MassDestroyContractRequest $request)
    {
        Contract::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function restore(Contract $contract)
    {
        $contract->restore();

        return Redirect::route('frontend.contracts.index')->with('success', 'Contract restored.');
    }
}
