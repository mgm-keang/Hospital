<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show login form
    public function loginForm()
    {
        if (!Auth::check()) {
            return view('loginForm');
        } else {
            return redirect()->route('dashboards.index');
        }
    }

    // Handle login submission
    public function login(Request $request)
    {
        $remember = $request->has('remember');

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('dashboards.index');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    // Handle logout
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('loginForm');
    }

    // Show registration form
    public function create()
    {
        $countries = Country::all(); // Uncommented and fixed model reference
        $user = User::all();
        return view('register', compact('countries','users'));
    }

    // Store new user (registration)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username', // use correct table
            'phone_number' => 'required|string|max:30',
            'role'         => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed'
            
        ]);

        User::create([
            'username'     => $validated['username'],
            'phone_number' => $validated['phone_number'],
            'role'         => $validated['role'],
            'password_hash'     => Hash::make($validated['password']),
        ]);

        return redirect()->route('loginForm')
                         ->with('success', 'Account created successfully.');
    }

    // Dashboard index with doctor status counts
    public function index()
    {
        $doctors = Doctor::with('status')->get();

        $status_available = $doctors->where('status_id', 1)->count();
        $status_surgery   = $doctors->where('status_id', 2)->count();
        $status_off_duty  = $doctors->where('status_id', 3)->count();

        return view('dashboards.index', compact('doctors', 'status_available', 'status_surgery', 'status_off_duty'));
    }
}
