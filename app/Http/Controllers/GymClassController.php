<?php

namespace App\Http\Controllers;

use App\Models\GymClass;
use Illuminate\Http\Request;

use App\Http\Requests\GymClass\StoreGymClassRequest;
use App\Http\Requests\GymClass\UpdateGymClassRequest;
use App\Services\GymClassService;
use App\Http\Resources\GymClassResource;

class GymClassController extends Controller
{
    protected $service;

    public function __construct(GymClassService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GymClassResource::collection($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymClassRequest $request)
    {
        $gymClass = $this->service->create($request->validated());
        return new GymClassResource($gymClass);
    }

    /**
     * Display the specified resource.
     */
    public function show(GymClass $gymClass)
    {
                return new GymClassResource($this->service->getById($gymClass));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymClassRequest $request, GymClass $gymClass)
    {
        $gymClass = $this->service->update($gymClass, $request->validated());
        return new GymClassResource($gymClass);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymClass $gymClass)
    {
        $this->service->delete($gymClass);
        return response()->noContent();
    }
}
