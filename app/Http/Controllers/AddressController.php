<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate =  $request->validate([
            'building_num' => 'required',
            'city' => 'required|max:30|string',
            'street' => 'required|max:30|string',
        ]);

        $address = Address::updateOrCreate(
            ['user_id' => auth()->id],
            $validate
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $validated =  $request->validate([
            'building_num' => 'nullable',
            'city' => 'nullable|max:30|string',
            'street' => 'nullable|max:30|string',
        ]);

        $address->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
