<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
    $users = User::paginate(5); // Fetch all users and 5 users per page
    $totalUsers = $users->count();
    $adminUsers = $users->where('role', 'admin')->count();
    $hrUsers = $users->where('role', 'HR')->count();
    $normalUsers = $users->where('role', 'normal')->count();

    // Make sure to pass all these variables to the view
    return view('users.manage', compact('users', 'totalUsers', 'adminUsers', 'hrUsers', 'normalUsers'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Validate the role
        $data = $request->validate([
            'role' => 'required|in:normal,HR,admin'
        ]);

        // Update the user's role
        $user->update([
            'role' => $data['role']
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('message', 'User role updated successfully.');
    }
}
