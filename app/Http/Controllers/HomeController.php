<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\StatisticsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function admin_dashboard(StatisticsService $statisticsService)
    {
        $statistics = $statisticsService->getStatistics();
        return view('admin.dashboard', $statistics);
    }
    
    function trackVisit(StatisticsService $statisticsService)
    {
        $visitors = $statisticsService->getUniqueVisitorsPerDay();        
        return view('admin.visitors.unique-visitors', $visitors);
    }
    function user_manage()
    {
        $users = User::where('type', '!=', 'admin')->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }
    function user_show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', ['user' => $user]);
    }
    // Show the Set Role form
    public function user_set_role($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // get all roles to show in dropdown
        return view('admin.users.set-role', compact('user', 'roles'));
    }

    // Update user role
    public function user_update_role(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        // Assign new role (sync removes old roles and assigns new)
        $user->role()->sync([$request->role_id]);

        return redirect()->route('user.set.role', $user->id)
                         ->with('success', 'Role updated successfully!');
    }
    function user_update_status(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Update the status
        $user->status = $request->input('status');
        $user->save();

        return response()->json(['success' => true]);
    }
}
