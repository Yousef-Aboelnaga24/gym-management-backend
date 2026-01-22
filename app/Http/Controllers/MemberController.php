<?php

namespace App\Http\Controllers;

use App\Models\Member;

// Resource
use App\Http\Resources\MemberResource;

// Services
use App\Services\MemberService;

// Requests
use App\Http\Requests\Member\StoreMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;

class MemberController extends Controller
{
    protected MemberService $service;

    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('user.address')->get();

        return MemberResource::collection($members);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $member = $this->service->create($request->validated());

        return (new MemberResource($member->load('user.address')))
            ->additional(['message' => 'Member created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return new MemberResource($member->load('user.address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member = $this->service->update($member, $request->validated());

        return (new MemberResource($member->load('user.address')))
            ->additional(['message' => 'Member updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $this->service->delete($member);

        return response()->noContent();
    }
}
