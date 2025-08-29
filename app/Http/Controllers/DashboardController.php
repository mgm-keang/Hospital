<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function index()
        {
            $doctors = Doctor::with('status')->get();
            $status_available = $doctors->where('status_id', 1)->count();
            $status_surgery = $doctors->where('status_id',2)->count();
            $status_off_duty = $doctors->where('status_id',3)->count();
             // good to eager load status
            return view('dashboards.index', compact('doctors','status_available','status_surgery','status_off_duty'));
        }
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
}
