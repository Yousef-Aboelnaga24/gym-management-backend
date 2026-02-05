<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Plan;

// Requests
use App\Http\Requests\Memberships\StoreMembershipRequest;
use App\Http\Requests\Memberships\UpdateMembershipRequest;

// Service
use App\Services\MembershipService;

// Resource
use App\Http\Resources\MembershipResource;

class MemberShipController extends Controller
{

      protected $service;

    public function __construct(MembershipService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return MembershipResource::collection($this->service->getAll());
    }

    public function store(StoreMembershipRequest $request)
    {
        $membership = $this->service->create($request->validated());
        return new MembershipResource($membership);
    }

    public function show(Membership $membership)
    {
        $membership->load(['member', 'plan']);
        return new MembershipResource($membership);
    }

    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership = $this->service->update($membership, $request->validated());
        return new MembershipResource($membership);
    }

    public function destroy(Membership $membership)
    {
        $this->service->delete($membership);
        return response()->json(['message' => 'Membership deleted successfully'], 200);
    }
}
