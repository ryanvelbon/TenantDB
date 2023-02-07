<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantReportRequest;
use App\Models\TenantReport;
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

            ],
        ]);
    }
}