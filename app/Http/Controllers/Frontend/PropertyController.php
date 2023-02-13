<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPropertyRequest;
use App\Http\Requests\StorePropertyRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Render the index page
     * 
     * @return \Inertia\Response
     */
    public function index()
    {
        $properties = Property::all();

        return Inertia::render('Frontend/Property/Index', [
            'data' => [
                'properties' => $properties,
            ],
        ]);
    }

    /**
     * Render the show page
     * 
     * @return \Inertia\Response
     */
    public function show(Property $property)
    {
        return Inertia::render('Frontend/Property/Show', [
            'data' => [
                'property' => $property
            ],
        ]);
    }

    /**
     * Render the create page
     * 
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Frontend/Property/Create', [
            'data' => [

            ],
            'meta' => [
                'type' => Property::TYPE_SELECT,
            ],
        ]);
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());

        return redirect()->route('frontend.properties.show', ['property' => $property]);
    }

    public function destroy(Property $property)
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function massDestroy(MassDestroyPropertyRequest $request)
    {
        Property::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}