<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.backend.users-list',  ['users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * View the specified resource from storage.
     */
    public function view()
    {
        $properties = Property::get(); // Fetch all property records
        return view('seller.property-list',  ['properties' => $properties]);
    }
    /**
     * Approve the specified resource from storage.
     */
    public function approve(User $user)
    {
        try {
            // Check if the user is already approved
            if ($user->is_verified !== 1) {
                // Find properties related to the user and update the 'is_verified' column
                $user->properties->each(function ($property) {
                    if ($property->is_verified !== 1) {
                        $property->update(['is_verified' => 1]);
                    }
                });
                // Update the 'is_verified' column for the user
                $user->update(['is_verified' => 1]);
            return redirect()->route('admin.users-list')->with('sucess', 'User Approved Successfully');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
