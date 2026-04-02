<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\GeneralSetting;

class PermissionController extends Controller
{
    // Get All Permissions with Pagination
public function index()
{
    $permissions = Permission::with('roles')->latest()->paginate(15);
    $dateFormat = GeneralSetting::first()->datetime_format;

    return response()->json([
        'status' => true,
        'message' => 'Permissions fetched successfully',
        'data' => $permissions,
        'dateFormat' => $dateFormat
    ], 200);
}


    // Create Permission (GET Not Needed in API)
    public function create()
    {
        return response()->json([
            'status' => true,
            'message' => 'Use this endpoint to POST new permission'
        ], 200);
    }

    // Store New Permission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Permission created successfully!',
            'data' => $permission
        ], 201);
    }

    // Show Single Permission
    public function edit($id)
    {
        // $permission = Permission::with(['roles', 'users'])->find($id);
        $permission = Permission::with('roles')->find($id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Permission details fetched successfully',
            'data' => $permission
        ], 200);
    }

    // Update Permission
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        $newName = $request->input('name');

        if ($permission->name !== $newName) {
            $hasRoles = $permission->roles()->exists();
            $hasUsers = $permission->users()->exists();

            if ($hasRoles || $hasUsers) {
                $roleNames = $permission->roles->pluck('name')->toArray();
                $roleList = implode(', ', $roleNames);

                return response()->json([
                    'status' => false,
                    'message' => 'Permission cannot be renamed because it is assigned to roles or users',
                    'details' => [
                        'roles' => $roleNames,
                        'has_users' => $hasUsers
                    ]
                ], 400);
            }
        }

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $permission->update(['name' => $request->name]);

        return response()->json([
            'status' => true,
            'message' => 'Permission updated successfully!',
            'data' => $permission
        ], 200);
    }

    // Delete Permission
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        $hasRoles = $permission->roles()->exists();
        $hasUsers = $permission->users()->exists();

        if ($hasRoles || $hasUsers) {
            $roleNames = $permission->roles->pluck('name')->toArray();

            return response()->json([
                'status' => false,
                'message' => 'Permission cannot be deleted because it is assigned',
                'details' => [
                    'roles' => $roleNames,
                    'has_users' => $hasUsers
                ]
            ], 400);
        }

        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully!'
        ], 200);
    }
}
