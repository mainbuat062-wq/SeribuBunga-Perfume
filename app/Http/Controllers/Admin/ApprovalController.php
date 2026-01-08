<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApprovalToken;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    /**
     * APPROVE admin / superadmin
     */
    public function approve($token)
    {
        $approval = ApprovalToken::where('token', $token)
            ->whereNull('used_at')          // token belum dipakai
            ->where('expired_at', '>', now()) // belum expired
            ->firstOrFail();

        $user = $approval->user;

        // aktifkan akun
        $user->is_active = 1;
        $user->save();

        // tandai token sudah digunakan
        $approval->used_at = Carbon::now();
        $approval->save();

        return view('admin.approval.success', compact('user'));
    }


    /**
     * REJECT admin / superadmin
     */
    public function reject($token)
    {
        $approval = ApprovalToken::where('token', $token)
            ->whereNull('used_at')
            ->firstOrFail();

        $user = $approval->user;

        // hapus user yang diajukan
        $user->delete();

        // tandai token sudah digunakan
        $approval->used_at = Carbon::now();
        $approval->save();

        return view('admin.approval.rejected');
    }
}
