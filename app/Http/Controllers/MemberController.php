<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

//Resource
use App\Http\Resources\MemberResource;

//Request
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('user.address')->get();
        return MemberResource::collection($members);
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
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('members', 'public');
            $validated['photo'] = $path;
        }

        $member = Member::create($validated);

        return (new MemberResource($member->load('user.address')))
            ->additional([
                'message' => 'Member created successfully'
            ])
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
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {

            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }

            $path = $request->file('photo')->store('members', 'public');
            $validated['photo'] = $path;
        }

        $member->update($validated);

        return (new MemberResource($member->load('user.address')))
            ->additional([
                'message' => 'Member updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();

        return response()->noContent();
    }
}
