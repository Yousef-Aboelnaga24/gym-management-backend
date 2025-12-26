<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $person = Person::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:people,email|email',
            'phone' => 'required|regex:/^01[0-5][0-9]{8}$/|unique:people,phone',
            'date_of_birth' => 'required|before:today',
            'gender' => 'required',
        ]);

        $person = Person::create($validated);

        return response()->json([
            'message' => 'Person created success',
            'data' => $person
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'name' => 'nullable|max:50',
            'email' => 'nullable|unique:people,email|email' . $person->id,
            'phone' => 'nullable|regex:/^01[0-5][0-9]{8}$/|unique:people,phone' . $person->id,
            'date_of_birth' => 'nullable|before:today',
            'gender' => 'nullable',
        ]);

        $person->update($validated);

        return response()->json([
            'message' => 'Person updated success',
            'data' => $person
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return response()->noContent();
    }
}
