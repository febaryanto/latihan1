<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('user.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Use 'confirmed' rule
            'role' => 'required|string'
        ]);

        // Create the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role = $request->role;
        $user->save();

        // Redirect or respond as needed
        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validate the input (password is optional)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure the email is unique but allow current user's email
            'password' => 'nullable|string|min:8|confirmed', // Password is optional and must match the confirmation if provided
            'role' => 'required|in:admin,user'
        ]);

        // Update the user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update the password if it is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil dihapus');
    }
}
