<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddressResource::collection(
            Address::with('user')->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'building_num' => 'required|string|max:20',
        'city'         => 'required|string|max:30',
        'street'       => 'required|string|max:50',
    ]);

    $address = Address::updateOrCreate(
        ['user_id' => auth()->id],
        $validated
    );

    return new AddressResource($address);
}


    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'building_num' => 'nullable|string|max:20',
            'city'         => 'nullable|string|max:30',
            'street'       => 'nullable|string|max:50',
        ]);

        $address->update($validated);

        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json([
            'message' => 'Address deleted successfully',
        ], 200);
    }
}
