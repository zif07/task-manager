<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Helpers\AuditLogger;

class AdminController extends Controller
{
    /**
     * 🔐 Enforce admin-only access (SSD requirement)
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * 📊 Admin Dashboard
     * - System statistics overview
     */
    public function dashboard()
    {
        AuditLogger::log(
            'view_admin_dashboard',
            'Admin accessed dashboard overview'
        );

        return view('admin.dashboard', [
            'totalUsers'     => User::count(),
            'totalTasks'     => Task::count(),
            'completedTasks' => Task::where('status', 'completed')->count(),
        ]);
    }

    /**
     * 👥 User Management Page
     * - View all registered users
     */
    public function users()
    {
        AuditLogger::log(
            'view_users',
            'Admin viewed user management page'
        );

        return view('admin.users', [
            'users' => User::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * 🔄 Toggle user role (admin <-> user)
     * - Prevents self-demotion (SSD safety control)
     * - Logs action to audit trail
     */
    public function toggleRole($id, Request $request)
    {
        $user = User::findOrFail($id);

        // 🔐 SSD: Prevent admin from changing own role
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $oldRole = $user->role;
        $newRole = $oldRole === 'admin' ? 'user' : 'admin';

        $user->role = $newRole;
        $user->save();

        // 🔍 AUDIT LOG (CRITICAL SECURITY EVENT)
        AuditLogger::log(
            'role_changed',
            "Changed role for {$user->email} from {$oldRole} to {$newRole}"
        );

        return back()->with('success', 'User role updated successfully.');
    }

    /**
     * 📋 Task Monitoring Page
     * - View all tasks with user ownership
     */
    public function tasks()
    {
        AuditLogger::log(
            'view_all_tasks',
            'Admin viewed all user tasks'
        );

        return view('admin.tasks', [
            'tasks' => Task::with('user')
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    /**
     * 🛡 Audit Logs Page
     * - View all security-relevant system actions
     */
    public function logs()
    {
        AuditLogger::log(
            'view_audit_logs',
            'Admin accessed audit logs'
        );

        return view('admin.logs', [
            'logs' => AuditLog::with('user')
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }
}
