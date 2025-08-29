<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class DoctorController extends Controller
{
    // 1. Display a listing of doctors
    public function index()
    {
        $doctors = Doctor::all();   
        return view('doctors.index', compact('doctors' ));
    }

    // 2. Show the form for creating a new doctor
    public function create()
    {
        $countries = \App\Models\Country::all();
        $statuses = \App\Models\Status::all();
        return view('doctors.create', compact('countries','statuses'));
    }

    // 3. Store a newly created doctor in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:doctors,email',
            'phone_number' => 'nullable|string|max:30',
            'gender'       => 'required|in:male,female,other,prefer_not_to_say',
            'address'      => 'required|string',
            'country_id'   => 'required|integer|exists:countries,id',
            'status_id'    => 'required|integer|exists:statuses,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('doctors', 'public');
        }

        // Map form data to Doctor model fields (adjust as necessary)
        Doctor::create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'gender'       => $validated['gender'],
            'address'      => $validated['address'],
            'country_id'   => $validated['country_id'],
            // 'role'         => $validated['role'],
            'image'        => $validated['image'] ?? null,
            'status_id'    => $validated['status_id']
        ]);

        return redirect()->route('doctors.index')
                        ->with('success', 'Doctor created successfully.');
    }


    // 4. Display the specified doctor
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    // 5. Show the form for editing the specified doctor
    public function edit(Doctor $doctor)
    {
        // return view('doctors.edit', compact('doctor'));
        $countries = \App\Models\Country::all();
        $statuses = \App\Models\Status::all();
        // $doctor = Doctor::all();
        return view('doctors.edit', compact('doctor','countries','statuses'));
    }

    // 6. Update the specified doctor in storage
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:doctors,email,' . $doctor->id,
            'phone_number' => 'nullable|string|max:30',
            'gender'       => 'required|in:Male,Female,Other',
            'address'      => 'required|string',
            'country_id'   => 'required|integer|exists:countries,id',
            // 'role'         => 'required|string',
            'status_id'    => 'required|integer|exists:statuses,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Remove old image if exists
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            $validated['image'] = $request->file('image')->store('doctors', 'public');
        }

        $doctor->update($validated);

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor updated successfully.');
    }

    // 7. Remove the specified doctor from storage
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($doctor->image) {
            Storage::disk('public')->delete($doctor->image);
        }

        $doctor->delete();
        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor deleted successfully.');
    }
}
