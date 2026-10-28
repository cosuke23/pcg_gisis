<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserAccountCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'employee_no' => 'required|unique:users',

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'agency' => 'nullable',

            'office' => 'nullable',

            'position' => 'nullable',

            'country' => 'required',

            'role' => 'required',

            'status' => 'required',

            'password' => 'required|min:8|confirmed',

        ]);

        // Keep original password for email
        $plainPassword = $validated['password'];

        // Hash password before saving
        $validated['password'] = Hash::make($plainPassword);

        try {

            // Create user
            $user = User::create($validated);

            Log::info('New user account created.', [

                'created_by' => [
                    'id' => Auth::id(),
                    'name' => Auth::user()?->name,
                    'email' => Auth::user()?->email,
                ],

                'new_user' => [
                    'id' => $user->id,
                    'employee_no' => $user->employee_no,
                    'name' => $user->name,
                    'email' => $user->email,
                    'agency' => $user->agency,
                    'office' => $user->office,
                    'position' => $user->position,
                    'country' => $user->country,
                    'role' => $user->role,
                    'status' => $user->status,
                ],

                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now()->toDateTimeString(),

            ]);

            // Send credentials email
            Mail::to($user->email)->send(
                new UserAccountCreated($user, $plainPassword)
            );

            Log::info('User account credentials email sent.', [

                'user_id' => $user->id,
                'employee_no' => $user->employee_no,
                'email' => $user->email,
                'sent_at' => now()->toDateTimeString(),

            ]);

            return redirect()
                ->route('users.index')
                ->with('success', 'User created successfully. Credentials have been emailed.');
        } catch (\Exception $e) {

            Log::error('Failed to create user or send credentials email.', [

                'created_by' => [
                    'id' => Auth::id(),
                    'name' => Auth::user()?->name,
                    'email' => Auth::user()?->email,
                ],

                'request_data' => [
                    'employee_no' => $request->employee_no,
                    'name' => $request->name,
                    'email' => $request->email,
                    'agency' => $request->agency,
                    'office' => $request->office,
                    'position' => $request->position,
                    'country' => $request->country,
                    'role' => $request->role,
                    'status' => $request->status,
                ],

                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),

                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),

                'failed_at' => now()->toDateTimeString(),

            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the user. Please check the application logs.');
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([

            'employee_no' => 'required|unique:users,employee_no,' . $user->id,

            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'agency' => 'nullable',

            'office' => 'nullable',

            'position' => 'nullable',

            'country' => 'required',

            'role' => 'required',

            'status' => 'required',

        ]);

        if ($request->filled('password')) {

            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
