<?php

namespace App\Http\Controllers\Seller;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\PropertyServiceInterface;
use App\Http\Requests\StorePropertyRequest;

class PropertyController extends Controller
{

    private $propertyService;

    public function __construct(PropertyServiceInterface $propertyService)
    {
        $this->propertyService = $propertyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $properties = $this->propertyService->getPropertiesForUser($userId);
        return view('seller.property-list',  ['properties' => $properties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.add-property');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $data = $request->all();
        dd($data);
        $this->propertyService->createProperty($data);
        // Redirect or return a response
        return redirect()->route('seller.properties')->with('success', 'Property Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($propertyId)
    {
        try {
            $property = $this->propertyService->findPropertyOrFail($propertyId);
            return view('home.components.backend.single-property', compact('property'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Display the specified resource.
     */
    public function allProperties()
    {
        return $this->propertyService->allProperties();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Use the service to update the property
        $this->propertyService->updateProperty($property, $validatedData);

        // Redirect to the property list page with a success message
        return redirect()->route('seller.properties')->with('success', 'Property Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $this->propertyService->destroyProperty($property);

        return redirect()->route('seller.properties')->with('success', 'Property Deleted Successfully');
    }
}
