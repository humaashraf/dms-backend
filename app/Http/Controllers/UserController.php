<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Users fetched successfully!',
            'data' => $users
        ], 200);
    }

    // Create (for frontend dropdown)
    public function create()
    {
        $roles = Role::all();
        return response()->json([
            'status' => true,
            'message' => 'Roles fetched successfully!',
            'roles' => $roles
        ], 200);
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'nullable',
            'username' => 'nullable|unique:users,username',
            'phone' => 'nullable',
            'type' => 'required|in:staff,user',
            'status' => 'required|in:0,1',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'phone' => $request->phone,
            'type' => $request->type,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully!',
            'data' => $user
        ], 201);
    }

    // Show
    public function show($id)
    {
        $user = User::with('roles')->find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'User details fetched successfully',
            'data' => $user
        ], 200);
    }

    // Edit (for form with roles)
    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'User & roles fetched successfully',
            'data' => $user,
            'roles' => $roles
        ], 200);
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'nullable',
            'username' => 'nullable|unique:users,username,' . $id,
            'phone' => 'nullable',
            'type' => 'required|in:staff,user',
            'status' => 'required|in:0,1',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->type = $request->type;
        $user->status = $request->status;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles($request->role);

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully!',
            'data' => $user
        ], 200);
    }

    // Delete
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
