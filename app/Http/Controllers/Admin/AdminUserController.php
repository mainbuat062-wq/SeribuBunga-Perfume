<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ApprovalToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * List admin
     */
    public function index()
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $admins = User::whereIn('role', ['admin', 'superadmin'])->get();

        return view('admin.admin_user.index', compact('admins'));
    }

    /**
     * Tambah admin / superadmin
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with(strtolower($value), '@gmail.com')) {
                        $fail('Hanya akun Gmail yang diperbolehkan.');
                    }
                }
            ],
            'password' => 'required|min:8',
            'role' => 'required|in:admin,superadmin',
        ]);

        /**
         * ADMIN → langsung aktif
         */
        if ($request->role === 'admin') {
            User::create([
                'name'      => $request->name,
                'email'     => strtolower($request->email),
                'password'  => Hash::make($request->password),
                'role'      => 'admin',
                'is_active' => true,
            ]);

            return back()->with('success', 'Admin berhasil ditambahkan.');
        }

        /**
         * SUPER ADMIN → via approval email
         */
        $user = User::create([
            'name'      => $request->name,
            'email'     => strtolower($request->email),
            'password'  => Hash::make($request->password),
            'role'      => 'superadmin',
            'is_active' => false,
        ]);

        $token = ApprovalToken::create([
            'user_id'    => $user->id,
            'token'      => Str::random(64),
            'expired_at' => now()->addHours(24),
        ]);

        Mail::send('emails.approval_superadmin', [
            'user'  => $user,
            'token' => $token->token,
        ], function ($message) {
            $message->to(config('mail.from.address'));
            $message->subject('Persetujuan Penambahan Super Admin');
        });

        return back()->with(
            'success',
            'Pengajuan Super Admin dikirim. Menunggu persetujuan melalui email.'
        );
    }

    /**
     * Hapus admin
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        if ($user->role === 'superadmin') {
            return back()->withErrors('Super Admin tidak boleh dihapus.');
        }

        $user->delete();

        return back()->with('success', 'Admin berhasil dihapus.');
    }

    /**
     * Update role admin
     */
    public function updateRole(Request $request, $id)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $request->validate([
            'role' => 'required|in:admin,superadmin',
        ]);

        $user = User::findOrFail($id);

        /**
         * Tidak boleh menurunkan satu-satunya superadmin
         */
        if (
            $user->role === 'superadmin' &&
            $request->role === 'admin' &&
            User::where('role', 'superadmin')->count() === 1
        ) {
            return back()->withErrors('Minimal harus ada satu Super Admin.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role admin berhasil diperbarui.');
    }
}
