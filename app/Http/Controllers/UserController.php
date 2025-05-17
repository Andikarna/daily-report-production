<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMenu;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('userRole')->get();
        $roles = UserRole::all();
        $menus = UserMenu::all();
        return view('user_management.userManagement', compact('users', 'roles', 'menus'));
    }

    public function updateRole(Request $request)
    {
        $user = User::find($request->user_id);
        $user->role_id = $request->role_id;
        $user->menus()->sync($request->menu_ids); // Assuming a many-to-many relationship
        $user->save();

        return response()->json(['message' => 'Role and menus updated successfully.']);
    }

    public function updateMenus(Request $request)
    {
        $role = UserRole::find($request->role_id);
        $role->menus()->sync($request->menu_ids); // Assuming a many-to-many relationship
        return response()->json(['message' => 'Menus updated successfully for the role.']);
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
