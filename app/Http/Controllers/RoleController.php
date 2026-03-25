<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Get All Roles
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return response()->json([
            'status' => true,
            'message' => 'Roles fetched successfully',
            'data' => $roles
        ], 200);
    }

    // Create Role - Fetch Permissions
    public function create()
    {
        $permissions = Permission::all();

        return response()->json([
            'status' => true,
            'message' => 'Permissions fetched successfully',
            'permissions' => $permissions
        ], 200);
    }

    // Store New Role
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|unique:roles,name',
    //         'permissions' => 'nullable|array'
    //     ]);

    //     $role = Role::create(['name' => $request->name]);
    //     if ($request->has('permissions')) {
    //         $role->syncPermissions($request->permissions);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Role created successfully',
    //         'data' => $role->load('permissions')
    //     ], 201);
    // }
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:roles,name',
        'permissions' => 'nullable|array'
    ]);

    $role = Role::create(['name' => $request->name]);

    if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions); // ✅ Permissions as array
    }

    return response()->json([
        'status' => true,
        'message' => 'Role created successfully',
        'data' => $role->load('permissions')
    ], 201);
}



    // Show Single Role
    public function show($id)
    {
        $role = Role::with('permissions')->find($id);

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Role details fetched successfully',
            'data' => $role
        ], 200);
    }

    // Edit Role (Fetch Role + Permissions)
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ], 404);
        }

        $permissions = Permission::all();

        return response()->json([
            'status' => true,
            'message' => 'Role & Permissions fetched successfully',
            'role' => $role,
            'permissions' => $permissions
        ], 200);
    }

    // Update Role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'nullable|array'
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return response()->json([
            'status' => true,
            'message' => 'Role updated successfully',
            'data' => $role->load('permissions')
        ], 200);
    }

    // Delete Role
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ], 404);
        }

        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully'
        ], 200);
    }
}
